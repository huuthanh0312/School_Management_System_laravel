<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamType;

class ExamTypeController extends Controller
{
    public function ViewExamType(){
        $data['allData'] = ExamType::all();
        return view('backend.setup.exam_type.view_exam_type', $data);
    }

    public function StoreExamType(Request $request){
        $validateData = $request->validate([
            'name' => 'required|unique:exam_types',
        ]);
        $data = new ExamType();
        $data['name'] = $request->name;
        $data->save();
        $notification=array(
            'message'=>'Exam Type Inserted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function EditExamType($id) {
        $exam_type = ExamType::find($id);
        return view('backend.setup.exam_type.edit_exam_type', compact('exam_type'));
    }

    public function UpdateExamType(Request $request, $id){
        $data = ExamType::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:exam_types,name,'.$data->id
        ]);
        
        $data->name = $request->name;
        $data->save();
        $notification=array(
            'message'=>'Exam Type Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('exam.type.view')->with($notification);
    }

    public function DeleteExamType($id) {
        ExamType::find($id)->delete();
        $notification=array(
            'message'=>'Exam Type Deleted Successfully',
            'alert-type'=>'info'
        );
        return Redirect()->back()->with($notification);
    }
}
