<!DOCTYPE html>
<html lang="en" data-layout="fluid" data-sidebar-theme="dark" data-sidebar-position="left" data-sidebar-behavior="sticky">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="{{ url('css/bootstrap.css') }}">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        .full-height {
            height: 100vh;
        }
        .bg-cover {
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>
    <div class="container-fluid full-height d-flex flex-column">
        <div class="row flex-grow-1">
            <!-- Left Side -->
            <div class="col-md-6 d-none d-md-block p-0">
                <div class="full-height bg-cover" style="background-image: url('https://storage.googleapis.com/a1aa/image/S39QHqrwNFcveg4cLi8RStsg6Pz7e43092-1_7-joy4.jpg');">
                    <div class="d-flex flex-column justify-content-end h-100 p-5 text-white">
                        <i class="fas fa-quote-left fa-2x"></i>
                        <p class="mt-4">That person is like a tree planted by streams of water, which yields its fruit in season and
                            whose leaf does not wither—whatever they do prospers.</p>
                            <p><strong>-Psalms 1:3</strong></p>
                    </div>
                </div>
            </div>

            <!-- Right Side -->
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="w-75 text-center">
                    <h2 class="mb-4">Reset Password</h2>
                    <p class="mb-4">Enter your email to reset your password.</p>

                    <form class="login-form" action="" method="post">
                        @csrf
                        <div class="mb-3 text-start">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control form-control-lg" type="email" name="email" placeholder="Enter your email">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                    </form>
                    <p class="mt-4 text-center">Don't have an account? <a href="#" class="text-primary">Sign up</a></p>
                    <p class="text-center text-muted mt-4">© 2024 - <a href="#" class="text-primary">AppStack</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap 5 JS -->
</body>
</html>

