@extends('layouts.app')

@section('content')
        <div class="container-fluid">
            <div class="mb-3">
                <h3 class="fw-bold fs-4 mb-3">Dashboard</h3>
                
                <div class="row">

                    <div class="col-xl-4 col-md-6 mb-4">
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

                    <div class="col-xl-4 col-md-6 mb-4">
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

                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-start py-2 small-box bg-primary-subtle">
                            <div class="card-body">
                                <div class="row g-0 align-items-center">
                                    <div class="col">
                                        <div class="text-xs fw-bold text-uppercase mb-1">
                                            Upcoming Announcements
                                        </div>
                                        <div class="h5 mb-0 fw-bold text-gray">{{ $upcomingAnnouncementsCount }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fa-solid fa-bullhorn fa-2x text-gray-300"></i>
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
                                    
                                    <!-- Card Body -->
                                    <div class="card-body">
                                        <h5 class="text-xs fw-bold text-uppercase mb-1">Upcoming Announcements (Next 7 Days)</h5>
                                        <ul class="list-group">
                                            @if($upcomingAnnouncementsCount > 0)
                                                @foreach($upcomingAnnouncements as $announcement)
                                                    <li class="list-group-item">
                                                        <strong>{{ $announcement->title }}</strong><br>
                                                        <small>Notice Date: {{ $announcement->notice_date->format('Y-m-d') }}</small><br>
                                                        <p>{{ $announcement->description }}</p>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li class="list-group-item">No upcoming announcements.</li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
@endsection

@push('scripts')

<script>

</script>
@include('sweetalert::alert')
@endpush
