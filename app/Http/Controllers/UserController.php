<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Mail;

class UserController extends Controller
{
    private $user;
    public function __construct(
        private readonly Order $order,
        private readonly PaypalController $paypalController,
        private readonly Product $product
    )
    {
        $this->user=new User();
    }

     public function account()
     {
         $user=$this->user->getUserById(session('id'));
         $ordered=Order::with('product')->where('user_id',session('id'))->get();
        return view('account', compact(['user','ordered']));
     }
     public function update_account(Request $request)
     {
         $id=session('id');
         $request->validate([
             'name'=>'required',
             'email'=>'required|email|unique:users,email,'.$id,
             'phone'=>'required',
             'address'=>'required',

         ]);
         $data=[
             'user_name'=>$request->name,
             'email'=>$request->email,
             'phone'=>$request->phone,
             'address'=>$request->address
         ];
         $this->user->update_user($id,$data);
         return back()->with('message_success','Update Successfully');
    }
    public function checkout(Request $request)
    {
        $email=null;
        $name=null;
        $data=[];
        $orderID=[];
        $carts=session()->get('cart');
        foreach ($carts as $cart){
            if (session()->has('id')) {
                $id_user=session('id');
                $user=User::find($id_user);
                $email=$user->email;
                $name=$user->user_name;
                $data=[
                    'product_id'=>$cart['id'],
                    'user_id'=>$id_user,
                    'quantity'=>$cart['quantity'],
                    'name'=>$name,
                    'phone'=>$user->phone,
                    'email'=>$email,
                    'address'=>$user->address,
                    'note'=>$request->note,
                    'created_at'=>date('Y-m-d H:i:s')
                ];
            }else{
                $email=$request->cus_email;
                $name=$request->cus_name;
                $request->validate([
                    'cus_name'=>'required|min:2',
                    'cus_phone'=>'required',
                    'cus_address'=>'required',
                    'cus_email'=>'required|email'
                ],[
                    'cus_name.required'=>'Enter your name Please!',
                    'cus_name.min'=>'Enter your real Name Please!',
                    'cus_phone.required'=>'Enter your phone Please!',
                    'cus_email.required'=>'Enter your email Please!',
                    'cus_email.email'=>'Enter your correct email!',
                    'cus_address.required'=>'Enter your address Please!'
                ]);
                $data=[
                    'product_id'=>$cart['id'],
                    'quantity'=>$cart['quantity'],
                    'name'=>$name,
                    'phone'=>$request->cus_phone,
                    'email'=>$email,
                    'address'=>$request->cus_address,
                    'note'=>$request->note,
                    'created_at'=>date('Y-m-d H:i:s')
                ];
            }
            $product=Product::where('id',$cart['id'])->first();
            $new_quantity=$product->quantity-$cart['quantity'];
            $this->product->updateQuantity($cart['id'],$new_quantity);
            $orderID[]=$this->order->insertOrder($data);
        }
        $request->request->add(['orderID'=>$orderID]);
        Mail::send('emails.order',compact('carts'),function ($mail) use($name, $email){
            $mail->subject('Thanks');
            $mail->to($email,$name);
        });
        if ($request->input('payment_method')=='paypal'){
            $this->paypalController->pay($request);
        }
        session()->forget('cart');
        return back();
    }
    public function userInfo()
    {
        $data_users=$this->user->list_user();
        return view('admin.users.list_user',compact(['data_users']));
    }

    public function add_form()
    {
        return view('admin.users.add_user');
    }
    public function add_to_db(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'email'=> 'required|email|unique:users',
            'password'=> 'required',
            'address'=> 'required',
            'phone'=> 'required'
        ]);
        $data=[
            'user_name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'address'=>$request->address,
            'phone'=>$request->phone,
            'created_at'=>date('Y-m-d H:i:s')
        ];
        if ($data) {
            if ($this->user->insert($data)) {
                $request->session()->flash('message', 'Success');
                return back();
            } else {
                $request->session()->flash('message', 'Error');
                return back();
            }

        }
    }
    public function update_form($id)
    {
        $data=$this->user->getUserById($id);
        return view('admin.users.update_user',compact(['data']));
    }

    public function update_to_db(Request $request,$id)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$id,
            'phone'=>'required',
            'address'=>'required',

        ]);

        $data=[
            'user_name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
        ];
        $this->user->update_user($id,$data);
        $request->session()->flash('message', 'Success');
        return back();
    }
    public function delete_category(Request $request,$id)
    {
        $this->user->deleteById($id);
        $request->session()->flash('message', 'Delete success');
        return back();
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password'=>'required',
            'newpassword'=>'required',
        ]);
        $user=User::find(session('id'))->first();
        if(Hash::check($request->newpassword,$user->password)){
            $data=[
                'password'=>Hash::make($request->newpassword)
            ];
            $this->user->updatePassword($user->id,$data);
            $request->session()->flash('message', 'success');
        }
        else{
            $request->session()->flash('message', 'password incorrect');
        }
        return back();
    }
}
