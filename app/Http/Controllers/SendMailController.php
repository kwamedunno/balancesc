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

    
    //Create ScoreCard Mail
    function createCardMail(Request $request){
        
       
        $mailstaff = Staff::where('id','=',$request->staff)->first();
        $mailscorecard = ScoreCard::where('period','=',$request->month."-".$request->year)->where('staff','=',$mailstaff->id)->first();

        $this->validate($request, [
            'staff'     =>  'required',
            'month'     =>  'required',
            'year'      =>  'required'
        ]);

        $body = "<h1>Welcome to BSC</h1><br><p>I'm a fucking legend. . . A fuckin' legend</p>";

        $mailStructure = array(
            'staff'     =>  $request->staff,
            'month'     =>  $request->month,
            'year'      =>  $request->year,
            'scorecard' =>  $mailscorecard,
            'staffname' =>  $mailstaff['name'],
            "body" => $body
        );

        Mail::to($mailstaff->email)->send(new SendMail($mailStructure));
    }

    //Save ScoreCard Mail
    function saveCardMail(Request $request){

        $mailstaff = Staff::where('id','=',$request->staff)->first();
        $mailscorecard = ScoreCard::where('period','=',$request->month."-".$request->year)->where('staff','=',$mailstaff->id)->first();

        $this->validate($request, [
            'staff'     =>  'required',
            'month'     =>  'required',
            'year'      =>  'required'
        ]);


        $mailStructure = array(
            'staff'     =>  $request->staff,
            'month'     =>  $request->month,
            'year'      =>  $request->year,
            'scorecard' =>  $mailscorecard,
            'staffname' =>  $mailstaff['name'],
            "body"      => $body
        );

        Mail::to($mailstaff->email)->send(new SendMail($mailStructure));
    }
}
