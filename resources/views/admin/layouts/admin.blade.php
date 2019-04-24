<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @extends('admin/layouts.head')

    <script>
        base_url = "<?php echo $app->make('url')->to('/')?>";
        action   = "<?php echo Route::getCurrentRoute()->getActionName()?>"
    </script>
</head>
<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">
<div class="page-header navbar navbar-fixed-top">

    <div class="page-header-inner ">
        <!-- logo start -->
        <div class="page-logo">
            <a href="{{url('/admin/dashboard')}}">
                <span class="logo-icon material-icons fa-rotate-45">school</span>
                <span class="logo-default">Smart</span> </a>
        </div>
        <!-- logo end -->
        <ul class="nav navbar-nav navbar-left in">
            <li><a href="#" class="menu-toggler sidebar-toggler"><i class="icon-menu"></i></a></li>
        </ul>
        <!-- start mobile menu -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse">
            <span></span>
        </a>
        <!-- end mobile menu -->
        <!-- start header menu -->

        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <li><a href="javascript:;" class="fullscreen-btn"><i class="fa fa-arrows-alt"></i></a></li>
                <!-- start language menu -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <span class="username username-hide-on-mobile"> {{Auth::guard('admin')->user()->name}} </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="#">
                                <i class="icon-user"></i> Profile </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-settings"></i> Settings
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-directions"></i> Help
                            </a>
                        </li>
                        <li class="divider"> </li>
                        <li>
                            <a href="#">
                                <i class="icon-lock"></i> Lock
                            </a>
                        </li>
                        <li>
                            <a href="{{url('/admin-panel')}}">
                                <i class="icon-logout"></i> Log Out </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
<div class="page-wrapper">
    <!-- start header -->

    <!-- end header -->
    <!-- start color quick setting -->
    <div class="quick-setting-main">
        <button class="control-sidebar-btn btn" data-toggle="control-sidebar"><i
                    class="fa fa-cog fa-spin"></i></button>
        <div class="quick-setting display-none">
            <ul id="themecolors">

                <li>
                    <p class="selector-title">Sidebar Color</p>
                </li>
                <li class="complete">
                    <div class="theme-color sidebar-theme">
                        <a href="#" data-theme="white"><span class="head"></span><span class="cont"></span></a>
                        <a href="#" data-theme="dark"><span class="head"></span><span class="cont"></span></a>
                        <a href="#" data-theme="blue"><span class="head"></span><span class="cont"></span></a>
                        <a href="#" data-theme="indigo"><span class="head"></span><span class="cont"></span></a>
                        <a href="#" data-theme="cyan"><span class="head"></span><span class="cont"></span></a>
                        <a href="#" data-theme="green"><span class="head"></span><span class="cont"></span></a>
                        <a href="#" data-theme="red"><span class="head"></span><span class="cont"></span></a>
                    </div>
                </li>
                <li>
                    <p class="selector-title">Header Brand color</p>
                </li>
                <li class="theme-option">
                    <div class="theme-color logo-theme">
                        <a href="#" data-theme="logo-white"><span class="head"></span><span class="cont"></span></a>
                        <a href="#" data-theme="logo-dark"><span class="head"></span><span class="cont"></span></a>
                        <a href="#" data-theme="logo-blue"><span class="head"></span><span class="cont"></span></a>
                        <a href="#" data-theme="logo-indigo"><span class="head"></span><span
                                    class="cont"></span></a>
                        <a href="#" data-theme="logo-cyan"><span class="head"></span><span class="cont"></span></a>
                        <a href="#" data-theme="logo-green"><span class="head"></span><span class="cont"></span></a>
                        <a href="#" data-theme="logo-red"><span class="head"></span><span class="cont"></span></a>
                    </div>
                </li>
                <li>
                    <p class="selector-title">Header color</p>
                </li>
                <li class="theme-option">
                    <div class="theme-color header-theme">
                        <a href="#" data-theme="header-white"><span class="head"></span><span
                                    class="cont"></span></a>
                        <a href="#" data-theme="header-dark"><span class="head"></span><span
                                    class="cont"></span></a>
                        <a href="#" data-theme="header-blue"><span class="head"></span><span
                                    class="cont"></span></a>
                        <a href="#" data-theme="header-indigo"><span class="head"></span><span
                                    class="cont"></span></a>
                        <a href="#" data-theme="header-cyan"><span class="head"></span><span
                                    class="cont"></span></a>
                        <a href="#" data-theme="header-green"><span class="head"></span><span
                                    class="cont"></span></a>
                        <a href="#" data-theme="header-red"><span class="head"></span><span class="cont"></span></a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- end color quick setting -->
    <!-- start page container -->
    <div class="page-container">

        <!-- start sidebar menu -->
        <div class="sidebar-container">
            <div class="sidemenu-container navbar-collapse collapse fixed-menu">
                <div id="remove-scroll" class="left-sidemenu">
                    <ul class="sidemenu  page-header-fixed slimscroll-style" data-keep-expanded="false"
                        data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <li class="sidebar-toggler-wrapper hide">
                            <div class="sidebar-toggler">
                                <span></span>
                            </div>
                        </li>

                        <li class="nav-item  start active open">
                            <a href="#" class="nav-link nav-toggle"> <i class="material-icons">dashboard</i>
                                <span class="title">Request fix</span> <span class="arrow open"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a href="{{url('/admin/order_notes')}}" class="nav-link "> <span class="title">Request fix</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link nav-toggle"> <i class="material-icons">person</i>
                                <span class="title">Orders</span> <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a href="{{url('/admin/orders')}}" class="nav-link "> <span class="title">All
												Orders</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item start  ">
                            <a href="#" class="nav-link nav-toggle">
                                <i class="material-icons">dashboard</i>
                                <span class="title">Backgrounds</span>
                                <span class="selected"></span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a href="{{url('/admin/add_background_type')}}" class="nav-link ">
                                        <span class="title">Add Background Category</span>
                                        <span class="selected"></span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="{{url('/admin/add_background')}}" class="nav-link ">
                                        <span class="title">Add Background</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item start  ">
                            <a href="#" class="nav-link nav-toggle">
                                <i class="material-icons">person</i>
                                <span class="title">Customers</span>
                                <span class="selected"></span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item">
                                    <a href="{{url('/admin/all_customer')}}" class="nav-link ">
                                        <span class="title">All Customer</span>
                                        <span class="selected"></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end sidebar menu -->

        <!-- start page content -->
        <div class="page-content-wrapper">
            <div class="page-content">
                @yield('content')
            </div>
        </div>
        <!-- end page content -->

    </div>
    <!-- end page container -->

</div>
</body>
@extends('admin/layouts.footer')
</html>
