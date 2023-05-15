<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    function login(){
        return view('auth/login');
    }

    function loginPost(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');
        if(Auth::attempt($credentials) && (auth()->user()->status == 'Active')){
            return redirect()->intended(route('dashboard'));
        }
        else if(Auth::attempt($credentials) && (auth()->user()->status == 'Deactivated')){
            return redirect()->route('login')->with('err', 'Your account is deactivated, please contact Admin.');
        }
        return redirect()->route('login')->with('err', 'Invalid username or password');
        
    }

    function logout(){
        Session::flush();
        Auth::logout();
        return redirect()->route('login');
    }
}