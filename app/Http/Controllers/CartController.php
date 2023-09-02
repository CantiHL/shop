<?php

namespace App\Http\Controllers;

use App\Models\paymethod;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function __construct(private readonly paymethod $paymethod)
    {
    }

    public function index(){
        $cartItem=session()->get('cart');
        $paymethods=$this->paymethod->getPaymethods();
        return view('clients.cart.cart_item',compact('cartItem','paymethods'));
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
                'name'=>$product->name,
                'price'=>$product->price,
                'image'=>$product->image,
                'quantity'=>1
            ];
            session()->put('cart',$cart);
        }
    }
    public function update_cart_item(Request $request)
    {
        $id=$request->id;
        $newquantity=$request->quantity;
        $product=Product::where('id',$id)->first();
        if ($product->quantity>=$newquantity){
            $cart=session()->get('cart');
            $id=$request->id;
            $quantity=$newquantity;
            $cart[$id]['quantity']=$quantity;
            session()->put('cart',$cart);
            return back();
        }else{
            return back()->with('message','sorry! quantity doesnt enough!');
        }

    }
    public function delete_item_cart(Request $request){
        $cart=(session()->get('cart'));
        unset($cart[$request->id]);
        session()->put('cart',$cart);
        return back();
    }

}
