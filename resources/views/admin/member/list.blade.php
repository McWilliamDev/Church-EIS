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
            <a href="{{ url('admin/member/add') }}" class="btn my-2">Add Church Members</a>
        </div>

        
            <div class="col-md-12">
                @include('alerts')
                <div class="table-responsive" style="overflow: auto;">
                    <div class="container-fluid">
                        <!--<div class="card p-2 g-col-6">
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
                        </div>-->
                    <table id="memberTable" class="table table-striped caption-top display">
                        <caption class="fs-5 fw-semibold">List of Church Members</caption>
                        <thead>
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
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>

$(document).ready(function() {
    $('#memberTable').DataTable();
    });

    function confirmDelete(event, id, name) {
        event.preventDefault();

        var confirmation = confirm('Are you sure you want to delete this Church Member: ' + name + '?');

        if (confirmation) {
            window.location.href = '{{ url('admin/member/delete') }}' + '/' + id;
        }
    }
</script>
@endsection
