@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Announcements</h3>
        </div>

        <div class="col-sm-6 button-list" style="text-align: right">
            <a href="{{ url('admin/announcements/create_announcement/add') }}" class="btn my-2">Create Announcement</a>
        </div>

        <div class="card p-2 g-col-6">
            <form method="get" action="">
                <div class="row">
                    <div class="form-group col-md-2">
                        <label>Title</label>
                        <input type="text" class="form-control" value="{{ Request::get('title') }}" name="title" placeholder="Title">
                    </div>

                    <div class="form-group col-md-2">
                        <label>Notice Date From</label>
                        <input type="date" class="form-control" value="{{ Request::get('notice_date_from') }}" name="notice_date_from">
                    </div>

                    <div class="form-group col-md-2">
                        <label>Notice Date To</label>
                        <input type="date" class="form-control" value="{{ Request::get('notice_date_to') }}" name="notice_date_to">
                    </div>

                    <div class="form-group col-md-2">
                        <label>Publish Date From</label>
                        <input type="date" class="form-control" value="{{ Request::get('publish_date_from') }}" name="publish_date_from">
                    </div>

                    <div class="form-group col-md-2">
                        <label>Publish Date To</label>
                        <input type="date" class="form-control" value="{{ Request::get('publish_date_to') }}" name="publish_date_to">
                    </div>

                    <div class="form-group col-md-3 d-flex align-items-end">
                        <button class="btn btn-primary me-2" type="submit" style="margin-top: 10px;">Search</button>
                        <a href="{{ url('admin/announcements') }}" class="btn btn-danger">Reset</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="card shadow-lg mb-4" style="margin-top: 10px">
            <div class="py-2">
                <h6 class="my-0 fs-5 fw-bold">List of Announcements</h6>
            </div>

            <div class="card-body my-0">
                <div class="table-responsive shadow-sm">
                    <table class="table table-striped" id="announcementTable" width="100%" cellspacing="0">
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
                                    <td>{{ $value->id }}</td>
                                    <td>{{ $value->title }}</td>
                                    <td>{{ date('d-m-Y', strtotime($value->notice_date)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($value->publish_date)) }}</td>
                                    <td>{{ $value->created_by_name }}</td>
                                    <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                    <td>
                                        <a href="{{ url('admin/announcements/create_announcement/edit', $value->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="{{ url('admin/announcements/create_announcement/delete', $value->id) }}" class="btn btn-danger btn-sm" onclick="confirmDelete(event, {{ $value->id }}, '{{ $value->title }}')">Delete</a>
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
            </div>
        </div>
    </div>
@endsection

@section('script')
@include('alerts')
    <script>
        $(document).ready(function() {
            $('#announcementTable').DataTable();
        });

        function confirmDelete(event, id, title) {
            event.preventDefault(); // Stop default link or form behavior

            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete this Announcement: ${title}. This action cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                        window.location.href = `/admin/announcements/create_announcement/delete/${id}`;
                }
            });
        }
    </script>
@endsection
