@extends('layouts.app')

@section('content')
    <!-- Profile 1 - Bootstrap Brain Component -->
    <div class="card widget-card border-light shadow-lg">
        <div class="card-body p-4">
            <ul class="nav nav-tabs" id="profileTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview-tab-pane" type="button" role="tab" aria-controls="overview-tab-pane" aria-selected="true">Overview</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Profile</button>
                </li>
            </ul>

            <div class="tab-content pt-4" id="profileTabContent">
                <div class="tab-pane fade show active" id="overview-tab-pane" role="tabpanel" aria-labelledby="overview-tab" tabindex="0">
                    <h4 class="mb-3 fw-bold">Profile</h4>
                    <div class="row g-0">
                        <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                            <div class="p-2">Name</div>
                        </div>

                        <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                            <div class="p-2">{{ $getRecord->name }}</div>
                        </div>

                        <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                            <div class="p-2">Position</div>
                        </div>

                        <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                            <div class="p-2">{{ $getRecord->position }}</div>
                        </div>

                        <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                            <div class="p-2">Email</div>
                        </div>

                        <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                            <div class="p-2">{{ $getRecord->email }}</div>
                        </div>

                        <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                            <div class="p-2">Address</div>
                        </div>

                        <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                            <div class="p-2">{{ $getRecord->address }}</div>
                        </div>

                        <div class="col-5 col-md-3 bg-light border-bottom border-white border-3">
                            <div class="p-2">Phone Number</div>
                        </div>

                        <div class="col-7 col-md-9 bg-light border-start border-bottom border-white border-3">
                            <div class="p-2">{{ $getRecord->phonenumber }}</div>
                        </div>

                    </div>
                </div>

                <!--Profile Tab-->
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                    <form class="row gy-3 gy-xxl-4" action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <div class="row gy-2">
                                <label class="col-12 form-label m-0 fw-bold">Profile Image</label>
                                <div class="col-12">
                                    @if (!empty($getRecord->profile_pic))
                                        <img src="{{ Auth::user()->profile_pic ? asset('upload/profile/' . Auth::user()->profile_pic) : asset('images/account.png') }}" class="img-fluid" style="height: 75px; width:75px;">
                                    @endif
                                </div>

                                <div class="col-12">
                                    <input type="file" id="profileImageInput" style="display: none;" accept="image/*" onchange="uploadImage(event)">
                                    <a href="#!" class="d-inline-block bg-primary link-light lh-1 p-2 rounded" onclick="document.getElementById('profileImageInput').click();">
                                        <i class="fa-solid fa-upload"></i>
                                    </a>
                                
                                    <a href="#!" class="d-inline-block bg-danger link-light lh-1 p-2 rounded" onclick="deleteImage();">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>

                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label">Name<span style="color: red;">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $getRecord->name) }}"
                                placeholder="Name">
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label">Email<span style="color: red;">*</span></label>
                            <input type="email" class="form-control" name="email" value="{{ old('email', $getRecord->email) }}" required placeholder="Email">
                            <div style="color: red">{{ $errors->first('email') }}</div>
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label">Phone Number<span style="color: red;">*</span></label>
                            <input type="tel" class="form-control" name="phonenumber" value="{{ old('phonenumber', $getRecord->phonenumber) }}" required placeholder="09XX-XXXX-XXX">
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label">Address<span style="color: red;">*</span></label>
                            <input type="address" class="form-control" name="address" value="{{ old('address', $getRecord->address) }}" required placeholder="Address">
                        </div>
                        
                        <div class="col-12 d-flex justify-content-evenly">
                            <button type="submit" class="btn btn-primary btn-sm w-25 h-75 mb-3">Save Changes</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
@endsection
@section('script')
@include('alerts')
<script>
    function uploadImage(event) {
        const file = event.target.files[0];
        if (!file) {
            return;
        }

        const formData = new FormData();
        formData.append('profile_pic', file);

        // Use SweetAlert for a loading message
        Swal.fire({
            title: 'Uploading...',
            text: 'Please wait while the image is being uploaded.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        fetch('{{ route("upload-image") }}', { 
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}' 
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Handle success with SweetAlert
                Swal.fire({
                    title: 'Uploaded!',
                    text: 'Profile Picture successfully updated.',
                    icon: 'success'
                }).then(() => {
                    location.reload(); // Reload to see the changes
                });
            } else {
                // Handle error with SweetAlert
                Swal.fire({
                    title: 'Error!',
                    text: data.message || 'Error uploading the image.',
                    icon: 'error'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error!',
                text: 'An error occurred while uploading the image.',
                icon: 'error'
            });
        });
    }

    function deleteImage() {
        // Use SweetAlert confirmation dialog
        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to delete this profile picture.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with the deletion request
                Swal.fire({
                    title: 'Deleting...',
                    text: 'Please wait while the image is being deleted.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                fetch('{{ route("delete-image") }}', { 
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' 
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Handle success with SweetAlert
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'Image deleted successfully.',
                            icon: 'success'
                        }).then(() => {
                            location.reload(); // Reload to see the changes
                        });
                    } else {
                        // Handle error with SweetAlert
                        Swal.fire({
                            title: 'Error!',
                            text: data.message || 'Error deleting the image.',
                            icon: 'error'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while deleting the image.',
                        icon: 'error'
                    });
                });
            }
        });
    }
</script>
@endsection