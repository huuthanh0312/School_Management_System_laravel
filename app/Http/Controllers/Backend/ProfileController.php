<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function ProfileView(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('backend.user.view_profile', compact('user'));
    }

    public function ProfileEdit(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('backend.user.edit_profile', compact('user'));
    }

    public function ProfileUpdate(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'image' => 'mimes:jpg,jpeg,png',
        ]);
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->mobile = $request->mobile;
        $data->address = $request->address;
        $data->gender = $request->gender;

        if($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('upload/user_images/'.$data->image));
            $image = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images/'),$image);
            $data['image'] = $image;

        }
        $data->save();
        $notification=array(
            'message'=>'User Inserted Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('profile.view')->with($notification);
    }
    
    public function PasswordView() {
        return view('backend.user.edit_password');
    }

    public function PasswordChange(Request $request){
        $validatedData = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        $password = Auth::user()->password;

        if(Hash::check($request->old_password, $password)){
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return Redirect()->route('login')->with('success', 'Please Login Return');

            
        }else{
            $notification=array(
                'message'=>'Old Password Is Not Correct',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }
    }
}
