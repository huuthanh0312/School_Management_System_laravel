<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function UserView(){
        $data['alluser']= User::where('type', 'Admin')->get();
        return view('backend.user.view_user',$data);
    }

    public function UserStore(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|unique:users',
            
        ]);
        $data = new User();
        $data['type'] = 'Admin';
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['role'] = $request->role;
        $code = rand(10000000, 99999999);
        $data['code'] = $code;
        $data['password'] = Hash::make($code);
        $data->save();
        $notification=array(
            'message'=>'User Inserted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);

    }

    public function UserEdit($id) {
        $user = User::find($id);
        return view('backend.user.edit_user',compact('user'));
    }

    public function UserUpdate(Request $request, $id) {
        $validatedData = $request->validate([
            'name' => 'required|',
            'email' => 'required',
        ]);
        $data = User::find($id);
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['role'] = $request->role;
        $data->save();
        $notification=array(
            'message'=>'User Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('user.view')->with($notification);
    }

    public function UserDelete($id) {
        User::find($id)->delete();
        $notification=array(
            'message'=>'User Deleted Successfully',
            'alert-type'=>'info'
        );
        return Redirect()->back()->with($notification);
    }
}
