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
use App\Models\FeeCategoryAmount;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DB;
use PDF;

class RegistrationFeeController extends Controller
{
    public function RegFeeView(){
        $data['student_years'] = StudentYear::all();
        $data['student_classes'] = StudentClass::all();
        return view('backend.student.registration_fee.registration_fee_view', $data);
    }

    public function RegFeeClasswiseGet(Request $request){
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        if($year_id != ''){
            $where[] = ['year_id', 'like', $year_id.'%'];
        }
        if($class_id != ''){
            $where[] = ['class_id', 'like', $class_id.'%'];
        }
        $allStudent = AssignStudent::with(['discount'])->where($where)->get();

        $html['thsource']  = '<th>SL</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Roll No</th>';
        $html['thsource'] .= '<th>Reg Fee</th>';
        $html['thsource'] .= '<th>Discount </th>';
        $html['thsource'] .= '<th>Student Fee </th>';
        $html['thsource'] .= '<th>Action</th>';


        foreach($allStudent as $key=>$data){
            $registrationfee = FeeCategoryAmount::where('fee_category_id','1')->where('class_id',$data->class_id)->first();
            $color = 'success';
            $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$data['student']['id_no'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$data['student']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$data->roll.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$registrationfee->amount.'</td>';
            $html[$key]['tdsource'] .= '<td>'.$data['discount']['discount'].'%'.'</td>';

            $originalfee = $registrationfee->amount;
            $discount = $data['discount']['discount'];
            $discounttablefee = $discount/100*$originalfee;
            $finalfee = (float)$originalfee - (float)$discounttablefee;

            $html[$key]['tdsource'] .= '<td>'.$finalfee.'$'.'</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-success" title="PaySlip" target="_blanks" 
                                        href="'.route('student.registration.fee.payslip').'?class_id='.$class_id.'&student_id='.$data->student_id.'">
                                        Fee Slip </a>';
            $html[$key]['tdsource'] .= '</td>';
        }
        return response()->json(@$html);

    }

    public function RegFeePaySlip(Request $request){
        $student_id = $request->student_id;
        $class_id = $request->class_id;
        $data['details'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)
                                    ->where('class_id', $class_id)->first();
        $pdf = PDF::loadView('backend.student.registration_fee.registration_fee_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
