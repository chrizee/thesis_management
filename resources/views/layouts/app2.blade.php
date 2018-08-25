<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{{ config('app.name', "Thesis management") }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset("images/icons/favicon.ico") }}">
    <link rel="apple-touch-icon" href="{{ asset("images/icons/favicon.png") }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset("images/icons/favicon-72x72.png") }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset("images/icons/favicon-72x72.png") }}x">
    <!--Loading bootstrap css-->
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
    <link type="text/css" rel="stylesheet" href="{{ asset("styles/jquery-ui-1.10.4.custom.min.css") }}">
    <link type="text/css" rel="stylesheet" href="{{ asset("styles/font-awesome.min.css") }}">
    <link type="text/css" rel="stylesheet" href="{{ asset("styles/bootstrap.min.css") }}">
    <link type="text/css" rel="stylesheet" href="{{ asset("styles/animate.css") }}">
    <link type="text/css" rel="stylesheet" href="{{ asset("styles/all.css") }}">
    <link type="text/css" rel="stylesheet" href="{{ asset("styles/main.css") }}">
    <link type="text/css" rel="stylesheet" href="{{ asset("styles/style-responsive.css") }}">
    <link type="text/css" rel="stylesheet" href="{{ asset("styles/zabuto_calendar.min.css") }}">
    <link type="text/css" rel="stylesheet" href="{{ asset("styles/pace.css") }}">
    <link type="text/css" rel="stylesheet" href="{{ asset("styles/jquery.news-ticker.css") }}">
    <link type="text/css" rel="stylesheet" href="{{ asset("styles/jplist-custom.css") }}">
    <link type="text/css" rel="stylesheet" href="{{ asset("dropzone/dropzone.css") }}">
    <link type="text/css" rel="stylesheet" href="{{ asset("dropzone/basic.css") }}">

    <script src="{{ asset("script/jquery-1.10.2.min.js") }}"></script>
    <style type="text/css" rel="stylesheet">
        @media (min-width: 768px) {
            #page-wrapper {
                position: relative;
                margin: 0 0 0 0px;
                padding: 0;
            }
        }
    </style>
</head>
<body>
<div>

    <!--BEGIN BACK TO TOP-->
    <a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
    <!--END BACK TO TOP-->
    <!--BEGIN TOPBAR-->
    <div id="header-topbar-option-demo" class="page-header-topbar">
        <nav id="topbar" role="navigation" style="margin-bottom: 0;" data-step="3" class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                <a id="logo" href="/" class="navbar-brand"><span class="fa fa-rocket"></span><span class="logo-text">Admin</span><span style="display: none" class="logo-text-icon">µ</span></a></div>
            <div class="topbar-main">
                {{--<form id="topbar-search" action="" method="" class="hidden-sm hidden-xs">--}}
                    {{--<div class="input-icon right text-white"><a href="#"><i class="fa fa-search"></i></a><input type="text" placeholder="Search here..." class="form-control text-white"/></div>--}}
                {{--</form>--}}
                <div class="news-update-box hidden-xs"><span class="text-uppercase mrm pull-left text-white">News:</span>
                    <ul id="news-update" class="ticker list-unstyled">
                        <li>Welcome today</li>
                        <li>Let's help you find that research work.</li>
                    </ul>
                </div>
                <ul class="nav navbar navbar-top-links navbar-right mbn">
                    <li class="dropdown topbar-user"><a data-hover="dropdown" href="#" class="dropdown-toggle"><img src="images/avatar/48.jpg" alt="" class="img-responsive img-circle"/>&nbsp;<span class="hidden-xs">{{ auth()->user()->name }}</span>&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-user pull-right">
                            <li><a href="{{ route("logout") }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-key"></i>Log Out</a></li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!--END TOPBAR-->
    <div id="wrapper">
        <div id="page-wrapper">
            <!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">
                        {{ $title }}</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="dashboard.html">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="hidden"><a href="#">Data Grid</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">{{ $title }}</li>
                </ol>
                <div class="clearfix">
                </div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE-->
            <!--BEGIN CONTENT-->
            <div class="col-lg-12">
                @include("layouts.messages")
            </div>
            @yield("content")
            <!--END CONTENT-->
            <!--BEGIN FOOTER-->
            <div id="footer">
                <div class="copyright">
                    <a href="#">{{ date("Y") }} © Valence Web.</a></div>
            </div>
            <!--END FOOTER-->
        </div>
        <!--END PAGE WRAPPER-->
    </div>
</div>
<script src="{{ asset("script/jquery-migrate-1.2.1.min.js") }}"></script>
<script src="{{ asset("script/jquery-ui.js") }}"></script>
<script src="{{ asset("script/bootstrap.min.js") }}"></script>
<script src="{{ asset("script/bootstrap-hover-dropdown.js") }}"></script>
<script src="{{ asset("script/html5shiv.js") }}"></script>
<script src="{{ asset("script/respond.min.js") }}"></script>
<script src="{{ asset("script/jquery.metisMenu.js") }}"></script>
<script src="{{ asset("script/jquery.slimscroll.js") }}"></script>
<script src="{{ asset("script/jquery.cookie.js") }}"></script>
<script src="{{ asset("script/icheck.min.js") }}"></script>
<script src="{{ asset("script/custom.min.js") }}"></script>
<script src="{{ asset("script/jquery.menu.js") }}"></script>
<script src="{{ asset("script/pace.min.js") }}"></script>
<script src="{{ asset("script/holder.js") }}"></script>
<script src="{{ asset("script/responsive-tabs.js") }}"></script>
<script src="{{ asset("script/index.js") }}"></script>
<script src="{{ asset("script/highcharts.js") }}"></script>
<script src="{{ asset("script/data.js") }}"></script>
<script src="{{ asset("script/drilldown.js") }}"></script>
<script src="{{ asset("script/exporting.js") }}"></script>
<script src="{{ asset("script/modernizr.min.js") }}"></script>
<script src="{{ asset("script/jplist.min.js") }}"></script>
<script src="{{ asset("script/jplist.js") }}"></script>
<!--CORE JAVASCRIPT-->
<script src="{{ asset("script/main.js") }}"></script>
<script src="{{ asset("dropzone/dropzone.js") }}"></script>
</body>
</html>
