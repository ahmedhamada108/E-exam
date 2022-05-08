<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="E-Exam">
    <meta name="keywords" content="E-Exam">
    <meta name="author" content="E-Exam">
    <link rel="icon" href="{{ asset('assets_web/logo.png') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="assets/logo.png" type="image/x-icon" />

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_web/css/bootstrap.css') }}">

    <!-- Style css -->
    <link rel="stylesheet" href="{{ asset('assets_web/css/landing_page.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_web/css/style.css') }}">

    <!-- animation css -->
    <link rel="stylesheet" href="{{ asset('assets_web/css/animate.css"') }}">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_web/css/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets_web/css/themify-icons.css') }}">

    <title>Smart E-Exam</title>

</head>
<body data-spy="scroll" data-target="#scroll-spy">


    <!--header start-->
    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col p-0">
                    <div class="top-header">
                        <div class="logo pl-2">
                            <a class="navbar-brand" href="index.html">
                                <img style="width: 50px;" src="{{ asset('assets_web/logo.png') }}"
                                    alt="logo"></a>
                        </div>
                        <div class="main-menu mx-auto" id="nav">
                            <nav id="navbar-example2" class="navbar navbar-expand-lg navbar-light">
                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#scroll-spy" aria-controls="scroll-spy" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="scroll-spy">
                                    <ul class="navbar-nav mx-auto nav">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="index.html">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="Subjects.html">Subjects</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="Account.html">My Account</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="About.html">About Us</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--header end-->

    <!--home section start-->
    <section class="main-img responsive-img  pt-0" id="img-bg">
        <div class="container-fluid">
            <div class="main-contain">
                <div>
                    <h1 class="m-0">Smart<span>Exam</span></h1>
                    <h3 class="m-0">The <span>BEST TEST</span> for students and professor</h3>
                    <img src="assets/images/landing-page/text.png" alt="" class="img-fluid">
                    <div class="mt-4">
                        <a href="{{ url('/login') }}" class="btn btn-primary m-0 d-inline-block">Login</a>
                        <a href="index.html" class="btn btn-secondary d-inline-block ml-3">Register</a>
                    </div>
                </div>
            </div>
            <div class="home-decor">
                <div class="decor-1 decor wow zoomIn" id="img-1">
                    <img src="{{ asset('assets_web/undraw_functions_re_alho.svg') }}" alt="" class="img-fluid blur-up lazyload">
                </div>
                <div class="decor-2 decor wow zoomIn" id="img-2">
                    <img src="{{ asset('assets_web/undraw_online_art_re_f1pk.svg') }}" alt="" class=" img-fluid blur-up lazyload">
                </div>
                <div class="decor-3 decor wow zoomIn" id="img-3">
                    <img src="{{ asset('assets_web/undraw_key_points_re_u903.svg') }}" alt="" class=" img-fluid blur-up lazyload">
                </div>
                <div class="decor-4 decor wow zoomIn" id="img-4">
                    <img src="{{ asset('assets_web/undraw_instant_analysis_re_mid5.svg') }}" alt="" class=" img-fluid blur-up lazyload">
                </div>
                <div class="decor-5 decor wow zoomIn" id="img-5">
                    <img src="{{ asset('assets_web/undraw_file_manager_re_ms29.svg') }}" alt="" class=" img-fluid blur-up lazyload">
                </div>
                <div class="decor-6 decor wow zoomIn" id="img-6">
                    <img src="{{ asset('assets_web/undraw_certification_re_ifll.svg') }}" alt="" class=" img-fluid blur-up lazyload">
                </div>
                <div class="decor-7 decor wow zoomIn" id="img-7">
                    <img src="{{ asset('assets_web/undraw_fitting_piece_re_pxay.svg') }}" alt="" class=" img-fluid blur-up lazyload">
                </div>
                <div class="decor-8 decor wow zoomIn" id="img-8">
                    <img src="{{ asset('assets_web/undraw_interior_design_re_7mvn.svg') }}" alt="" class=" img-fluid blur-up lazyload">
                </div>
                <div class="decor-9 decor wow zoomIn" id="img-9">
                    <img src="{{ asset('assets_web/undraw_work_in_progress_re_byic.svg') }}" alt="" class=" img-fluid blur-up lazyload">
                </div>
                <div class="decor-10 decor wow zoomIn" id="img-10">
                    <img src="{{ asset('assets_web/undraw_tasting_re_3k5a.svg') }}" alt="" class=" img-fluid blur-up lazyload">
                </div>
                <div class="decor-11 decor wow zoomIn" id="img-11">
                    <img src="{{ asset('assets_web/undraw_services_re_hu5n.svg') }}" alt="" class=" img-fluid blur-up lazyload">
                </div>
            </div>
        </div>
    </section>
    <!--home section end-->

    <!-- tap to top -->
    <div class="tap-top">
        <div>
            <i class="fa fa-angle-double-up"></i>
        </div>
    </div>
    <!-- tap to top End -->


    <!-- latest jquery-->
    <script src="{{ asset('assets_web/js/jquery-3.3.1.min.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ asset('assets_web/js/bootstrap.js') }}"></script>

    <!-- popper js-->
    <script src="{{ asset('assets_web/js/popper.min.js') }}"></script>

    <!-- wow js-->
    <script src="{{ asset('assets_web/js/wow.min.js') }}"></script>

    <!-- lazyload js-->
    <script src="{{ asset('assets_web/js/lazysizes.min.js') }}"></script>

    <!-- script js-->
    <script src="{{ asset('assets_web/js/landing-script.js') }}"></script>


    <script>
        new WOW().init();
    </script>

</body>
</html>
