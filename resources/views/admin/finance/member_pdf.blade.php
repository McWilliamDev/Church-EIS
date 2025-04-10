<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Member Report</title>
    <style>
        body {
            font-family: 'Dejavu Sans' , Arial, sans-serif;
            color: #333;
        }
        h2 {
            color: #0056b3; 
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .contact-info {
            font-size: 12px;
            color: #888;
            margin-top: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f7f7f7;
            color: #0056b3;
        }
        td {
            background-color: #fff;
        }
        .total {
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>New Ground Generation Church</h1>
        <h2>Member Contribution Report</h2>
        <p><strong>Member Name:</strong> {{ $member->name }} {{ $member->last_name }}</p>
        <p><strong>Period:</strong> {{ \Carbon\Carbon::parse($from)->format('F Y') }} to {{ \Carbon\Carbon::parse($to)->format('F Y') }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Contribution Type</th>
                <th>Amount (₱)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contributions as $item)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($item->date)->format('F d, Y') }}</td>
                    <td>{{ $item->type }}</td>
                    <td>{{ number_format($item->amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p class="total">
        <strong>Total Contributions:</strong> ₱{{ number_format($total, 2) }}
    </p>

</body>
</html>
