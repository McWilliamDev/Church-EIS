@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Add Church Resources</h3>
        </div>

        <form class="row g-3" method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="col-6">
                <label class="form-label">File Name<span style="color: red">*</span></label>
                <input type="text" class="form-control" name="file_name" required placeholder="File Name">
            </div>

            <div class="col-6">
                <label class="form-label">Document<span style="color: red">*</span></label>
                <input type="file" class="form-control" name="document" required>
                <div style="color: red">{{ $errors->first('document') }}</div>
            </div>

            <div class="col-6">
                <label class="form-label">File Image<span style="color: red">*</span></label>
                <input type="file" class="form-control" name="file_image" required>
                <div style="color: red">{{ $errors->first('file_image') }}</div>
            </div>

            <div class="col-6">
                <label class="form-label">File Description<span style="color: red">*</span></label>
                <textarea class="form-control" id="description" name="description" maxlength="250" rows="3" placeholder="Maximum 150 Characters"></textarea>
            </div>

            <div class="d-flex justify-content-evenly">
                <button type="submit" class="btn btn-primary btn-sm w-25 h-75 mb-3">Submit</button>
                <button type="reset" class="btn btn-danger btn-sm w-25 h-75 mb-3">Clear</button>
            </div>
            
        </form>
    </div>
@endsection
