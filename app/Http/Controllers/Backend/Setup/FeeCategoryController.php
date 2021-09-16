<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategory;

class FeeCategoryController extends Controller
{
    public function ViewFeeCategory(){
        $data['allData'] = FeeCategory::all();
        return view('backend.setup.fee_category.view_fee_cat', $data);
    }

    public function StoreFeeCategory(Request $request){
        $validateData = $request->validate([
            'name' => 'required|unique:fee_categories',
        ]);
        $data = new FeeCategory();
        $data['name'] = $request->name;
        $data->save();
        $notification=array(
            'message'=>'Fee Category Inserted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function EditFeeCategory($id) {
        $fee_cat = FeeCategory::find($id);
        return view('backend.setup.fee_category.edit_fee_cat', compact('fee_cat'));
    }

    public function UpdateFeeCategory(Request $request, $id){
        $data = FeeCategory::find($id);
        $validateData = $request->validate([
            'name' => 'required|unique:fee_categories,name,'.$data->id
        ]);
        
        $data->name = $request->name;
        $data->save();
        $notification=array(
            'message'=>'Fee Category Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('fee.category.view')->with($notification);
    }

    public function DeleteFeeCategory($id) {
        FeeCategory::find($id)->delete();
        $notification=array(
            'message'=>'Fee Category Deleted Successfully',
            'alert-type'=>'info'
        );
        return Redirect()->back()->with($notification);
    }
}
