<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login(){
        return view('admin.pages.authentications.login');
    }

    public function postLogin(Request $request){
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        $credentials = array(
            'email' => $request['email'],
            'password' => $request['password'],
        );

        if(Auth::guard('web')->attempt($credentials)){
            if(auth()->user()->status == 1){
                return redirect()->route('admin.dashboard');
            }elseif(auth()->user()->status == 2){
                Auth::guard('web')->logout();
                return redirect()->route('admin.login')->with('fail', 'Your account has been deactivated');
            }
        }else{
            return redirect()->route('admin.login')->with('fail', 'The email or password you entered is incorrect. Please try again');
        }
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('admin.login')->with('fail', 'You have been logged out');
    }
}
