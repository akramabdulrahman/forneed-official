<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Twist &mdash; Free Fully Responsive HTML5 Template by FREEHTML5.co</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Template by FreeHTML5.co"/>
    <meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive"/>
    <meta name="author" content="FreeHTML5.co"/>

<!--
      //////////////////////////////////////////////////////

      FREE HTML5 TEMPLATE
      DESIGNED & DEVELOPED by FREEHTML5.CO

      Website: 		http://freehtml5.co/
      Email: 			info@freehtml5.co
      Twitter: 		http://twitter.com/fh5co
      Facebook: 		https://www.facebook.com/fh5co

      //////////////////////////////////////////////////////
       -->

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content=""/>
    <meta name="twitter:image" content=""/>
    <meta name="twitter:url" content=""/>
    <meta name="twitter:card" content=""/>

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'> -->
    <link rel="stylesheet" href="{{url('css/uikit.min.css')}}">
    <link rel="stylesheet" href="{{url('css/uikit.gradient.min.css')}}">

    <!-- Animate.css -->
    <link rel="stylesheet" href="{{url('css/animate.css')}}">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="{{url('css/icomoon.css')}}">
    <!-- Simple Line Icons -->
    <link rel="stylesheet" href="{{url('css/simple-line-icons.css')}}">

    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{url('css/bootstrap.css')}}">
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="{{url('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url('css/owl.theme.default.min.css')}}">
    <!-- Style -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">

    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">

    <link rel="stylesheet" href="{{url('css/citizen-style-default.css')}}">
    <link rel="stylesheet" href="{{url('css/citizen-style.css')}}">
    <link href="{{url('css/style-responsive.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/user-card.css')}}">
    <link rel="stylesheet" href="{{url('css/to-do.css')}}">
    <!-- Modernizr JS -->
    <script src="{{url('js/modernizr-2.6.2.min.js')}}"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="{{url('js/respond.min.js')}}"></script>


    <![endif]-->
    <style>
        /*
    Note: It is best to use a less version of this file ( see http://css2less.cc
    For the media queries use

        @screen-sm-min

        instead of 768px.
                    For .omb_spanOr use

        @body-bg

        instead of white.
                */

        @media (min-width: 768px) {
            .omb_row-sm-offset-3 div:first-child[class*="col-"] {
                margin-left: 25%;
            }
        }

        .omb_login .omb_authTitle {
            text-align: center;
            line-height: 300%;
        }

        .omb_login .omb_socialButtons a {
            color: white;
        / / In yourUse @body-bg   opacity: 0.9;
        }

        .omb_login .omb_socialButtons a:hover {
            color: white;
            opacity: 1;
        }

        .omb_login .omb_socialButtons .omb_btn-facebook {
            background: #3b5998;
        }

        .omb_login .omb_socialButtons .omb_btn-twitter {
            background: #00aced;
        }

        .omb_login .omb_socialButtons .omb_btn-google {
            background: #c32f10;
        }

        .omb_login .omb_loginOr {
            position: relative;
            color: #aaa;

            margin-top: 1em;
            margin-bottom: 1em;
            padding-top: 0.5em;
            padding-bottom: 0.5em;
        }

        .omb_login .omb_loginOr .omb_hrOr {
            background-color: #cdcdcd;
            height: 1px;
            margin-top: 0px !important;
            margin-bottom: 0px !important;
        }

        .omb_login .omb_loginOr .omb_spanOr {
            display: block;
            position: absolute;
            left: 50%;
            top: -0.6em;
            margin-left: -1.5em;
            background-color: white;
            width: 3em;
            text-align: center;
        }

        /*=========================
          Icons
         ================= */

        /* footer social icons */
        ul.social-network {
            list-style: none;
            display: inline;
            margin-left: 0 !important;
            padding: 0;
        }

        ul.social-network li {
            display: inline;
            margin: 0 5px;
        }

        /* footer social icons */
        .social-network a.icoRss:hover {
            background-color: #F56505;
        }

        .social-network a.icoFacebook:hover {
            background-color: #3B5998;
        }

        .social-network a.icoTwitter:hover {
            background-color: #33ccff;
        }

        .social-network a.icoGoogle:hover {
            background-color: #BD3518;
        }

        .social-network a.icoVimeo:hover {
            background-color: #0590B8;
        }

        .social-network a.icoLinkedin:hover {
            background-color: #007bb7;
        }

        .social-network a.icoRss:hover i, .social-network a.icoFacebook:hover i, .social-network a.icoTwitter:hover i,
        .social-network a.icoGoogle:hover i, .social-network a.icoVimeo:hover i, .social-network a.icoLinkedin:hover i {
            color: #fff;
        }

        a.socialIcon:hover, .socialHoverClass {
            color: #44BCDD;
        }

        .social-circle li a {
            display: inline-block;
            position: relative;
            margin: 0 auto 0 auto;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
            text-align: center;
            width: 50px;
            height: 50px;
            font-size: 20px;
        }

        .social-circle li i {
            margin: 0;
            line-height: 50px;
            text-align: center;
        }

        .social-circle li a:hover i, .triggeredHover {
            -moz-transform: rotate(360deg);
            -webkit-transform: rotate(360deg);
            -ms--transform: rotate(360deg);
            transform: rotate(360deg);
            -webkit-transition: all 0.2s;
            -moz-transition: all 0.2s;
            -o-transition: all 0.2s;
            -ms-transition: all 0.2s;
            transition: all 0.2s;
        }

        .social-circle i {
            color: #fff;
            -webkit-transition: all 0.8s;
            -moz-transition: all 0.8s;
            -o-transition: all 0.8s;
            -ms-transition: all 0.8s;
            transition: all 0.8s;
        }

        .social-circle a {
            background-color: #D3D3D3;
        }
    </style>
    @stack('styles')
