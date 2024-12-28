@extends('layouts.app')

@section('content')
    <h3 class="fw-bold fs-4 my-3">Church Administrators</h3>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr class="highlight">
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Address</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Date Added</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark William Madrista</td>
                        <td>admin@gmail.com</td>
                        <td>Makati City</td>
                        <td>123456789</td>
                        <td>12/16/2024</td>
                        <td>Edit / Delete</td>
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
@endsection
