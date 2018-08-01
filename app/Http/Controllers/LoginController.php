<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        //判断是否已经登陆
        if(Auth::check()){
            return redirect()->intended(route('records.index'));
        }

        if($request->isMethod('post')){
            $email = $request->input('email');
            $password = $request->input('password');
            $remember = $request->input('remember', 0);

            if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
                return redirect()->intended(route('records.index'));
            }
        }
        return view('login.login');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
