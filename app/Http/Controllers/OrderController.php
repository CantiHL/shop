<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

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
}
