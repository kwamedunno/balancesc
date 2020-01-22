<?php

namespace App\Http\Controllers\Auth;

use App\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        $staff =  Staff::where('id','=',Auth::user()->id)->get('password')->first();
        $staff->password = $request->password;
        if(($request->password_confirmation)!=($request->password)){
            return redirect()->back()
                ->with('error','Passwords do not match');
        }
        else{
        $staff->update(['password'=>$staff->password]);
        
        return view('login')
            ->with('success','Password successfully changed');
        }
    }

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';
}
