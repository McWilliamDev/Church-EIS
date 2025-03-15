@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Administrators (Total: {{ $getRecord->total() }})</h3>
        </div>
        
        <div class="col-sm-6 button-list" style="text-align: right">
            <a href="{{ url('admin/user/add') }}" class="btn my-2">Add Administrators</a>
        </div>
        
        <div class="card shadow-lg mb-4">
            <div class="py-2">
                <h6 class="my-0 fs-5 fw-bold">List of Administrators</h6>
            </div>

                <div class="table-responsive shadow-sm">
                    <table class="table table-striped" id="adminTable" width="100%" cellspacing="0">
                        <thead class="mt-5">
                            <tr class="highlight">
                                <th scope="col">#</th>
                                <th scope="col">Profile Picture</th>
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
                            @foreach ($getRecord as $value)
                                <tr>
                                    <td>{{ $value->id }}</td>
                                    <td>
                                        @if (!empty($value->getProfile()))
                                        <a href="#">
                                            <img src="{{ $value->getProfile() }}" style="height: 50px; width:50px; border-radius:50px;" 
                                                data-bs-toggle="modal" data-bs-target="#imageModal" 
                                                data-image="{{ $value->getProfile() }}" class="clickable-image">
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->position }}</td>
                                    <td>{{ $value->address }}</td>
                                    <td>{{ $value->phonenumber }}</td>
                                    <td>{{ $value->created_at }}</td>
                                    <td>
                                        <a href="{{ url('admin/user/edit', $value->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="{{ url('admin/user/delete', $value->id) }}" class="btn btn-danger btn-sm" onclick="confirmDelete(event, {{ $value->id }}, '{{ $value->name }}')">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>

    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modalImage" src="" alt="Profile Picture" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@include('alerts')
<script>
    $(document).ready(function() {
        $('#adminTable').DataTable();
        $('.clickable-image').on('click', function() {
            var imageSrc = $(this).data('image');
            $('#modalImage').attr('src', imageSrc);
        });
    });

    function confirmDelete(event, id, name) {
        event.preventDefault();

        // SweetAlert confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to delete Administrator ${name}. This action cannot be undone!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with deletion
                Swal.fire({
                    title: "Deleted!",
                    text: "Admin successfully deleted.",
                    icon: "success"
                }).then(() => {
                    // Redirect after confirmation
                    window.location.href = '{{ url("admin/user/delete") }}/' + id;
                });
            }
        });
    }
</script>

@endsection