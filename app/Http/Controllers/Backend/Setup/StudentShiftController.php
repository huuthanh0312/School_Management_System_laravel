<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentShift;

class StudentShiftController extends Controller
{
    public function ViewStudentShift(){
        $data['allData'] = StudentShift::all();
        return view('backend.setup.shift.view_shift', $data);
    }

    public function StoreStudentShift(Request $request){
        $validateData = $request->validate([
            'name' => 'required|unique:student_shifts',
        ]);
        $data = new StudentShift();
        $data['name'] = $request->name;
        $data->save();
        $notification=array(
            'message'=>'Student Shift Inserted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function EditStudentShift($id) {
        $shift = StudentShift::find($id);
        return view('backend.setup.shift.edit_shift', compact('shift'));
    }

    public function UpdateStudentShift(Request $request, $id){
        $data = StudentShift::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:student_shifts,name,'.$data->id
        ]);
        
        $data->name = $request->name;
        $data->save();
        $notification=array(
            'message'=>'Student Shift Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('student.shift.view')->with($notification);
    }

    public function DeleteStudentShift($id) {
        StudentShift::find($id)->delete();
        $notification=array(
            'message'=>'Student Shift Deleted Successfully',
            'alert-type'=>'info'
        );
        return Redirect()->back()->with($notification);
    }
}
