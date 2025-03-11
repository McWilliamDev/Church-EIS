@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Edit Church Member</h3>
        </div>

        <form class="row g-3" method="POST" action="" enctype="multipart/form-data">
            @csrf
            <div class="col-6">
                <label class="form-label">First Name<span style="color: red;">*</span></label>
                <input type="text" class="form-control" value="{{ old('name', $getRecord->name) }}" name="name"
                    required placeholder="First Name">
                <div style="color: red">{{ $errors->first('name') }}</div>
            </div>


            <div class="col-6">
                <label class="form-label">Last Name<span style="color: red;">*</span></label>
                <input type="text" class="form-control" value="{{ old('last_name', $getRecord->last_name) }}"
                    name="last_name" required placeholder="Last Name">
                <div style="color: red">{{ $errors->first('last_name') }}</div>
            </div>


            <div class="col-6">
                <label class="form-label">Email<span style="color: red;">*</span></label>
                <input type="text" class="form-control" value="{{ old('email', $getRecord->email) }}" name="email"
                    required placeholder="Email">
                <div style="color: red">{{ $errors->first('email') }}</div>
            </div>


            <div class="col-6">
                <label class="form-label">Phone Number<span style="color: red;">*</span></label>
                <input type="tel" class="form-control" value="{{ old('phonenumber', $getRecord->phonenumber) }}"
                    name="phonenumber" required placeholder="09XX-XXXX-XXX">
                <div style="color: red">{{ $errors->first('phonenumber') }}</div>
            </div>


            <div class="col-6">
                <label class="form-label">Gender<span style="color: red;">*</span></label>
                <select class="form-select" required name="gender">
                    <option value="">Select Gender</option>
                    <option {{ old('gender', $getRecord->gender) == 'Male' ? 'selected' : '' }} value="Male">Male</option>
                    <option {{ old('gender', $getRecord->gender) == 'Female' ? 'selected' : '' }} value="Female">Female
                    </option>
                    <option {{ old('gender', $getRecord->gender) == 'Other' ? 'selected' : '' }} value="Others">Others
                    </option>
                </select>
                <div style="color: red">{{ $errors->first('gender') }}</div>
            </div>

            <div class="col-6">
                <label class="form-label">Date of Birth<span style="color: red;">*</span></label>
                <input type="date" class="form-control" value="{{ old('date_of_birth', $getRecord->date_of_birth) }}"
                    name="date_of_birth" required>
                <div style="color: red">{{ $errors->first('date_of_birth') }}</div>
            </div>


            <div class="col-6">
                <label class="form-label">Address<span style="color: red;">*</span></label>
                <input type="address" class="form-control" value="{{ old('address', $getRecord->address) }}" name="address"
                    required placeholder="Address">
                <div style="color: red">{{ $errors->first('address') }}</div>
            </div>


            <div class="col-6">
                <label class="form-label">Status<span style="color: red;">*</span></label>
                <select class="form-select" required name="member_status">
                    <option value="">Select Status</option>
                    <option {{ old('member_status', $getRecord->member_status) == 0 ? 'selected' : '' }} value="0">
                        Active</option>
                    <option {{ old('member_status', $getRecord->member_status) == 1 ? 'selected' : '' }} value="1">
                        Inactive</option>
                </select>
                <div style="color: red">{{ $errors->first('member_status') }}</div>
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
                <button type="submit" class="btn btn-primary btn-sm w-25 h-75 mb-3">Update</button>
            </div>
        </form>
    </div>
@endsection
