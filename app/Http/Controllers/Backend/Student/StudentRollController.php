<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentShift;
use App\Models\StudentGroup;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DB;
use PDF;

class StudentRollController extends Controller
{
    public function StudentRollView(){
        $data['student_years'] = StudentYear::all();
        $data['student_classes'] = StudentClass::all();
        
        return view('backend.student.roll_generate.roll_generate_view', $data);
    }

    public function GetStudents(Request $request) {
        $allData = AssignStudent::with(['student'])->where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
        return response()->json($allData);
    }

    public function StudenrRollStore(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        if($request->student_id != null){
            for($i = 0; $i < count($request->student_id); $i++){
                AssignStudent::where('year_id', $request->year_id)->where('class_id', $request->class_id)->
                                where('student_id', $request->student_id[$i])->update(['roll'=> $request->roll[$i]]);
            }
        }else{
            $notification=array(
                'message'=>'Sory There Are No Student',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
        $notification=array(
            'message'=>'Well DOne Roll Generate Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('roll.generate.view')->with($notification);

    }
}
