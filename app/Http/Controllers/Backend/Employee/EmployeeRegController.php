<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Designation;
use App\Models\User;
use App\Models\EmployeeSalaryLog;
use PDF;

class EmployeeRegController extends Controller
{
    public function EmployeeRegView(){
        $data['allData'] = User::where('type', 'Employee')->get();
        return view('backend.employee.employee_reg.employee_reg_view', $data);
    }

    public function EmployeeRegAdd() {
        $data['designation'] = Designation::all();
        return view('backend.employee.employee_reg.employee_reg_add', $data);
    }

    public function EmployeeRegStore(Request $request) {
        DB::transaction(function() use ($request) {
            $checkYear = date('Ym', strtotime($request->join_date));
            $employee = User::where('type', 'Employee')->orderBy('id', 'desc')->first();

            if($employee == null){
                $firstReg = 0;
                $employeeId = $firstReg + 1;
                if($employee <10){
                    $id_no = '000'.$employeeId;
                }elseif($employee <100){
                    $id_no = '00'.$employeeId;
                }elseif($employee <1000){
                    $id_no = '0'.$employeeId;
                }
            }else{
                $employee =User::where('type', 'Employee')->orderBy('id', 'desc')->first()->id;
                $employeeId = $employee + 1;
                if($employee <10){
                    $id_no = '000'.$employeeId;
                }elseif($employee <100){
                    $id_no = '00'.$employeeId;
                }elseif($employee <1000){
                    $id_no = '0'.$employeeId;
                }
            }
            $final_id_no = $checkYear.$id_no;
            $user = new User();
            $user->type = 'Employee';
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
            $user->salary = $request->salary;
            $user->designation_id = $request->designation_id;
            $user->dob = date('Y-m-d',strtotime($request->dob));
            $user->join_date = date('Y-m-d',strtotime($request->join_date));

            if($request->file('image')){
                $file = $request->file('image');
                $image = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/employee_images/'),$image);
                $user['image'] = $image;
            }
            $user->save();

            $employee_salary = new EmployeeSalaryLog();
            $employee_salary->employee_id = $user->id;
            $employee_salary->effected_salary = date('Y-m-d',strtotime($request->join_date));
            $employee_salary->previous_salary = $request->salary;
            $employee_salary->present_salary = $request->salary;
            $employee_salary->increment_salary = '0';
            $employee_salary->save();
        });
        $notification=array(
            'message'=>'Employee Registration Inserted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('employee.registration.view')->with($notification);
    }

    public function EmployeeRegEdit($id){
        $data['editData'] = User::find($id);
        $data['designation'] = Designation::all();
        return view('backend.employee.employee_reg.employee_reg_edit', $data);
    }

    public function EmployeeRegUpdate(Request $request, $id) {
        DB::transaction(function() use ($request, $id) {
            $user = User::find($id);
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->designation_id = $request->designation_id;
            $user->dob = date('Y-m-d',strtotime($request->dob));

            if($request->file('image')){
                $file = $request->file('image');
                @unlink(public_path('upload/employee_images/'),$request->old_image);
                $image = date('YmdHi').$file->getClientOriginalName();
                $file->move(public_path('upload/employee_images/'),$image);
                $user['image'] = $image;
            }
            $user->save();
        });
        $notification=array(
            'message'=>'Employee Registration Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('employee.registration.view')->with($notification);
    }

    public function EmployeeRegDetails($id){
        $data['details'] = User::find($id);
        $pdf = PDF::loadView('backend.employee.employee_reg.employee_details_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
