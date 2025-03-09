@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Members Ministry</h3>
        </div>

        <div class="col-sm-6 button-list" style="text-align: right">
            <a href="{{ url('admin/assign_ministry') }}" class="btn my-2">Assign Members to Ministry</a>
        </div>

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
                                <option {{ Request::get('ministry_status') == 100 ? 'selected' : '' }} value="100">Active</option>
                                <option {{ Request::get('ministry_status') == 1 ? 'selected' : '' }} value="1">Inactive</option>
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

        <div class="card shadow-lg mb-4" style="margin-top: 10px">
            <div class="py-2">
                <h6 class="my-0 fs-5 fw-bold">List of Assigned Members to Ministry</h6>
            </div>

            <div class="card-body my-0">
                <div class="table-responsive shadow-sm">
                    <table class="table table-striped" id="assignministryTable" width="100%" cellspacing="0">
                        <thead class="mt-5">
                            <tr class="highlight">
                                <th scope="col">Member Name</th>
                                <th scope="col">Ministry</th>
                                <th scope="col">Ministry Status</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@include('alerts')
    <script>
        $(document).ready(function() {
            $('#assignministryTable').DataTable();
        });

        function confirmDelete(event, id, member_name) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete the Member: ${member_name} from the Ministry. This action cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show success alert before redirecting
                    Swal.fire({
                        title: "Deleted!",
                        text: "Assigned Member successfully deleted from Ministry.",
                        icon: "success"
                        
                    }).then(() => {
                        // Redirect to execute the backend deletion logic
                        window.location.href = `/admin/assign_ministry/delete/${id}`;
                    });
                }
            });
        }
    </script>
@endsection
