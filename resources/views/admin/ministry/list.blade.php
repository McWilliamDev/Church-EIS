@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Ministry Groups</h3>
        </div>
        
        <div class="col-sm-6 button-list" style="text-align: right">
            <a href="{{ url('admin/ministry/add') }}" class="btn my-2">Add Ministry</a>
        </div>
        
        @include('alerts')
        
        <div class="card shadow-lg mb-4">
            <div class="py-2">
                <h6 class="my-0 fs-5 fw-bold">List of Ministry</h6>
            </div>

            <div class="card-body my-0">
                <div class="table-responsive shadow-sm">
                    <table class="table table-striped" id="ministryTable" width="100%" cellspacing="0">
                        <thead class="mt-5">
                            <tr class="highlight">
                                <th scope="col">#</th>
                                <th scope="col">Ministry Name</th>
                                <th scope="col">Ministry Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Ministry Profile</th>
                                <th scope="col">Created By</th>
                                <th scope="col">Date Created</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getRecord as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->ministry_name }}</td>
                                    <td>{{ $value->ministry_description }}</td>
                                    <td>
                                        @if ($value->ministry_status == 0)
                                            Active
                                        @else
                                            Inactive
                                        @endif
                                    </td>
                                    <td>@if (!empty($value->getMinistryProfile()))
                                        <img src="{{ $value->getMinistryProfile() }}"
                                            style="height: 50px; width:50px;">
                                        @endif</td>
                                    <td>{{ $value->created_by }}</td>
                                    <td>{{ \Carbon\Carbon::parse($value->created_at)->timezone('Asia/Manila')->format('d-m-Y H:i A') }}
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/ministry/edit', $value->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <a href="{{ url('admin/ministry/delete', $value->id) }}"
                                            class="btn btn-danger btn-sm"
                                            onclick="confirmDelete(event, {{ $value->id }}, '{{ $value->ministry_name }}')">Delete</a>
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
<script>
    $(document).ready(function() {
        $('#ministryTable').DataTable();
    });
    function confirmDelete(event, id, ministry_name) {
        event.preventDefault();

        var confirmation = confirm('Are you sure you want to delete this Ministry: ' + ministry_name + '?');

        if (confirmation) {
            window.location.href = '{{ url('admin/ministry/delete') }}' + '/' + id;
        }
    }
</script>

@endsection