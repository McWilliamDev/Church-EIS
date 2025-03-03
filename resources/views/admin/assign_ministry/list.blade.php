@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Members Ministry</h3>
        </div>
        <div class="col-sm-6 button-list" style="text-align: right">
            <a href="{{ url('admin/assign_ministry') }}" class="btn my-2">Assign Members to Ministry</a>
        </div>

        <div class="container-fluid shadow-lg ">
            <div class="card p-2 g-col-6">
                <div class="card-header">
                    <h5 class="fw-bold fs-5">Search Member</h5>
                </div>

                <form method="get" action="">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label>Member Name</label>
                                <input type="text" class="form-control" value="{{ Request::get('member_name') }}" name="member_name"
                                    placeholder="Member Name">
                            </div>

                            <div class="form-group col-md-2">
                                <label>Ministry</label>
                                <input type="text" class="form-control" value="{{ Request::get('ministry_name') }}"
                                    name="ministry_name" placeholder="Ministry">
                            </div>

                            <div class="form-group col-md-2">
                                <label>Member Ministry Status</label>
                                <select class="form-select" name="ministry_status">
                                    <option value="">Select Status</option>
                                    <option {{ Request::get('ministry_status') == 100 ? 'selected' : '' }} value="100">
                                        Active</option>
                                    <option {{ Request::get('ministry_status') == 1 ? 'selected' : '' }} value="1">
                                        Inactive</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3 d-flex align-items-end">
                                <button class="btn btn-primary me-2" type="submit">Search</button>
                                <a href="{{ url('admin/assign_ministry/list') }}" class="btn btn-danger">Reset</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                @include('alerts')
                <div class="table-responsive">
                    <table class="table table-striped caption-top">
                        <caption class="fs-5 fw-semibold">List of Ministries</caption>
                        <thead>
                            <tr class="highlight">
                                <th scope="col">Member Name</th>
                                <th scope="col">Ministry</th>
                                <th scope="col">Ministry Status</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($getRecord->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center">No records found.</td>
                                </tr>
                            @else
                                @foreach ($getRecord as $value)
                                    <tr>
                                        <td>{{ $value->member_name }} {{ $value->member_lname }}</td>
                                        <td>{{ $value->ministry_name }}</td>
                                        <td>
                                            @if ($value->ministry_status == 0)
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        </td>
                                        <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                        <td>
                                            <a href="{{ url('admin/assign_ministry/edit', $value->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <a href="{{ url('admin/assign_ministry/delete', $value->id) }}" class="btn btn-danger btn-sm" onclick="confirmDelete(event, {{ $value->id }}, '{{ $value->member_name }}')">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
                <div class="d-flex justify-content-center">
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(event, id, member_name) {
            event.preventDefault();

            var confirmation = confirm('Are you sure you want to delete this Member to the Ministry: ' + member_name + '?');

            if (confirmation) {
                window.location.href = '{{ url('admin/assign_ministry/delete') }}' + '/' + id;
            }
        }
    </script>
@endsection
