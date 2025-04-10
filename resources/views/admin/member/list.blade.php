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
        
        <div class="card p-2 g-col-6 mb-4">
            <div class="card-header">
                <h5 class="fw-bold fs-5">Search Member</h5>
            </div>

            <form method="get" action="">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" value="{{ Request::get('name') }}" name="name"
                                placeholder="Name">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" value="{{ Request::get('email') }}"
                                name="email" placeholder="Email">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="date">Phone No.</label>
                            <input type="text" class="form-control" value="{{ Request::get('phonenumber') }}"
                                name="phonenumber" placeholder="Phone Number">
                        </div>

                        <div class="form-group col-md-2">
                            <label for="date">Member Status</label>
                            <select class="form-select" name="member_status">
                                <option value="">Select Status</option>
                                <option {{ Request::get('member_status') == 100 ? 'selected' : '' }} value="100">
                                    Active</option>
                                <option {{ Request::get('member_status') == 1 ? 'selected' : '' }} value="1">
                                    Inactive</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3 d-flex align-items-end">
                            <button class="btn btn-primary me-2" type="submit">Search</button>
                            <a href="{{ url('admin/member/list') }}" class="btn btn-danger">Reset</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="card shadow-lg mb-4">
            <div class="py-2">
                <h6 class="my-0 fs-5 fw-bold">List of Church Members</h6>
            </div>
                <div class="table-responsive shadow-sm">
                    <table class="table table-striped" id="memberTable" width="100%" cellspacing="0">
                        <thead class="mt-5">
                            <tr class="highlight">
                                <th >Profile Picture</th>
                                <th >Name</th>
                                <th >Email</th>
                                <th >Phone No. </th>
                                <th >Gender</th>
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
                                            onclick="confirmDelete(event, {{ $value->id }}, '{{ $value->name }}')">Archive</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
        text: `You are about to move this Church Member: ${name} to archive.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, Move to Archive'
    }).then((result) => {
        if (result.isConfirmed) {
                window.location.href = `/admin/member/delete/${id}`;
        }
    });
}
    </script>
@endsection