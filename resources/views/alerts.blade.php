<script>
    $(document).ready(function() {
        // Check for error message in session
        @if(session('error'))
            Swal.fire({
                title: "Error!",
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonText: "OK"
            });
        @endif

        // Check for success message in session
        @if(session('success'))
            Swal.fire({
                title: "Success!",text: "{{ session('success') }}",
                icon: "success",
                confirmButtonText: "OK"
            });
        @endif
});
</script>