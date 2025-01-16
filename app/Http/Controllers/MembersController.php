<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MembersModel;
use App\Models\MinistryModel;
use Illuminate\Support\Str;


class MembersController extends Controller
{
    public function list()
    {
        $data['getRecord'] = MembersModel::getMember();
        $data['header_title'] = "Members List";
        return view('admin.member.list', $data);
    }

    public function add()
    {
        $data['getMinistry'] = MinistryModel::getRecord();
        $data['header_title'] = "Add New Student";
        return view('admin.member.add', $data);
    }
    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:members',
            'phonenumber' => 'max:20|min:11',
        ]);

        $member = new MembersModel;
        $member->name = $request->name;
        $member->last_name = $request->last_name;
        $member->email = $request->email;
        $member->phonenumber = $request->phonenumber;
        $member->gender = $request->gender;
        $member->ministry_id = $request->ministry_id;

        if (!empty($request->date_of_birth)) {
            $member->date_of_birth = trim($request->date_of_birth);
        }

        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename =  strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);

            $member->profile_pic = $filename;
        }

        $member->address = $request->address;
        $member->member_status = $request->member_status;
        $member->save();


        return redirect('admin/member/list')->with('success', 'Member Added Successfully');
    }
    public function edit($id)
    {
        $data['getRecord'] = MembersModel::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['getMinistry'] = MinistryModel::getRecord();
            $data['header_title'] = "Edit Member";
            return view('admin.member.edit', $data);
        } else {
            return redirect('admin/member/list')->with('error', 'No Record Found');
        }
    }
    public function update(Request $request, $id)
    {
        request()->validate([
            'email' => 'required|email|unique:members,email,' . $id,
            'phonenumber' => 'max:20|min:11',
        ]);

        $member = MembersModel::getSingle($id);
        $member->name = $request->name;
        $member->last_name = $request->last_name;
        $member->email = $request->email;
        $member->phonenumber = $request->phonenumber;
        $member->gender = $request->gender;
        $member->ministry_id = $request->ministry_id;

        if (!empty($request->date_of_birth)) {
            $member->date_of_birth = trim($request->date_of_birth);
        }

        if (!empty($request->file('profile_pic'))) {
            if (!empty($member->getProfile())) {
                unlink('upload/profile/' . $member->profile_pic);
            }

            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename =  strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);

            $member->profile_pic = $filename;
        }

        $member->address = $request->address;
        $member->member_status = $request->member_status;
        $member->save();


        return redirect('admin/member/list')->with('success', 'Member Successfully Updated');
    }
    public function delete($id)
    {
        $getRecord = MembersModel::getSingle($id);
        if (!empty($getRecord)) {
            $getRecord->is_delete = 1;
            $getRecord->save();
            return redirect()->back()->with('success', "Member Successfully Deleted");
        } else {
            return redirect()->back()->with('error', "Member Not Found");
        }
    }
}
