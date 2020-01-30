<?php

namespace App\Http\Controllers\Auth;

use App\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    public function showResetPassword(){
        return view('auth.passwords.reset');
    }

    public function updatePassword(Request $request){
        $staff =  Staff::find(Auth::user()->id);
        if(($request->password_confirmation)!=($request->password)){
            return redirect()->back()
                ->with('error','Passwords do not match');
        }
        else{
            $staff->password = Hash::make($request->password);
            $staff->save();
            // $staff->update(['password'=>$staff->password]);
            
            return redirect()->back()
                ->with('success','Password changed successfully');
        }
    }

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';
}
