<?php

namespace App\Http\Controllers;

use App\Models\MembersModel;
use App\Models\MinistryModel;
use App\Models\AssignMinistryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignMinistryController extends Controller
{
    public function list(Request $request)
    {
        $data['getRecord'] = AssignMinistryModel::getRecord();
        $data['header_title'] = "Assign Ministry List";

        if (Auth::check()) {
            if (Auth::user()->user_type == 'admin') {
                return view('admin.assign_ministry.list', $data);
            } else if (Auth::user()->user_type == 'user') {
                return view('user.assign_ministry.list', $data);
            }
        } else {
            return redirect('login')->with('error', 'Please log in to view the ministry list');
        }
    }
    public function assign(Request $request)
    {
        $data['getMinistries'] = MinistryModel::getMinistries();
        $data['getMembers'] = MembersModel::getMembers();
        $data['header_title'] = "Assign Ministry";

        if (Auth::check()) {
            if (Auth::user()->user_type == 'admin') {
                return view('admin.assign_ministry.assign', $data);
            } else if (Auth::user()->user_type == 'user') {
                return view('user.assign_ministry.assign', $data);
            }
        } else {
            return redirect('login')->with('error', 'Please log in to assign a ministry');
        }
    }
    public function assigned(Request $request)
    {
        $assignedministry = new AssignMinistryModel;
        $assignedministry->member_id = $request->member_id;
        $assignedministry->ministry_id = $request->ministry_id;
        $assignedministry->ministry_status = $request->ministry_status;
        $assignedministry->save();

        return redirect('admin/assign_ministry/list')->with('success', "Member successfully assigned to Ministry");
    }
    public function edit($id)
    {
        $data['getRecord'] = AssignMinistryModel::getSingle($id);
        $data['getMinistries'] = MinistryModel::getMinistries();
        $data['getMembersEdit'] = MembersModel::getMembersEdit();
        $data['header_title'] = "Edit Assigned Ministry";

        if (Auth::check()) {
            if (Auth::user()->user_type == 'admin') {
                return view('admin.assign_ministry.edit', $data);
            } else if (Auth::user()->user_type == 'user') {
                return view('user.assign_ministry.edit', $data);
            }
        } else {
            return redirect('login')->with('error', 'Please log in to edit the ministry assignment');
        }
    }
    public function update(Request $request, $id)
    {
        $assignedministry = AssignMinistryModel::getSingle($id);
        $assignedministry->ministry_id = $request->ministry_id;
        $assignedministry->ministry_status = $request->ministry_status;
        $assignedministry->save();

        return redirect('admin/assign_ministry/list')->with('success', "Assigned Ministry successfully updated");
    }

    public function delete($id)
    {
        $record = AssignMinistryModel::find($id);
        if ($record) {
            $record->delete();
            return redirect()->back()->with('success', 'Assigned member successfully deleted from the Ministry.');
        } else {
            return redirect('admin/assign_ministry/list')->with('error', 'No record found');
        }
    }
}
