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
            <a href="{{ url('admin/events/add') }}" class="btn my-2">Add Events</a>
        </div>
        
        @include('alerts')
        
        <div class="card shadow-lg mb-4">
            <div class="py-2">
                <h6 class="my-0 fs-5 fw-bold">List of Events</h6>
            </div>

            <div class="card-body my-0">
                <div class="table-responsive shadow-sm">
                    <table class="table table-striped" id="eventTable" width="100%" cellspacing="0">
                        <thead class="mt-5">
                            <tr class="highlight">
                                <th scope="col">#</th>
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
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->title }}</td>
                                <td>{{ $value->description }}</td>
                                <td>{{ $value->location }}</td>
                                <td>
                                    @if (!empty($value->date))
                                            {{ date('d-m-Y H:i A', strtotime($value->date)) }}
                                    @endif

                                </td>
                                <td>
                                    @if (!empty($value->getFeatured()))
                                    <img src="{{ $value->getFeatured() }}"
                                        style="height: 50px; width:50px;">
                                    @endif
                                </td>
                                <td>{{ $value->created_by }}</td>
                                <td>
                                    <a href="{{ url('admin/events/edit', $value->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <a href="{{ url('admin/events/delete', $value->id) }}"
                                        class="btn btn-danger btn-sm"
                                        onclick="confirmDelete(event, {{ $value->id }}, '{{ $value->title }}')">Delete</a>
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
            $('#eventTable').DataTable();
        });

        function confirmDelete(event, id, title) {
            event.preventDefault();

            var confirmation = confirm('Are you sure you want to delete this Event: ' + title + '?');

            if (confirmation) {
                window.location.href = '{{ url('admin/events/delete') }}' + '/' + id;
            }
        }

    </script>
@endsection