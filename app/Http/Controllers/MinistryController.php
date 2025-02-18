<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MinistryModel;


class MinistryController extends Controller
{
    public function list()
    {
        $data['getRecord'] = MinistryModel::getRecord();
        $data['header_title'] = "Ministry List";

        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return view('admin.ministry.list', $data);
            } else if (Auth::user()->user_type == 'user') {
                return view('user.ministry.list', $data);
            }
        }
    }

    public function add()
    {
        $data['header_title'] = "Add Ministry";
        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return view('admin.ministry.add', $data);
            } else if (Auth::user()->user_type == 'user') {
                return view('user.ministry.add', $data);
            }
        }
    }
    public function insert(Request $request)
    {
        $ministry = new MinistryModel;
        $ministry->ministry_name = $request->name;
        $ministry->ministry_status = $request->status;
        $ministry->created_by = Auth::user()->id;
        $ministry->save();

        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return redirect('admin/ministry/list')->with('success', 'Ministry Added Successfully');
            } else if (Auth::user()->user_type == 'user') {
                return redirect('user/ministry/list')->with('success', 'Ministry Added Successfully');
            }
        }
    }

    public function edit($id)
    {
        $data['getRecord'] = MinistryModel::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = "Edit Ministry";

            if (Auth::check()) {
                if (Auth::user()->user_type == 'admin') {
                    return view('admin.ministry.edit', $data);
                } elseif (Auth::user()->user_type == 'user') {
                    return view('user.ministry.edit', $data);
                } else {
                    return redirect('admin/ministry/list')->with('error', 'Ministry Not Found');
                }
            } else {
                return redirect('login')->with('error', 'Please log in to edit the ministry');
            }
        } else {
            return redirect('admin/ministry/list')->with('error', 'Ministry Not Found');
        }
    }

    public function update(Request $request, $id)
    {
        $ministry = MinistryModel::getSingle($id);
        $ministry->ministry_name = $request->name;
        $ministry->ministry_status = $request->status;
        $ministry->save();

        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return redirect('admin/ministry/list')->with('success', 'Ministry Successfully Updated');
            } else if (Auth::user()->user_type == 'user') {
                return redirect('user/ministry/list')->with('success', 'Ministry Successfully Updated');
            }
        }
    }
    public function delete($id)
    {
        $ministry = MinistryModel::getSingle($id);
        $ministry->is_delete = 1;
        $ministry->save();

        if (!empty(Auth::check())) {
            if (Auth::user()->user_type == 'admin') {
                return redirect()->back()->with('success', 'Ministry Successfully Deleted');
            } else if (Auth::user()->user_type == 'user') {
                return redirect()->back()->with('success', 'Ministry Successfully Deleted');
            }
        }
    }
}
