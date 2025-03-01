@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Edit Assigned Ministry</h3>
        </div>
        <div class="shadow-lg p-3 mb-5">
            <div class="form-group">
            <form class="row g-3" method="POST" action="">
                @csrf
                <p class="text-danger mb-1 fs-6">*NOTE: Member Name will be empty, if all Members have assigned with Ministry</p>
                
                <div class="col-4">
                    <label>Member Name</label>
                    <select name="member_id" id="member_id" class="form-control" disabled>
                        @foreach($getMembersEdit as $member)
                            <option value="{{ $member->id }}" {{ $member->id == $getRecord->member_id ? 'selected' : '' }}>
                                {{ $member->name }} {{ $member->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-4">
                    <label>Ministry Name</label>
                    <select class="form-select" name="ministry_id" required>
                        <option value="">Select Ministry</option>
                        @foreach($getMinistries as $ministry)
                        <option value="{{ $ministry->id }}" {{ $ministry->id == $getRecord->ministry_id ? 'selected' : '' }}>
                            {{ $ministry->ministry_name }}
                        </option>
                    @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <div>
                        <input type="radio" id="active" name="ministry_status" value="0" {{ $getRecord->ministry_status == 0 ? 'checked' : '' }} required>
                        <label>Active</label>
                        <input type="radio" id="inactive" name="ministry_status" value="1" {{ $getRecord->ministry_status == 1 ? 'checked' : '' }} required>
                        <label>Inactive</label>
                    </div>
                </div>
            </div>

                <div class="col-4 d-flex justify-content-start">
                    <button type="submit" class="btn btn-primary btn-sm w-25 h-75 mb-3 mt-3">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection