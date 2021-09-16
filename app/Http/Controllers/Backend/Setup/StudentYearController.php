<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentYear;

class StudentYearController extends Controller
{
    public function ViewStudentYear(){
        $data['allData'] = StudentYear::all();
        return view('backend.setup.year.view_year', $data);
    }

    public function StoreStudentYear(Request $request){
        $validateData = $request->validate([
            'name' => 'required|unique:student_years',
        ]);
        $data = new StudentYear();
        $data['name'] = $request->name;
        $data->save();
        $notification=array(
            'message'=>'Student Year Inserted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function EditStudentYear($id) {
        $year = StudentYear::find($id);
        return view('backend.setup.year.edit_year', compact('year'));
    }

    public function UpdateStudentYear(Request $request, $id){
        $data = StudentYear::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:student_years,name,'.$data->id
        ]);
        
        $data->name = $request->name;
        $data->save();
        $notification=array(
            'message'=>'Student Year Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('student.year.view')->with($notification);
    }

    public function DeleteStudentYear($id) {
        StudentYear::find($id)->delete();
        $notification=array(
            'message'=>'Student Year Deleted Successfully',
            'alert-type'=>'info'
        );
        return Redirect()->back()->with($notification);
    }
}
