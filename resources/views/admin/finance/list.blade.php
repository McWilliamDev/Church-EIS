@extends('layouts.app')

@php
    $activeTab = request('tab');

    // If no tab parameter, use session success as the indicator
    if (!$activeTab) {
        $activeTab = session('success') ? 'reports' : 'analytics';
    }
    if ($activeTab === 'analytics' && $reports->isEmpty()) {
        $activeTab = 'reports';
    }
@endphp

@section('content')
<div class="m-2">
    <div>
        <ul class="nav nav-tabs justify-content-end">
            <li class="nav-item">
                <p class="nav-link c-pointer {{ $activeTab == 'analytics' ? 'active' : '' }}" id="analytics-tab" onclick="openTab('analytics')">Finance Analytics</p>
            </li>
            <li class="nav-item">
                <p class="nav-link c-pointer {{ $activeTab == 'reports' ? 'active' : '' }}" id="reports-tab" onclick="openTab('reports')">Finance Reports</p>
            </li>
            <li class="nav-item">
                <p class="nav-link c-pointer {{ $activeTab == 'member-report' ? 'active' : '' }}" id="member-report-tab" onclick="openTab('member-report')">Member Report</p>
            </li>
        </ul>
    </div>

    <div id="analytics-content" class="tab-content {{ $activeTab == 'analytics' ? '' : 'd-none' }}">
        <h3 class="fw-bold fs-4 my-3">Finance Analytics</h3>
        
        @if($reports->isEmpty())
        <div class="h4 text-center p-4 bg-light rounded mt-3">
            No financial records found
        </div>
        
        @else
        <div class="mb-3">
            <label for="totalBy">Total Amount by:</label>
            <select class="form-select mt-1" name='totalBy' aria-label="Default select example" style="max-width: 280px" onchange="sortBy(event)">
                <option value="monthly" selected>Monthly</option>
                <option value="yearly">Yearly</option>
            </select>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <div class="d-flex justify-content-center" style="height: 560px;">  
                        <canvas id="barChart" style="height: 100%; width: 100%"></canvas>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <div id="reports-content" class="tab-content {{ $activeTab == 'reports' ? '' : 'd-none' }}">
        <div class="row mt-4">
            <div class="col-6">
                <h3 class="fw-bold fs-4 my-3">Finance Reports</h3>
            </div>

            <div class="col-sm-6 button-list" style="text-align: right">
                <a href="{{ route('finance.add') }}" class="btn my-2">Add Finance</a>
            </div>
        </div>

        @if($reports->isEmpty())
            <div class="h4 text-center p-4 bg-light rounded mt-3">
                No financial records found
            </div>
        @else
        <table class="table table-striped" id="financeTable">
            <thead>
                <tr class="highlight">
                    <th scope="col">Member Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                <tr>
                    <td>{{ $report->member->name }} {{ $report->member->last_name }}</td>
                    <td>{{ $report->type }}</td>
                    <td>{{ $report->amount }}</td>
                    <td>{{ date('d/m/Y', strtotime($report->date)) }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ url('admin/finance/edit', $report->id) }}">Edit</a>
                        <a class="btn btn-success btn-sm" href="{{ route('finance.receipt.view', $report->id) }}">Print Receipt</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        
    </div>

    <div id="member-report-content" class="tab-content {{ $activeTab == 'member-report' ? '' : 'd-none' }}">
        <div class="mt-4">
            <h3 class="fw-bold fs-4 my-3">Generate Member Contribution Report</h3>
    
            <form method="GET" action="{{ route('finance.memberReport') }}" class="row g-3 mb-4">
                <input type="hidden" name="tab" value="member-report">
                <div class="col-md-4">
                    <label for="member_id" class="form-label">Select Member</label>
                    <select name="member_id" class="form-select select2" required>
                        <option value="">Member Name</option>
                        @foreach(App\Models\MembersModel::all() as $member)
                            <option value="{{ $member->id }}">{{ $member->name }} {{ $member->last_name }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="col-md-3">
                    <label for="from" class="form-label">From (Date)</label>
                    <input type="month" name="from" class="form-control" required>
                </div>
    
                <div class="col-md-3">
                    <label for="to" class="form-label">To (Date)</label>
                    <input type="month" name="to" class="form-control" required>
                </div>
    
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Generate</button>
                </div>
            </form>
    
            @isset($memberReport)
                <p><strong>Member Name:</strong> {{ $member->name }} {{ $member->last_name }}</p>
                <div class="alert alert-info">Total Contributions: <strong>₱{{ number_format($memberReport['total'], 2) }}</strong></div>
        
                <ul class="list-group mt-3">
                    @foreach ($memberReport['details'] as $item)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ \Carbon\Carbon::parse($item->date)->format('F Y') }} - {{ $item->type }}</span>
                            <span>₱{{ number_format($item->amount, 2) }}</span>
                        </li>
                    @endforeach
                </ul>
        
            <div class="d-flex justify-content-center">
                <a href="{{ route('finance.memberReport.pdf', ['member_id' => request('member_id'), 'from' => request('from'), 'to' => request('to')]) }}" class="btn btn-success mt-3">Download PDF</a>
            </div>            
            @endisset
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>

    $(document).ready(function() {
    $('#financeTable').DataTable();
    $('.select2').select2({
        placeholder: "Select a member",           
    });      
});

