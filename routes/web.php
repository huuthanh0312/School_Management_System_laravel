<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\FeeAmountController;
use App\Http\Controllers\Backend\Setup\ExamTypeController;
use App\Http\Controllers\Backend\Setup\SchoolSubjectController;
use App\Http\Controllers\Backend\Setup\AssignSubjectController;
use App\Http\Controllers\Backend\Setup\DesignationController;
use App\Http\Controllers\Backend\Student\StudentRegController;
use App\Http\Controllers\Backend\Student\StudentRollController;
use App\Http\Controllers\Backend\Student\RegistrationFeeController;
use App\Http\Controllers\Backend\Student\MonthlyFeeController;
use App\Http\Controllers\Backend\Student\ExamFeeController;
use App\Http\Controllers\Backend\Employee\EmployeeRegController;
use App\Http\Controllers\Backend\Employee\EmployeeSalaryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

//Admin Pages Routes 

Route::get('/admin/logout', [AdminController::class, 'Logout'])->name('admin.logout');


Route::group(['middleware' => 'auth'], function(){


//User All Routes 

Route::prefix('users')->group(function(){

Route::get('/view', [UserController::class, 'UserView'])->name('user.view');

Route::post('/store', [UserController::class, 'UserStore'])->name('users.store');

Route::get('/edit/{id}', [UserController::class, 'UserEdit'])->name('users.edit');

Route::post('/update/{id}', [UserController::class, 'UserUpdate'])->name('users.update');

Route::get('/delete/{id}', [UserController::class, 'UserDelete'])->name('users.delete');
});

//Profile All Routes
Route::prefix('profile')->group(function(){

Route::get('/view', [ProfileController::class, 'ProfileView'])->name('profile.view');

Route::get('/edit', [ProfileController::class, 'ProfileEdit'])->name('profile.edit');

Route::post('/update', [ProfileController::class, 'ProfileUpdate'])->name('profile.update');

Route::get('/password/view', [ProfileController::class, 'PasswordView'])->name('password.view');

Route::post('/password/change', [ProfileController::class, 'PasswordChange'])->name('password.change');

});

//Profile All Routes
Route::prefix('setups')->group(function(){

//Student Class All Routes

Route::get('/student/class/view', [StudentClassController::class, 'ViewStudentClass'])->name('student.class.view');

Route::post('/student/class/store', [StudentClassController::class, 'StoreStudentClass'])->name('student.class.store');

Route::get('/student/class/edit/{id}', [StudentClassController::class, 'EditStudentClass'])->name('student.class.edit');

Route::post('/student/class/update/{id}', [StudentClassController::class, 'UpdateStudentClass'])->name('student.class.update');

Route::get('/student/class/delete/{id}', [StudentClassController::class, 'DeleteStudentClass'])->name('student.class.delete');

//Student Year All Routes

Route::get('/student/year/view', [StudentYearController::class, 'ViewStudentYear'])->name('student.year.view');

Route::post('/student/year/store', [StudentYearController::class, 'StoreStudentYear'])->name('student.year.store');

Route::get('/student/year/edit/{id}', [StudentYearController::class, 'EditStudentYear'])->name('student.year.edit');

Route::post('/student/year/update/{id}', [StudentYearController::class, 'UpdateStudentYear'])->name('student.year.update');

Route::get('/student/year/delete/{id}', [StudentYearController::class, 'DeleteStudentYear'])->name('student.year.delete');

//Student Group All Routes

Route::get('/student/group/view', [StudentGroupController::class, 'ViewStudentGroup'])->name('student.group.view');

Route::post('/student/group/store', [StudentGroupController::class, 'StoreStudentGroup'])->name('student.group.store');

Route::get('/student/group/edit/{id}', [StudentGroupController::class, 'EditStudentGroup'])->name('student.group.edit');

Route::post('/student/group/update/{id}', [StudentGroupController::class, 'UpdateStudentGroup'])->name('student.group.update');

Route::get('/student/group/delete/{id}', [StudentGroupController::class, 'DeleteStudentGroup'])->name('student.group.delete');

//Student Shift All Routes

Route::get('/student/shift/view', [StudentShiftController::class, 'ViewStudentShift'])->name('student.shift.view');

Route::post('/student/shift/store', [StudentShiftController::class, 'StoreStudentShift'])->name('student.shift.store');

Route::get('/student/shift/edit/{id}', [StudentShiftController::class, 'EditStudentShift'])->name('student.shift.edit');

Route::post('/student/shift/update/{id}', [StudentShiftController::class, 'UpdateStudentShift'])->name('student.shift.update');

Route::get('/student/shift/delete/{id}', [StudentShiftController::class, 'DeleteStudentShift'])->name('student.shift.delete');

//Fee Category All Routes

Route::get('/fee/category/view', [FeeCategoryController::class, 'ViewFeeCategory'])->name('fee.category.view');

Route::post('/fee/category/store', [FeeCategoryController::class, 'StoreFeeCategory'])->name('fee.category.store');

Route::get('/fee/category/edit/{id}', [FeeCategoryController::class, 'EditFeeCategory'])->name('fee.category.edit');

Route::post('/fee/category/update/{id}', [FeeCategoryController::class, 'UpdateFeeCategory'])->name('fee.category.update');

Route::get('/fee/category/delete/{id}', [FeeCategoryController::class, 'DeleteFeeCategory'])->name('fee.category.delete');

//Fee Category Amount All Routes

Route::get('/fee/amount/view', [FeeAmountController::class, 'ViewFeeAmount'])->name('fee.amount.view');

Route::post('/fee/amount/store', [FeeAmountController::class, 'StoreFeeAmount'])->name('fee.amount.store');

Route::get('/fee/amount/edit/{fee_category_id}', [FeeAmountController::class, 'EditFeeAmount'])->name('fee.amount.edit');

Route::post('/fee/amount/update/{fee_category_id}', [FeeAmountController::class, 'UpdateFeeAmount'])->name('fee.amount.update');

Route::get('/fee/amount/details/{fee_category_id}', [FeeAmountController::class, 'DetailsFeeAmount'])->name('fee.amount.details');

//Exam Type All Routes

Route::get('/exam/type/view', [ExamTypeController::class, 'ViewExamType'])->name('exam.type.view');

Route::post('/exam/type/store', [ExamTypeController::class, 'StoreExamType'])->name('exam.type.store');

Route::get('/exam/type/edit/{id}', [ExamTypeController::class, 'EditExamType'])->name('exam.type.edit');

Route::post('/exam/type/update/{class_id}', [ExamTypeController::class, 'UpdateExamType'])->name('exam.type.update');

Route::get('/exam/type/delete/{class_id}', [ExamTypeController::class, 'DeleteExamType'])->name('exam.type.delete');

//School Subject All Routes

Route::get('school/subject/view', [SchoolSubjectController::class, 'ViewSchoolSubject'])->name('school.subject.view');

Route::post('school/subject/store', [SchoolSubjectController::class, 'StoreSchoolSubject'])->name('school.subject.store');

Route::get('school/subject/edit/{id}', [SchoolSubjectController::class, 'EditSchoolSubject'])->name('school.subject.edit');

Route::post('school/subject/update/{id}', [SchoolSubjectController::class, 'UpdateSchoolSubject'])->name('school.subject.update');

Route::get('school/subject/delete/{id}', [SchoolSubjectController::class, 'DeleteSchoolSubject'])->name('school.subject.delete');

//Assign Subject All Routes

Route::get('/assign/subject/view', [AssignSubjectController::class, 'ViewAssignSubject'])->name('assign.subject.view');

Route::post('/assign/subject/store', [AssignSubjectController::class, 'StoreAssignSubject'])->name('assign.subject.store');

Route::get('/assign/subject/edit/{id}', [AssignSubjectController::class, 'EditAssignSubject'])->name('assign.subject.edit');

Route::post('/assign/subject/update/{class_id}', [AssignSubjectController::class, 'UpdateAssignSubject'])->name('assign.subject.update');

Route::get('/assign/subject/details/{class_id}', [AssignSubjectController::class, 'DetailsAssignSubject'])->name('assign.subject.details');

//Designation All Routes

Route::get('/designation/view', [DesignationController::class, 'ViewDesignation'])->name('designation.view');

Route::post('/designation/store', [DesignationController::class, 'StoreDesignation'])->name('designation.store');

Route::get('/designation/edit/{id}', [DesignationController::class, 'EditDesignation'])->name('designation.edit');

Route::post('/designation/update/{id}', [DesignationController::class, 'UpdateDesignation'])->name('designation.update');

Route::get('/designation/delete/{id}', [DesignationController::class, 'DeleteDesignation'])->name('designation.delete');

});

Route::prefix('students')->group(function(){

Route::get('/registration/view', [StudentRegController::class, 'StudentRegView'])->name('student.registration.view');

Route::get('/registration/add', [StudentRegController::class, 'StudentRegAdd'])->name('student.registration.add');

Route::post('/registration/store', [StudentRegController::class, 'StudentRegStore'])->name('student.registration.store');

Route::get('/year/class/wise', [StudentRegController::class, 'StudentYearClassWise'])->name('student.year.class.wise');

Route::get('/registration/edit/{student_id}', [StudentRegController::class, 'StudentRegEdit'])->name('student.registration.edit');

Route::post('/registration/update/{student_id}', [StudentRegController::class, 'StudentRegUpdate'])->name('student.registration.update');

Route::get('/registration/promotion/{student_id}', [StudentRegController::class, 'StudentRegPromotion'])->name('student.registration.promotion');

Route::post('/registration/promotion/update/{student_id}', [StudentRegController::class, 'StudentRegUpdatePromotion'])->name('promotion.registration.update');

Route::get('/registration/detail/{student_id}', [StudentRegController::class, 'StudentRegDetails'])->name('student.registration.details');

//Student Roll Generate All Routes
Route::get('/roll/generate/view', [StudentRollController::class, 'StudentRollView'])->name('roll.generate.view');

Route::get('/reg/getstudents', [StudentRollController::class, 'GetStudents'])->name('student.registration.getstudents');

Route::post('/roll/generate/store', [StudentRollController::class, 'StudenrRollStore'])->name('roll.generate.store');

//Registration Fee All Routes
Route::get('/reg/fee/view', [RegistrationFeeController::class, 'RegFeeView'])->name('registration.fee.view');

Route::get('/reg/fee/classwise/data', [RegistrationFeeController::class, 'RegFeeClasswiseGet'])->name('registration.fee.classwise.get');

Route::get('/reg/fee/payslip', [RegistrationFeeController::class, 'RegFeePaySlip'])->name('student.registration.fee.payslip');

//Month Fee All Routes
Route::get('/monthly/fee/view', [MonthlyFeeController::class, 'MonthlyFeeView'])->name('monthly.fee.view');

Route::get('/monthly/fee/classwise/data', [MonthlyFeeController::class, 'MonthlyFeeClasswiseGet'])->name('monthly.fee.classwise.get');

Route::get('/monthly/fee/payslip', [MonthlyFeeController::class, 'MonthlyFeePaySlip'])->name('student.monthly.fee.payslip');

//Exam Fee All Routes
Route::get('/exam/fee/view', [ExamFeeController::class, 'ExamFeeView'])->name('exam.fee.view');

Route::get('/exam/fee/classwise/data', [ExamFeeController::class, 'ExamFeeClasswiseGet'])->name('exam.fee.classwise.get');

Route::get('/exam/fee/payslip', [ExamFeeController::class, 'ExamFeePaySlip'])->name('student.exam.fee.payslip');



});
Route::prefix('employees')->group(function(){

//Employee Registration Routes

Route::get('/registration/view', [EmployeeRegController::class, 'EmployeeRegView'])->name('employee.registration.view');

Route::get('/registration/add', [EmployeeRegController::class, 'EmployeeRegAdd'])->name('employee.registration.add');

Route::post('/registration/store', [EmployeeRegController::class, 'EmployeeRegStore'])->name('employee.registration.store');

Route::get('/registration/view', [EmployeeRegController::class, 'EmployeeRegView'])->name('employee.registration.view');

Route::get('/registration/edit/{id}', [EmployeeRegController::class, 'EmployeeRegEdit'])->name('employee.registration.edit');

Route::post('/registration/update/{id}', [EmployeeRegController::class, 'EmployeeRegUpdate'])->name('employee.registration.update');

Route::get('/registration/details/{id}', [EmployeeRegController::class, 'EmployeeRegDetails'])->name('employee.registration.details');

//Employee Salary Routes

Route::get('/salary/view', [EmployeeSalaryController::class, 'SalaryView'])->name('employee.salary.view');

Route::get('/salary/increment/{id}', [EmployeeSalaryController::class, 'SalaryIncrement'])->name('employee.salary.increment');

Route::post('/salary/increment/store/{id}', [EmployeeSalaryController::class, 'SalaryIncrementStore'])->name('store.salary.increment');

Route::get('/salary/increment/details/{id}', [EmployeeSalaryController::class, 'SalaryIncrementDetails'])->name('employee.salary.increment.details');

});

}); //End  Middleware Auth