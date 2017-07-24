<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.5
Version: 4.5.2
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8"/>
    <title>Metronic | Dashboard</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('dashboard/assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('dashboard/assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}"
          rel="stylesheet" type="text/css"/>
    {{--<link rel="stylesheet" href="{{asset('/cdn/materialize.min.css')}}"/>--}}

    <link href="{{asset('dashboard/assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <style>
        .handCursor {
            cursor: pointer;
        }
        html, body, .container-table {
            height: 100%;
        }
        .container-table {
            display: table;
        }
        .vertical-center-row {
            display: table-cell;
            vertical-align: middle;
        }
    </style>
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css"
          integrity="sha256-an4uqLnVJ2flr7w0U74xiF4PJjO2N5Df91R2CUmCLCA=" crossorigin="anonymous"/>

    <link rel="stylesheet"
          href="{{asset('/cdn/bootstrap-select.min.css')}}"
    />

@stack('page_style_plugins')
<!-- BEGIN THEME GLOBAL STYLES -->

    <link href="{{asset('dashboard/assets/global/css/components.min.css')}}" rel="stylesheet" id="style_components"
          type="text/css"/>
    <link href="{{asset('dashboard/assets/global/css/plugins.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{asset('dashboard/assets/layouts/layout/css/layout.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('dashboard/assets/layouts/layout/css/themes/darkblue.min.css')}}" rel="stylesheet"
          type="text/css"
          id="style_color"/>
    <link href="{{asset('dashboard/assets/layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="{{asset('dashboard/assets/favicon.ico')}}"/>
</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-sidebar-closed">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">

        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->

        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN NOTIFICATION DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    <a href="javascript:;" class="dropdown-toggle" onclick="user_seen()" data-toggle="dropdown"
                       data-hover="dropdown"
                       data-close-others="true">
                        <i class="icon-bell"></i>
                        <?php $notif_count = $auth_user->unreadNotifications->count(); ?>
                        @if($notif_count)
                            <span class="badge badge-default"> {{$notif_count}} </span>
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li class="external">
                            <h3>
                                <span class="bold">{{$notif_count?$notif_count:'No' }} pending</span>
                                notifications</h3>
                            <a href="">view all</a>
                        </li>
                        <li>
                            <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                @foreach($auth_user->unreadNotifications as $notification)
                                    <li>
                                        <a href="{{$notification->data['url']}}">
                                            <span class="details">
                                                    <span class="label label-sm label-icon label-warning">
                                                        <i class="fa fa-bell"></i>
                                                    </span>
                                                {{$notification->data['message']}}
                                            </span>
                                            <span class="time">{{$notification->created_at->diffForHumans()}}</span>

                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- END NOTIFICATION DROPDOWN -->
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <img alt="" class="img-circle"
                             src="  {{asset('dashboard/assets/layouts/layout/img/avatar3_small.jpg')}} "/>
                        <span class="username username-hide-on-mobile"> {{Auth::user()->name}} </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            {{--<a href="{{route('Dashboard.show')}}">--}}
                                <i class="icon-user"></i> My Profile </a>
                        </li>
                        <li class="divider"></li>
                        <li>

                            <a href="@if($impersonator){{route('endusers.worker.logoutas')}} @else {{route('logout')}} @endif">
                                <i class="icon-key"></i> Log Out </a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
                <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-quick-sidebar-toggler">
                    <a href="javascript:;" class="dropdown-toggle">
                        <i class="icon-logout"></i>
                    </a>
                </li>
                <!-- END QUICK SIDEBAR TOGGLER -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"></div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->

<!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class=" row no-padding no-margin page-content-wrapper" style="height:100%;">
        <!-- BEGIN CONTENT BODY -->
    @yield('content')
    <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->


    <!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->

<!-- END FOOTER -->
<!--[if lt IE 9]>

<script src="{{asset('dashboard/assets/global/plugins/respond.min.js')}}"></script>
<script src="{{asset('dashboard/assets/global/plugins/excanvas.min.js')}}"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{asset('dashboard/assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/assets/global/plugins/bootstrap/js/bootstrap.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('dashboard/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"
        type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{asset('dashboard/assets/global/scripts/app.js')}}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"
        integrity="sha256-JD3g+rB9BjW6/cGEuwCue1sGtitb2aQVNs/pl4114XQ=" crossorigin="anonymous"></script>
@stack('page_script_plugins')
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="{{asset('dashboard/assets/layouts/layout/scripts/layout.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/assets/layouts/layout/scripts/demo.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/assets/layouts/global/scripts/quick-sidebar.min.js')}}" type="text/javascript"></script>
{{--<script>--}}
    {{--function user_seen(){--}}
        {{--$.get('{{route('Dashboard.notifications')}}',function (data) {--}}

        {{--})--}}
    {{--}--}}
{{--</script>--}}
<!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>