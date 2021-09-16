<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;

class StudentClassController extends Controller
{
    public function ViewStudentClass(){
        $data['allData'] = StudentClass::all();
        return view('backend.setup.student_class.view_class', $data);
    }

    public function StoreStudentClass(Request $request){
        $validateData = $request->validate([
            'name' => 'required|unique:student_classes',
        ]);
        $data = new StudentClass();
        $data['name'] = $request->name;
        $data->save();
        $notification=array(
            'message'=>'Student Class Inserted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function EditStudentClass($id) {
        $class = StudentClass::find($id);
        return view('backend.setup.student_class.edit_class', compact('class'));
    }

    public function UpdateStudentClass(Request $request, $id){
        $data = StudentClass::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:student_classes,name,'.$data->id
        ]);
        
        $data->name = $request->name;
        $data->save();
        $notification=array(
            'message'=>'Student Class Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('student.class.view')->with($notification);
    }

    public function DeleteStudentClass($id) {
        StudentClass::find($id)->delete();
        $notification=array(
            'message'=>'Student Class Deleted Successfully',
            'alert-type'=>'info'
        );
        return Redirect()->back()->with($notification);
    }

 
}
