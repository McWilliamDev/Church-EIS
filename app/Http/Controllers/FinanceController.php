<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FinanceModel;
use App\Models\MembersModel;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

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
        $report = FinanceModel::with('member')->findOrFail($id);

        // Check if the record is locked
        if ($report->locked_by && $report->locked_by !== Auth::id()) {
            // Check if the lock has expired (e.g., 15 minutes)
            if ($report->locked_at && now()->diffInMinutes($report->locked_at) > 15) {
                // Unlock the record
                $report->update([
                    'locked_by' => null,
                    'locked_at' => null,
                ]);
            } else {
                Alert::error('Error!', 'This record is currently being modified by another admin.');
                return redirect()->route('finance.list');
            }
        }

        // Lock the record
        $report->update([
            'locked_by' => Auth::id(),
            'locked_at' => now(),
        ]);

        $members = MembersModel::all();
        return view('admin.finance.edit', $data, compact('report', 'members'));
    }


    public function addFinance(Request $request)
    {
        // Validate form input
        $request->validate([
            'member' => 'required|integer',
            'type' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
            'date' => 'required|date',
            'purpose' => 'nullable|string|max:150',
        ]);

        // Save data to the database
        FinanceModel::create([
            'member_id' => $request->member,
            'type' => $request->type,
            'amount' => $request->amount,
            'date' => $request->date,
            'purpose' => $request->purpose,
            'locked_by' => null, // Ensure it's not locked
            'locked_at' => null,
        ]);

        Alert::success('Success!', 'Finance Record has been added successfully.');
        return redirect()->route('finance.list');
    }

    public function update(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'member' => 'required|integer',
            'type' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1',
            'date' => 'required|date',
            'purpose' => 'required|string|max:150',
        ]);

        // Find the record and check if it's locked
        $report = FinanceModel::findOrFail($id);
        if ($report->locked_by && $report->locked_by !== Auth::id()) {
            Alert::error('Error!', 'This record is currently being edited by another admin.');
            return redirect()->route('finance.list');
        }

        // Update the record
        $report->update([
            'member_id' => $request->member,
            'type' => $request->type,
            'amount' => $request->amount,
            'date' => $request->date,
            'purpose' => $request->purpose,
            'locked_by' => null, // Unlock the record after update
            'locked_at' => null,
        ]);

        Alert::success('Success!', 'Finance Record has been updated successfully.');
        return redirect()->route('finance.list');
    }

    public function delete($id)
    {
        $report = FinanceModel::findOrFail($id);
        $report->delete();

        Alert::success('Success!', 'Finance Record has been deleted successfully.');
        return redirect()->route('finance.list');
    }
}
