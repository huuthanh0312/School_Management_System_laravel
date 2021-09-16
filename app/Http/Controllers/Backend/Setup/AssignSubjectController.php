<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;
use App\Models\SchoolSubject;
use App\Models\AssignSubject;

class AssignSubjectController extends Controller
{
    public function ViewAssignSubject(){
        $data['classes'] = StudentClass::all();
        $data['school_subjects'] = SchoolSubject::all();
        $data['allData'] = AssignSubject::select('class_id')->GroupBy('class_id')->get();
        return view('backend.setup.assign_subject.view_assign_subject', $data);
    }

    public function StoreAssignSubject(Request $request) {
        $countsubject = count($request->subject_id);
        if($countsubject != NULL){
            for($i=0 ; $i< $countsubject; $i++){
                $assign_subject = new AssignSubject();
                $assign_subject->class_id = $request->class_id;
                $assign_subject->subject_id = $request->subject_id[$i];
                $assign_subject->full_mark = $request->full_mark[$i];
                $assign_subject->pass_mark = $request->pass_mark[$i];
                $assign_subject->subjective_mark = $request->subjective_mark[$i];
                $assign_subject->save();
                
            }
            $notification=array(
                'message'=>'Assign Subject Inserted Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }

    }
    public function EditAssignSubject($class_id){
        $data['classes'] = StudentClass::all();
        $data['school_subjects'] = SchoolSubject::all();
        $data['editData'] = AssignSubject::where('class_id', $class_id)->orderBy('subject_id', 'asc')->get();
        return view('backend.setup.assign_subject.edit_assign_subject', $data);
    }

    public function UpdateAssignSubject(Request $request, $class_id){
        
        if($request->subject_id != NULL){
            $countsubject = count($request->subject_id);
            AssignSubject::where('class_id', $class_id)->delete();
            for($i=0 ; $i< $countsubject; $i++){
                $assign_subject = new AssignSubject();
                $assign_subject->class_id = $request->class_id;
                $assign_subject->subject_id = $request->subject_id[$i];
                $assign_subject->full_mark = $request->full_mark[$i];
                $assign_subject->pass_mark = $request->pass_mark[$i];
                $assign_subject->subjective_mark = $request->subjective_mark[$i];
                $assign_subject->save();
                
            }
            $notification=array(
                'message'=>'Assign Subject Inserted Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('assign.subject.view')->with($notification);
        }else{
            $notification=array(
                'message'=>'Sorry You Do Not Select Any Subject',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function DetailsAssignSubject($class_id){
        $data['detailsData'] = AssignSubject::where('class_id', $class_id)->orderBy('subject_id', 'asc')->get();
        return view('backend.setup.assign_subject.details_assign_subject', $data);
    }
}
