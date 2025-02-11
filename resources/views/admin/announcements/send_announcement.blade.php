@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ url('select2.min.css') }}">
    <style type="text/css">
        .select2-container .select2-selection--single{
            height: 40px;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Send Announcement</h3>
        </div>

        <form class="row g-3" method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="col-12">
                <label class="form-label">Subject</label>
                <input type="text" class="form-control" name="subject" required placeholder="Subject">
            </div>

            <div class="form-group">
                <label>Send Email to (Admins / Members) </label>
                <select name="user_id" class="form-select select2" style="width: 100%;">
                    <option value="">Select</option>
                </select>
            </div>

            <div class="form-group">
                <label style="display: block;">Email To</label>
                <label style="margin-right:25px;"><input type="checkbox" value="admin" name="email_to[]" style="margin-right: 10px;">Church Administrator</label>
                <label style="margin-right:25px;"><input type="checkbox" value="user" name="email_to[]" style="margin-right: 10px;">Admins</label>
                <label style="margin-right:25px;"><input type="checkbox" value="member" name="email_to[]" style="margin-right: 10px;">Members</label>
            </div>

            <div class="col-12"> 
                <label class="form-label">Description</label>
                <textarea id="summernote" class="form-control" name="description" style="height: 300px"></textarea>
            </div>

            <div class="d-flex justify-content-evenly">
                <button type="submit" class="btn btn-primary btn-sm w-25 h-75 mb-3">Send Announcements</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>

        $(document).ready(function() {
        $('.select2').select2({
            ajax: {
        url: '{{ url('admin/announcements/search_users') }}',
            dataType: 'json',
            delay: 250,
            data: function (data) {
                return {
                    search: data.term,
                };
            },
            processResults: function (response) {
                return {
                    results: response,
                };
            },
        }
    });

        $('#summernote').summernote({
            height: 200, 
        });
    });
    </script>
@endsection
