@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @include('alerts')
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">My Profile</h3>
            @if (!empty($getRecord->getProfile()))
            <img src="{{ $getRecord->getProfile() }}" style="height: 100px; width:100px; border-radius:100px;">
            @endif
        </div>

        <form class="row g-3" method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="col-6">
                <label class="form-label">Name<span style="color: red;">*</span></label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $getRecord->name) }}"
                    placeholder="Name">
            </div>

            <div class="col-6">
                <label class="form-label">Email<span style="color: red;">*</span></label>
                <input type="email" class="form-control" name="email" value="{{ old('email', $getRecord->email) }}"
                    required placeholder="Email">
                <div style="color: red">{{ $errors->first('email') }}</div>
            </div>
            
            <div class="col-6">
                <label class="form-label">Phone Number<span style="color: red;">*</span></label>
                <input type="tel" class="form-control" name="phonenumber"
                    value="{{ old('phonenumber', $getRecord->phonenumber) }}" required placeholder="09XX-XXXX-XXX">
            </div>

            <div class="col-6">
                <label class="form-label">Address<span style="color: red;">*</span></label>
                <input type="address" class="form-control" name="address" value="{{ old('address', $getRecord->address) }}"
                    required placeholder="Address">
            </div>

            <div class="col-6">
                <label class="form-label">Profile Picture</label>
                <input type="file" class="form-control" name="profile_pic">
                <div style="color: red">{{ $errors->first('profile_pic') }}</div>
                
            </div>


            <div class="d-flex justify-content-evenly">
                <button type="submit" class="btn btn-primary btn-sm w-25 h-75 mb-3">Update</button>
            </div>
        </form>
    </div>
@endsection
