@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Church Members (Total: {{ $getRecord->total() }})</h3>
        </div>
        
        <div class="col-sm-6 button-list" style="text-align: right">
            <a href="{{ url('admin/member/add') }}" class="btn my-2">Add Church Member</a>
        </div>
        
        <div class="card shadow-lg mb-4">
            <div class="py-2">
                <h6 class="my-0 fs-5 fw-bold">List of Church Administrators</h6>
            </div>

            <div class="card-body my-0">
                <div class="table-responsive shadow-sm">
                    <table class="table table-striped" id="memberTable" width="100%" cellspacing="0">
                        <thead class="mt-5">
                            <tr class="highlight">
                                <th>#</th>
                                <th >Profile Picture</th>
                                <th >Name</th>
                                <th >Email</th>
                                <th >Phone No. </th>
                                <th >Gender</th>
                                <th >Ministry</th>
                                <th >Date of Birth</th>
                                <th >Address</th>
                                <th >Status</th>
                                <th >Created By</th>
                                <th >Date Added</th>
                                <th >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getRecord as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>
                                        @if (!empty($value->getProfile()))
                                            <img src="{{ $value->getProfile() }}"
                                                style="height: 50px; width:50px; border-radius:50px;">
                                        @endif
                                    </td>
                                    <td>{{ $value->name }} {{ $value->last_name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->phonenumber }}</td>
                                    <td>{{ $value->gender }}</td>
                                    <td>{{ $value->ministry_name }}</td>
                                    <td>
                                        @if (!empty($value->date_of_birth))
                                            {{ date('d-m-Y', strtotime($value->date_of_birth)) }}
                                        @endif
                                    </td>
                                    <td>{{ $value->address }}</td>
                                    <td>{{ $value->member_status == 0 ? 'Active' : 'Inactive' }}</td>
                                    <td>{{ $value->created_by }}</td>
                                    <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>

                                    <td style="min-width: 200px;">
                                        <a href="{{ url('admin/member/edit', $value->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <a href="{{ url('admin/member/delete', $value->id) }}"
                                            class="btn btn-danger btn-sm"
                                            onclick="confirmDelete(event, {{ $value->id }}, '{{ $value->name }}')">Delete</a>
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
            $('#memberTable').DataTable();
        });

        function confirmDelete(event, id, name) {
    event.preventDefault(); // Stop default action

    // SweetAlert confirmation dialog
    Swal.fire({
        title: 'Are you sure?',
        text: `You are about to delete this Church Member: ${name}. This action cannot be undone!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect to perform deletion
            Swal.fire({
                title: "Deleted!",
                text: "Church Member successfully deleted.",
                icon: "success"
            }).then(() => {
                // Redirect to execute the backend deletion logic
                window.location.href = `/admin/member/delete/${id}`;
            });
        }
    });
}
    </script>
@endsection