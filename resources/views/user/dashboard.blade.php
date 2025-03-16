@extends('layouts.app')

@section('content')
        <div class="container-fluid">
            <div class="mb-3">
                <h3 class="fw-bold fs-4 mb-3">Dashboard</h3>
                
                <div class="row">

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-start py-2 small-box bg-primary-subtle">
                            <a href="{{ url('user/member/list')}}">
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
                        </a>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-start py-2 small-box bg-primary-subtle">
                            <div class="card-body">
                                <div class="row g-0 align-items-center">
                                    <div class="col">
                                        <div class="text-xs fw-bold text-uppercase mb-1">
                                            Upcoming Events
                                        </div>
                                        <div class="h5 mb-0 fw-bold text-gray">{{ $upcomingEventsCount }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-calendar-days fa-2x text-gray-300"></i>
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
                                            Announcements
                                        </div>
                                        <div class="h5 mb-0 fw-bold text-gray">{{ $upcomingEventsCount }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-calendar-days fa-2x text-gray-300"></i>
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
                                            Upcoming Events
                                        </div>
                                        <div class="h5 mb-0 fw-bold text-gray">{{ $upcomingEventsCount }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-calendar-days fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                        <div class="row">
                            <!-- Upcoming Events -->
                            <div class="col-xl-8">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header">
                                        <h6 class="m-0 fs-5 fw-bold">Upcoming Events</h6>
                                    </div>
                                    <div class="card-body">
                                        @if($upcomingEvents->isEmpty())
                                            <p>No upcoming events found.</p>
                                        @else
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr class="highlight">
                                                        <th>Event Title</th>
                                                        <th class="break-word">Description</th>
                                                        <th>Location</th>
                                                        <th>Start Date & Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($upcomingEvents as $event)
                                                        <tr>
                                                            <td>{{ $event->title }}</td>
                                                            <td>{{ $event->description }}</td>
                                                            <td>{{ $event->location }}</td>
                                                            <td>{{ $event->date }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        
                            <!-- Pie Chart -->
                            <div class="col-xl-4">
                                <div class="card shadow mb-4">
                                    <!-- Card Header - Dropdown -->
                                    <div class="card-header py-3 d-flex align-items-center justify-content-between">
                                        <h6 class="m-0 fw-bold">Church Members Status</h6>
                                        <div class="dropdown">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownMenuLink">
                                                <li><h6 class="dropdown-header">Member Status</h6></li>
                                                <li><a class="dropdown-item" href="{{ url('user/member/add') }}">Add Member</a></li>
                                                <li><a class="dropdown-item" href="{{ url('user/member/list') }}">View Members</a></li>
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
                                                <i class="fas fa-circle" style="color: rgb(75, 192, 192);"></i> Active
                                            </span>
                                            <span class="me-2">
                                                <i class="fas fa-circle" style="color: rgb(255, 99, 132)"></i> Inactive
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
    var memberstatus = document.getElementById("myPieChart");
    var myPieChart = new Chart(memberstatus, {
        type: 'pie',
        data: {
            labels: ["Active", "Inactive"],
            datasets: [{
                data: [{{ $activeMembersCount }}, {{ $inactiveMembersCount }}],
                backgroundColor: [
                    'rgb(75, 192, 192)',
                    'rgb(255, 99, 132)',
                ], // Green for active, red for inactive
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });

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
