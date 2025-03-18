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
            <a href="{{ url('user/ministry/add') }}" class="btn my-2">Add Ministry</a>
        </div>

        <div class="card shadow-lg mb-4">
            <div class="py-2">
                <h6 class="my-0 fs-5 fw-bold">List of Ministry</h6>
            </div>
                <div class="table-responsive shadow-sm">
                    <table class="table table-striped" id="ministryTable" width="100%" cellspacing="0">
                        <thead class="mt-5">
                            <tr class="highlight">
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
                                    <td>{{ $value->ministry_name }}</td>
                                    <td class="break-word">{{ $value->ministry_description }}</td>
                                    <td>
                                        @if ($value->ministry_status == 0)
                                            Active
                                        @else
                                            Inactive
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($value->getMinistryProfile()))
                                        <a href="#">
                                            <img src="{{ $value->getMinistryProfile() }}" style="height: 50px; width:50px;" 
                                                data-bs-toggle="modal" data-bs-target="#imageModal" 
                                                data-image="{{ $value->getMinistryProfile() }}" class="clickable-image">
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{ $value->created_by }}</td>
                                    <td>{{ \Carbon\Carbon::parse($value->created_at)->timezone('Asia/Manila')->format('d-m-Y H:i A') }}</td>
                                    <td>
                                        <a href="{{ url('user/ministry/edit', $value->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="{{ url('user/ministry/delete', $value->id) }}" class="btn btn-danger btn-sm" onclick="confirmDelete(event, {{ $value->id }}, '{{ $value->ministry_name }}')">Delete</a>
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
                    <h5 class="modal-title" id="imageModalLabel">Ministry Featured Photo</h5>
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
            $('#ministryTable').DataTable();
            $('.clickable-image').on('click', function() {
                var imageSrc = $(this).data('image');
                $('#modalImage').attr('src', imageSrc);
            });
        });

        function confirmDelete(event, id, ministry_name) {
            event.preventDefault(); // Stop default link or form behavior

            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete this Ministry: ${ministry_name}. This action cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                        window.location.href = `/user/ministry/delete/${id}`;
                }
            });
        }
    </script>
@endsection