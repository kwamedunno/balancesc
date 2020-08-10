<?php

namespace App\Http\Controllers;

use App\Staff;
use App\ScoreCard;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMailController extends Controller
{
    //

    function index(){

        return view('/contact-us');

    }

    function sendmail(Request $request){
        
        $mailstaff = Staff::where('id','=',$request->staff)->first();
        $mailscorecard = ScoreCard::where('period','=',$request->month."-".$request->year)->where('staff','=',$mailstaff->id)->first();
        

        $this->validate($request, [
            'staff'      =>  'required',
            'month'     =>  'required',
            'year'   =>  'required'
        ]);
        
        $data_createcard = array(
            'staff'      =>  $request->staff,
            'month'     =>  $request->month,
            'year'   =>  $request->year,
            'scorecard' => $mailscorecard,
            'staffname' => $mailstaff['name']
        );

        Mail::to($mailstaff->email)->send(new SendMail($data_createcard));
    }
}
