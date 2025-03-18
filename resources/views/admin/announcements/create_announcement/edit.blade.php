@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Edit Announcement</h3>
        </div>

        <form class="row g-3" method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="col-12">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" value="{{$getRecord->title }}" name="title" required placeholder="Announcement Title">
            </div>

            <div class="col-12">
                <label class="form-label">Notice Date</label>
                <input type="date" class="form-control" value="{{ \Carbon\Carbon::parse($getRecord->notice_date)->format('Y-m-d') }}" name="notice_date" required min="{{ date('Y-m-d') }}">
            </div>

            <div class="col-12">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" maxlength="250" rows="4" placeholder="Maximum 250 Characters"> {{ $getRecord->description }}</textarea>
            </div>

            <div class="d-flex justify-content-evenly">
                <button type="submit" class="btn btn-primary btn-sm w-25 h-75 mb-3">Save Changes</button>
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
