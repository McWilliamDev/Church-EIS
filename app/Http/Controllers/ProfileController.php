<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function MyProfile()
    {
        $data['getRecord'] = User::getSingle(Auth::user()->id);
        $data['header_title'] = "My Profile";
        if (Auth::user()->user_type == 'admin') {
            return view('admin.my_profile', $data);
        } else if (Auth::user()->user_type == 'user') {
            return view('user.my_profile', $data);
        }
    }

    public function UpdateMyProfileAdmin(Request $request)
    {
        $id = Auth::user()->id;

        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'phonenumber' => 'max:20|min:11',
        ]);
        $admin = User::getSingle($id);
        $admin->name = trim($request->name);
        $admin->email = trim($request->email);
        $admin->address = trim($request->address);
        $admin->phonenumber = trim($request->phonenumber);
        $admin->user_type = 'admin';
        $admin->save();

        return redirect()->back()->with('success', 'Profile Updated Successfully');
    }
    public function uploadProfileImage(Request $request)
    {
        $request->validate([
            'profile_pic' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $id = Auth::user()->id;
        $admin = User::getSingle($id);

        if ($request->hasFile('profile_pic')) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);

            // Optionally delete the old image if it exists
            if ($admin->profile_pic) {
                $oldImagePath = public_path('upload/profile/' . $admin->profile_pic);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $admin->profile_pic = $filename;
            $admin->save();
        }

        return response()->json(['success' => true, 'message' => 'Image uploaded successfully.']);
    }

    public function deleteProfileImage()
    {
        $id = Auth::user()->id;
        $admin = User::getSingle($id);

        if ($admin->profile_pic) {
            $oldImagePath = public_path('upload/profile/' . $admin->profile_pic);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
                $admin->profile_pic = null; // Clear the profile_pic field
                $admin->save();
                return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
            }
        }

        return response()->json(['success' => false, 'message' => 'No image found to delete.']);
    }

    public function UpdateMyProfile(Request $request)
    {
        $id = Auth::user()->id;
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'phonenumber' => 'max:20|min:11',
        ]);

        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);

        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename =  strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);

            $user->profile_pic = $filename;
        }
        $user->address = trim($request->address);
        $user->phonenumber = trim($request->phonenumber);
        $user->user_type = 'user';
        $user->save();

        return redirect()->back()->with('success', 'Profile Updated Successfully');
    }

    public function change_password()
    {
        $data['header_title'] = "Change Password";
        return view('profile.change_password', $data);
    }

    public function update_change_password(Request $request)
    {
        $user = User::getSingle(Auth::user()->id);
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect()->back()->with('success', 'Password Successfully Updated');
        } else {
            return redirect()->back()->with('error', 'Old password is incorrect!');
        }
    }
}
