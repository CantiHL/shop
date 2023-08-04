<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
class CartController extends Controller
{

    private $cart;
    private $user;
    public function __construct()
    {
        $this->cart=new Cart;
        $this->user=new User;
    }
    public function index(){
        $cartItem=session()->get('cart');
       
        return view('clients.cart.cart_item',compact('cartItem'));
    }
    public function add_to_cart($id)
    {
       $product=Product::find($id);
      
        $cart=session()->get('cart');
        if (isset($cart[$id])) {
            $cart[$id]['quantity']+=1;
        }
        else
        {
            $cart[$id]=[
                'id'=>$id,
                'name'=>$product->product_name,
                'price'=>$product->product_price,
                'image'=>$product->product_image,
                'quantity'=>1
            ];
            session()->put('cart',$cart);
        }
    }
    public function update_cart_item(Request $request)
    {
       $cart=session()->get('cart');
       $id=$request->id;
       $quantity=$request->quantity;
       $cart[$id]['quantity']=$quantity;
       session()->put('cart',$cart);
       return back();
    }
    public function delete_item_cart(Request $request){
        $cart=(session()->get('cart'));
        unset($cart[$request->id]);
        session()->put('cart',$cart);
        return back();
    }
   
    
}
