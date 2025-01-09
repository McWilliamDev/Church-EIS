@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Church Members (Total: {{ $getMember->total() }})</h3>
        </div>
        <div class="col-sm-6 button-list" style="text-align: right">
            <a href="{{ url('admin/member/add') }}" class="btn my-2">Add Member</a>
        </div>

        <div class="container-fluid shadow-lg ">
            <div class="card p-2 g-col-6">
                <div class="card-header">
                    <h5 class="fw-bold fs-5">Search Member</h5>
                </div>

                <form method="get" action="">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" value="{{ Request::get('name') }}" name="name"
                                    placeholder="Name">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" value="{{ Request::get('email') }}"
                                    name="email" placeholder="Email">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="date">Phone No.</label>
                                <input type="text" class="form-control" value="{{ Request::get('phonenumber') }}"
                                    name="phonenumber" placeholder="Phone Number">
                            </div>

                            <div class="form-group col-md-3 d-flex align-items-end">
                                <button class="btn btn-primary me-2" type="submit">Search</button>
                                <a href="{{ url('admin/member/list') }}" class="btn btn-danger">Reset</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-12">
                @include('alerts')
                <div class="table-responsive">
                    <table class="table table-striped caption-top">
                        <caption class="fs-5 fw-semibold">List of Church Members</caption>
                        <thead>
                            <tr class="highlight">
                                <th scope="col">#</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Position</th>
                                <th scope="col">Address</th>
                                <th scope="col">Phone No.</th>
                                <th scope="col">Date Added</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($getMember as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->position }}</td>
                                    <td>{{ $value->address }}</td>
                                    <td>{{ $value->phonenumber }}</td>
                                    <td>{{ $value->created_at }}</td>
                                    <td>
                                        <a href="{{ url('admin/admin/edit', $value->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <a href="{{ url('admin/admin/delete', $value->id) }}" class="btn btn-danger btn-sm"
                                            onclick="confirmDelete(event, {{ $value->id }}, '{{ $value->name }}')">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {!! $getMember->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(event, id, name) {
            event.preventDefault();

            var confirmation = confirm('Are you sure you want to delete this Church Administrator: ' + name + '?');
            if (confirmation) {
                window.location.href = '{{ url('admin/admin/delete') }}' + '/' + id;
            }
        }
    </script>
@endsection
