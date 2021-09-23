<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use App\Models\User;


class EmployeeAttendanceController extends Controller
{
    public function AttendanceView(){
        $data['allData'] = EmployeeAttendance::select('date')->groupby('date')->orderBy('date', 'desc')->get();
        return view('backend.employee.employee_attendance.employee_attendance_view', $data); 
    }

    public function AttendanceAdd(){;
        $data['employees'] = User::where('type', 'Employee')->get();
        return view('backend.employee.employee_attendance.employee_attendance_add', $data); 
    }

    public function AttendanceStore(Request $request) {
        EmployeeAttendance::where('date', date('Y-m-d', strtotime($request->date)))->delete();
        $countemployee = count($request->employee_id);
        for($i=0; $i < $countemployee; $i++) {
            $attend_status = 'attend_status'.$i;
            $attend = new EmployeeAttendance();
            $attend->date = date('Y-m-d', strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status = $request->$attend_status;
            $attend->save();
        }
         $notification=array(
            'message'=>'Employee Attend Data Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('employee.attendance.view')->with($notification);
    }

    public function AttendanceEdit($date) {
        $data['employees'] = User::where('type', 'Employee')->get();
        $data['editData'] = EmployeeAttendance::where('date',$date)->get();
        return view('backend.employee.employee_attendance.employee_attendance_edit', $data); 
    }

    public function AttendanceDetails($date) {
        $data['details'] = EmployeeAttendance::where('date',$date)->get();
        return view('backend.employee.employee_attendance.employee_attendance_details', $data); 
    }
}
