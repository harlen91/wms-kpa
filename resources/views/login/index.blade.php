<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Inventory APP | Login</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendors/themify-icons/css/themify-icons.css') }}" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link href="{{ asset('css/pages/auth-light.css') }}" rel="stylesheet" />

</head>

<body style="background-image: url('{{ asset('img/bg.jpg') }}'); background-position: center; background-size: 100%;">
    <h1 style="text-align: center;"
        class="mt-5 mb-3 text-white shadow-lg bg-body-tertiary;  font-family:'Bookman Old Style', Georgia, serif !important;">
        Selamat Datang di
        Sistem
        Management Warehouse
    </h1>
    <div class="content">
        {{-- <div class="brand">
            <a class="link" href="#">Selamat Datang di Sistem Management Warehouse
            </a>
        </div> --}}
        <form id="login-form" action="{{ route('login.proses') }}" method="post">
            <h2 class="login-title">Log in</h2>
            @csrf
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-id-card"></i></div>
                    <input class="form-control" type="text" name="username" placeholder="Username"
                        value="{{ @old('username') }}">
                    @error('username')
                        <label class="text-danger"> {{ $message }}</label>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="input-group-icon right">
                    <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                    <input class="form-control" type="password" name="password" placeholder="Password"
                        value="{{ @old('password') }}">
                    @error('password')
                        <label class="text-danger"> {{ $message }}</label>
                    @enderror
                </div>
            </div>
            <!-- <div class="form-group d-flex justify-content-between">
                <label class="ui-checkbox ui-checkbox-info">
                    <input type="checkbox">
                    <span class="input-span"></span>Remember me</label>
                <a href="forgot_password.html">Forgot password?</a>
            </div> -->
            <div class="form-group">
                <button class="btn btn-info btn-block" type="submit">Login</button>
            </div>
        </form>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS -->
    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/popper.js/dist/umd/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS -->
    <script src="{{ asset('vendors/jquery-validation/dist/jquery.validate.min.js') }}" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->

</body>

</html>
