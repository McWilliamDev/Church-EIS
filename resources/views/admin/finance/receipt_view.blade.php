@extends('layouts.app')

@section('content')
<div class="container mt-4 p-4 border bg-white rounded shadow">
    <h2 class="text-center mb-4">Finance Receipt</h2>
    <table class="table table-bordered">
        <tr><th>Receipt ID</th><td>{{ $report->id }}</td></tr>
        <tr><th>Member Name</th><td>{{ $report->member->name }} {{ $report->member->last_name }}</td></tr>
        <tr><th>Type</th><td>{{ $report->type }}</td></tr>
        <tr><th>Amount</th><td>₱{{ number_format($report->amount, 2) }}</td></tr>
        <tr><th>Date</th><td>{{ date('F d, Y', strtotime($report->date)) }}</td></tr>
        <tr><th>Purpose</th><td>{{ $report->purpose }}</td></tr>
    </table>

    <div class="text-center mt-4">
        <a href="{{ route('finance.receipt.download', $report->id) }}" class="btn btn-success">Download PDF</a>
        <a href="{{ route('finance.list', ['tab' => 'reports']) }}" class="btn btn-secondary">Back to Finance List</a>

    </div>
</div>
@endsection
