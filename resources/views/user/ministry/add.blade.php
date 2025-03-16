@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Add Ministry</h3>
        </div>

        <form class="row g-3" method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="col-6">
                <label class="form-label">Ministry Name<span style="color: red">*</span></label>
                <input type="text" class="form-control" name="name" required placeholder="Ministry Name">
            </div>

            <div class="col-6">
                <label class="form-label">Ministry Description<span style="color: red">*</span></label>
                <input type="text" class="form-control" name="ministry_description" required placeholder="Ministry Description">
            </div>

            <div class="col-6">
                <label class="form-label">Status<span style="color: red">*</span></label>
                <select class="form-select" name="status">
                    <option value="0">Active</option>
                    <option value="1">Inactive</option>
                </select>
            </div>

            <div class="col-6">
                <label class="form-label">Ministry Profile<span style="color: red">*</span></label>
                <input type="file" class="form-control" name="ministry_profile" required>
                <div style="color: red">{{ $errors->first('ministry_profile') }}</div>
            </div>

            <div class="d-flex justify-content-evenly">
                <button type="submit" class="btn btn-primary btn-sm w-25 h-75 mb-3">Submit</button>
                <button type="reset" class="btn btn-danger btn-sm w-25 h-75 mb-3">Clear</button>
            </div>
        </form>
    </div>
@endsection
