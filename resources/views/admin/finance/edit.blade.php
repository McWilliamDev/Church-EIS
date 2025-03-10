@extends('layouts.app')
@section('content')


<div class="container-form m-auto">
    <h3 class="fw-bold fs-4 my-3">Update Report</h3>
    <form id="modalForm" method="POST" action="{{ route('finance.update', $report->id) }}">
        @csrf
        @method('PUT') <!-- Tells Laravel to treat this as a PUT request -->
    
        <div class="mb-3">
            <label for="member" class="form-label">Member Name</label>
            <select id="userSelect" style="width: 100%;" disabled>
                @foreach($members as $member)
                    <option value="{{ $member->id }}" {{ $member->id == $report->member_id ? 'selected' : '' }}>
                        {{ $member->name }} {{ $member->last_name }}
                    </option>
                @endforeach
            </select>
            
            <!-- Hidden input to submit the selected member_id -->
            <input type="hidden" name="member" value="{{ $report->member_id }}">
        </div>
    
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <input type="text" class="form-control" id="type" name="type" 
                value="{{ $report->type }}" placeholder="Ex: Expenses, Donation etc." required>
        </div>
    
        <div class="mb-3">
            <label for="amount" class="form-label">Price</label>
            <input type="number" class="form-control" id="amount" name="amount" 
                min="1" value="{{ $report->amount }}" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" 
                value="{{ $report->date }}" required>
        </div>
    
        <div class="mb-3">
            <label for="purpose" class="form-label">Purpose or Description</label>
            <textarea class="form-control" id="purpose" name="purpose" maxlength="150" rows="3" 
                    placeholder="Maximum 150 Characters" required>{{ $report->purpose }}</textarea>
        </div>
    
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-secondary" onclick="redirectToReports()">Cancel</button>
            <button type="submit" class="btn btn-primary ms-3">Update</button>
        </div>
    </form>
    
</div>







@endsection

@push('scripts')
<script>
    $('#userSelect').select2({
        placeholder: "Select a user",
    })

    function redirectToReports() {
        window.location.href = "{{ route('finance.list', ['tab' => 'reports']) }}";
    }

</script>
@endpush