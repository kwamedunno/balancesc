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
            //Calculate average score for year
            for ($i=0; $i<sizeof($staff); $i++) {
                $averagescore=0;
                $staff[$i]['averagescore'] = 0;
                $scorecards = ScoreCard::where('staff','=',$staff[$i]['id'])->where('year','=',\Carbon\Carbon::now()->format('Y'))->get()->toArray();
    
                if (sizeof($scorecards)>0){
                    for ($j=0; $j < sizeof($scorecards); $j++) {
                        $averagescore += ($scorecards[$j]['total_score']);
                    }
                    $staff[$i]['averagescore'] = $averagescore/sizeof($scorecards);
                }
            }

        }elseif(Auth::user()->role == 2){
            # show only staff in that department

            if(Auth::user()->department == 2){
                $staff = Staff::where('department','=', 2)->orWhere('department', '=', 4)->where('role', '>', Auth::user()->role)->with('role', 'department','scorecard')->get()->toArray();
                $departments = Department::where('id', '=', Auth::user()->department)->get()->toArray();
                for ($i=0; $i<sizeof($staff); $i++) {
                    $averagescore=0;
                    $staff[$i]['averagescore'] = 0;
                    $scorecards = ScoreCard::where('staff','=',$staff[$i]['id'])->where('year','=',\Carbon\Carbon::now()->format('Y'))->get()->toArray();
        
                    if (sizeof($scorecards)>0){
                        for ($j=0; $j < sizeof($scorecards); $j++) {
                            $averagescore += ($scorecards[$j]['total_score']);
                        }
                        $staff[$i]['averagescore'] = $averagescore/sizeof($scorecards);
                    }
                }
            }
            else{
                $staff = Staff::where('department', '=', Auth::user()->department)->where('role', '>', Auth::user()->role)->with('role', 'department','scorecard')->get()->toArray();
                $departments = Department::where('id', '=', Auth::user()->department)->get()->toArray();
                for ($i=0; $i<sizeof($staff); $i++) {
                    $averagescore=0;
                    $staff[$i]['averagescore'] = 0;
                    $scorecards = ScoreCard::where('staff','=',$staff[$i]['id'])->where('year','=',\Carbon\Carbon::now()->format('Y'))->get()->toArray();
        
                    if (sizeof($scorecards)>0){
                        for ($j=0; $j < sizeof($scorecards); $j++) {
                            $averagescore += ($scorecards[$j]['total_score']);
                        }
                        $staff[$i]['averagescore'] = $averagescore/sizeof($scorecards);
                    }
                }

            }
        }else{
            # Permission denied
            return redirect()->back()
                ->with('error', 'Permission Denied');
        }

        
        return view('staff.staff')
            ->with('staff', $staff)
            // ->with('scoredStaff',$scoredStaff)
            ->with('roles', Role::where('id', '>=', Auth::user()->role)->get()->toArray())
            ->with('departments', $departments);
    }

    public function showProfile($id){
            $staff = Staff::where('id','=', $id)->get()->first();
            $averagescore=0;
            $staff['averagescore'] = 0;
            $scorecards = ScoreCard::where('staff','=',$staff['id'])->where('year','=',\Carbon\Carbon::now()->format('Y'))->get()->toArray();
            $allcards = ScoreCard::where('staff','=',$staff['id'])->get()->toArray();

            if (sizeof($scorecards)>0){
                for ($j=0; $j < sizeof($scorecards); $j++) {
                    $averagescore += ($scorecards[$j]['total_score']);
                }
            $staff['averagescore'] = $averagescore/sizeof($scorecards);
            }
            
            
            return view('staff/profile')
                ->with('staff', $staff)
                ->with('scorecards',$scorecards)
                ->with('allcards',$allcards);
    }

    public function showLoggedUserProfile(){
        $staff = Staff::where('id','=', Auth::user()->id)->get()->first();
        $averagescore=0;
        $staff['averagescore'] = 0;
        $scorecards = ScoreCard::where('staff','=',$staff['id'])->where('year','=',\Carbon\Carbon::now()->format('Y'))->get()->toArray();
        $allcards = ScoreCard::where('staff','=',$staff['id'])->get()->toArray();

        if (sizeof($scorecards)>0){
            for ($j=0; $j < sizeof($scorecards); $j++) {
                $averagescore += ($scorecards[$j]['total_score']);
            }
        $staff['averagescore'] = $averagescore/sizeof($scorecards);
        }
        
        
        return view('staff/profile')
            ->with('staff', $staff)
            ->with('scorecards',$scorecards)
            ->with('allcards',$allcards);
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

   
    public function showDepartmentStaff($id){
        $staff = Staff::where('department','=',$id)->with('role', 'department','scorecard')->get()->toArray();
        $departments = Department::get()->toArray();
            for ($i=0; $i<sizeof($staff); $i++) {
                $averagescore=0;
                $staff[$i]['averagescore'] = 0;
                $scorecards = ScoreCard::where('staff','=',$staff[$i]['id'])->get()->toArray();
    
                if (sizeof($scorecards)>0){
                    for ($j=0; $j < sizeof($scorecards); $j++) {
                        $averagescore += ($scorecards[$j]['total_score']);
                    }
                    $staff[$i]['averagescore'] = $averagescore/sizeof($scorecards);
                }
            }
            return view('staff.staff')
            ->with('staff', $staff)
            // ->with('scoredStaff',$scoredStaff)
            ->with('roles', Role::all())
            ->with('departments', $departments);
    }
}
