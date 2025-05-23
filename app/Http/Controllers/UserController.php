<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getUser();
        $data['header_title'] = "Board Members List";
        return view('admin.user.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add Board Member";
        return view('admin.user.add', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'phonenumber' => 'max:20|min:11',
            'password' => [
                'required',
                'string',
                'min:8', // Minimum length
                'regex:/[A-Z]/', // At least one uppercase letter
                'regex:/[a-z]/', // At least one lowercase letter
                'regex:/[0-9]/', // At least one number
                'regex:/[@$!%*?&]/', // At least one special character
            ],
        ]);

        $user = new User;
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
        $user->password = Hash::make(($request->password));
        $user->address = trim($request->address);
        $user->phonenumber = trim($request->phonenumber);
        $user->position = trim($request->position);
        $user->user_type = 'user';
        $user->save();

        return redirect('admin/user/list')->with('success', "Board Member successfully added");
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = "Edit Board Member";
            return view('admin.user.edit', $data);
        } else {
            return redirect('admin/user/list')->with('error', 'No Record Found');
        }
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'phonenumber' => 'max:20|min:11',
        ]);

        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);

        // Store the old profile picture filename for deletion
        $oldProfilePic = $user->profile_pic;

        if (!empty($request->file('profile_pic'))) {
            // If a new profile picture is uploaded, delete the old one
            if (!empty($oldProfilePic) && file_exists('upload/profile/' . $oldProfilePic)) {
                unlink('upload/profile/' . $oldProfilePic);
            }

            // Process the new profile picture
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);

            $user->profile_pic = $filename;
        }

        $user->address = trim($request->address);
        $user->phonenumber = trim($request->phonenumber);
        $user->position = trim($request->position);
        $user->user_type = 'user';
        $user->save();

        return redirect('admin/user/list')->with('success', "Board Member successfully updated");
    }
    public function delete($id)
    {
        $getRecord = User::find($id);

        if ($getRecord) {
            if (!empty($getRecord->profile_pic) && file_exists('upload/profile/' . $getRecord->profile_pic)) {
                unlink('upload/profile/' . $getRecord->profile_pic);
            }

            $getRecord->delete();

            return redirect('admin/user/list')->with('success', "Board Member successfully deleted");
        } else {
            return redirect()->back()->with('error', "No Record Found");
        }
    }
}
