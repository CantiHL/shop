<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
session_start();
class AdminController extends Controller
{
    private $product;
    private $cart;

    public function __construct()
    {
        $this->cart=new Cart();
        $this->product=new Product();
    }

    public function index()
    {
      $title="Welcome To Admin Dashboard";
      return view('admin.home',compact('title'));
    }
    public function order()
    {
      $data=$this->cart->list_order();
      return view('admin.customer_orders.customer_order_list',compact('data'));
    }
    public function update_order(Request $request)
    {
      $data=[
        'status'=>$request->status,
        'updated_at'=>date('Y-m-d H:i:s')
      ];
      $data=$this->cart->update_status($request->id,$data);
      return back();
    }
    public function delete_order(Request $request){
      $this->cart->deleteoder($request->id);
       return back();
   }
}
