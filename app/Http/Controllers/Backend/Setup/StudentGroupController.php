<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentGroup;

class StudentGroupController extends Controller
{
    public function ViewStudentGroup(){
        $data['allData'] = StudentGroup::all();
        return view('backend.setup.group.view_group', $data);
    }

    public function StoreStudentGroup(Request $request){
        $validateData = $request->validate([
            'name' => 'required|unique:student_groups',
        ]);
        $data = new StudentGroup();
        $data['name'] = $request->name;
        $data->save();
        $notification=array(
            'message'=>'Student Group Inserted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function EditStudentGroup($id) {
        $group = StudentGroup::find($id);
        return view('backend.setup.group.edit_group', compact('group'));
    }

    public function UpdateStudentGroup(Request $request, $id){
        $data = StudentGroup::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:student_groups,name,'.$data->id
        ]);
        
        $data->name = $request->name;
        $data->save();
        $notification=array(
            'message'=>'Student Group Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('student.group.view')->with($notification);
    }

    public function DeleteStudentGroup($id) {
        StudentGroup::find($id)->delete();
        $notification=array(
            'message'=>'Student Group Deleted Successfully',
            'alert-type'=>'info'
        );
        return Redirect()->back()->with($notification);
    }
}
