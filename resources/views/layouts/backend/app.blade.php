<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Socioeconomic Dashboard</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    {{-- amcharts start --}}
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    {{-- amcharts end --}}

    {{-- highcharts end --}}
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    {{-- highcharts end --}}

    {{-- MODAL
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}

    @livewireStyles
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="{{ route('backend.about') }}"><img src="{{ asset('assets/img/logo.png') }}" /></a></h1>

            <nav id="navbar" class="navbar">
                <ul>
                    <li class="mx-4">
                        <div class="form-group has-search">
                            <span class="bx bx-search form-control-feedback"></span>
                            <input type="text" class="form-control" placeholder="Search" />
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle p-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span>
                                <p class="mb-0">Hi, <span class="fw-bold">{{ auth()->user()->name }}</span></p>
                            </span>
                            <img src="{{ asset('assets/img/avatar2.png') }}" width="40" height="40" class="rounded-circle mx-2" />
                        </a>
                        <ul>
                            <li><a href="#">User Profile</a></li>
                            <li><a href="#">Setting</a></li>
                            <li><a href="#">Manage Profile</a></li>
                            <li>@livewire('widgets.logout')</li>
                        </ul>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <main id="main">
        <section id="main-nav" class="main-nav">
            <div class="container" data-aos="fade-up">
                <div class="faq-list">
                    <ul>
                        <li data-aos="fade-up">
                            <a href="{{ route('backend.about') }}">
                                <div class="nav-title">
                                    <h6>
                                        <i class="bx bx-info-circle"></i>
                                        About
                                    </h6>
                                </div>
                            </a>
                        </li>
                        <li data-aos="fade-up">
                            <a href="{{ route('backend.education') }}">
                                <div class="nav-title">
                                    <h6>
                                        <i class="bx bxs-graduation"></i>
                                        Education
                                    </h6>
                                </div>
                            </a>
                        </li>
                        <li data-aos="fade-up">
                            <a data-bs-toggle="collapse" class="collapsed" data-bs-target="#faq-list-1">
                                <div class="nav-title-collapse">
                                    <h6>
                                        <i class="bx bxs-graduation"></i>
                                        Sample
                                    </h6>
                                    <div class="arrow">
                                        <i class="bx bxs-down-arrow icon-show"></i>
                                        <i class="bx bxs-down-arrow icon-close" data-aos="fade-up"></i>
                                    </div>
                                </div>
                            </a>
                            <div id="faq-list-1" class="collapse sub-collapse" data-bs-parent=".faq-list">
                                <div class="sub-alignment">
                                    <a>
                                        <div class="nav-title-sub sub-active">
                                            <h6>
                                                Overview of the Economy
                                            </h6>
                                        </div>
                                    </a>
                                    <a>
                                        <div class="nav-title-sub">
                                            <h6>
                                                Overseas Employment and Remittance
                                            </h6>
                                        </div>
                                    </a>
                                    <a>
                                        <div class="nav-title-sub">
                                            <h6>
                                                Import and Export
                                            </h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>

                        <li data-aos="fade-up">
                            <a>
                                <div class="nav-title">
                                    <h6>
                                        <i class="bx bx-stats"></i>
                                        Economy
                                    </h6>
                                </div>
                            </a>
                        </li>

                        <li data-aos="fade-up">
                            <a data-bs-toggle="collapse" class="collapsed" data-bs-target="#faq-list-2">
                                <div class="nav-title-collapse">
                                    <h6>
                                        <i class="bx bx-shield-alt-2"></i>
                                        Social Protection
                                    </h6>
                                    <div class="arrow">
                                        <i class="bx bxs-down-arrow icon-show"></i>
                                        <i class="bx bxs-down-arrow icon-close" data-aos="fade-up"></i>
                                    </div>
                                </div>
                            </a>
                            <div id="faq-list-2" class="collapse sub-collapse" data-bs-parent=".faq-list">
                                <div class="sub-alignment">
                                    <a>
                                        <div class="nav-title-sub sub-active">
                                            <h6>
                                                Overview of the Economy
                                            </h6>
                                        </div>
                                    </a>
                                    <a>
                                        <div class="nav-title-sub">
                                            <h6>
                                                Overseas Employment and Remittance
                                            </h6>
                                        </div>
                                    </a>
                                    <a>
                                        <div class="nav-title-sub">
                                            <h6>
                                                Import and Export
                                            </h6>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>

            </div>
        </section>

        @yield('content')
        @isset($slot) {{ $slot }} @endisset
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container py-4">
            <div class="text-center">
                <div class="copyright">
                    &copy; Copyright <strong><span>Socioeconomy</span></strong>. All Rights Reserved
                </div>
            </div>
        </div>
    </footer><!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>



    @livewireScripts
    <script>
        window.addEventListener('swal:modal', event => {
            swal({
                title: event.detail.message
                , text: event.detail.text
                , icon: event.detail.type
            , });
        });

    </script>
</body>

</html>
