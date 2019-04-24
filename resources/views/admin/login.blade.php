<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    {{--<link href="{{ asset('assets/fonts/bootstrap/css/bootstrap.min.css') }}fonts.googleapis.com/cssbc32.css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet"
          type="text/css" />--}}
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{asset('assets/fonts/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/iconic/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/extra_pages.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/img/favicon.ico') }}">
</head>
<body>

<div id="preloader">
    <div class="loader"></div>
</div>
<div class="login-area">
    <div class="container">
        <div class="limiter">
            <div class="container-login100 page-background">
                <div class="wrap-login100">
                    <form class="login100-form validate-form" method="post" action='{{route('admin.login.submit')}}' aria-label="{{ __('Login') }}">
                        {{ csrf_field() }}

                        <span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>
                        <div class="wrap-input100 validate-input" data-validate="Enter Email" {{ $errors->has('email') ? ' has-error' : '' }}>
                            <input class="input100" type="email" id="email_inp" autocomplete="off" name="email" placeholder="Email" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="focus-input100" data-placeholder="&#xf207;">{{ $errors->first('email') }}</span>
                            @endif

                        </div>
                        <div class="wrap-input100 validate-input" data-validate="Enter password" {{ $errors->has('password') ? ' has-error' : '' }}>
                            <input class="input100" id="pass"  name="password" type="password" placeholder="Password">

                            @if ($errors->has('password'))
                                <span class="focus-input100" data-placeholder="&#xf191;">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="checkbox contact100-form-checkbox rtl">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                            <label class="label-checkbox100" for="ckb1">
                                Remember me
                            </label>
                        </div>
                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/pages/extra-pages/pages.js') }}"></script>
</div>
</body>
</html>
