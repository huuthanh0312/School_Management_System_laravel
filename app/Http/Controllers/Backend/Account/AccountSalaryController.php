<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountEmployeeSalary;
use App\Models\EmployeeAttendance;

class AccountSalaryController extends Controller
{
    public function EmployeeSalaryView() {
        $data['allData'] = AccountEmployeeSalary::all();
        return view('backend.account.employee_salary.employee_salary_view', $data);
    }

    public function EmployeeSalaryAdd(){
        return view('backend.account.employee_salary.employee_salary_add');
    }

    public function EmployeeSalaryGetEmployee(Request $request){
        $date = date('Y-m',strtotime($request->date));
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
            $account_salary = AccountEmployeeSalary::where('employee_id',$attend->employee_id)->where('date', $date)->first();
            if($account_salary != null){
                $checked = 'checked';
            } else {
                $checked = '';
            }

            $total_attend = EmployeeAttendance::with(['user'])->where($where)->where('employee_id',$attend->employee_id)->get();
            $count_absent = count($total_attend->where('attend_status', 'Absent'));
            $html[$key]['tdsource'] = '<td>'.($key+1).'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['name'].'</td>';
            $html[$key]['tdsource'] .= '<td>'.$attend['user']['salary'].'$</td>';

            $salary = (float)$attend['user']['salary'];
            $salary_perday = (float)$salary/30;
            $total_salary_minus = (float)$count_absent * (float)$salary_perday;
            $total_salary = (float)$salary - (float)$total_salary_minus;

            $html[$key]['tdsource'] .= '<td>'.$total_salary.'$<input type="hidden" name="amount[]" value="'.$total_salary.'">'.'</td>';
            $html[$key]['tdsource'] .= '<td>'.'<input type="hidden" name="employee_id[]" value="'.$attend->employee_id.'">'.
                                    '<input type="checkbox" name="checkmanage[]" id="'.$key.'" value="'.$key.'" '.$checked.
                                    ' style="transform: scale(1.5);margin-left: 10px;">'.
                                    ' <label for="'.$key.'"> </label> '.'</td>'; 
        }
        return response()->json(@$html);
    }

    public function EmployeeSalaryStore(Request $request){
        $date = date('Y-m', strtotime($request->date));
        AccountEmployeeSalary::where('date', $request->date)->delete();
        $check_data = $request->checkmanage;
        if($check_data != null){
            for($i=0; $i < count($check_data) ; $i++){
                $data = new AccountEmployeeSalary();
                $data->date = $date;
                $data->employee_id = $request->employee_id[$check_data[$i]];
                $data->amount = $request->amount[$check_data[$i]];
                $data->save();
            }
        }

        if(!empty(@$data) || empty($check_data)){
            $notification=array(
                'message'=>'Well Done Data Successfully Updated',
                'alert-type'=>'success'
            );
            return Redirect()->route('account.employee.salary.view')->with($notification);
        }else{
            $notification=array(
                'message'=>'Sorry Data Not Saved',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
}
