@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="fw-bold fs-4 my-3">Archived Members (Total: {{ $getRecord->total() }})</h3>
        </div>
        
        <div class="card shadow-lg mb-4">
            <div class="py-2">
                <h6 class="my-0 fs-5 fw-bold">List of Archived Members</h6>
            </div>
                <div class="table-responsive shadow-sm">
                    <table class="table table-striped" id="memberTable" width="100%" cellspacing="0">
                        <thead class="mt-5">
                            <tr class="highlight">
                                <th >Name</th>
                                <th >Email</th>
                                <th >Phone No. </th>
                                <th >Gender</th>
                                <th >Date of Birth</th>
                                <th >Address</th>
                                <th >Date Deleted</th>
                                <th >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($getRecord as $value)
                                <tr>
                                    <td>{{ $value->name }} {{ $value->last_name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->phonenumber }}</td>
                                    <td>{{ $value->gender }}</td>
                                    <td>
                                        @if (!empty($value->date_of_birth))
                                            {{ date('d-m-Y', strtotime($value->date_of_birth)) }}
                                        @endif
                                    </td>
                                    <td>{{ $value->address }}</td>
                                    <td>{{ date('d-m-Y H:i A', strtotime($value->updated_at)) }}</td>
                                    <td style="min-width: 200px;">
                                        <a href="{{ url('admin/archived/restore/member', $value->id) }}"
                                            class="btn btn-primary btn-sm">Restore</a>
                                        <a href="{{ url('admin/archived/delete/member', $value->id) }}"
                                            class="btn btn-danger btn-sm"
                                            onclick="confirmDelete(event, {{ $value->id }}, '{{ $value->name }}')">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
@endsection

@section('script')
@include('alerts')
<script>
    $(document).ready(function() {
            $('#memberTable').DataTable();
        });
        function confirmDelete(event, id, name) {
    event.preventDefault(); // Stop default action

    // SweetAlert confirmation dialog
    Swal.fire({
        title: 'Are you sure?',
        text: `You are about to delete this Church Member: ${name} from the archived. This action cannot be undone!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
                window.location.href = `/admin/archived/delete/${id}`;
        }
    });
}
</script>
@endsection