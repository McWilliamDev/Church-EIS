@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Add Announcement</h3>
        </div>

        <form class="row g-3" method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="col-12">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title" required placeholder="Announcement Title">
            </div>

            <div class="col-12">
                <label class="form-label">Notice Date</label>
                <input type="date" class="form-control" name="notice_date" min="{{ date('Y-m-d') }}" required>
            </div>

            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea  class="form-control" name="description" maxlength="250" rows="4" placeholder="Maximum 250 Characters"></textarea>
            </div>

            <div class="d-flex justify-content-evenly">
                <button type="submit" class="btn btn-primary btn-sm w-25 h-75 mb-3">Submit</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
            height: 200, 
        });
    });
    </script>
@endsection
