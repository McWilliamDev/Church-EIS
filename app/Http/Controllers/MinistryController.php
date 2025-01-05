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
        return view('admin.ministry.list', $data);
    }

    public function add()
    {
        $data['header_title'] = "Add Ministry";
        return view('admin.ministry.add', $data);
    }
    public function insert(Request $request)
    {
        $ministry = new MinistryModel;
        $ministry->ministry_name = $request->name;
        $ministry->ministry_status = $request->status;
        $ministry->created_by = Auth::user()->id;
        $ministry->save();

        return redirect('admin/ministry/list')->with('success', 'Ministry Added Successfully');
    }

    public function edit($id)
    {
        $data['getRecord'] = MinistryModel::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = "Edit Ministry";
            return view('admin.ministry.edit', $data);
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

        return redirect('admin/ministry/list')->with('success', 'Ministry Successfully Updated');
    }
    public function delete($id)
    {
        $ministry = MinistryModel::getSingle($id);
        $ministry->is_delete = 1;
        $ministry->save();

        return redirect()->back()->with('success', 'Ministry Successfully Deleted');
    }
}
