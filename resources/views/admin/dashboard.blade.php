@extends('layouts.app')

@section('content')
    <div class="dashboardgreetings">
        @include('layouts.greetings')
    </div>
    <main class="content px-3 py-4">
        <div class="container-fluid">
            <div class="mb-3">
                <h3 class="fw-bold fs-4 mb-3">Dashboard</h3>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="card border-0">
                            <div class="card-body py-4">
                                <h5 class="mb-2 fw-bold">
                                    Total Members
                                </h5>
                                <p class="mb-2 fw-bold">
                                    1001
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
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="card border-0">
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
                        <div class="card border-0">
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

                    <h3 class="fw-bold fs-4 my-3">Avg. Tithes Earnings</h3>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="highlight">
                                        <th scope="col">#</th>
                                        <th scope="col">First</th>
                                        <th scope="col">Last</th>
                                        <th scope="col">Handle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td colspan="2">Larry the Bird</td>
                                        <td>@twitter</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
