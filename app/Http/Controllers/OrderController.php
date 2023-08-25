<?php

namespace App\Http\Controllers;

use App\Exports\OrdersExport;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;
class OrderController extends Controller
{
    public function __construct(
        private readonly Order $order
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
}
