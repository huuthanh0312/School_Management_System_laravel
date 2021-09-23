<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentYear;
use App\Models\ExamType;
use App\Models\StudentClass;
use App\Models\AssignSubject;
use App\Models\MarksGrade;
use App\Models\StudentMarks;

class MarkSheetController extends Controller
{
    public function MarkSheetView(){
        $data['student_years'] = StudentYear::orderBy('id', 'desc')->get();
        $data['student_classes'] = StudentClass::all();
        $data['exam_type'] = ExamType::all();
        return view('backend.report.marksheet.marksheet_view', $data);
    }
    public function MarkSheetGet(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;
        $id_no = $request->id_no;
        $count_fail = StudentMarks::where('year_id', $year_id)->where('class_id', $class_id)
                ->where('exam_type_id', $exam_type_id)->where('id_no', $id_no)->where('marks','<','33')->get()->count();
        $single_student = StudentMarks::where('year_id', $year_id)->where('class_id', $class_id)
                ->where('exam_type_id', $exam_type_id)->where('id_no', $id_no)->first();

        if($single_student == true){
            $all_marks = StudentMarks::with(['assign_subject'],['year'])->where('year_id', $year_id)->where('class_id', $class_id)
                            ->where('exam_type_id', $exam_type_id)->where('id_no', $id_no)->get();
            $all_grade = MarksGrade::all();
            return view('backend.report.marksheet.marksheet_pdf', compact('count_fail', 'all_marks', 'all_grade'));
        }else{
            $notification=array(
                'message'=>'Sorry These Find Not Match',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
        
    }
}
