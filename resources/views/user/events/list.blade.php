@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Manage Events</h3>
        </div>

        <div class="col-sm-6 button-list" style="text-align: right">
            <a href="{{ url('user/events/add') }}" class="btn my-2">Add Events</a>
        </div>

        <div class="card shadow-lg mb-4">
            <div class="py-2">
                <h6 class="my-0 fs-5 fw-bold">List of Events</h6>
            </div>
                <div class="table-responsive shadow-sm">
                    <table class="table table-striped" id="eventTable" width="100%" cellspacing="0">
                        <thead class="mt-5">
                            <tr class="highlight">
                                <th scope="col">Event Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Location</th>
                                <th scope="col">Start Date</th>
                                <th scope="col">Featured Image</th>
                                <th scope="col">Created By</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getRecord as $value)
                                <tr>
                                    <td>{{ $value->title }}</td>
                                    <td class="break-word">{{ $value->description }}</td>
                                    <td>{{ $value->location }}</td>
                                    <td>
                                        @if (!empty($value->date))
                                            {{ date('d-m-Y H:i A', strtotime($value->date)) }}
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($value->getFeatured()))
                                        <a href="#">
                                            <img src="{{ $value->getFeatured() }}" style="height: 50px; width:50px;" 
                                                data-bs-toggle="modal" data-bs-target="#imageModal" 
                                                data-image="{{ $value->getFeatured() }}" class="clickable-image">
                                            </a>
                                        @endif
                                    </td>
                                    <td>{{ $value->created_by }}</td>
                                    <td>
                                        <a href="{{ url('user/events/edit', $value->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="{{ url('user/events/delete', $value->id) }}" class="btn btn-danger btn-sm" onclick="confirmDelete(event, {{ $value->id }}, '{{ $value->title }}')">Delete</a>
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
                    <h5 class="modal-title" id="imageModalLabel">Event Featured Image</h5>
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
            $('#eventTable').DataTable();
            $('.clickable-image').on('click', function() {
                var imageSrc = $(this).data('image');
                $('#modalImage').attr('src', imageSrc);
            });
        });

        function confirmDelete(event, id, title) {
            event.preventDefault(); // Stop default form or link behavior

            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete this Event: ${title}. This action cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                        window.location.href = `/user/events/delete/${id}`;
                }
            });
        }
    </script>
@endsection