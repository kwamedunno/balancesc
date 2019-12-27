<?php

namespace App\Http\Controllers;

use Auth;
use App\Role;
use App\Staff;
use App\Department;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:staff');
    }

    public function showStaff(){
        if (Auth::user()->role == 1) {
            # show all
            $staff = Staff::with('role', 'department')->get()->toArray();
            $departments = Department::get()->toArray();
        }elseif(Auth::user()->role == 2){
            # show only staff in that department
            $staff = Staff::where('department', '=', Auth::user()->department)->where('role', '<', Auth::user()->role)->with('role', 'department')->get()->toArray();
            $departments = Department::where('id', '=', Auth::user()->department)->get()->toArray();
        }else{
            # Permission denied
            return redirect()->back()
                ->with('error', 'Permission Denied');
        }



        return view('staff')
            ->with('staff', $staff)
            ->with('roles', Role::where('id', '>=', Auth::user()->role)->get()->toArray())
            ->with('departments', $departments);
    }

    public function addStaff(Request $request){
        /* Add Staff */

        $staff = new Staff;
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->role = $request->role;
        $staff->department = $request->department;

        // $password = rand(1000, 9999);
        $staff->password = Hash::make($request->password);

        $staff->save();
        
        return redirect()->route('show.staff')
            ->with('success', 'Staff inserted successfully.');
    }

}
