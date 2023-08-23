<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle(Request $request){
        try {

            $google_user=Socialite::driver('google')->user();
//            $user=User::where('google_id',$google_user->getId())->get();
//
//            if (!$user){
//                $new_user= new User();
//                $new_user->user_name=$google_user->getName();
//                $new_user->email=$google_user->getEmail();
//                $new_user->google_id=$google_user->getId();
//                $new_user->save();
//                dd($new_user);
//                Auth::loginUsingId($new_user);
//
//                return redirect()->intended('client_home');
//            }else{
//                Auth::loginUsingId($user->id);
//
//                return redirect()->intended('client_home');
//
//            }
                $request->session()->put('id', $google_user->getId());
                $request->session()->put('user_name', $google_user->getName());
                return redirect()->route('client_home');

        }catch (\Throwable $th){
            return $th->getMessage();
        }
    }
}