</head>
<body>
<header role="banner" id="fh5co-header">
    <div class="fluid-container">
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <!-- Mobile Toggle Menu Button -->
                <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle" data-toggle="collapse" data-target="#navbar"
                   aria-expanded="false" aria-controls="navbar"><i></i></a>
                <a class="navbar-brand" href={{route('Dashboard.landing')}} style="letter-spacing: 6pt;font-weight:lighter"><b
                            style="display:inline-block;transform: scale(-1, 1);">For</b><span style="">needs</span></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="#home" data-nav-section="home"><span>Home</span></a></li>
                    <li><a href="#services" data-nav-section="services"><span>Services</span></a></li>
                    <li><a href="#testimony" data-nav-section="testimony"><span>Testimony</span></a></li>
                    <li><a href="#contact" data-nav-section="contact"><span>contact</span></a></li>
                    <li><a href="#faq" data-nav-section="faq"><span>FAQ</span></a></li>

                </ul>
            </div>
        </nav>
    </div>
</header>

<section id="fh5co-home" class="row " data-section="home">

    <div id="map" class="col-lg-8 fh5co-map .gradient" style="padding:0px"></div>
    @yield('content')


    <div class="col-lg-4 uk-align-left col-md-push-1 animate-box fadeInRight animated-fast"
         data-animate-effect="fadeInRight" style="position:absolute;right: 68px;top: 85px;">
        <div class="uk-block">
            <div class="row">
                <div class="form-wrap">
                    <div class="col-md-12 col-md-offset-0 text-left">
                        <div class="row row-mt-15em">

                            <div class="col-md-8 mt-text animate-box fadeInUp animated-fast"
                                 data-animate-effect="fadeInUp">
                                <span class="intro-text-small"> Citizen Or ServiceProvider</span>
                                <h1>What Are You ?</h1>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- jQuery -->
<script src="{{url('js/jquery.min.js')}}"></script>
<!-- Ui kit -->
<script src="{{url('js/uikit.min.js')}}"></script>
<!-- jQuery Easing -->
<script src="{{url('js/jquery.easing.1.3.js')}}"></script>
<!-- Bootstrap -->
<script src="{{url('js/bootstrap.min.js')}}"></script>
<!-- Waypoints -->
<script src="{{url('js/jquery.waypoints.min.js')}}"></script>
<!-- Stellar Parallax -->
<script src="{{url('js/jquery.stellar.min.js')}}"></script>
<!-- Owl Carousel -->
<script src="{{url('js/owl.carousel.min.js')}}"></script>
<!-- Counters -->
<script src="{{url('js/jquery.countTo.js')}}"></script>
<!-- switcher -->
<script src="{{url('js/jquery.style.switcher.js')}}"></script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
<script src="{{url('js/google_map.js')}}"></script>
<!-- Main JS (Do not remove) -->
<script src="{{url('js/main.js')}}"></script>
@stack('scripts')
</body>
</html>


