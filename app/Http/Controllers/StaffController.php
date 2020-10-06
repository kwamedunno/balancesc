<?php

namespace App\Http\Controllers;

use Auth;
use App\Role;
use App\Staff;
use App\ScoreCard;

use App\Department;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class StaffController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:staff');
    }

    public function showStaff(){
        if (Auth::user()->role == 1) {
            # show all
            $staff = Staff::with('role', 'department','scorecard')->get()->toArray();
            $departments = Department::get()->toArray();
        }elseif(Auth::user()->role == 2){
            # show only staff in that department
            $staff = Staff::where('department', '=', Auth::user()->department)->where('role', '>', Auth::user()->role)->with('role', 'department','scorecard')->get()->toArray();
            $departments = Department::where('id', '=', Auth::user()->department)->get()->toArray();
        }else{
            # Permission denied
            return redirect()->back()
                ->with('error', 'Permission Denied');
        }
        $scoredStaff = Staff::with('scorecard')->get()->toArray();
        
        
        
        for ($i=0; $i<sizeof($scoredStaff); $i++) {
            $averagescore=0;
            $scoredStaff[$i]['averagescore'] = 0;
            $scorecards = ScoreCard::where('staff','=',$scoredStaff[$i])->get()->toArray();

            if (sizeof($scorecards)>0){
                for ($j=0; $j < sizeof($scorecards); $j++) {
                    $averagescore += ($scorecards[$j]['total_score']);
                }
            $scoredStaff[$i]['averagescore'] = $averagescore/sizeof($scorecards);
            }
        }
        
        return view('staff.staff')
            ->with('staff', $staff)
            ->with('scoredStaff',$scoredStaff)
            ->with('roles', Role::where('id', '>=', Auth::user()->role)->get()->toArray())
            ->with('departments', $departments);
    }

    public function showProfile($id){
            $staff = Staff::where('id','=', $id)->get()->first();
            $averagescore=0;
            $staff['averagescore'] = 0;
            $scorecards = ScoreCard::where('staff','=',$staff['id'])->get()->toArray();

            if (sizeof($scorecards)>0){
                for ($j=0; $j < sizeof($scorecards); $j++) {
                    $averagescore += ($scorecards[$j]['total_score']);
                }
            $staff['averagescore'] = $averagescore/sizeof($scorecards);
            }
            
            
            return view('staff/profile')
                ->with('staff', $staff)
                ->with('scorecards',$scorecards);
    }

    public function showLoggedUserProfile(){
        $staff = Staff::where('id','=', Auth::user()->id)->get()->first();
        $averagescore=0;
        $staff['averagescore'] = 0;
        $scorecards = ScoreCard::where('staff','=',$staff['id'])->get()->toArray();

        if (sizeof($scorecards)>0){
            for ($j=0; $j < sizeof($scorecards); $j++) {
                $averagescore += ($scorecards[$j]['total_score']);
            }
        $staff['averagescore'] = $averagescore/sizeof($scorecards);
        }
        
        
        return view('staff/profile')
            ->with('staff', $staff)
            ->with('scorecards',$scorecards);
    }

    
    public function addStaff(Request $request){
        /* Add Staff */

        $staff = new Staff;
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->role = $request->role;
        $staff->department = $request->department;
        $staff->google_id = 1;

        $staff->password = Hash::make($request->password);
        $staff->save();

        if($request->name)
        {
            
            $body = "<h3>Hi from BSC</h3><br><p>Your account  has been created. Please login here to access it >> <a href='https://scorecard.instntmny.com'>Balanced Scorecard</a></p>";
            
        }
        
        $mailStructure = array(
            "body"      => $body
        );

        Mail::to($staff->email)->send(new SendMail($mailStructure));

        
        return redirect()->route('show.staff')
            ->with('success', 'Staff inserted successfully.');
    }

    public function deleteStaff($id){
        $staff = Staff::where('id','=', $id)->first();
        $staff->delete();
        $scorecard = ScoreCard::where('staff','=', $id)->delete();

        return redirect()->back()
            ->with('deleted','Staff has been deleted');

        
    }

    public function editStaff(Request $request){

        //returns staff with id 
        $staff= Staff::find($request->name);
        $staff->role = $request->role;
        $staff->department = $request->department;
        if($request->password_reset !=null){
            $staff->password = Hash::make($request->password_reset);
        }
        $staff->save();

        return redirect()->back()
        ->with('upated','Staff has been updated');
    }

    
    public function restoreStaff(){
        $staff = new Staff;
        $staff->id = 11;
        $staff->name = "Samuel Kwadwo Tuffour";
        $staff->department = "8";
        $staff->role = "3";
        $staff->email = "skt@myzeepay.com";
        $staff->google_id = "1";
        $staff->password= hash::make('password');


        $cards = new ScoreCard;
        $cards->id = 11;
        $cards->staff = 11;
        $cards->period = "01-2020";
        $cards->total_score= 16;
        $cards->approval = "no";
        $cards->last_updated_by = 1;

        $cards1 = new ScoreCard;
        $cards1->id = 100;
        $cards1->staff = 11;
        $cards1->period = "07-2020";
        $cards1->total_score= 0;
        $cards1->approval = "no";
        $cards1->last_updated_by = 1;

        $cards2 = new ScoreCard;
        $cards2->id = 101;
        $cards2->staff = 11;
        $cards2->period = "08-2020";
        $cards2->total_score= 0;
        $cards2->approval = "no";
        $cards2->last_updated_by = 1;
        
        $cards3 = new ScoreCard;
        $cards3->id = 44;
        $cards3->staff = 11;
        $cards3->period = "02-2020";
        $cards3->total_score= 0;
        $cards3->approval = "no";
        $cards3->last_updated_by = 1;

        $cards4 = new ScoreCard;
        $cards4->id = 47;
        $cards4->staff = 11;
        $cards4->period = "03-2020";
        $cards4->total_score= 0;
        $cards4->approval = "no";
        $cards4->last_updated_by = 1;

        $cards5 = new ScoreCard;
        $cards5->id = 70;
        $cards5->staff = 11;
        $cards5->period = "05-2020";
        $cards5->total_score= 0;
        $cards5->approval = "no";
        $cards5->last_updated_by = 1;

        $cards6 = new ScoreCard;
        $cards6->id = 71;
        $cards6->staff = 11;
        $cards6->period = "06-2020";
        $cards6->total_score= 0;
        $cards6->approval = "no";
        $cards6->last_updated_by = 1;

        $cards7 = new ScoreCard;
        $cards7->id = 59;
        $cards7->staff = 11;
        $cards7->period = "04-2020";
        $cards7->total_score= 0;
        $cards7->approval = "no";
        $cards7->last_updated_by = 1;

        $staff->save();
        $cards->save();
        $cards1->save();
        $cards2->save();
        $cards3->save();
        $cards4->save();
        $cards5->save();
        $cards6->save();
        $cards7->save();
    }
    
}
