<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NGGC - Reset Password</title>
    <link rel="stylesheet" href="{{ url('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('css/auth.css') }}">
    <style>
        .text-success {
            color: green;
        }

        .text-danger {
            color: red;
        }

        .input-group-text {
            cursor: pointer;
        }
    </style>
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
                <form class="login-form" action="" method="post"> <!-- Specify the action -->
                    @csrf
                    <!--Logo-->
                    <a href="#" class="d-flex justify-content-center mb-3">
                        <img src="{{ asset('images/primarylogo.jpg') }}" alt="logo" width="60">
                    </a>
                    <!--Logo End-->

                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Reset Password</h3>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control form-control-lg fs-6" required name="password"
                            placeholder="New Password" id="password">
                        <span class="input-group-text" id="togglePassword" onclick="togglePasswordVisibility('password')">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </span>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control form-control-lg fs-6" required name="confirmpassword"
                            placeholder="Confirm Password" id="confirmpassword">
                        <span class="input-group-text" id="toggleConfirmPassword" onclick="togglePasswordVisibility('confirmpassword')">
                            <i class="fas fa-eye" id="confirmEyeIcon"></i>
                        </span>
                    </div>

                    <p class="text-danger">Password must be at least 8 characters long, include uppercase, lowercase, number, and special character.</p>

                    <ul id="password-requirements">
                        <li id="length" class="text-danger">At least 8 characters long</li>
                        <li id="uppercase" class="text-danger">At least one uppercase letter</li>
                        <li id="lowercase" class="text-danger">At least one lowercase letter</li>
                        <li id="number" class="text-danger">At least one number</li>
                        <li id="special" class="text-danger">At least one special character</li>
                    </ul>

                    <button type="submit" class="btn btn-success btn-lg w-100 mb-3">Reset</button>
                </form>
            </div>
            <!--Right Side End-->

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('sweetalert::alert')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirmpassword');
            const requirements = {
                length: document.getElementById('length'),
                uppercase: document.getElementById('uppercase'),
                lowercase: document.getElementById('lowercase'),
                number: document.getElementById('number'),
                special: document.getElementById('special')
            };

            function checkPasswordRequirements(password) {
                // Check length
                if (password.length >= 8) {
                    requirements.length.classList.remove('text-danger');
                    requirements.length.classList.add('text-success');
                } else {
                    requirements.length.classList.remove('text-success');
                    requirements.length.classList.add('text-danger');
                }

                // Check for uppercase letter
                if (/[A-Z]/.test(password)) {
                    requirements.uppercase.classList.remove('text-danger');
                    requirements.uppercase.classList.add('text-success');
                } else {
                    requirements.uppercase.classList.remove('text-success');
                    requirements.uppercase.classList.add('text-danger');
                }

                // Check for lowercase letter
                if (/[a-z]/.test(password)) {
                    requirements.lowercase.classList.remove('text-danger');
                    requirements.lowercase.classList.add('text-success');
                } else {
                    requirements.lowercase.classList.remove('text-success');
                    requirements.lowercase.classList.add('text-danger');
                }

                // Check for number
                if (/[0-9]/.test(password)) {
                    requirements.number.classList.remove('text-danger');
                    requirements.number.classList.add('text-success');
                } else {
                    requirements.number.classList.remove('text-success');
                    requirements.number.classList.add('text-danger');
                }

                // Check for special character
                if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
                    requirements.special.classList.remove('text-danger');
                    requirements.special.classList.add('text-success');
                } else {
                    requirements.special.classList.remove('text-success');
                    requirements.special.classList.add('text-danger');
                }
            }

            passwordInput.addEventListener('input', function () {
                checkPasswordRequirements(passwordInput.value);
            });

            confirmPasswordInput.addEventListener('input', function () {
                checkPasswordRequirements(confirmPasswordInput.value); // Check confirm password as well
            });

            // SweetAlert for error notifications
            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ $errors ->first() }}',
                });
            @endif
            
            @if(session('error'))
            Swal.fire({
                title: "Error!",
                text: "{{ session('error') }}",
                icon: "error",
                confirmButtonText: "OK"
            });
        @endif
        });

        function togglePasswordVisibility(inputId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = inputId === 'password' ? document.getElementById('eyeIcon') : document.getElementById('confirmEyeIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>