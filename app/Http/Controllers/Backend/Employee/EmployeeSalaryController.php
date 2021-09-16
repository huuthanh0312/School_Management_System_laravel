<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EmployeeSalaryLog;

class EmployeeSalaryController extends Controller
{
    public function SalaryView(){
        $data['allData'] = User::where('type', 'Employee')->get();
        return view('backend.employee.employee_salary.employee_salary_view', $data);
    }
    
    public function SalaryIncrement($id) {
        $data['salary'] = User::find($id);
        return view('backend.employee.employee_salary.employee_salary_increment', $data);
    }

    public function SalaryIncrementStore(Request $request, $id) {
        $user = User::find($id);
        $previous_salary = $user->salary;
        $present_salary = (float)$previous_salary + $request->increment_salary;
        $user->salary = $present_salary;
        $user->save();

        $salaryData = new EmployeeSalaryLog();
        $salaryData->employee_id = $id;
        $salaryData->previous_salary = $previous_salary;
        $salaryData->present_salary = $present_salary;
        $salaryData->increment_salary = $request->increment_salary;
        $salaryData->effected_salary = date('Y-m-d',strtotime($request->effected_salary));
        $salaryData->save();

        $notification=array(
            'message'=>'Employee Salary Increment Inserted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('employee.salary.view')->with($notification);
    }

    public function SalaryIncrementDetails($id){
        $data['details'] = User::find($id);
        $data['salary_log'] = EmployeeSalaryLog::where('employee_id',$data['details']->id)->get();
        return view('backend.employee.employee_salary.employee_salary_details', $data);
    }
}
