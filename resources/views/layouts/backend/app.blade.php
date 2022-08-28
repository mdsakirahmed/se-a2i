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

    {{-- highcharts end --}}
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    {{-- <script src="https://code.highcharts.com/maps/highmaps.js"></script> --}}
    <script src="https://code.highcharts.com/maps/modules/map.js"></script>
    <script src="https://code.highcharts.com/modules/marker-clusters.js"></script>
    {{-- highcharts end --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.4.11/d3.min.js"></script>


    <style>
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        #container {
            height: 400px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

        .slidecontainer {
            width: 100%;
        }

        .slider {
            -webkit-appearance: none;
            width: 100%;
            height: 25px;
            background: #d3d3d3;
            outline: none;
            opacity: 0.7;
            -webkit-transition: .2s;
            transition: opacity .2s;
        }

        .slider:hover {
            opacity: 1;
        }

        .slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 25px;
            height: 25px;
            background: #04AA6D;
            cursor: pointer;
        }

        .slider::-moz-range-thumb {
            width: 25px;
            height: 25px;
            background: #04AA6D;
            cursor: pointer;
        }

        .range-label-container {
            display: flex;
            justify-content: space-between;

        }

        .range-label {
            text-align: center;
            flex: 0 0 25px;
            transform: rotate(-90deg);
        }

    </style>
    @livewireStyles
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="{{ route('backend.about') }}"><img src="{{ asset('assets/img/logo.png') }}" /></a></h1>

            <nav id="navbar" class="navbar">
                <ul>
                    <!-- <li class="mx-4">
                        <div class="form-group has-search">
                            <span class="bx bx-search form-control-feedback"></span>
                            <input type="text" class="form-control" placeholder="Search" />
                        </div>
                    </li> -->
                    <li class="mx-4">
                        <div class="lang-icon">
                            <div class="lang-text">@livewire('language-switcher')</div>
                            <img src="{{ asset('assets/img/uk-flag.png') }}" />
                            <img src="{{ asset('assets/img/bd-flag.png') }}" />
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle p-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span>
                                <p class="mb-0">Hi, <span class="fw-bold">{{ auth()->user()->name }}</span></p>
                            </span>
                            <i class="bx bx-user"></i>
                            <!-- <img src="{{ asset('assets/img/avatar2.png') }}" width="40" height="40" class="rounded-circle mx-2" /> -->
                        </a>
                        <ul>
                            <li><a href="#">User Profile</a></li>
                            <li><a href="#">Setting</a></li>
                            <li><a href="#">Manage Profile</a></li>
                            <li>@livewire('logout')</li>
                        </ul>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <main id="main">
        <section id="main-nav" class="fixed-top">
            <div class="container">
                <div class="main-nav">
                    <div class="container" data-aos="fade-up">
                        <div class="faq-list">
                            <ul>
                                <li data-aos="fade-up">
                                    <a href="{{ route('backend.about') }}">
                                        <div class="nav-title">
                                            <h6>
                                                <i class="bx bx-info-circle"></i>
                                                {{ __('About') }}
                                            </h6>
                                        </div>
                                    </a>
                                </li>
                                <li data-aos="fade-up">
                                    <a href="{{ route('backend.education') }}">
                                        <div class="nav-title">
                                            <h6>
                                                <i class="bx bxs-graduation"></i>
                                                {{ __('Education') }}
                                            </h6>
                                        </div>
                                    </a>
                                </li>
                                <li data-aos="fade-up">
                                    <a href="{{ route('backend.education') }}">
                                        <div class="nav-title">
                                            <h6>
                                                <i class="bx bxs-graduation"></i>
                                                {{ __('Education') }}
                                            </h6>
                                        </div>
                                    </a>
                                </li>
                                <li data-aos="fade-up">
                                    <a data-bs-toggle="collapse" class="collapsed" data-bs-target="#faq-list-1">
                                        <div class="nav-title-collapse">
                                            <h6>
                                                <i class="bx bx-stats"></i>
                                                {{ __('Economy') }}
                                            </h6>
                                            <div class="arrow">
                                                <i class="bx bxs-down-arrow icon-show"></i>
                                                <i class="bx bxs-down-arrow icon-close" data-aos="fade-up"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <div id="faq-list-1" class="collapse sub-collapse" data-bs-parent=".faq-list">
                                        <div class="sub-alignment">
                                            <a href="{{ route('backend.economy.overview_of_the_economy') }}">
                                                <div class="nav-title-sub sub-active">
                                                    <h6>
                                                        Overview of the Economy
                                                    </h6>
                                                </div>
                                            </a>
                                            <a href="{{ route('backend.economy.overseas_employment_and_remittance') }}">
                                                <div class="nav-title-sub">
                                                    <h6>
                                                        Overseas Employment and Remittance
                                                    </h6>
                                                </div>
                                            </a>
                                            <a href="{{ route('backend.economy.import_export') }}">
                                                <div class="nav-title-sub">
                                                    <h6>
                                                        Import and Export
                                                    </h6>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    </a>
                                    <div id="faq-list-1" class="collapse sub-collapse" data-bs-parent=".faq-list">
                                        <div class="sub-alignment">
                                            <a href="{{ route('backend.economy.overview_of_the_economy') }}">
                                                <div class="nav-title-sub sub-active">
                                                    <h6>
                                                        Overview of the Economy
                                                    </h6>
                                                </div>
                                            </a>
                                            <a href="{{ route('backend.economy.overseas_employment_and_remittance') }}">
                                                <div class="nav-title-sub">
                                                    <h6>
                                                        Overseas Employment and Remittance
                                                    </h6>
                                                </div>
                                            </a>
                                            <a href="{{ route('backend.economy.import_export') }}">
                                                <div class="nav-title-sub">
                                                    <h6>
                                                        Import and Export
                                                    </h6>
                                                </div>
                                            </a>
                                            <a href="{{ route('backend.economy.banking_and_finance') }}">
                                                <div class="nav-title-sub">
                                                    <h6>
                                                        Banking and Finance
                                                    </h6>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </li>

                                <li data-aos="fade-up">
                                    <a data-bs-toggle="collapse" class="collapsed" data-bs-target="#faq-list-2">
                                        <div class="nav-title-collapse">
                                            <h6>
                                                <i class="bx bx-shield-alt-2"></i>
                                                {{ __('Social Protection') }}
                                            </h6>
                                            <div class="arrow">
                                                <i class="bx bxs-down-arrow icon-show"></i>
                                                <i class="bx bxs-down-arrow icon-close" data-aos="fade-up"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <div id="faq-list-2" class="collapse sub-collapse" data-bs-parent=".faq-list">
                                        <div class="sub-alignment">
                                            <a href="{{ route('backend.social_protection.index') }}">
                                                <div class="nav-title-sub sub-active">
                                                    <h6>
                                                        {{ __('Social Protection') }}
                                                    </h6>
                                                </div>
                                            </a>
                                            <a href="{{ route('backend.social_protection.food_security') }}">
                                                <div class="nav-title-sub sub-active">
                                                    <h6>
                                                        {{ __('Food Security') }}
                                                    </h6>
                                                </div>
                                            </a>
                                            <a href="{{ route('backend.social_protection.budget_and_coverage') }}">
                                                <div class="nav-title-sub sub-active">
                                                    <h6>
                                                        {{ __('Budget and Coverage') }}
                                                    </h6>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>

        </section>

        @yield('content')
        @isset($slot) {{ $slot }} @endisset
    </main><!-- End #main -->

    @livewire('edit-chart')

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
    @stack('scripts')
    <script>
        window.addEventListener('swal:modal', event => {
            swal({
                title: event.detail.message
                , text: event.detail.text
                , icon: event.detail.type
            , });
        });
        window.addEventListener('refresh-page', event => {
            window.location.reload(true);
        });

    </script>
</body>

</html>
