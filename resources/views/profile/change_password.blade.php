@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Change Password</h3>
        </div>

        <form class="row g-3" method="POST" action="">
            @csrf
            <div class="col-12">
                <label class="form-label">Old Password</label>
                <input type="password" class="form-control" name="old_password" required placeholder="Old Password">
            </div>

            <div class="col-12">
                <label class="form-label">New Password</label>
                <input type="password" class="form-control" name="new_password" required placeholder="New Password">
                <div style="color: red">{{ $errors->first('new_password') }} Password must be at least 8 characters long, include at least one uppercase letter, one lowercase letter, one number, and one special character.</div>
            </div>

            <div class="d-flex justify-content-start">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
@section('script')
@include('alerts')
@endsection
