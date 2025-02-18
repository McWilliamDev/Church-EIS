@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Ministry Groups</h3>
        </div>
        <div class="col-sm-6 button-list" style="text-align: right">
            <a href="{{ url('user/ministry/add') }}" class="btn my-2">Add Ministry</a>
        </div>

        <div class="container-fluid shadow-lg ">
            <div class="col-md-12">
                @include('alerts')
                <div class="table-responsive">
                    <table class="table table-striped caption-top">
                        <caption class="fs-5 fw-semibold">List of Ministries</caption>
                        <thead>
                            <tr class="highlight">
                                <th scope="col">#</th>
                                <th scope="col">Ministry Name</th>
                                <th scope="col">Status</th>
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
                                    <td>
                                        @if ($value->ministry_status == 0)
                                            Active
                                        @else
                                            Inactive
                                        @endif
                                    </td>
                                    <td>{{ $value->created_by }}</td>
                                    <td>{{ \Carbon\Carbon::parse($value->created_at)->timezone('Asia/Manila')->format('d-m-Y H:i A') }}
                                    </td>
                                    <td>
                                        <a href="{{ url('user/ministry/edit', $value->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <a href="{{ url('user/ministry/delete', $value->id) }}"
                                            class="btn btn-danger btn-sm"
                                            onclick="confirmDelete(event, {{ $value->id }}, '{{ $value->ministry_name }}')">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
                <div class="d-flex justify-content-center">
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(event, id, ministry_name) {
            event.preventDefault();

            var confirmation = confirm('Are you sure you want to delete this Ministry: ' + ministry_name + '?');

            if (confirmation) {
                window.location.href = '{{ url('user/ministry/delete') }}' + '/' + id;
            }
        }
    </script>
@endsection
