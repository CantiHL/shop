<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Session;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
session_start();
class AdminController extends Controller
{
    private $product;

    public function __construct(
        private readonly Order $order,
        private readonly User $user,
        private readonly Payment $payment
    )
    {
        $this->product=new Product();
    }

    public function index()
    {
      $title="Welcome To Admin Dashboard";
      return view('admin.home',compact('title'));
    }
    public function order()
    {
        $payments=$this->payment->list_payed();
        $products=$this->product->list();
        $orders=$this->order->list_order();
        foreach ($orders as $order){
            $order->id_product= json_decode( $order->id_product);
            $order->quantity=json_decode($order->quantity);
        }
      return view('admin.customer_orders.customer_order_list',compact(['orders','products','payments']));
    }
    public function update_order(Request $request)
    {
      $data=[
        'status'=>$request->status,
        'updated_at'=>date('Y-m-d H:i:s')
      ];
      $data=$this->order->update_status($request->id,$data);
      return back();
    }
    public function delete_order(Request $request){
      $this->order->deleteOrder($request->id);
       return back();
   }

}
