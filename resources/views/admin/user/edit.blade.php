@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Edit Board Member</h3>
        </div>

        <form class="row g-3" method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="col-6">
                <label class="form-label">Full Name<span style="color: red;">*</span></label>
                <input type="text" class="form-control" value="{{ old('name',$getRecord->name) }}" name="name" required
                    placeholder="Full Name">
                <div style="color: red">{{ $errors->first('name') }}</div>
            </div>
            

            <div class="col-6">
                <label class="form-label">Email<span style="color: red;">*</span></label>
                <input type="email" class="form-control" value="{{ old('email', $getRecord->email) }}" name="email" required
                    placeholder="Email">
                <div style="color: red">{{ $errors->first('email') }}</div>
            </div>

            <div class="col-6">
                <label class="form-label">Position</label>
                <select class="form-select" value="{{ old('position', $getRecord->position) }}" required name="position">
                    <option value="">Select Position</option>
                    <option {{ (old('position', $getRecord->position)=='Assigned Administrator')? 'selected' : '' }} value="Assigned Administrator">Assigned Administrator</option>
                    <option {{ (old('position', $getRecord->position)=='Board Member')? 'selected' : '' }} value="Board Member">Board Member</option>
                </select>
                <div style="color: red">{{ $errors->first('position') }}</div>
            </div>

            <div class="col-6">
                <label class="form-label">Phone Number<span style="color: red;">*</span></label>
                <input type="tel" class="form-control" value="{{ old('phonenumber', $getRecord->phonenumber) }}" name="phonenumber" required
                    placeholder="09XX-XXXX-XXX">
                <div style="color: red">{{ $errors->first('phonenumber') }}</div>
            </div>

            <div class="col-6">
                <label class="form-label">Address<span style="color: red;">*</span></label>
                <input type="address" class="form-control" value="{{ old('address',$getRecord->address ) }}" name="address" required
                    placeholder="Address">
                    <div style="color: red">{{ $errors->first('address') }}</div>
            </div>

            <div class="col-6">
                <label class="form-label">Profile Picture</label>
                <input type="file" class="form-control" name="profile_pic">
                <div style="color: red">{{ $errors->first('profile_pic') }}</div>
                @if (!empty($getRecord->getProfile()))
                    <img src="{{ $getRecord->getProfile() }}" style="width: auto; height:50px;">
                @endif
            </div>

            <div class="d-flex justify-content-evenly">
                <button type="submit" class="btn btn-primary btn-sm w-25 h-75 mb-3">Save Changes</button>
            </div>
        </form>
    </div>
@endsection