var barChart;
var viewData = "";
var reportsData = @json($reports);

// Declare global variables
var monthlyLabels = [];
var monthlyData = [];
var yearlyLabels = [];
var yearlyData = [];

document.addEventListener("DOMContentLoaded", function() {
    var monthlyTotals = {};
var yearlyTotals = {};

// Generate last 5 months list (including year to differentiate)
let monthsList = [];
let currentDate = new Date();
for (let i = 11; i >= 0; i--) {
    let pastDate = new Date(currentDate.getFullYear(), currentDate.getMonth() - i, 1);
    let monthYear = pastDate.toLocaleString('default', { month: 'long' }) + " " + pastDate.getFullYear();
    monthsList.push(monthYear);
    monthlyTotals[monthYear] = 0; // Initialize with zero
}

// Generate last 5 years list
let yearsList = [];
let currentYear = currentDate.getFullYear();
for (let i = 4; i >= 0; i--) {
    let year = currentYear - i;
    yearsList.push(year);
    yearlyTotals[year] = 0; // Initialize with zero
}

// Process reports
reportsData.forEach(report => {
    let date = new Date(report.date);
    let monthYear = date.toLocaleString('default', { month: 'long' }) + " " + date.getFullYear();
    let year = date.getFullYear();

    if (monthsList.includes(monthYear)) {
        monthlyTotals[monthYear] += parseFloat(report.amount);
    }

    if (yearsList.includes(year)) {
        yearlyTotals[year] += parseFloat(report.amount);
    }
});

// Assign global variables
monthlyLabels = monthsList;
monthlyData = monthsList.map(monthYear => monthlyTotals[monthYear]);
yearlyLabels = yearsList;
yearlyData = yearsList.map(year => yearlyTotals[year]);


    var barCanvas = document.getElementById('barChart').getContext('2d');

    // Initialize Bar Chart
    barChart = new Chart(barCanvas, {
        type: 'bar',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Total Amount (Monthly)',
                data: monthlyData,
                backgroundColor: [
                'rgba(255, 99, 132, 0.2)',   // Red
                'rgba(54, 162, 235, 0.2)',   // Blue
                'rgba(255, 206, 86, 0.2)',   // Yellow
                'rgba(75, 192, 192, 0.2)',   // Teal
                'rgba(153, 102, 255, 0.2)',  // Purple
                'rgba(255, 159, 64, 0.2)',   // Orange
                'rgba(201, 203, 207, 0.2)',  // Gray
                'rgba(0, 128, 0, 0.2)',      // Green
                'rgba(128, 0, 128, 0.2)',    // Dark Purple
                'rgba(255, 165, 0, 0.2)',    // Deep Orange
                'rgba(0, 255, 255, 0.2)',    // Cyan
                'rgba(255, 20, 147, 0.2)'    // Deep Pink
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(201, 203, 207, 1)',
                'rgba(0, 128, 0, 1)',
                'rgba(128, 0, 128, 1)',
                'rgba(255, 165, 0, 1)',
                'rgba(0, 255, 255, 1)',
                'rgba(255, 20, 147, 1)'
            ],
                borderWidth: 1
            }]
        },
        options: { 
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        generateLabels: function(chart) {
                            return chart.data.datasets.map((dataset) => ({
                                text: dataset.label, // Show only text
                                hidden: false,
                                datasetIndex: dataset.index, // Required for legend functionality
                                fillStyle: 'transparent', // Remove color fill
                                strokeStyle: 'transparent', // Remove border color
                                lineWidth: 0, // Remove any border width
                                pointStyle: false // Remove the box
                            }));
                        }
                    }
                }
            },
            scales: { 
                y: { 
                    beginAtZero: true 
                } 
            } 
        }
    });
});

// Sort by Monthly or Yearly
function sortBy(event) {
    let viewData = event.target.value;

    if (viewData === "yearly") {
        barChart.data.labels = yearlyLabels;
        barChart.data.datasets[0].data = yearlyData;
        barChart.data.datasets[0].label = 'Total Amount (Yearly)';

    } else {
        barChart.data.labels = monthlyLabels;
        barChart.data.datasets[0].data = monthlyData;
        barChart.data.datasets[0].label = 'Total Amount (Monthly)';
    }

    barChart.update();
}

function openTab(tabName) {
    // Remove active class and hide all tab contents
    document.querySelectorAll('.nav-link').forEach(tab => tab.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(content => content.classList.add('d-none'));

    // Set the active tab in the UI
    document.getElementById(tabName + '-tab').classList.add('active');
    document.getElementById(tabName + '-content').classList.remove('d-none');

    history.pushState(null, '', '?tab=' + tabName);
}
</script>
@include('sweetalert::alert')
@endpush


