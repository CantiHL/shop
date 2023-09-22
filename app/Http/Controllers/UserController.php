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
         return back()->with('message','Success');
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
        return back()->with('message', 'Success');
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
