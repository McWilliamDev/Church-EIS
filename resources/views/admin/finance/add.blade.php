@extends('layouts.app')
@section('style')
<style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>

@endsection
@section('content')


<div class="container-form m-auto">
    <h3 class="fw-bold fs-4 my-3">Add New Report</h3>
    <form id="modalForm" method="POST" action="{{ route('finance.addFinance') }}">
        @csrf 
        <div class="mb-3">
            <label for="member" class="form-label">Member Name</label>
            <select id="userSelect" name="member" style="width: 100%;">
                @if($members->isEmpty())
                <option>No members found</option>
                @else
                    @foreach($members as $member)
                        <option value="{{ $member->id }}">{{ $member->name }} {{ $member->last_name }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-select" required name="type">
                <option value="">Select Type</option>
                <option {{ old('type') == 'Donation' ? 'selected' : '' }} value="Donation">Donation</option>
                <option {{ old('type') == 'First Fruits' ? 'selected' : '' }} value="First Fruits">First Fruits</option>
                <option {{ old('type') == 'Love Gifts' ? 'selected' : '' }} value="Love Gifts">Love Gifts</option>
                <option {{ old('type') == 'Offering' ? 'selected' : '' }} value="Offering">Offerings</option>
                <option {{ old('type') == 'Pledge' ? 'selected' : '' }} value="Pledge">Pledge</option>
                <option {{ old('type') == 'Sacrifice' ? 'selected' : '' }} value="Sacrifice">Sacrifice</option>
                <option {{ old('type') == 'Sacrificial Giving' ? 'selected' : '' }} value="Sacrificial Giving">Sacrificial Giving</option>
                <option {{ old('type') == 'Seed' ? 'selected' : '' }} value="Seed">Seed</option>
                <option {{ old('type') == 'Tithes' ? 'selected' : '' }} value="Tithes">Tithes</option>
            </select>
            <div style="color: red">{{ $errors->first('position') }}</div>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter Amount" required>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" max="{{ date('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label for="purpose" class="form-label">Purpose or Description</label>
            <textarea class="form-control" id="purpose" name="purpose" maxlength="150" rows="3" placeholder="Maximum 150 Characters"></textarea>
        </div>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-secondary" onclick="redirectToReports()">Cancel</button>
            <button type="submit" class="btn btn-primary ms-3">Save</button>
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