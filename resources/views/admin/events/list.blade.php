@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Manage Events</h3>
        </div>
        <div class="col-sm-6 button-list" style="text-align: right">
            <a href="{{ url('admin/events/add') }}" class="btn my-2">Add Events</a>
        </div>

        <div class="container-fluid shadow-lg ">
            <div class="col-md-12">
                @include('alerts')
                <div class="table-responsive" style="overflow: auto;">
                    <table class="table table-striped caption-top">
                        <caption class="fs-5 fw-semibold">List of Events</caption>
                        <thead>
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
                <div class="d-flex justify-content-center">
                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(event, id, title) {
            event.preventDefault();

            var confirmation = confirm('Are you sure you want to delete this Event: ' + title + '?');

            if (confirmation) {
                window.location.href = '{{ url('admin/events/delete') }}' + '/' + id;
            }
        }
    </script>
@endsection
