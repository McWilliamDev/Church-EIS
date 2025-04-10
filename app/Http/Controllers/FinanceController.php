<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FinanceModel;
use App\Models\MembersModel;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;

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
        return redirect()->route('finance.list', ['tab' => 'reports']);
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
        return redirect()->route('finance.list', ['tab' => 'reports']);
    }

    // View-only receipt
    public function viewReceipt($id)
    {
        $data['header_title'] = "View Receipt";
        $report = FinanceModel::with('member')->findOrFail($id);
        return view('admin.finance.receipt_view', $data, compact('report'));
    }

    // Downloadable PDF receipt
    public function downloadReceipt($id)
    {
        $report = FinanceModel::with('member')->findOrFail($id);

        $pdf = Pdf::loadView('admin.finance.receipt_pdf', compact('report'));

        $filename = $report->member->name . '_' . $report->member->last_name . '_' . Carbon::parse($report->date)->format('Y-m-d') . '_receipt.pdf';

        return $pdf->download($filename);
    }
    public function memberReport(Request $request)
    {

        $request->validate([
            'member_id' => 'required|integer|exists:members,id',
            'from' => 'required|date_format:Y-m',
            'to' => 'required|date_format:Y-m',
        ]);

        $fromDate = \Carbon\Carbon::createFromFormat('Y-m', $request->from)->startOfMonth();
        $toDate = \Carbon\Carbon::createFromFormat('Y-m', $request->to)->endOfMonth();

        $contributions = FinanceModel::where('member_id', $request->member_id)
            ->whereBetween('date', [$fromDate, $toDate])
            ->orderBy('date', 'asc')
            ->get();

        $total = $contributions->sum('amount');

        $data['reports'] = FinanceModel::with('member')->get();
        $data['memberReport'] = [
            'total' => $total,
            'details' => $contributions,
        ];

        return view('admin.finance.list', $data)->with('tab', 'member-report');
    }

    public function exportMemberReportPDF(Request $request)
    {
        $request->validate([
            'member_id' => 'required|integer|exists:members,id',
            'from' => 'required|date_format:Y-m',
            'to' => 'required|date_format:Y-m',
        ]);

        $fromDate = \Carbon\Carbon::createFromFormat('Y-m', $request->from)->startOfMonth();
        $toDate = \Carbon\Carbon::createFromFormat('Y-m', $request->to)->endOfMonth();

        $member = MembersModel::findOrFail($request->member_id);
        $contributions = FinanceModel::where('member_id', $request->member_id)
            ->whereBetween('date', [$fromDate, $toDate])
            ->orderBy('date', 'asc')
            ->get();

        $total = $contributions->sum('amount');

        $pdf = Pdf::loadView('admin.finance.member_pdf', [
            'member' => $member,
            'contributions' => $contributions,
            'total' => $total,
            'from' => $request->from,
            'to' => $request->to,
        ])->setOption('font', 'DejaVu Sans');


        return $pdf->download('Member_Report_' . $member->name . '_' . $member->last_name . '.pdf');
    }
}
