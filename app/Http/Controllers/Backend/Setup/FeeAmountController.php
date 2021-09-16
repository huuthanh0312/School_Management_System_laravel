<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategory;
use App\Models\StudentClass;
use App\Models\FeeCategoryAmount;

class FeeAmountController extends Controller
{
    public function ViewFeeAmount(){
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        $data['allData'] = FeeCategoryAmount::select('fee_category_id')->GroupBy('fee_category_id')->get();
        return view('backend.setup.fee_amount.view_fee_amount', $data);
    }

    public function StoreFeeAmount(Request $request) {
        $countclass = count($request->class_id);
        if($countclass != NULL){
            for($i=0 ; $i< $countclass; $i++){
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];

                $fee_amount->save();
                
            }
            $notification=array(
                'message'=>'Fee Amount Inserted Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
        
    }

    public function EditFeeAmount($fee_category_id){
        
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        $data['editData'] = FeeCategoryAmount::where('fee_category_id',$fee_category_id)->orderBy('class_id', 'desc')->get();
        return view('backend.setup.fee_amount.edit_fee_amount', $data);
    }

    public function UpdateFeeAmount(Request $request, $fee_category_id){
        if($request->class_id == NULL){
            $notification=array(
                'message'=>'Sorry You Do Not Select Any Class Amount',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }else{
            $countclass = count($request->class_id);
            FeeCategoryAmount::where('fee_category_id', $fee_category_id)->delete();
            for($i=0 ; $i< $countclass; $i++){
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];

                $fee_amount->save();
                
            }
            $notification=array(
                'message'=>'Fee Amount Updated Successfully',
                'alert-type'=>'success'
            );
            return Redirect()->route('fee.amount.view')->with($notification);
            
        }
    }

    public function DetailsFeeAmount($fee_category_id){
        $data['detailsData'] = FeeCategoryAmount::where('fee_category_id', $fee_category_id)->orderBy('class_id', 'asc')->get();
        return view('backend.setup.fee_amount.details_fee_amount', $data);
    }
}
