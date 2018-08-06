<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->only('login');

        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request){
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
