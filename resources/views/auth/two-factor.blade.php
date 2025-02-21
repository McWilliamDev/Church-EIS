<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Authentication</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ url('bootstrap-5.3.3-dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('css/auth.css') }}">
</head>

<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <!--Left Side-->
            <div class="col-md-6 left-side text-center d-flex justify-content-center align-items-center ">
                <div>
                    <p>That person is like a tree planted by streams of water, which yields its fruit in season and
                        whose leaf does not wither—whatever they do prospers.</p>
                    <hr />
                    <p><strong>Psalms 1:3</strong></p>
                </div>
            </div>
            <!--Left Side End-->

            <!--Right Side-->
            <div class="col-md-6 right-side d-flex justify-content-center align-items-center">
            <form class="login-form" action="{{ route('two-factor.verify') }}" method="post">
                    @csrf
                    <!--Logo-->
                    <a href="#" class="d-flex justify-content-center mb-3">
                        <img src="images/primarylogo.jpg" alt="logo" width="60">
                    </a>
                    <!--Logo End-->

                    <div class="text-center mb-4">
                        <h3 class="fw-bold">Two-Factor Authentication</h3>
                        @include('alerts')
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">
                            <i class='bx bx-key'></i>
                        </span>
                        <input type="text" class="form-control form-control-lg fs-6" required name="code" id="code" placeholder="Please enter authentication code ">
                    </div>

                    <button type="submit" class="btn btn-success btn-lg w-100 mb-3">Submit</button>
                </form>
                @if ($errors->any())
                <div>
                    @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif
            </div>
            <!--Right Side End-->

        </div>
    </div>
</body>

</html>
