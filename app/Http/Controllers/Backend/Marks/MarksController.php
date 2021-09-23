<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentYear;
use App\Models\ExamType;
use App\Models\StudentClass;
use App\Models\AssignSubject;
use App\Models\AssignStudent;
use App\Models\StudentMarks;

class MarksController extends Controller
{
    public function MarksEntryAdd(){
        $data['student_years'] = StudentYear::all();
        $data['student_classes'] = StudentClass::all();
        $data['exam_type'] = ExamType::all();
        return view('backend.marks.marks_add', $data);
    }

    public function MarksGetSubject(Request $request){
        $class_id  = $request->class_id;
        $data = AssignSubject::with(['school_subject'])->where('class_id', $class_id)->get();
        return response()->json($data);
    }

    public function GetStudents(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        
        $data = AssignStudent::with(['student'])->where('year_id', $year_id)->where('class_id', $class_id)->get();
        return response()->json($data);

    }

    public function MarksEditGetStudents(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $assign_subject_id = $request->assign_subject_id;
        $exam_type_id = $request->exam_type_id;
        $data = StudentMarks::with(['student'])->where('year_id', $year_id)->where('class_id', $class_id)
                ->where('assign_subject_id', $assign_subject_id)->where('exam_type_id', $exam_type_id)->get();
        return response()->json($data);

    }

    public function MarksEntryStore(Request $request){
        $count_student = $request->student_id;
        if($count_student){
            for($i=0; $i < count($count_student); $i++){
                $data = new StudentMarks();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->assign_subject_id = $request->assign_subject_id;
                $data->exam_type_id = $request->exam_type_id;
                $data->student_id = $request->student_id[$i];
                $data->id_no = $request->id_no[$i];
                $data->marks = $request->marks[$i];
                $data->save();
            }
            $notification=array(
                'message'=>'Student Marks Inserted Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }else{
            
            $notification=array(
                'message'=>'Sorry Data Not Saved',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function MarksEntryEdit(){
        $data['student_years'] = StudentYear::all();
        $data['student_classes'] = StudentClass::all();
        $data['exam_type'] = ExamType::all();
        return view('backend.marks.marks_edit', $data);
    }

    public function MarksEntryUpdate(Request $request){
        StudentMarks::with(['student'])->where('year_id', $request->year_id)->where('class_id', $request->class_id)
                ->where('assign_subject_id', $request->assign_subject_id)->where('exam_type_id', $request->exam_type_id)->delete();
        $count_student = $request->student_id;
        if($count_student){
            for($i=0; $i < count($count_student); $i++){
                $data = new StudentMarks();
                $data->year_id = $request->year_id;
                $data->class_id = $request->class_id;
                $data->assign_subject_id = $request->assign_subject_id;
                $data->exam_type_id = $request->exam_type_id;
                $data->student_id = $request->student_id[$i];
                $data->id_no = $request->id_no[$i];
                $data->marks = $request->marks[$i];
                $data->save();
            }
            $notification=array(
                'message'=>'Student Marks Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        } else{
            
            $notification=array(
                'message'=>'Sorry Data Not Saved',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
        
    }
}
