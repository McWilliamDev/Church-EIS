<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MinistryModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class MembersController extends Controller
{
    public function list()
    {
        $data['getMember'] = User::getMember();
        $data['header_title'] = "Members List";
        return view('admin.member.list', $data);
    }

    public function add()
    {
        $data['getRecord'] = MinistryModel::getRecord();
        $data['header_title'] = "Add Member";
        return view('admin.member.add', $data);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'phonenumber' => 'max:15|min:11',
        ]);

        $member = new User;
        $member->name = trim($request->name);
        $member->last_name = trim($request->name);
        $member->email = trim($request->email);
        $member->phonenumber = trim($request->phonenumber);
        $member->gender = trim($request->gender);
        $member->ministry_name = trim($request->ministry_name);
        $member->user_type = 'member';
        if (!empty($request->date_of_birth)) {
            $member->date_of_birth = trim($request->date_of_birth);
        }
        if (!empty($request->profile_pic)) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);

            $member->profile_pic = $filename;
        }
        $member->address = trim($request->address);
        $member->password = Hash::make($request->password);
        $member->save();
        return redirect('admin/member/list')->with('success', 'Member Added Successfully');
    }
}
