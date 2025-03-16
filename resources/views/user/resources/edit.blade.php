@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Edit Church Resources</h3>
        </div>

        <form class="row g-3" method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="col-6">
                <label class="form-label">File Name<span style="color: red">*</span></label>
                <input type="text" class="form-control" name="file_name" value="{{ old('file_name', $resource->file_name) }}" required placeholder="File Name">
            </div>

            <div class="col-6">
                <label class="form-label">Document<span style="color: red">*</span></label>
                <input type="file" class="form-control" name="document">
                <div style="color: red">{{ $errors->first('document') }}</div>
                <small>Current Document: <a href="{{ $resource->getDocument() }}" target="_blank">{{ $resource->document }}</a></small>
            </div>

            <div class="col-6">
                <label class="form-label">File Image<span style="color: red">*</span></label>
                <input type="file" class="form-control" name="file_image">
                <div style="color: red">{{ $errors->first('file_image') }}</div>
                <img src="{{ $resource->getImage() }}" alt="Current Image" style="max-width: 100px;">
            </div>

            <div class="col-6">
                <label class="form-label">File Description<span style="color: red">*</span></label>
                <textarea class="form-control" id="description" name="description" maxlength="250" rows="3" placeholder="Maximum 250 Characters">{{ old('description', $resource->description) }}</textarea>
            </div>

            <div class="d-flex justify-content-evenly">
                <button type="submit" class="btn btn-primary btn-sm w-25 h-75 mb-3">Save Changes</button>
            </div>
        </form>
    </div>
@endsection