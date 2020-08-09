<?php

namespace App\Http\Controllers;

use App\Staff;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    //

    function index(){

        return view('/contact-us');

    }

    function send(Request $request){

        $mailstaff= Staff::where('name','=',$request->staff)->first() ;
        $mailscorecard = ScoreCard::where('month','=',$request->month)->where('year','=',$request->year)->first();

        $this->validate($request, [
            'staff'      =>  'required',
            'month'     =>  'required',
            'year'   =>  'required'
        ]);
        
        $data_createcard = array(
            'staff'      =>  $request->staff,
            'month'     =>  $request->month,
            'year'   =>  $request->year
        );

        Mail::to('eka@myzeepay.com')->send(new SendMail($data_createcard));
        
        return back()->with('success','Your message has been sent successfully');



    }
}
