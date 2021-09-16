<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;

class DesignationController extends Controller
{
    public function ViewDesignation(){
        $data['allData'] = Designation::all();
        return view('backend.setup.designation.view_designation', $data);
    }

    public function StoreDesignation(Request $request){
        $validateData = $request->validate([
            'name' => 'required|unique:designations',
        ]);
        $data = new Designation();
        $data['name'] = $request->name;
        $data->save();
        $notification=array(
            'message'=>'Designation Inserted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function EditDesignation($id) {
        $designation = Designation::find($id);
        return view('backend.setup.designation.edit_designation', compact('designation'));
    }

    public function UpdateDesignation(Request $request, $id){
        $data = Designation::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:designations,name,'.$data->id
        ]);
        
        $data->name = $request->name;
        $data->save();
        $notification=array(
            'message'=>'Designation Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('designation.view')->with($notification);
    }

    public function DeleteDesignation($id) {
        Designation::find($id)->delete();
        $notification=array(
            'message'=>'Designation Deleted Successfully',
            'alert-type'=>'info'
        );
        return Redirect()->back()->with($notification);
    }
}
