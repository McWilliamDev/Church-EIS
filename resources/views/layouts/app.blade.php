<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ !empty($header_title) ? $header_title : '' }} - NGGC</title>
    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('bootstrap-5.3.3-dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ url('summernote-0.9.0-dist/summernote-bs5.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@yield('style')

</head>

<body>
    <div class="wrapper">
        <!--SIDEBAR START HERE-->
        @include('layouts.sidebar')
        <!--SIDEBAR END HERE-->

        <!--TOP BAR START HERE-->
        <div class="main">
            @include('layouts.navbar')
            <!--TOP BAR END HERE-->

            <!--MAIN CONTENT HERE-->
            <main class="content px-3 py-4">
                @yield('content')
                <!--MAIN CONTENT END HERE-->
            </main>

            <!--Footer HERE-->
            @include('layouts.footer')
            <!--Footer end HERE-->
        </div>
    </div>

    <script src="{{ url('bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('plugins/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ url('summernote-0.9.0-dist/summernote-bs5.min.js') }}"></script>
    <script src="{{ url('plugins/select2.full.min.js') }}"></script>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
@yield('script')

</body>

</html>
