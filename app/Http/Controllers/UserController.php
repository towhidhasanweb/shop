<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\Facades\Image;


class UserController extends Controller
{
    function user_view(){
        $view_users = User::all();
        $total_users = User::count();
        return view('admin.user.view_users', compact('view_users', 'total_users'));
    }
    function user_delete($user_id){
        User::find($user_id )->delete();
        return back()->with('delete', 'User Deleted Success!');
    }

    function profile(){
        return view('admin.user.profile');
    }

    function name_change(Request $request){
          User::find(Auth::id())->update([
            'name'=>$request->name,
          ]);
          return back()->with('name_update', 'Name has been updated!');
    }
    function password_change(Request $request){
        $request->validate([
            'old_password'=> 'required',
            'password'=> ['required', 'confirmed', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
            'password_confirmation'=> 'required',
        ],[
                'old_password.required'=> 'Old password missing',
                'password.required'=> 'Password missing',
                'password_confirmation.required'=> 'confirm password missing',
                'password.confirmed'=>'password and confirm password not match'
            ]);
            if(Hash::check($request->old_password, Auth::user()->password)){
                User::find(Auth::id())->update([
                    'password'=>bcrypt($request->password)
                ]);
                return back()->with('password_update', 'Password has been updated!');
            }else{
                return back()->with('password_wrong', 'wrong old password');
            }
    }

    function photo_change(Request $request){
        $profile_image = $request->profile_image;
        if(Auth::user()->profile_image != null){
            $path = public_path('upload/user/'.Auth::user()->profile_image);
            unlink($path);

            $extension = $profile_image->getClientOriginalExtension();
            $image_name = "user".Auth::id().'.'.$extension;
            Image::make($profile_image)->save(public_path('upload/user/'.$image_name));
            User::find(Auth::id())->update([
                'profile_image'=>$image_name,
            ]);
            return back()->with('image_success', 'Photo has been updated');
        } else{
            $extension = $profile_image->getClientOriginalExtension();
            $image_name = "user".Auth::id().'.'.$extension;
            Image::make($profile_image)->save(public_path('upload/user/'.$image_name));
            User::find(Auth::id())->update([
                'profile_image'=>$image_name,
            ]);
            return back()->with('image_success', 'Photo has been updated');
        }

    }
}
