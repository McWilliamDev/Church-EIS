<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getAdmin();
        $data['header_title'] = "Church Administrator List";
        return view('admin.admin.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add Church Administrator ";
        return view('admin.admin.add', $data);
    }
    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
            'phonenumber' => 'max:20|min:11',
        ]);
        $admin = new User;
        $admin->name = trim($request->name);
        $admin->email = trim($request->email);

        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename =  strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);

            $admin->profile_pic = $filename;
        }

        $admin->password = Hash::make(($request->password));
        $admin->address = trim($request->address);
        $admin->phonenumber = trim($request->phonenumber);
        $admin->position = trim($request->position);
        $admin->user_type = 'admin';
        $admin->save();

        return redirect('admin/admin/list')->with('success', "Church Administrator successfully added");
    }
    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = "Edit Church Administrator";
            return view('admin.admin.edit', $data);
        } else {
            return redirect('admin/admin/list')->with('error', 'No Record Found');
        }
    }
    public function update(Request $request, $id)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'phonenumber' => 'max:20|min:11',
        ]);

        $admin = User::getSingle($id);
        $admin->name = trim($request->name);
        $admin->email = trim($request->email);

        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename =  strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);

            $admin->profile_pic = $filename;
        }
        $admin->address = trim($request->address);
        $admin->phonenumber = trim($request->phonenumber);
        $admin->position = trim($request->position);
        $admin->user_type = 'admin';
        $admin->save();

        return redirect('admin/admin/list')->with('success', "Church Administrator successfully updated");
    }
    public function delete($id)
    {
        $admin = User::getSingle($id);
        $admin->is_delete = 1;
        $admin->save();
        return redirect('admin/admin/list')->with('success', "Church Administrator successfully deleted");
    }
}
