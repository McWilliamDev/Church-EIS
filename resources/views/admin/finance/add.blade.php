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
            <input type="text" class="form-control" id="type" name="type" placeholder="Ex: Expenses, Donation etc."required>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Price</label>
            <input type="number" class="form-control" id="amount" name="amount" min="1" value="1" required>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>

        <div class="mb-3">
            <label for="purpose" class="form-label">Purpose or Description</label>
            <textarea class="form-control" id="purpose" name="purpose" maxlength="150" rows="3" placeholder="Maximum 150 Characters"></textarea>
        </div>
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-secondary"  onclick="redirectToReports()">Cancel</button>
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