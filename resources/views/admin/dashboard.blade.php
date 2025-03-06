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
            </div>
        </div>
@endsection
