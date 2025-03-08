<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FinanceModel;
use App\Models\MembersModel;
use RealRashid\SweetAlert\Facades\Alert;

class FinanceController extends Controller
{
    public function list()
    {
        $data['header_title'] = "Finance List";
        $reports = FinanceModel::with('member')->get(); // Fetch all finance records
        return view('admin.finance.list', $data, compact('reports'));
    }

    public function add()
    {
        $data['header_title'] = "Add Finance";
        $members = MembersModel::all(); // Fetch all members
        $reports = FinanceModel::with('member')->get();
        return view('admin.finance.add', $data, compact('members'));
    }

    public function edit($id)
    {
        $data['header_title'] = "Edit Finance";
        $report = FinanceModel::with('member')->findOrFail($id); // Fetch finance record with related member
        $members = MembersModel::all(); // Fetch all members
        return view('admin.finance.edit', $data, compact('report', 'members'));
    }



    public function addFinance(Request $request)
    {
        // Validate form input
        $request->validate([
            'member' => 'required|integer',
            'type' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
            'purpose' => 'nullable|string|max:150',
        ]);

        // Save data to the database
        FinanceModel::create([
            'member_id' => $request->member,
            'type' => $request->type,
            'amount' => $request->amount,
            'purpose' => $request->purpose
        ]);
        Alert::success('Success!', 'Data has been added successfully.');
        // Redirect with success message
        return redirect()->route('finance.list');
    }

    public function update(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'member' => 'required|integer',
            'type' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
            'purpose' => 'required|string|max:150',
        ]);

        // Find the record and update it
        $report = FinanceModel::findOrFail($id);
        $report->update([
            'member_id' => $request->member,
            'type' => $request->type,
            'amount' => $request->amount,
            'purpose' => $request->purpose,
        ]);
        Alert::success('Success!', 'Data has been updated successfully.');
        return redirect()->route('finance.list');
    }

    public function delete($id)
    {
        $report = FinanceModel::findOrFail($id);
        $report->delete();

        Alert::success('Success!', 'Data has been deleted successfully.');
        return redirect()->route('finance.list');
    }
}
