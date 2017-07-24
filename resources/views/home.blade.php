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
    <link rel="stylesheet" href="{{asset('css/uikit.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/uikit.gradient.min.css')}}">

    <!-- Animate.css -->
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="{{asset('css/icomoon.css')}}">
    <!-- Simple Line Icons -->
    <link rel="stylesheet" href="{{asset('css/simple-line-icons.css')}}">

    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <!-- Style -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <!-- Modernizr JS -->
    <script src="{{asset('js/modernizr-2.6.2.min.js')}}"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="{{asset('js/respond.min.js')}}"></script>


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
        / / In yourUse @body-bg  opacity: 0.9;
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

<section id="fh5co-home"  class="row " data-section="home" >

    <div id="map" class="col-lg-8 fh5co-map .gradient" style="padding:0px"></div>

    <div class="col-lg-4  uk-align-right" style="position: absolute;right: 28px;">
        <div class="uk-block ">
            <div class="row uk-margin-large-top">
                <div class=" col-md-push-1 animate-box fadeInRight animated-fast" data-animate-effect="fadeInRight">
                    <div class="form-wrap">
                        <div class="tab">
                            <ul class="tab-menu ">
                                <li class="gtco-first {{session('active')?"":"active"}} "><a href="#" data-tab="signup">Sign up</a></li>
                                <li class="gtco-second {{session('active')?"active":""}}" ><a href="#" data-tab="login">Login</a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-content-inner {{session('active')?"":"active"}}" data-content="signup">
                                    @include('auth.register')

                                </div>

                                <div class="tab-content-inner {{session('active')?"active":""}}" data-content="login">
                                    @include('auth.login')

                                </div>

                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="col-lg-4 uk-align-left col-md-push-1 animate-box fadeInRight animated-fast"
         data-animate-effect="fadeInRight" style="position:absolute;right: 68px;top: 85px;">
        <div class="uk-block">
            <div class="row">
                <div class="form-wrap">
                    <div class="col-md-12 col-md-offset-0 text-left">
                        <div class="row row-mt-15em">

                            <div class="col-md-7 mt-text animate-box fadeInUp animated-fast"
                                 data-animate-effect="fadeInUp">
                                <span class="intro-text-small">Crowd Sourcing  Needs Gathering Proccess !</span>
                                <h1>Sign Up Your Needs Now</h1>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="fh5co-services" data-section="services" class="row ">
    <div class="fh5co-services">
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-heading text-center">
                    <h2 class="to-animate"><span>We Offer Services</span></h2>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 subtext">
                            <h3 class="to-animate">Far far away, behind the word mountains, far from the countries
                                Vokalia and Consonantia, there live the blind texts. Separated they live in
                                Bookmarksgrove. </h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 text-center">
                    <div class="box-services">
                        <div class="icon to-animate">
                            <span><i class="icon-chemistry"></i></span>
                        </div>
                        <div class="fh5co-post to-animate">
                            <h3>Hand-crafted with Detailed</h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                                there live the blind texts.</p>
                        </div>
                    </div>

                    <div class="box-services">
                        <div class="icon to-animate">
                            <span><i class="icon-energy"></i></span>
                        </div>
                        <div class="fh5co-post to-animate">
                            <h3>Light and Fast</h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                                there live the blind texts.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="box-services">
                        <div class="icon to-animate">
                            <span><i class="icon-trophy"></i></span>
                        </div>
                        <div class="fh5co-post to-animate">
                            <h3>Award-winning Landing Page</h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                                there live the blind texts.</p>
                        </div>
                    </div>

                    <div class="box-services">
                        <div class="icon to-animate">
                            <span><i class="icon-paper-plane"></i></span>
                        </div>
                        <div class="fh5co-post to-animate">
                            <h3>Sleek and Smooth Animation</h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                                there live the blind texts.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="box-services">
                        <div class="icon to-animate">
                            <span><i class="icon-people"></i></span>
                        </div>
                        <div class="fh5co-post to-animate">
                            <h3>Satisfied &amp; Happy Clients</h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                                there live the blind texts.</p>
                        </div>
                    </div>

                    <div class="box-services">
                        <div class="icon to-animate">
                            <span><i class="icon-screen-desktop"></i></span>
                        </div>
                        <div class="fh5co-post to-animate">
                            <h3>Looks Amazing on Devices</h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                                there live the blind texts.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-center">
                    <div class="box-services">
                        <div class="icon to-animate">
                            <span><i class="icon-life-saver"></i></span>
                        </div>
                        <div class="fh5co-post to-animate">
                            <h3>24/7 Help &amp; Support</h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                                there live the blind texts.</p>
                        </div>
                    </div>

                    <div class="box-services">
                        <div class="icon to-animate">
                            <span><i class="icon-key"></i></span>
                        </div>
                        <div class="fh5co-post to-animate">
                            <h3>Secure Account</h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                                there live the blind texts.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="core-features">
        <div class="grid2 to-animate" style="background-image: url({{asset('images/full_image_5.jpg')}});">
        </div>
        <div class="grid2 fh5co-bg-color">
            <div class="core-f">
                <h2 class="to-animate">Core Features</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="core">
                            <i class="icon-cloud-download to-animate-2"></i>
                            <div class="fh5co-post to-animate">
                                <h3>Free Download</h3>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and
                                    Consonantia, there live the blind texts.</p>
                            </div>
                        </div>
                        <div class="core">
                            <i class="icon-laptop to-animate-2"></i>
                            <div class="fh5co-post to-animate">
                                <h3>Responsive Layout</h3>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and
                                    Consonantia, there live the blind texts.</p>
                            </div>
                        </div>
                        <div class="core">
                            <i class="icon-hand-paper-o to-animate-2"></i>
                            <div class="fh5co-post to-animate">
                                <h3>24/7 Help &amp; Support</h3>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and
                                    Consonantia, there live the blind texts.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="core">
                            <i class="icon-lightbulb-o to-animate-2"></i>
                            <div class="fh5co-post to-animate">
                                <h3>Free Update</h3>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and
                                    Consonantia, there live the blind texts.</p>
                            </div>
                        </div>
                        <div class="core">
                            <i class="icon-trophy to-animate-2"></i>
                            <div class="fh5co-post to-animate">
                                <h3>Featured Template</h3>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and
                                    Consonantia, there live the blind texts.</p>
                            </div>
                        </div>
                        <div class="core">
                            <i class="icon-columns2 to-animate-2"></i>
                            <div class="fh5co-post to-animate">
                                <h3>Lots of Elements</h3>
                                <p>Far far away, behind the word mountains, far from the countries Vokalia and
                                    Consonantia, there live the blind texts.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="fh5co-testimony" data-section="testimony" class="row " class="fh5co-bg-color">
    <div class="container" >

        <div id="fh5co-counter-section" class="fh5co-counters">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 section-heading text-center">
                        <h2 class="to-animate"><span>Some Fun Facts</span></h2>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 subtext">
                                <h3 class="to-animate">Far far away, behind the word mountains, far from the countries
                                    Vokalia and Consonantia, there live the blind texts. Separated they live in
                                    Bookmarksgrove. </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row to-animate">
                    <div class="col-md-3 text-center">
                    <span class="fh5co-counter js-counter" data-from="0" data-to="3452" data-speed="5000"
                          data-refresh-interval="50"></span>
                        <span class="fh5co-counter-label">Cups of Coffee</span>
                    </div>
                    <div class="col-md-3 text-center">
                    <span class="fh5co-counter js-counter" data-from="0" data-to="234" data-speed="5000"
                          data-refresh-interval="50"></span>
                        <span class="fh5co-counter-label">Client</span>
                    </div>
                    <div class="col-md-3 text-center">
                    <span class="fh5co-counter js-counter" data-from="0" data-to="6542" data-speed="5000"
                          data-refresh-interval="50"></span>
                        <span class="fh5co-counter-label">Projects</span>
                    </div>
                    <div class="col-md-3 text-center">
                    <span class="fh5co-counter js-counter" data-from="0" data-to="8687" data-speed="5000"
                          data-refresh-interval="50"></span>
                        <span class="fh5co-counter-label">Finished Projects</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<div class="getting-started row getting-started-1">
    <div class="getting-grid" style="background-image:  url({{asset('images/full_image_3.jpg')}});">
        <div class="desc">
            <h2>Getting <span>Started</span></h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the
                blind texts. </p>
        </div>
    </div>
    <a href="#" class="getting-grid2">
        <div class="call-to-action text-center">
            <p href="#" class="sign-up">Sign Up For Free</p>
        </div>
    </a>

