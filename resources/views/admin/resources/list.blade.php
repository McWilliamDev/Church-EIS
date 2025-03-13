@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Church Resources</h3>
        </div>

        <div class="col-sm-6 button-list" style="text-align: right">
            <a href="{{ url('admin/church_resources/add') }}" class="btn my-2">Add Church Resources</a>
        </div>

        <div class="card shadow-lg mb-4">
            <div class="py-2">
                <h6 class="my-2 fs-5 fw-bold">List of Spiritual Growth Materials</h6>
            </div>

            <div class="row">
                @foreach($getRecord as $resource)
                    <div class="col-lg-3 col-xl-2">
                        <div class="file-man-box">
                            <a href="javascript:void(0);" class="file-close" onclick="confirmDelete(event, '{{ $resource->id }}', '{{ $resource->file_name }}')"><i class="fa fa-times-circle"></i></a>
                            <div class="file-img-box">
                                <img src="{{ $resource->getImage() ?: asset('images/default.png') }}" alt="icon">
                            </div>
                            <a href="{{ $resource->getDocument() }}" class="file-download" download><i class="fa fa-download"></i></a>
                            <a href="{{ url('admin/church_resources/edit', $resource->id) }}" class="file-edit"><i class="fa fa-edit"></i></a> <!-- Edit Icon -->
                            <div class="file-man-title">
                                <h5 class="mb-0 text-overflow fw-bold">{{ $resource->file_name }}</h5>
                                <p class="mb-0"><small>
                                    @php
                                        $documentSize = $resource->getDocumentSize();
                                    @endphp
                                    Document Size: {{ $documentSize > 0 ? round($documentSize / 1024, 2) . ' KB' : 'N/A' }}
                                </small></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('script')
@include('alerts')
<script>
    function confirmDelete(event, id, file_name) {
        event.preventDefault(); 

        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to delete this File: ${file_name}. This action cannot be undone!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `/admin/church_resources/delete/${id}`;
            }
        });
    }
</script>
@endsection