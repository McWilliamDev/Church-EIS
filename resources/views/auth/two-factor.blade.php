<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NGGC - Two-Factor Authentication</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ url('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('css/auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
</head>

<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <!--Left Side-->
            <div class="row flex-grow-1">
                <!-- Left Side -->
                <div class="col-md-6 d-none d-md-block p-0">
                    <div class="full-height bg-cover">
                        <div class="d-flex flex-column justify-content-end h-100 p-5 text-white">
                            <i class="fas fa-quote-left fa-2x"></i>
                            <p class="mt-4">That person is like a tree planted by streams of water, which yields its fruit in season and
                                whose leaf does not wither—whatever they do prospers.</p>
                            <p><strong>-Psalms 1:3</strong></p>
                        </div>
                    </div>
                </div>
                <!--Left Side End-->

                <!--Right Side-->
                <div class="col-md-6 d-flex justify-content-center align-items-center bg-light">
                    <form class="login-form" action="{{ route('two-factor.verify') }}" method="post">
                        @csrf
                        <!-- Logo -->
                        <a href="#" class="d-flex justify-content-center mb-3">
                            <img src="{{ asset('images/primarylogo.jpg') }}" alt="logo" width="60">
                        </a>
                        <!-- Logo End -->

                        <div class="text-center mb-4">
                            <h3 class="fw-bold">Two-Factor Authentication</h3>
                            @include('alerts1')
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <i class='fa-solid fa-lock'></i>
                            </span>
                            <input type="text" class="form-control form-control-lg fs-6" required name="code" id="code" placeholder="Enter Authentication Code">
                        </div>

                        <div id="timer" class="text-danger mb-3"></div>

                        <button type="submit" class="btn btn-success btn-lg w-100 mb-3">Submit</button>
                        <button type="button" id="resend-button" class="btn btn-warning btn-lg w-100 mb-3" onclick="resendCode()" disabled>Resend Code</button>
                        @if ($errors->any())
                        <div class="text-danger">
                            @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                            @endforeach
                        </div>
                        @endif
                    </form>
                </div>
                <!--Right Side End-->

            </div>
        </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        localStorage.setItem('twoFactorExpiry', {{ $expiryTimestamp }});
    </script>

    <script>
        let countdown;
        let timeLeft;

        function getRemainingTime() {
            const expiryTime = localStorage.getItem('twoFactorExpiry');
            if (!expiryTime) return 0;

            const now = Math.floor(Date.now() / 1000);
            return Math.max(0, expiryTime - now);
        }

        function startTimer() {
            timeLeft = getRemainingTime();

            if (timeLeft <= 0) {
                document.getElementById("timer").innerHTML = "Code expired!";
                document.getElementById("resend-button").disabled = false;
                return;
            }

            countdown = setInterval(() => {
                if (timeLeft <= 0) {
                    clearInterval(countdown);
                    document.getElementById("timer").innerHTML = "Code expired!";
                    document.getElementById("resend-button").disabled = false;
                } else {
                    const minutes = Math.floor(timeLeft / 60);
                    const seconds = timeLeft % 60;
                    document.getElementById("timer").innerHTML = `Time left: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
                    timeLeft--;
                }
            }, 1000);
        }

        function resendCode() {
            document.getElementById("resend-button").disabled = true; // Disable button while processing
            fetch('/two-factor/resend', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    swal("Success!", "New code sent to your email.", "success");
                    const newExpiry = Math.floor(Date.now() / 1000) + 180; // 3 minutes from now
                    localStorage.setItem('twoFactorExpiry', newExpiry);
                    clearInterval(countdown);
                    startTimer();
                } else {
                    swal("Error!", "Failed to resend code.", "error");
                }
            })
            .finally(() => {
                document.getElementById("resend-button").disabled = false; // Re-enable button after processing
            });
        }

        window.onload = function() {
            startTimer();
        };
    </script>
</body>

</html>