@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Announcements</h3>
        </div>
        <div class="col-sm-6 button-list" style="text-align: right">
            <a href="{{ url('admin/announcements/create_announcement/add') }}" class="btn my-2">Add Announcement</a>
        </div>

        <div class="container-fluid shadow-lg ">
            <div class="card p-2 g-col-6">
                <div class="card-header">
                    <h5 class="fw-bold fs-5">Search Announcement</h5>
                </div>

                <form method="get" action="">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label>Title</label>
                                <input type="text" class="form-control" value="{{ Request::get('title') }}" name="title"
                                    placeholder="Title">
                            </div>

                            <div class="form-group col-md-2">
                                <label>Notice Date From</label>
                                <input type="date" class="form-control" value="{{ Request::get('notice_date_from') }}"
                                    name="notice_date_from">
                            </div>

                            <div class="form-group col-md-2">
                                <label>Notice Date To</label>
                                <input type="date" class="form-control" value="{{ Request::get('notice_date_to') }}"
                                    name="notice_date_to">
                            </div>

                            <div class="form-group col-md-2">
                                <label>Publish Date From</label>
                                <input type="date" class="form-control" value="{{ Request::get('publish_date_from') }}"
                                    name="publish_date_from">
                            </div>

                            <div class="form-group col-md-2">
                                <label>Publish Date To</label>
                                <input type="date" class="form-control" value="{{ Request::get('publish_date_to') }}"
                                    name="publish_date_to">
                            </div>

                            <div class="form-group col-md-3 d-flex align-items-end">
                                <button class="btn btn-primary me-2" type="submit" style="margin-top: 10px;">Search</button>
                                <a href="{{ url('admin/announcements') }}" class="btn btn-danger">Reset</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                @include('alerts')
                <div class="table-responsive">
                    <table class="table table-striped caption-top">
                        <caption class="fs-5 fw-semibold">Announcement List</caption>
                        <thead>
                            <tr class="highlight">
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Notice Date</th>
                                <th scope="col">Publish Date</th>
                                <th scope="col">Created By</th>
                                <th scope="col">Created Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($getRecord as $value)
                                <tr>
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->title}}</td>
                                    <td>{{date('d-m-Y', strtotime ($value->notice_date))}}</td>
                                    <td>{{date('d-m-Y', strtotime ($value->publish_date))}}</td>
                                    <td>{{$value->created_by_name}}</td>
                                    <td>{{date('d-m-Y', strtotime ($value->created_at))}}</td>
                                    <td>
                                        <a href="{{ url('admin/announcements/create_announcement/edit', $value->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <a href="{{ url('admin/announcements/create_announcement/delete', $value->id) }}"
                                            class="btn btn-danger btn-sm"
                                            onclick="confirmDelete(event, {{ $value->id }}, '{{ $value->title }}')">Delete</a>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="100%">No Record Found.</td>
                            </tr>
                            @endempty
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
            </div>
        </div>
    </div>
    
@endsection
@section('script')

<script>
    function confirmDelete(event, id, title) {
        event.preventDefault();

        var confirmation = confirm('Are you sure you want to delete this Announcement: ' + title + '?');

        if (confirmation) {
            window.location.href = '{{ url('admin/announcements/create_announcement/delete') }}' + '/' + id;
        }
    }
</script>
@endsection
