@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Add Ministry</h3>
        </div>

        <form class="row g-3" method="POST" action="">
            @csrf
            <div class="col-6">
                <label class="form-label">Ministry Name</label>
                <input type="text" class="form-control" value="{{ $getRecord->ministry_name }}" name="name" required
                    placeholder="Ministry Name">
            </div>

            <div class="col-6">
                <label class="form-label">Status</label>
                <select class="form-control" name="status">
                    <option {{ $getRecord->ministry_status == 0 ? 'selected' : '' }} value="0">Active</option>
                    <option {{ $getRecord->ministry_status == 1 ? 'selected' : '' }} value="1">Inactive</option>
                </select>
            </div>

            <div class="d-flex justify-content-evenly">
                <button type="submit" class="btn btn-primary btn-sm w-25 h-75 mb-3">Update</button>
            </div>
        </form>
    </div>
@endsection
