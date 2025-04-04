<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ !empty($header_title) ? $header_title : '' }} - NGGC</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" href="{{ asset('/favicon-32x32.png') }}">
    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/bootstrap.css') }}">
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
            <main class="content px-3 py-3">
                @yield('content')
                <!--MAIN CONTENT END HERE-->
            </main>

            <!--Footer HERE-->
            @include('layouts.footer')
            <!--Footer end HERE-->
        </div>
    </div>
    <script>
        let inactivityTime = function () {
            let timeout;
            let countdownTimer;
    
            const resetTimer = () => {
                clearTimeout(timeout);
                clearInterval(countdownTimer);
                timeout = setTimeout(() => {
                    let countdown = 60; // 60 seconds countdown
                    Swal.fire({
                        title: 'Inactivity Alert',
                        text: "You have been inactive. You will be logged out in " + countdown + " seconds.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Stay Logged In',
                        cancelButtonText: 'Log Me Out',
                        timer: 60000, // 30 seconds
                        timerProgressBar: true,
                        onBeforeOpen: () => {
                            Swal.showLoading();
                            countdownTimer = setInterval(() => {
                                countdown--;
                                Swal.getContent().querySelector('strong').textContent = countdown;
                                if (countdown <= 0) {
                                    clearInterval(countdownTimer);
                                    window.location.href = '/logout'; 
                                }
                            }, 1000);
                        }
                    }).then((result) => {
                        clearInterval(countdownTimer);
                        if (result.isConfirmed) {
                            // User is still there, reset the timer
                            resetTimer();
                        } else {
                            // User chose to log out
                            window.location.href = '/logout'; 
                        }
                    });
                }, 300000); // 5 minutes
            };
    
            // Events to reset the timer
            window.onload = resetTimer;
            document.onmousemove = resetTimer;
            document.onkeypress = resetTimer;
        };
    
        inactivityTime();
    </script>
    <!-- jQuery (must be loaded first) -->
    <script src="{{ url('plugins/jquery-3.7.1.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ url('js/bootstrap.bundle.min.js') }}"></script>

    <!-- Select2 (must be loaded after jQuery and Bootstrap) -->
    <script src="{{ url('plugins/select2.full.min.js') }}"></script>

    <!-- Other plugins -->
    <script src="{{ url('summernote-0.9.0-dist/summernote-bs5.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    let inactivityTime = function () {
        let timeout;
        let countdownTimer;

        const resetTimer = () => {
            clearTimeout(timeout);
            clearInterval(countdownTimer);
            timeout = setTimeout(() => {
                let countdown = 60; // 60 seconds countdown
                Swal.fire({
                    title: 'Inactivity Alert',
                    text: "You have been inactive. You will be logged out in " + countdown + " seconds.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Stay Logged In',
                    cancelButtonText: 'Log Me Out',
                    timer: 60000, // 30 seconds
                    timerProgressBar: true,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                        countdownTimer = setInterval(() => {
                            countdown--;
                            Swal.getContent().querySelector('strong').textContent = countdown;
                            if (countdown <= 0) {
                                clearInterval(countdownTimer);
                                window.location.href = '/logout'; 
                            }
                        }, 1000);
                    }
                }).then((result) => {
                    clearInterval(countdownTimer);
                    if (result.isConfirmed) {
                        // User is still there, reset the timer
                        resetTimer();
                    } else {
                        // User chose to log out
                        window.location.href = '/logout'; 
                    }
                });
            }, 300000); // 5 minutes
        };

        // Events to reset the timer
        window.onload = resetTimer;
        document.onmousemove = resetTimer;
        document.onkeypress = resetTimer;
    };

    inactivityTime();
</script>
@yield('script')
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.8/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stack('scripts')

@include('sweetalert::alert')
</body>

</html>
