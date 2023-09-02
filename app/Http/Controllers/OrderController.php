<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;
class OrderController extends Controller
{
    public function __construct(
        private readonly Order $order,
        private readonly Product $product
    ){

    }
    public function order()
    {
        $orders=Order::with(['product','payment'])->get();
        return view('admin.customer_orders.customer_order_list',compact(['orders']));
    }
    public function update_order(Request $request)
    {
        $data=[
            'status'=>$request->status,
            'updated_at'=>date('Y-m-d H:i:s')
        ];
        $this->order->update_status($request->id,$data);
        return back();
    }
    public function delete_order(Request $request){
        $this->order->deleteOrder($request->id);
        return back();
    }
    public function statistical(Request $request){
        $quantity = Order::where('orders.status','done')->sum('quantity');
        $revenue = Order::join('products', 'orders.product_id', '=', 'products.id')->where('orders.status','done')
            ->sum(DB::raw('orders.quantity * products.price'));
        $details = $this->order->getDetailsOrder();
        return view('admin.statistical.statistical', compact(['quantity','revenue','details']));
    }
    public function expportOrders(){
        return Excel::download(new OrdersExport(), 'orders.xlsx');
    }
    public function updateOrderQuantity(Request $request){

        if (array_key_exists('update',$request->input())){
            $order_id=$request->order_id;
            $product_id=$request->product_id;
            $order=Order::where('id',$order_id)->first();
            $product=Product::where('id',$product_id)->first();
            if ($order->quantity>=$request->quantity){
                $new_quantity=$product->quantity+$order->quantity-$request->quantity;
                $this->product->updateQuantity($product_id,$new_quantity);
                $this->order->updateQuantity($order_id,$request->quantity);
            }else{
                $currenqtt=$request->quantity-$order->quantity;
                if($product->quantity<$currenqtt){
                    return back()->with('message','quantity unavailable');
                }else{
                    $new_quantity=$product->quantity-$currenqtt;
                    $this->product->updateQuantity($product_id,$new_quantity);
                    $this->order->updateQuantity($order_id,$request->quantity);
                }
            }
        }
        if (array_key_exists('cancel',$request->input())){
            $product=Product::where('id',$product_id)->first();
            $new_quantity=$product->quantity+$request->quantity;
            $this->product->updateQuantity($product_id,$new_quantity);
            $this->order->update_status($order_id,['status'=>'cancel']);
        }
        return back();
    }
}
