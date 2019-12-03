<?php

namespace App\Http\Controllers;

use Auth;
use App\Role;
use App\Staff;
use App\Department;

use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:staff');
    }

    public function showDepartment(){
        if (Auth::user()->role == 1) {
            # show all
            $department = Department::select('id','description')->get()->toArray();

        }elseif(Auth::user()->role == 2){
            # show only staff in that department
            $department = Department::where('department', '=', Auth::user()->department)->get()->toArray();
            
        }else{
            # Permission denied
            return redirect()->back()
                ->with('error', 'Permission Denied');
        }



        return view('departments')
            ->with('department', $department);
    }

    public function addDepartment(Request $request){
        /* Add Department */

        $department = new Department;
        $department->description = $request->description;
        $department->save();
        
        return redirect()->route('show.departments')
            ->with('success', 'department inserted successfully.');
    }
}