</div>


<section id="fh5co-faq" class="row " data-section="faq" class="fh5co-bg-color">
    <div class="fh5co-faq" >
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-heading text-center">
                    <h2 class="to-animate"><span>Common Questions</span></h2>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 subtext">
                            <h3 class="to-animate">Everything you need to know before you get started</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="box-faq to-animate-2">
                        <i class="icon-check2"></i>
                        <div class="desc">
                            <h3>What is Twist?</h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                                there live the blind texts. Separated they live in Bookmarksgrove right at the coast of
                                the Semantics, a large language ocean.</p>
                        </div>
                    </div>
                    <div class="box-faq to-animate-2">
                        <i class="icon-check2"></i>
                        <div class="desc">
                            <h3>I have technical problem, who do I email? </h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                                there live the blind texts. Separated they live in Bookmarksgrove right at the coast of
                                the Semantics, a large language ocean.</p>
                        </div>
                    </div>
                    <div class="box-faq to-animate-2">
                        <i class="icon-check2"></i>
                        <div class="desc">
                            <h3>How do I use Twist features?</h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                                there live the blind texts. Separated they live in Bookmarksgrove right at the coast of
                                the Semantics, a large language ocean.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box-faq to-animate-2">
                        <i class="icon-check2"></i>
                        <div class="desc">
                            <h3>What language are available?</h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                                there live the blind texts. Separated they live in Bookmarksgrove right at the coast of
                                the Semantics, a large language ocean.</p>
                        </div>
                    </div>
                    <div class="box-faq to-animate-2">
                        <i class="icon-check2"></i>
                        <div class="desc">
                            <h3>Can I have a username that is already taken?</h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                                there live the blind texts. Separated they live in Bookmarksgrove right at the coast of
                                the Semantics, a large language ocean.</p>
                        </div>
                    </div>
                    <div class="box-faq to-animate-2">
                        <i class="icon-check2"></i>
                        <div class="desc">
                            <h3>Is Twist free?</h3>
                            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia,
                                there live the blind texts. Separated they live in Bookmarksgrove right at the coast of
                                the Semantics, a large language ocean.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="fh5co-trusted" class="row " data-section="trusted">
    <div class="fh5co-trusted">
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-heading text-center">
                    <h2 class="to-animate"><span>Trusted By</span></h2>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 subtext">
                            <h3 class="to-animate">We’re trusted by these popular companies</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-sm-3 col-xs-6 col-sm-offset-0 col-md-offset-1">
                    <div class="partner-logo to-animate-2">
                        <img src="{{asset('images/logo1.png')}}" alt="Partners" class="img-responsive">
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-6">
                    <div class="partner-logo to-animate-2">
                        <img src="{{asset('images/logo2.png')}}" alt="Partners" class="img-responsive">
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-6">
                    <div class="partner-logo to-animate-2">
                        <img src="{{asset('images/logo3.png')}}" alt="Partners" class="img-responsive">
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-6">
                    <div class="partner-logo to-animate-2">
                        <img src="{{asset('images/logo4.png')}}" alt="Partners" class="img-responsive">
                    </div>
                </div>
                <div class="col-md-2 col-sm-12 col-xs-12">
                    <div class="partner-logo to-animate-2">
                        <img src="{{asset('images/logo5.png')}}" alt="Partners" class="img-responsive">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="fh5co-footer" class="row " data-section="contact" role="contentinfo">
    <div class="container" >
        <div class="row">
            <div class="col-md-4 to-animate">
                <h3 class="section-title">About Us</h3>
                <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live
                    the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics.</p>
                <p class="copy-right">&copy; 2015 Twist Free Template. <br>All Rights Reserved. <br>
                    Designed by <a href="http://freehtml5.co/" target="_blank">FREEHTML5.co</a>
                    Demo Images: <a href="http://unsplash.com/" target="_blank">Unsplash</a>
                </p>
            </div>

            <div class="col-md-4 to-animate">
                <h3 class="section-title">Our Address</h3>
                <ul class="contact-info">
                    <li><i class="icon-map-marker"></i>198 West 21th Street, Suite 721 New York NY 10016</li>
                    <li><i class="icon-phone"></i>+ 1235 2355 98</li>
                    <li><i class="icon-envelope"></i><a href="#">info@yoursite.com</a></li>
                    <li><i class="icon-globe2"></i><a href="#">www.yoursite.com</a></li>
                </ul>
                <h3 class="section-title">Connect with Us</h3>
                <ul class="social-media">
                    <li><a href="#" class="facebook"><i class="icon-facebook"></i></a></li>
                    <li><a href="#" class="twitter"><i class="icon-twitter"></i></a></li>
                    <li><a href="#" class="dribbble"><i class="icon-dribbble"></i></a></li>
                    <li><a href="#" class="github"><i class="icon-github-alt"></i></a></li>
                </ul>
            </div>
            <div class="col-md-4 to-animate">
                <h3 class="section-title">Drop us a line</h3>
                <form class="contact-form">
                    <div class="form-group">
                        <label for="name" class="sr-only">Name</label>
                        <input type="name" class="form-control" id="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="email" class="sr-only">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="message" class="sr-only">Message</label>
                        <textarea class="form-control" id="message" rows="7" placeholder="Message"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" id="btn-submit" class="btn btn-send-message btn-md" value="Send Message">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- jQuery -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<!-- Ui kit -->
<script src="{{asset('js/uikit.min.js')}}"></script>
<!-- jQuery Easing -->
<script src="{{asset('js/jquery.easing.1.3.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- Waypoints -->
<script src="{{asset('js/jquery.waypoints.min.js')}}"></script>
<!-- Stellar Parallax -->
<script src="{{asset('js/jquery.stellar.min.js')}}"></script>
<!-- Owl Carousel -->
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<!-- Counters -->
<script src="{{asset('js/jquery.countTo.js')}}"></script>
<!-- switcher -->
<script src="{{asset('js/jquery.style.switcher.js')}}"></script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
<script src="{{asset('js/google_map.js')}}"></script>
<!-- Main JS (Do not remove) -->
<script src="{{asset('js/main.js')}}"></script>

</body>
</html>


