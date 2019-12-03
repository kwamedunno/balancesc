<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLogin(){
        return view('login');
    }

    public function login(Request $request){
        if(Auth::guard('staff')->attempt(['email' => $request->username, 'password' => $request->password], $request->remember)){
            return redirect()->route('show.dashboard');
        }

        return view('login')
            ->with('message', 'Invalid login credentials');
    }

    public function logout(){
        Auth::guard('staff')->logout();
        return redirect(route('show.login'));
    }
}
