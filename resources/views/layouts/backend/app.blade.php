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
    <script src="https://code.highcharts.com/modules/treemap.js"></script>
    {{-- highcharts end --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.4.11/d3.min.js"></script>

    <style>
        .highcharts-figure,
        .highcharts-data-table table {
            width: 100%;
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
            position: relative;
            height: 12px;
            margin: 15px 0;
        }

        .slider {
            -webkit-appearance: none;
            width: 100%;
            height: 12px;
            outline: none;
            opacity: 0.2;
            -webkit-transition: .2s;
            transition: opacity .2s;
            position: absolute;
            top: 0;
            z-index: 2;
        }

        /*.slider:hover {*/
        /*    opacity: 1;*/
        /*} */

        #chart_id_22 .highcharts-series-label {
            display: none;
        }

        #chart_id_18 .highcharts-series-label {
            display: none;
        }

        #chart_id_6 .highcharts-series-label {
            display: none;
        }

        #chart_id_7 .highcharts-series-label {
            display: none;
        }

        #chart_id_8 .highcharts-series-label {
            display: none;
        }

        #chart_id_44 .highcharts-series-label {
            display: none;
        }

        .card-body select {
            display: inline-block;
            margin-right: 20px;
            margin-bottom: 20px;
            min-width: 150px;
            max-width: 240px;
            padding: 0.375rem 0.75rem 0.375rem 0.75rem;
            -moz-padding-start: calc(0.75rem - 3px);
            font-size: 0.9rem;
            font-weight: 400;
            line-height: 1.5;
            color: #646e78;
            background-color: rgb(199 205 215 / 25%);`
            background-image: url(data:image/svg+xml,%3csvg xmlns= 'http://www.w3.org/2000/svg' viewBox= '0 0 16 16' %3e%3cpath fill= 'none' stroke= '%23343a40' stroke-linecap= 'round' stroke-linejoin= 'round' stroke-width= '2' d= 'M2 5l6 6 6-6' /%3e%3c/svg%3e);
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
            border: 1px solid #ced4da;
            border-radius: 1rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }
        .col-form-label {
            font-size: 0.85em;
            font-weight: 500;
            margin-bottom: 5px;
        }

    </style>
    @livewireStyles
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="{{ route('backend.about') }}"><img src="{{ asset('assets/img/logo.png') }}" /></a>
            </h1>

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
                            @if(App::isLocale('en'))
                            <img src="{{ asset('assets/img/uk-flag.png') }}" />
                            @else
                            <img src="{{ asset('assets/img/bd-flag.png') }}" />
                            @endif
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
                            @can('role permission management')<li><a href="{{ route('backend.role_permission') }}">Permission Module</a></li>@endcan
                            @can('user management')<li><a href="{{ route('backend.user_management') }}">User Module</a></li> @endcan
                            <li><a href="{{ route('backend.profile') }}">My Profile</a></li>
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
                                        <div class="nav-title @if(request()->routeIs('backend.about')) nav-title-active @endif">
                                            <h6>
                                                <i class="bx bx-info-circle"></i>
                                                {{ __('About') }}
                                            </h6>
                                        </div>
                                    </a>
                                </li>
                                <li data-aos="fade-up">
                                    <a href="{{ route('backend.education') }}">
                                        <div class="nav-title @if(request()->routeIs('backend.education')) nav-title-active @endif">
                                            <h6>
                                                <i class="bx bxs-graduation"></i>
                                                {{ __('Education') }}
                                            </h6>
                                        </div>
                                    </a>
                                </li>
                                <li data-aos="fade-up">
                                    <a data-bs-toggle="collapse" class="collapsed" data-bs-target="#faq-list-1">
                                        <div class="nav-title-collapse @if(request()->is('backend/economy/*')) nav-title-collapse-active @endif">
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
                                    <div id="faq-list-1" class="collapse sub-collapse @if(request()->is('backend/economy/*')) show @endif" data-bs-parent=".faq-list">
                                        <div class="sub-alignment">
                                            <a href="{{ route('backend.economy.overview_of_the_economy') }}">
                                                <div class="nav-title-sub @if(request()->routeIs('backend.economy.overview_of_the_economy')) sub-active @endif">
                                                    <h6>
                                                        {{ __('Overview of the Economy') }}
                                                    </h6>
                                                </div>
                                            </a>
                                            <a href="{{ route('backend.economy.overseas_employment_and_remittance') }}">
                                                <div class="nav-title-sub @if(request()->routeIs('backend.economy.overseas_employment_and_remittance')) sub-active @endif">
                                                    <h6>
                                                        {{ __('Overseas Employment and Remittance') }}
                                                    </h6>
                                                </div>
                                            </a>
                                            <a href="{{ route('backend.economy.import_export') }}">
                                                <div class="nav-title-sub @if(request()->routeIs('backend.economy.import_export')) sub-active @endif">
                                                    <h6>
                                                        {{ __('Import and Export') }}
                                                    </h6>
                                                </div>
                                            </a>
                                            <a href="{{ route('backend.economy.banking_and_finance') }}">
                                                <div class="nav-title-sub @if(request()->routeIs('backend.economy.banking_and_finance')) sub-active @endif">
                                                    <h6>
                                                        {{ __('Banking and Finance') }}
                                                    </h6>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li data-aos="fade-up">
                                    <a data-bs-toggle="collapse" class="collapsed" data-bs-target="#faq-list-3">
                                        <div class="nav-title-collapse">
                                            <h6>
                                                <i class="bx bx-heart"></i>
                                                {{ __('Health') }}
                                            </h6>
                                            <div class="arrow">
                                                <i class="bx bxs-down-arrow icon-show"></i>
                                                <i class="bx bxs-down-arrow icon-close" data-aos="fade-up"></i>
                                            </div>
                                        </div>
                                    </a>
                                    <div id="faq-list-3" class="collapse sub-collapse" data-bs-parent=".faq-list">
                                        <div class="sub-alignment">
                                            <a href="{{ route('backend.health.child-mortality') }}">
                                                <div class="nav-title-sub @if(request()->routeIs('backend.health.child-mortality')) sub-active @endif">
                                                    <h6>
                                                        {{ __('Child Mortality') }}
                                                    
                                                    </h6>
                                                </div>
                                            </a>
                                            <a href="{{ route('backend.health.causes-of-death') }}">
                                                <div class="nav-title-sub  @if(request()->routeIs('backend.health.causes-of-death')) sub-active @endif">
                                                    <h6>
                                                        {{ __('Causes of Death') }}
                                                    
                                                    </h6>
                                                </div>
                                            </a>
                                            <a href="{{ route('backend.health.maternal-and-child-health-service') }}">
                                                <div class="nav-title-sub  @if(request()->routeIs('backend.health.maternal-and-child-health-service')) sub-active @endif">
                                                    <h6>
                                                        {{ __('Maternal/Child Health Services') }}
                                                    
                                                    </h6>
                                                </div>
                                            </a>
                                             <a href="{{ route('backend.health.sdg-analytic-hub') }}">
                                                <div class="nav-title-sub @if(request()->routeIs('backend.health.sdg-analytic-hub')) sub-active @endif">
                                                    <h6>
                                                        {{ __('SDG Analytic Hub') }}                                                   
                                                    </h6>
                                                </div>
                                            </a> 
                                        </div>
                                    </div>
                                </li>
                                <li data-aos="fade-up">
                                    <a data-bs-toggle="collapse" class="collapsed" data-bs-target="#faq-list-2">
                                        <div class="nav-title-collapse @if(request()->is('backend/social-protection/*')) nav-title-collapse-active @endif">
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
                                    <div id="faq-list-2" class="collapse sub-collapse @if(request()->is('backend/social-protection/*')) show @endif" data-bs-parent=".faq-list">
                                        <div class="sub-alignment">
                                            <a href="{{ route('backend.social_protection.index') }}">
                                                <div class="nav-title-sub @if(request()->routeIs('backend.social_protection.index')) sub-active @endif">
                                                    <h6>
                                                        {{ __('Social Protection') }}
                                                    </h6>
                                                </div>
                                            </a>
                                            <a href="{{ route('backend.social_protection.food_security') }}">
                                                <div class="nav-title-sub @if(request()->routeIs('backend.social_protection.food_security')) sub-active @endif">
                                                    <h6>
                                                        {{ __('Food Security') }}
                                                    </h6>
                                                </div>
                                            </a>
                                            <a href="{{ route('backend.social_protection.budget_and_coverage') }}">
                                                <div class="nav-title-sub @if(request()->routeIs('backend.social_protection.budget_and_coverage')) sub-active @endif">
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
