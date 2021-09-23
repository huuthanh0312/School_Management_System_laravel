<?php

namespace App\Http\Controllers\Backend\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentYear;
use App\Models\ExamType;
use App\Models\StudentClass;
use App\Models\AssignSubject;
use App\Models\AssignStudent;
use App\Models\StudentMarks;
use PDF;

class ResultReportController extends Controller
{
    public function StudentReportView(){
        $data['student_years'] = StudentYear::orderBy('id', 'desc')->get();
        $data['student_classes'] = StudentClass::all();
        $data['exam_type'] = ExamType::all();
        return view('backend.report.student_result.student_result_view', $data);
    }

    public function StudentReportGet(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam_type_id = $request->exam_type_id;
        $single_result = StudentMarks::where('year_id', $year_id)->where('class_id', $class_id)
                ->where('exam_type_id', $exam_type_id)->first();
        // dd($single_result);
        if($single_result == true){
            $data['allData'] = StudentMarks::select('year_id', 'class_id', 'exam_type_id', 'student_id')
                            ->where('year_id', $year_id)->where('class_id', $class_id)->where('exam_type_id', $exam_type_id)
                            ->groupBy('year_id')->groupBy('class_id')->groupBy('exam_type_id')->groupBy('student_id')->get();
            $pdf = PDF::loadView('backend.report.student_result.student_result_pdf',$data);
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');
        }else{
            $notification=array(
                'message'=>'Sorry These Find Not Match',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function StudentIDCardView(){
        $data['student_years'] = StudentYear::orderBy('id', 'desc')->get();
        $data['student_classes'] = StudentClass::all();
        return view('backend.report.idcard.idcard_view', $data);
    }
    public function StudentIDCardGet(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $check_data = AssignStudent::where('year_id', $year_id)->where('class_id', $class_id)->first();
        // dd($single_result);
        if($check_data == true){
            $data['allData'] = AssignStudent::where('year_id', $year_id)->where('class_id', $class_id)->get();
            $pdf = PDF::loadView('backend.report.idcard.idcard_pdf',$data);
            $pdf->SetProtection(['copy', 'print'], '', 'pass');
            return $pdf->stream('document.pdf');
        }else{
            $notification=array(
                'message'=>'Sorry These Find Not Match',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
}
