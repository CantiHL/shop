<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(private readonly User $user)
    {
    }

    public function register(Request $request)
    {
        $request->validate([
            'user_name'=> 'required',
            'email'=> 'required|email|unique:users',
            'password'=> 'required',
            'address'=> 'required',
            'phone'=> 'required'
        ]);
        $data=[
            'user_name'=>$request->user_name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'address'=>$request->address,
            'phone'=>$request->phone,
            'created_at'=>date('Y-m-d H:i:s')
        ];
        $this->user->register($data);
        $request->session()->flash('message', 'register success');
        return back();
    }
    public function login()
    {
        return view('login');
    }
    public function check(Request $request)
    {

        $request->validate([
            'email_login'=> 'required',
            'password_login'=> 'required'
        ]);
        $email=$request->email_login;
        $password=$request->password_login;

        $user=$this->user->getUserByEmail($email);

        if($user){
            if (Hash::check($password,$user->password)){
                if ($user->position===0) {
                    $request->session()->put('id', $user->id);
                    $request->session()->put('user_name', $user->user_name);
                    $request->session()->put('admin', $user->id);
                    return redirect()->route('dashboard');
                }else{
                    $request->session()->put('id', $user->id);
                    $request->session()->put('user_name', $user->user_name);
                    return redirect()->route('client_home');
                }
            }else{
                return back()->with('message1','Incorrect Password');
            }
        }
        return back()->with('message1','Email or Password is Incorrect');
    }
    public function logout(Request $request){
        $request->session()->forget('id');
        $request->session()->forget('user_name');
        $request->session()->forget('admin');
        return redirect()->route('login');

    }
}
