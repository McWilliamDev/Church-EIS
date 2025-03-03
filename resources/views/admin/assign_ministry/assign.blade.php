@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Assign Ministry to Member</h3>
        </div>
        <div class="shadow-lg p-3 mb-5">
            <div class="form-group">
            <form class="row g-3" method="POST" action="">
                @csrf
                <p class="text-danger mb-1 fs-6">*NOTE: Member Name will be empty, if all Members have assigned with Ministry</p>
                
                <div class="col-4">
                    <label>Member Name</label>
                    <select class="form-select" name="member_id" required>
                        <option value="">Select Name</option>
                        @foreach($getMembers as $member)
                        <option value="{{$member->id}}">{{$member->name}} {{$member->last_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-4">
                    <label>Ministry Name</label>
                    <select class="form-select" name="ministry_id" required>
                        <option value="">Select Ministry</option>
                        @foreach($getMinistries as $ministry)
                        <option value="{{$ministry->id}}">{{$ministry->ministry_name}}</option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" name="ministry_status" value="0">
    </div>
    
                <div class="col-4 d-flex justify-content-start">
                    <button type="submit" class="btn btn-primary btn-sm w-25 h-75 mb-3 mt-3">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection