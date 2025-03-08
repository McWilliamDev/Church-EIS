@extends('layouts.app')

@section('content')
        <div class="container-fluid">
            <div class="mb-3">
                <h3 class="fw-bold fs-4 mb-3">Dashboard</h3>
                
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-start py-2 small-box bg-info-subtle">
                            <div class="card-body">
                                <div class="row g-0 align-items-center">
                                    <div class="col">
                                        <div class="text-xs fw-bold text-uppercase mb-1">
                                            Total Church Administrators
                                        </div>
                                        <div class="h5 mb-0 fw-bold text-gray">{{ $TotalAdmin }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-users-gear fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-start py-2 small-box bg-primary-subtle">
                            <div class="card-body">
                                <div class="row g-0 align-items-center">
                                    <div class="col">
                                        <div class="text-xs fw-bold text-uppercase mb-1">
                                            Total Administrators
                                        </div>
                                        <div class="h5 mb-0 fw-bold text-gray">{{ $TotalUser }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-user-tie fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-start py-2 small-box bg-secondary-subtle">
                            <div class="card-body">
                                <div class="row g-0 align-items-center">
                                    <div class="col">
                                        <div class="text-xs fw-bold text-uppercase mb-1">
                                            Total Church Members
                                        </div>
                                        <div class="h5 mb-0 fw-bold text-gray">{{ $TotalMembers }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-users fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-start py-2 small-box bg-danger-subtle">
                            <div class="card-body">
                                <div class="row g-0 align-items-center">
                                    <div class="col">
                                        <div class="text-xs fw-bold text-uppercase mb-1">
                                            Upcoming Events
                                        </div>
                                        <div class="h5 mb-0 fw-bold text-gray">{{ $TotalMembers }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-calendar-days fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-start py-2 small-box bg-warning-subtle">
                            <div class="card-body">
                                <div class="row g-0 align-items-center">
                                    <div class="col">
                                        <div class="text-xs fw-bold text-uppercase mb-1">
                                            Upcoming Events
                                        </div>
                                        <div class="h5 mb-0 fw-bold text-gray">{{ $TotalMembers }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                    <!--<div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-start border-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row g-0 align-items-center">
                                    <div class="col">
                                        <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                                            Total Church Members
                                        </div>
                                        <div class="h5 mb-0 fw-bold text-gray">{{ $TotalMembers }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-start border-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row g-0 align-items-center">
                                    <div class="col">
                                        <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                                            Total Monthly Donations
                                        </div>
                                        <div class="h5 mb-0 fw-bold text-gray"></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-start border-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row g-0 align-items-center">
                                    <div class="col">
                                        <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                                            Upcoming Events
                                        </div>
                                        <div class="h5 mb-0 fw-bold text-gray">{{ $TotalUser }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-start border-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row g-0 align-items-center">
                                    <div class="col">
                                        <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                                            Earnings (Monthly)
                                        </div>
                                        <div class="h5 mb-0 fw-bold text-gray">$40,000</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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
                        </div>-->

                        <div class="row">

                            <!-- Area Chart -->
                            <div class="col-xl-8 col-lg-7">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header py-3 d-flex align-items-center justify-content-between">
                                        <h6 class="m-0 fw-bold">Monthly Donation Earnings Overview</h6>
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownMenuLink">
                                                <li><h6 class="dropdown-header">Finance Report</h6></li>
                                                <li><a class="dropdown-item" href="#">Add Finance</a></li>
                                                <li><a class="dropdown-item" href="#">View Finance List</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="chart-area">
                                            <canvas id="lineChart"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <!-- Pie Chart -->
                            <div class="col-xl-4 col-lg-5">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header py-3 d-flex align-items-center justify-content-between">
                                        <h6 class="m-0 fw-bold">Church Members Status</h6>
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownMenuLink">
                                                <li><h6 class="dropdown-header">Dropdown Header:</h6></li>
                                                <li><a class="dropdown-item" href="#">Action</a></li>
                                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <div class="chart-pie pt-4 pb-2">
                                            <canvas id="myPieChart"></canvas>
                                        </div>
                                        <div class="mt-4 text-center small">
                                            <span class="me-2">
                                                <i class="fas fa-circle text-success"></i> Active
                                            </span>
                                            <span class="me-2">
                                                <i class="fas fa-circle text-danger"></i> Inactive
                                            </span>
                                            <span class="me-2">
                                                <i class="fas fa-circle text-info"></i> Referral
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                        
                <!--<div class="d-flex justify-content-center">
                    <div class="d-flex justify-content-center" style="height: 560px; width: 100%;">  
                        <canvas id="lineChart" style="height: 50vh; width: 100%"></canvas>
                    </div>
                </div>-->
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
