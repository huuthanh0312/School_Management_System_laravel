<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountOtherCost;

class OtherCostController extends Controller
{
    public function OtherCostView(){
        $data['allData'] = AccountOtherCost::orderBy('id', 'desc')->get();
        return view('backend.account.other_cost.other_cost_view', $data);
    }

    public function OtherCostStore(Request $request) {
        $data = new AccountOtherCost();
        $data->date = date('Y-m-d', strtotime($request->date));
        $data->amount = $request->amount;
        $data->description = $request->description;
        if($request->file('image')){
            $file = $request->file('image');
            $image = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/cost_images/'),$image);
            $data['image'] = $image;

        }
        $data->save();
        $notification=array(
            'message'=>'Other Cost Inserted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('account.other.cost.view')->with($notification);
    }

    public function OtherCostEdit($id) {
        $data['editData'] = AccountOtherCost::find($id);
        return view('backend.account.other_cost.other_cost_edit', $data);
    }

    public function OtherCostUpdate(Request $request, $id) {
        $data = AccountOtherCost::find($id);
        $data->date = date('Y-m-d', strtotime($request->date));
        $data->amount = $request->amount;
        $data->description = $request->description;
        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('upload/cost_images/'.$data->image));
            $image = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/cost_images/'),$image);
            $data['image'] = $image;

        }
        $data->save();
        $notification=array(
            'message'=>'Other Cost Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('account.other.cost.view')->with($notification);
    }
}
