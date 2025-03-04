@extends('layouts.app')

@php
    $activeTab = request('tab');

    // If no tab parameter, use session success as the indicator
    if (!$activeTab) {
        $activeTab = session('success') ? 'reports' : 'analytics';
    }

    // Ensure 'reports' is selected if there are no reports
    if ($activeTab === 'analytics' && $reports->isEmpty()) {
        $activeTab = 'reports';
    }
@endphp
<script>
    var reportsData = @json($reports);
</script>
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
        </ul>
    </div>

    <div id="analytics-content" class="tab-content {{ $activeTab == 'analytics' ? '' : 'd-none' }}">
        <h3 class="fw-bold fs-4 my-3">Finance Analytics</h3>
        
        @if($reports->isEmpty())
        <div class="h4 text-center p-4 bg-light rounded mt-3">
            No reports found
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
            <div class="col-12 col-xxl-6">
                <div class="d-flex justify-content-center">
                    <div class="d-flex justify-content-center" style="height: 560px; width: 100%;">  
                        <canvas id="barChart" style="height: 100%; width: 100%"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xxl-6">
                <div class="d-flex justify-content-center">
                    <div class="d-flex justify-content-center" style="max-height: 500px; width: 100%;">  
                        <canvas id="pieChart" class="mt-4" style="height: 100%; width: 100%"></canvas>
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
            <div class="col-6 d-flex align-items-center justify-content-end">
                <a href="{{ route('finance.add') }}" class="btn btn-primary">Add Report</a>
            </div>
        </div>

        @if($reports->isEmpty())
            <div class="h4 text-center p-4 bg-light rounded mt-3">
                No reports found
            </div>
        @else
        <table class="table table-striped">
            <thead>
                <tr class="highlight">
                    <th scope="col">Type</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Date</th>
                    <th scope="col">Person Accountable</th>
                    <th scope="col">Purpose</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                <tr>
                    <td>{{ $report->type }}</td>
                    <td>{{ $report->amount }}</td>
                    <td>{{ date('m/d/Y', strtotime($report->created_at)) }}</td>
                    <td>{{ $report->member->name }} {{ $report->member->last_name }}</td>
                    <td class="break-word">{{ $report->purpose }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="{{ url('admin/finance/edit', $report->id) }}">Edit</a>
                        <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="deleteReport({{ $report->id }})">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        
    </div>
</div>
@if (isset($report) && $report->id)
    <form id="delete-form-{{ $report->id }}" action="{{ route('finance.delete', $report->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endif

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

var barChart, pieChart;
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
for (let i = 4; i >= 0; i--) {
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
    let date = new Date(report.created_at);
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
    var pieCanvas = document.getElementById('pieChart').getContext('2d');

    // Initialize Bar Chart
    barChart = new Chart(barCanvas, {
        type: 'bar',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Total Amount (Monthly)',
                data: monthlyData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
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

    // Initialize Pie Chart
    pieChart = new Chart(pieCanvas, {
        type: 'doughnut',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Total Amount (Monthly)',
                data: monthlyData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: { responsive: true }
    });
});

// Sort by Monthly or Yearly
function sortBy(event) {
    let viewData = event.target.value;

    if (viewData === "yearly") {
        barChart.data.labels = yearlyLabels;
        barChart.data.datasets[0].data = yearlyData;
        barChart.data.datasets[0].label = 'Total Amount (Yearly)';

        pieChart.data.labels = yearlyLabels;
        pieChart.data.datasets[0].data = yearlyData;
        pieChart.data.datasets[0].label = 'Total Amount (Yearly)';
    } else {
        barChart.data.labels = monthlyLabels;
        barChart.data.datasets[0].data = monthlyData;
        barChart.data.datasets[0].label = 'Total Amount (Monthly)';

        pieChart.data.labels = monthlyLabels;
        pieChart.data.datasets[0].data = monthlyData;
        pieChart.data.datasets[0].label = 'Total Amount (Monthly)';
    }

    barChart.update();
    pieChart.update();
}



    function openTab(tabName) {
        document.querySelectorAll('.nav-link').forEach(tab => tab.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(content => content.classList.add('d-none'));

        document.getElementById(tabName + '-tab').classList.add('active');
        document.getElementById(tabName + '-content').classList.remove('d-none');
    }

    function deleteReport(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@include('sweetalert::alert')
@endpush


