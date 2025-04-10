<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Finance Receipt</title>
    <style>
        body { 
            font-family: 'Dejavu Sans', sans-serif; 
            font-size: 14px; }
        .container{ 
            padding: 20px; }
        h2 { 
            text-align: center; 
            margin-bottom: 30px; }
        table {
            width: 100%; 
            border-collapse: collapse; }
        th, td { 
            padding: 8px 12px; 
            text-align: left; }
        th { 
            background-color: #f2f2f2; }
        .footer { margin-top: 40px; text-align: center; font-style: italic; }
    </style>
</head>
<body>
    <div class="container">
        <h2>New Ground Generation Church Finance Receipt</h2>
        <table border="1">
            <tr><th>Receipt ID</th><td>{{ $report->id }}</td></tr>
            <tr><th>Member Name</th><td>{{ $report->member->name }} {{ $report->member->last_name }}</td></tr>
            <tr><th>Type</th><td>{{ $report->type }}</td></tr>
            <tr><th>Amount</th><td>₱{{ number_format($report->amount, 2) }}</td></tr>
            <tr><th>Date</th><td>{{ date('F d, Y', strtotime($report->date)) }}</td></tr>
            <tr><th>Purpose</th><td>{{ $report->purpose }}</td></tr>
        </table>
        <p class="footer">This is a system-generated receipt.</p>
    </div>
</body>
</html>
