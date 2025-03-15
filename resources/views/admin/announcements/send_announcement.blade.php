@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ url('plugins/select2.min.css') }}">
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
                <label>Send Email to Member</label>
                <select id="userSelect" name="member_id" style="width: 100%;">
                    <option value="">Select a member</option>
                    @if($members->isEmpty())
                        <option>No members found</option>
                    @else
                        @foreach($members as $member)
                            <option value="{{ $member->id }}">{{ $member->name }} {{ $member->last_name }} - {{ $member->email }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label style="display: block;">Email To</label>
                <label style="margin-right:25px;">
                    <input type="checkbox" value="all" name="email_to_all" style="margin-right: 10px;"> All Church Members
                </label>
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
@include('alerts')
    <script>
        $(document).ready(function() {
            $('#userSelect').select2(); 
            $('#summernote').summernote({
                height: 200, 
            });
        });
    </script>
@endsection