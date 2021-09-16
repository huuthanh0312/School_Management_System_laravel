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
class StudentRegController extends Controller
{
    public function StudentRegView(){
        $data['student_years'] = StudentYear::all();
        $data['student_classes'] = StudentClass::all();
        $data['year_id'] = StudentYear::orderby('id', 'desc')->first()->id;
        $data['class_id'] = StudentClass::orderby('id', 'desc')->first()->id;
        $data['allData'] = AssignStudent::where('year_id', $data['year_id'])->where('class_id', $data['class_id'])->get();
        return view('backend.student.student_reg.student_view', $data);
    }

    public function StudentYearClassWise(Request $request){
        $data['student_years'] = StudentYear::all();
        $data['student_classes'] = StudentClass::all();
        $data['year_id'] = $request->year_id;
        $data['class_id'] = $request->class_id;
        $data['allData'] = AssignStudent::where('year_id', $data['year_id'])->where('class_id', $data['class_id'])->get();
        return view('backend.student.student_reg.student_view', $data);
    }
    public function StudentRegAdd(){
        $data['student_years'] = StudentYear::all();
        $data['student_classes'] = StudentClass::all();
        $data['student_shifts'] = StudentShift::all();
        $data['student_groups'] = StudentGroup::all();
        return view('backend.student.student_reg.student_add', $data);
    }
    
    public function StudentRegStore(Request $request){
        DB::transaction(function() use ($request) {
            $checkYear = StudentYear::find($request->year_id)->name;
            $student = User::where('type', 'Student')->orderBy('id', 'desc')->first();

            if($student == null){
                $firstReg = 0;
                $studentId = $firstReg + 1;
                if($student <10){
                    $id_no = '000'.$studentId;
                }elseif($student <100){
                    $id_no = '00'.$studentId;
                }elseif($student <1000){
                    $id_no = '0'.$studentId;
                }
            }else{
                $student =User::where('type', 'Student')->orderBy('id', 'desc')->first()->id;
                $studentId = $student + 1;
                if($student <10){
                    $id_no = '000'.$studentId;
                }elseif($student <100){
                    $id_no = '00'.$studentId;
                }elseif($student <1000){
                    $id_no = '0'.$studentId;
                }
            }
            $final_id_no = $checkYear.$id_no;
            $user = new User();
            $user->type = 'Student';
            $user->id_no =$final_id_no;
            $code = rand(10000000, 99999999);
            $user->code = $code;
            $user->name = $request->name;
            $user->password = Hash::make($code);
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d',strtotime($request->dob));

            if($request->file('image')){
                $file = $request->file('image');
                $image = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/student_images/'),$image);
                $user['image'] = $image;
            }
            $user->save();

            $assign_student = new AssignStudent();
            $assign_student->student_id = $user->id;
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = '1';
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });
        $notification=array(
            'message'=>'Student Registration Inserted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('student.registration.view')->with($notification);
    }

    public function StudentRegEdit($student_id){
        $data['student_years'] = StudentYear::all();
        $data['student_classes'] = StudentClass::all();
        $data['student_shifts'] = StudentShift::all();
        $data['student_groups'] = StudentGroup::all();
        $data['editData'] = AssignStudent::with('student', 'discount')->where('student_id', $student_id)->first();
        return view('backend.student.student_reg.student_edit', $data);
    }

    public function StudentRegUpdate(Request $request, $student_id){
        DB::transaction(function() use ($request, $student_id) {

            $user = User::Where('id', $student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d',strtotime($request->dob));

            if($request->file('image')){
                $file = $request->file('image');
                $old_image = $request->file('old_image');
                @unlink(public_path('upload/student_images'. $old_image));
                $image = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/student_images/'),$image);
                $user['image'] = $image;
            }
            $user->save();

            $assign_student = AssignStudent::Where('id', $request->id)->Where('student_id', $student_id)->first();
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = DiscountStudent::Where('assign_student_id', $request->id)->first();
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });
        $notification=array(
            'message'=>'Student Registration Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('student.registration.view')->with($notification);
    }

    public function StudentRegPromotion($student_id){
        $data['student_years'] = StudentYear::all();
        $data['student_classes'] = StudentClass::all();
        $data['student_shifts'] = StudentShift::all();
        $data['student_groups'] = StudentGroup::all();
        $data['editData'] = AssignStudent::with('student', 'discount')->where('student_id', $student_id)->first();
        return view('backend.student.student_reg.student_promotion', $data);
    }

    public function StudentRegUpdatePromotion(Request $request, $student_id){
        DB::transaction(function() use ($request, $student_id) {

            $user = User::Where('id', $student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d',strtotime($request->dob));

            if($request->file('image')){
                $file = $request->file('image');
                $old_image = $request->file('old_image');
                @unlink(public_path('upload/student_images'. $old_image));
                $image = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/student_images/'),$image);
                $user['image'] = $image;
            }
            $user->save();

            $assign_student = new AssignStudent();
            $assign_student->student_id = $student_id;
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = '1';
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });
        $notification=array(
            'message'=>'Student Promotion Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('student.registration.view')->with($notification);
    }

    public function StudentRegDetails($student_id){
        $data['details'] = AssignStudent::with('student', 'discount')->where('student_id', $student_id)->first();;
        $pdf = PDF::loadView('backend.student.student_reg.student_details_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
