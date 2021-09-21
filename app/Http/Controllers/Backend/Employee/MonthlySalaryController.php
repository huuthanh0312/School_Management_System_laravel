<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use PDF;

class MonthlySalaryController extends Controller
{
    public function MonthlySalaryView() {
        return view('backend.employee.monthly_salary.monthly_salary_view');
    }

    public function MonthlySalaryGet(Request $request) {
        $date = date('Y-m-d',strtotime($request->date));
        if($date != ''){
            $where[] = ['date', 'like', $date.'%'];
        }
        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where($where)->get();

        $html['thsource']  = '<th>SL</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary This Month</th>';
        $html['thsource'] .= '<th>Action</th>';


        foreach($data as $key=>$attend){
            $total_attend = EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$attend->employee_id)->get();
            $count_absent = count($total_attend->where('attend_status', 'Absent'));
            $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['salary'].'$</td>';

            $salary = (float)$attend['user']['salary'];
            $salary_perday = (float)$salary/30;
            $total_salary_minus = (float)$count_absent * (float)$salary_perday;
            $total_salary = (float)$salary - (float)$total_salary_minus;

            $html[$key]['tdsource'] .= '<td>'.$total_salary.'$'.'</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-success" title="PaySlip" target="_blanks" 
                                        href="'.route('employee.monthly.salary.payslip', $attend->employee_id).'">Fee Slip </a>';
            $html[$key]['tdsource'] .= '</td>';
        }
        return response()->json(@$html);
    }

    public function MonthlySalaryPaySlip($employee_id){
        $id = EmployeeAttendance::where('employee_id', $employee_id)->first();
        $date = date('Y-m-d',strtotime($id->date));
        if($date != ''){
            $where[] = ['date', 'like', $date.'%'];
        }
        $data['details'] = EmployeeAttendance::with(['user'])->where($where)->where('employee_id', $employee_id)->get();
        $pdf = PDF::loadView('backend.employee.monthly_salary.monthly_salary_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
