@extends('layouts.app')

@section('content')
        <div class="container-fluid">
            <div class="mb-3">
                <h3 class="fw-bold fs-4 mb-3">Dashboard</h3>
                
                <div class="row">
                    <div class="col-12 col-md-4">
                        <a href="{{ url('admin/admin/list') }}">
                            <div class="card border-0 dashboard-card">
                                <div class="card-body py-4">
                                    <h5 class="mb-2 fw-bold">
                                        Total Church Administrators
                                    </h5>
                                    <p class="mb-2 fw-bold">
                                        {{ $TotalAdmin }}
                                    </p>
                                    <div class="mb-0">
                                        <span class="badge text-success me-2">
                                            +69
                                        </span>
                                        <span class="fw-bold">
                                            Since Last Month
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-12 col-md-4">
                        <a href="{{ url('admin/user/list') }}">
                            <div class="card border-0 dashboard-card">
                                <div class="card-body py-4">
                                    <h5 class="mb-2 fw-bold">
                                        Total Administrators
                                    </h5>
                                    <p class="mb-2 fw-bold">
                                        {{ $TotalUser }}
                                    </p>
                                    <div class="mb-0">
                                        <span class="badge text-success me-2">
                                            +9.0%
                                        </span>
                                        <span class="fw-bold">
                                            Since Last Month
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-12 col-md-4">
                        <a href="{{ url('admin/member/list') }}">
                            <div class="card border-0 dashboard-card">
                                <div class="card-body py-4">
                                    <h5 class="mb-2 fw-bold">
                                        Total Church Members
                                    </h5>
                                    <p class="mb-2 fw-bold">
                                        {{ $TotalMembers }}
                                    </p>
                                    <div class="mb-0">
                                        <span class="badge text-success me-2">
                                            +25000
                                        </span>
                                        <span class="fw-bold">
                                            Since Last Month
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
    
                        <div class="col-12 col-md-4">
                            <div class="card border-0 dashboard-card">
                                <div class="card-body py-4">
                                    <h5 class="mb-2 fw-bold">
                                        Upcoming Events
                                    </h5>
                                    <p class="mb-2 fw-bold">
                                        1002
                                    </p>
                                    <div class="mb-0">
                                        <span class="badge text-success me-2">
                                            +9.0%
                                        </span>
                                        <span class="fw-bold">
                                            Since Last Month
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-12 col-md-4">
                            <div class="card border-0 dashboard-card">
                                <div class="card-body py-4">
                                    <h5 class="mb-2 fw-bold">
                                        Total Donations
                                    </h5>
                                    <p class="mb-2 fw-bold">
                                        $72, 500
                                    </p>
                                    <div class="mb-0">
                                        <span class="badge text-success me-2">
                                            +25000
                                        </span>
                                        <span class="fw-bold">
                                            Since Last Month
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>

                <div class="d-flex justify-content-center">
                    <div class="d-flex justify-content-center" style="height: 560px; width: 100%;">  
                        <canvas id="lineChart" style="height: 50vh; width: 100%"></canvas>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('scripts')

<script>

var lineChart;
var viewData = "";
var reportsData = @json($reports ?? []);

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


    var chartCanvas = document.getElementById('lineChart').getContext('2d');

    // Initialize Bar Chart
    lineChart = new Chart(chartCanvas, {
        type: 'line',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Total Amount (Monthly)',
                data: monthlyData,
                borderColor: 'rgb(75, 192, 192)',
                borderWidth: 4,
                tension: 0.4
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
                                // lineWidth: 0, // Remove any border width
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

</script>
@include('sweetalert::alert')
@endpush
