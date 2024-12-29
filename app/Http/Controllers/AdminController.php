<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        ]);
        $user = new User;
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make(($request->password));
        $user->address = trim($request->address);
        $user->phonenumber = trim($request->phonenumber);
        $user->position = trim($request->position);
        $user->user_type = 'admin';
        $user->save();

        return redirect('admin/admin/list')->with('success', "Church Administrator successfully added");
    }
    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = "Edit Church Administrator";
            return view('admin.admin.edit', $data);
        } else {
            abort(404);
        }
    }
    public function update(Request $request, $id)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $user = User::getSingle($id);
        $user->name = trim($request->name);
        $user->email = trim($request->email);
        $user->password = Hash::make(($request->password));
        $user->address = trim($request->address);
        $user->phonenumber = trim($request->phonenumber);
        $user->position = trim($request->position);
        $user->user_type = 'admin';
        $user->save();

        return redirect('admin/admin/list')->with('success', "Church Administrator successfully updated");
    }
    public function delete($id)
    {
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();
        return redirect('admin/admin/list')->with('success', "Church Administrator successfully deleted");
    }
}
