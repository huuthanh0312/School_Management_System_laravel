<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolSubject;

class SchoolSubjectController extends Controller
{
    public function ViewSchoolSubject(){
        $data['allData'] = SchoolSubject::all();
        return view('backend.setup.school_subject.view_school_subject', $data);
    }

    public function StoreSchoolSubject(Request $request){
        $validateData = $request->validate([
            'name' => 'required|unique:school_subjects',
        ]);
        $data = new SchoolSubject();
        $data['name'] = $request->name;
        $data->save();
        $notification=array(
            'message'=>'School Subject Inserted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function EditSchoolSubject($id) {
        $school_subject = SchoolSubject::find($id);
        return view('backend.setup.school_subject.edit_school_subject', compact('school_subject'));
    }

    public function UpdateSchoolSubject(Request $request, $id){
        $data = SchoolSubject::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:school_subjects,name,'.$data->id
        ]);
        
        $data->name = $request->name;
        $data->save();
        $notification=array(
            'message'=>'School Subject Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('school.subject.view')->with($notification);
    }

    public function DeleteSchoolSubject($id) {
        SchoolSubject::find($id)->delete();
        $notification=array(
            'message'=>'School Subject Deleted Successfully',
            'alert-type'=>'info'
        );
        return Redirect()->back()->with($notification);
    }
}
