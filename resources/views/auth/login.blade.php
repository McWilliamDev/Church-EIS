<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NGGC - Login</title>
    <link rel="stylesheet" href="{{ url('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('css/auth.css') }}">
</head>

<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <!--Left Side-->
            <div class="row flex-grow-1">
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
            <div class="col-md-6 right-side d-flex justify-content-center align-items-center bg-light">
                <form class="login-form" action="{{ url('login') }}" method="post">
                    @csrf
                    <!--Logo-->
                    <a href="#" class="d-flex justify-content-center mb-3">
                        <img src="{{ asset('images/primarylogo.jpg') }}" alt="logo" width="60">
                    </a>
                    <!--Logo End-->

                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Admin Login</h3>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class='fa-solid fa-user'></i>
                        </span>
                        <input type="email" class="form-control form-control-lg fs-6" required name="email"
                            placeholder="Email">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class='fa-solid fa-key'></i>
                        </span>
                        <input type="password" class="form-control form-control-lg fs-6" required name="password"
                            placeholder="Password">
                    </div>

                    <div class="input-group mb-3 d-flex justify-content-between">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe">
                            <label class="form-check-label text-secondary" for="rememberMe"><small>Remember
                                    me</small></label>
                        </div>
                        <div>
                            <small><a href="{{ url('forgot-password') }}" class="text-success">Forgot
                                    Password?</a></small>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-lg w-100 mb-3">Login</button>
                </form>
            </div>
            <!--Right Side End-->

        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('sweetalert::alert')
    @include('alerts')

    <script>
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
    </script>
</body>
</html>