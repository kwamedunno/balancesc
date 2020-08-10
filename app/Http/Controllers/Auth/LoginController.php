<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Exception;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLogin(){
        return view('login');
    }

    public function showLogin2(){
        return view('login2');
    }

    public function login(Request $request){
        if(Auth::guard('staff')->attempt(['email' => $request->username, 'password' => $request->password], $request->remember)){
            return redirect()->route('show.logged.profile');
        }

        return view('login')
            ->with('message', 'Invalid login credentials');
    }

    //Google login 
    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback() {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = Staff::where('email', $user->email)->first();
            if ($finduser) {
                Auth::guard('staff')->login($finduser);
                return redirect()->route('show.profile',Auth::user()->id);
            } else {
                $newUser = Staff::create(['name' => $user->name, 'email' => $user->email, 'google_id' => $user->id]);
                Auth::guard('staff')->login($newUser);
                return redirect()->back();
            }
        }
        catch(Exception $e) {
            return redirect('auth/google');
        }
    }
    //end of Google login

    public function logout(){
        Auth::guard('staff')->logout();
        return redirect(route('show.login'));
    }


}
