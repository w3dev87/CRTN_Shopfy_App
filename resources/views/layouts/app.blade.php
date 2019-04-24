<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slick.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navBar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login/hamburgers.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login/animsition.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login/util.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login/main.css') }}" rel="stylesheet">

    @if(!empty(Cookie::get('customerInfo')))
    {{-- Nav bar --}}
        <div class="container menu_container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="{{route('dashboard')}}"><img class="small--hide" src="//cdn.shopify.com/s/files/1/0009/9604/8932/files/CRTN.ME_51260f60-d7e2-4b09-ac29-62a9571a518c_130x.png?v=1530533907" srcset="//cdn.shopify.com/s/files/1/0009/9604/8932/files/CRTN.ME_51260f60-d7e2-4b09-ac29-62a9571a518c_130x.png?v=1530533907 1x, //cdn.shopify.com/s/files/1/0009/9604/8932/files/CRTN.ME_51260f60-d7e2-4b09-ac29-62a9571a518c_130x@2x.png?v=1530533907 2x" alt="CRTN.ME" itemprop="logo"></a>
            </nav>
            <div class="dropdown drop-menu">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Menu
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{route('dashboard')}}">Home</a>
                    <a class="dropdown-item" href="{{route('logout')}}">Log Out</a>
                </div>
            </div>
            <br class="clear">
        </div>
    @endif
    {{-- Router genereit pages --}}
    <script>
        action = "<?php echo Route::getCurrentRoute()->getActionName();?>";
        base_url = "<?php echo $app->make('url')->to('/');?>";
    </script>
</head>

<body class="">

<div class="container-fluid">

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/jquery-3.1.0.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/login/animsition.min.js') }}"></script>
<script src="{{ asset('js/login/select2.min.js') }}"></script>
<script src="{{ asset('js/login/moment.min.js') }}"></script>
<script src="{{ asset('js/login/countdowntime.js') }}"></script>
<script src="{{ asset('js/login/login-main.js') }}"></script>

<script src="{{ asset('js/bootbox.min.js') }}"></script>
<script src="{{ asset('js/validation_lib.js') }}"></script>
<script src="{{ asset('js/ajax_lib.js') }}"></script>

<script src="{{ asset('js/jquery.zoom.min.js') }}"></script>

<script src="{{ asset('js/slick.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>