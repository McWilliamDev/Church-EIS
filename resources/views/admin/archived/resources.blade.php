@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Archived Church Resources (Total: {{ $getRecord->total() }})</h3>
        </div>
        
        <div class="card shadow-lg mb-4">
            <div class="py-2">
                <h6 class="my-0 fs-5 fw-bold">List of Archived Church Resources</h6>
            </div>
            <div class="table-responsive shadow-sm">
                <table class="table table-striped" id="resourcesTable" width="100%" cellspacing="0">
                    <thead class="mt-5">
                        <tr class="highlight">
                            <th>File Name</th>
                            <th>Document</th>
                            <th>Description</th>
                            <th>File Image</th>
                            <th>Date Deleted</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getRecord as $value)
                            <tr>
                                <td>{{ $value->file_name }}</td>
                                <td>
                                    @if($value->getDocument())
                                        <a href="{{ $value->getDocument() }}" target="_blank">View Document</a>
                                    @else
                                        No Document
                                    @endif
                                </td>
                                <td>{{ $value->description }}</td>
                                <td>
                                    @if($value->getImage())
                                        <img src="{{ $value->getImage() }}" alt="File Image" style="width: 50px; height: auto;">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ date('d-m-Y H:i A', strtotime($value->updated_at)) }}</td>
                                <td style="min-width: 200px;">
                                    <a href="{{ url('admin/archived/restore', $value->id) }}" class="btn btn-primary btn-sm">Restore</a>
                                    <a href="{{ url('admin/archived/delete', $value->id) }}" class="btn btn-danger btn-sm" onclick="confirmDelete(event, {{ $value->id }}, '{{ $value->file_name }}')">Delete</a>
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
        $('#resourcesTable').DataTable();
    });

    function confirmDelete(event, id, name) {
        event.preventDefault(); // Stop default action

        // SweetAlert confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to delete this File: ${name} from the archived. This action cannot be undone!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `/admin/archived/delete/${id}`;
            }
        });
    }
</script>
@endsection