@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Create New Event</h3>
        </div>

        <form class="row g-3" method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="col-6">
                <label class="form-label">Event Title<span style="color: red">*</span></label>
                <input type="text" class="form-control" value="{{ old('title', $getRecord->title) }}" name="title" required
                    placeholder="Event Name">
                    <div style="color: red">{{ $errors->first('title') }}</div>
            </div>

            <div class="col-6">
                <label class="form-label">Location<span style="color: red">*</span></label>
                <input type="text" class="form-control" value="{{ old('location', $getRecord->location) }}" name="location" required placeholder="Location">
                <div style="color: red">{{ $errors->first('location') }}</div>
            </div>

            <div class="col-6">
                <label class="form-label">Event Description<span style="color: red">*</span></label>
                <textarea class="form-control" name="description" required
                    placeholder="Event Description">{{ old('description', $getRecord->description) }}</textarea>
                    <div style="color: red">{{ $errors->first('description') }}</div>
            </div>

            <div class="col-6">
                <label class="form-label">Date & Time<span style="color: red">*</span></label>
                <input type="datetime-local" class="form-control" value="{{ old('date', $getRecord->date ? date('Y-m-d\TH:i', strtotime($getRecord->date)) : '') }}" name="date" required min="{{ date('Y-m-d\TH:i') }}">
                <div style="color: red">{{ $errors->first('date') }}</div>
            </div>
            
            <div class="col-6">
                <label class="form-label">Featured Image<span style="color: red">*</span></label>
                <input type="file" class="form-control" name="featured_image">
                <div style="color: red">{{ $errors->first('featured_image') }}</div>
            </div>
            
            <div class="col-6">
                @if (!empty($getRecord->getFeatured()))
                    <img src="{{ $getRecord->getFeatured() }}" style="width: auto; height:100px;">
                @endif
            </div>

            <div class="d-flex justify-content-evenly">
                <button type="submit" class="btn btn-primary btn-sm w-25 h-75 mb-3">Submit</button>
            </div>
        </form> 
    </div>
@endsection
