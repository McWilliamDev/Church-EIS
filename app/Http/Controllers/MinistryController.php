<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\MinistryModel;

class MinistryController extends Controller
{
    public function list()
    {
        $data['getRecord'] = MinistryModel::getRecord();
        $data['header_title'] = "Ministry List";

        if (Auth::check()) {
            if (Auth::user()->user_type == 'admin') {
                return view('admin.ministry.list', $data);
            } else if (Auth::user()->user_type == 'user') {
                return view('user.ministry.list', $data);
            }
        } else {
            return redirect('login')->with('error', 'Please log in to view the ministry list');
        }
    }

    public function add()
    {
        $data['header_title'] = "Add Ministry";

        if (Auth::check()) {
            if (Auth::user()->user_type == 'admin') {
                return view('admin.ministry.add', $data);
            } else if (Auth::user()->user_type == 'user') {
                return view('user.ministry.add', $data);
            }
        } else {
            return redirect('login')->with('error', 'Please log in to add a ministry');
        }
    }

    public function insert(Request $request)
    {
        $ministry = new MinistryModel;
        $ministry->ministry_name = $request->name;
        $ministry->ministry_description = $request->ministry_description;
        $ministry->ministry_status = $request->status;
        $ministry->created_by = Auth::user()->id;

        if ($request->hasFile('ministry_profile')) {
            $file = $request->file('ministry_profile');
            $ext = $file->getClientOriginalExtension();
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/ministry/', $filename);
            $ministry->ministry_profile = $filename;
        }
        $ministry->save();

        if (Auth::check()) {
            if (Auth::user()->user_type == 'admin') {
                return redirect('admin/ministry/list')->with('success', 'Ministry Added Successfully');
            } else if (Auth::user()->user_type == 'user') {
                return redirect('user/ministry/list')->with('success', 'Ministry Added Successfully');
            }
        } else {
            return redirect('login')->with('error', 'Please log in to add a ministry');
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
        $ministry->ministry_description = $request->ministry_description;
        $ministry->ministry_status = $request->status;
        $ministry->created_by = Auth::user()->id;

        if ($request->hasFile('ministry_profile')) {
            $file = $request->file('ministry_profile');
            $ext = $file->getClientOriginalExtension();
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/ministry/', $filename);
            $ministry->ministry_profile = $filename;
        }
        $ministry->save();

        if (Auth::check()) {
            if (Auth::user()->user_type == 'admin') {
                return redirect('admin/ministry/list')->with('success', 'Ministry Successfully Updated');
            } else if (Auth::user()->user_type == 'user') {
                return redirect('user/ministry/list')->with('success', 'Ministry Successfully Updated');
            }
        } else {
            return redirect('login')->with('error', 'Please log in to update the ministry');
        }
    }

    public function delete($id)
    {
        // Find the ministry by ID
        $ministry = MinistryModel::getSingle($id);

        if ($ministry) {
            $ministry->is_delete = 1;
            $ministry->save();
            return redirect()->back()->with('success', 'Ministry successfully marked as deleted.');
        } else {

            return redirect()->back()->with('error', 'Ministry not found.');
        }
    }
}
