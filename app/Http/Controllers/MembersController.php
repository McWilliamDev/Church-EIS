<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MembersModel;
use App\Models\MinistryModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class MembersController extends Controller
{
    public function list()
    {
        $data['getRecord'] = MembersModel::getMember();
        $data['header_title'] = "Members List";

        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return view('admin.member.list', $data);
            } else if (Auth::user()->user_type == 'user') {
                return view('user.member.list', $data);
            }
        }
    }

    public function add()
    {
        $data['getMinistry'] = MinistryModel::getRecord();
        $data['header_title'] = "Add New Member";

        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return view('admin.member.add', $data);
            } else if (Auth::user()->user_type == 'user') {
                return view('user.member.add', $data);
            }
        }
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
        $member->created_by = Auth::user()->id;
        $member->ministry_id = $request->ministry_id;

        if (!empty($request->date_of_birth)) {
            $member->date_of_birth = trim($request->date_of_birth);
        }

        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename =  strtolower($randomStr) . '.' . $ext;
            $file->move('upload/member_profiles/', $filename);

            $member->profile_pic = $filename;
        }

        $member->address = $request->address;
        $member->member_status = $request->member_status;
        $member->save();

        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return redirect('admin/member/list')->with('success', 'Member Added Successfully');
            } else if (Auth::user()->user_type == 'user') {
                return redirect('user/member/list')->with('success', 'Member Added Successfully');
            }
        }
    }

    public function edit($id)
    {
        $data['getRecord'] = MembersModel::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['getMinistry'] = MinistryModel::getRecord();
            $data['header_title'] = "Edit Member";

            if (Auth::check()) {
                if (Auth::user()->user_type == 'admin') {
                    return view('admin.member.edit', $data);
                } elseif (Auth::user()->user_type == 'user') {
                    return view('user.member.edit', $data);
                } else {
                    return redirect('admin/member/list')->with('error', 'No Record Found');
                }
            } else {
                return redirect('login')->with('error', 'Please log in to edit the members');
            }
        } else {
            return redirect('admin/member/list')->with('error', 'Member Not Found');
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

        $oldProfilePic = $member->profile_pic;

        if (!empty($request->file('profile_pic'))) {
            // If a new profile picture is uploaded, delete the old one
            if (!empty($oldProfilePic) && file_exists('upload/member_profiles/' . $oldProfilePic)) {
                unlink('upload/member_profiles/' . $oldProfilePic);
            }

            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/member_profiles/', $filename);

            $member->profile_pic = $filename;
        }

        $member->address = $request->address;
        $member->member_status = $request->member_status;
        $member->save();

        if (Auth::check()) {
            if (Auth::user()->user_type == 'admin') {
                return redirect('admin/member/list')->with('success', 'Member Successfully Updated');
            } else if (Auth::user()->user_type == 'user') {
                return redirect('user/member/list')->with('success', 'Member Successfully Updated');
            }
        }
    }
    public function delete($id)
    {
        // Find the member by ID
        $getRecord = MembersModel::find($id);

        if ($getRecord) {
            $getRecord->is_delete = 1; // Mark the member as deleted
            $getRecord->save();

            return redirect()->back()->with('success', 'Member successfully deleted.');
        }

        return redirect()->back()->with('error', 'Member not found.');
    }

    //Archived Functions
    public function archived()
    {
        $data['getRecord'] = MembersModel::where('is_delete', 1)->paginate(999);
        $data['header_title'] = "Archived Members";
        return view('admin.archived.members', $data);
    }
    public function restore($id)
    {
        $member = MembersModel::find($id);
        if ($member) {
            $member->is_delete = 0;
            $member->save();
            return redirect('admin/archived/members')->with('success', 'Member has been restored.');
        }
        return redirect('admin/archived/members')->with('error', 'User  not found.');
    }
    public function deleteArchived($id)
    {
        $member = MembersModel::find($id);
        if ($member) {
            if (!empty($member->profile_pic) && file_exists(public_path('upload/member_profiles/' . $member->profile_pic))) {
                unlink(public_path('upload/member_profiles/' . $member->profile_pic));
            }
            $member->delete();
            return redirect('admin/archived/members')->with('success', 'Member has been deleted permanently.');
        }
        return redirect('admin/archived/members')->with('error', 'Member not found.');
    }
}
