@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Add Church Administrators</h3>
        </div>

        <form class="row g-3" method="POST" action="">
            @csrf
            <div class="col-6">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" value="{{ old('name') }}" name="name" required
                    placeholder="Full Name">
            </div>
            <div class="col-6">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" value="{{ old('email') }}" name="email" required
                    placeholder="Email">
                <div style="color: red">{{ $errors->first('email') }}</div>
            </div>
            <div class="col-6">
                <label class="form-label">Position</label>
                <select class="form-select" name="position" value="{{ old('position') }}" required placeholder="Position"
                    id="specificSizeSelect">
                    <option value="Senior Pastor">Senior Pastor</option>
                    <option value="Lead Pastor">Lead Pastor</option>
                    <option value="Assigned Administrator">Assigned Administrator</option>
                </select>
            </div>
            <div class="col-6">
                <label class="form-label">Phone Number</label>
                <input type="tel" class="form-control" value="{{ old('phonenumber') }}" name="phonenumber" required
                    placeholder="09XX-XXXX-XXX">
            </div>
            <div class="col-6">
                <label class="form-label">Address</label>
                <input type="address" class="form-control" value="{{ old('address') }}" name="address" required
                    placeholder="Address">
            </div>
            <div class="col-6">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required placeholder="Password">
            </div>

            <div class="d-flex justify-content-evenly">
                <button type="submit" class="btn btn-primary btn-sm w-25 h-75 mb-3">Submit</button>
                <button type="reset" class="btn btn-danger btn-sm w-25 h-75 mb-3">Clear</button>
            </div>
        </form>
    </div>
@endsection
