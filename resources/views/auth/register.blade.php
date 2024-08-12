<!DOCTYPE html>
<html lang="en">

<head>
    <title>RSBFM &mdash; Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" href="{{ asset('favicon.png') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login-template/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login-template/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login-template/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login-template/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login-template/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login-template/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login-template/css/util.css">
    <link rel="stylesheet" type="text/css" href="login-template/css/main.css">
    <!--===============================================================================================-->
</head>

<body>
    <div class="limiter">
        <div class="container-login100" style="background-image: url('login-template/images/img-01.jpg');">
            <div class="wrap-login100 p-t-40 p-b-10">
                <form method="POST" action="{{ route('register') }}" class="login100-form validate-form">
                    @csrf
                    <div class="login100-form-avatar">
                        <img src="logo.png" alt="AVATAR">
                    </div>
                    <span class="login100-form-title p-t-20 p-b-45">
                        @error('email')
                            <strong>{{ $message }}</strong>
                        @enderror
                        @error('password')
                            <strong>{{ $message }}</strong>
                        @enderror
                    </span>

                    <div class="wrap-input100 validate-input m-b-10">
                        <input class="input100" type="text" name="name" placeholder="Nama">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-10">
                        <input class="input100" type="email" name="email" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-10">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-10">
                        <input class="input100" type="password" name="password_confirmation"
                            placeholder="Password Confirmation">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn p-t-10">
                        <button type="submit" class="login100-form-btn">
                            Login
                        </button>
                    </div>

                    <div class="text-center w-full p-t-25 p-b-50">
                    </div>

                    <div class="text-center w-full">
                        <a class="txt1" href="{{ route('login') }}">
                            Login
                            <i class="fa fa-long-arrow-right"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--===============================================================================================-->
    <script src="login-template/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="login-template/vendor/bootstrap/js/popper.js"></script>
    <script src="login-template/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="login-template/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="login-template/js/main.js"></script>

</body>

</html>
