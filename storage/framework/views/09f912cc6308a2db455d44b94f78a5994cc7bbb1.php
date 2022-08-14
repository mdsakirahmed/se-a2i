<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Socioeconomic Dashboard</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?php echo e(asset('assets/img/favicon.png')); ?>" rel="icon">
    <link href="<?php echo e(asset('assets/img/apple-touch-icon.png')); ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo e(asset('assets/vendor/aos/aos.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/boxicons/css/boxicons.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/glightbox/css/glightbox.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/remixicon/remixicon.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/vendor/swiper/swiper-bundle.min.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('assets/css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/css/main.css')); ?>" rel="stylesheet">

    
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    

    
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
    </style>
    <?php echo \Livewire\Livewire::styles(); ?>

</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo"><a href="<?php echo e(route('backend.about')); ?>"><img src="<?php echo e(asset('assets/img/logo.png')); ?>" /></a></h1>

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
                            <div class="lang-text"><?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('language-switcher')->html();
} elseif ($_instance->childHasBeenRendered('90uwaWC')) {
    $componentId = $_instance->getRenderedChildComponentId('90uwaWC');
    $componentTag = $_instance->getRenderedChildComponentTagName('90uwaWC');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('90uwaWC');
} else {
    $response = \Livewire\Livewire::mount('language-switcher');
    $html = $response->html();
    $_instance->logRenderedChild('90uwaWC', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?></div>
                            <img src="<?php echo e(asset('assets/img/uk-flag.png')); ?>"/>
                            <img src="<?php echo e(asset('assets/img/bd-flag.png')); ?>"/>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link dropdown-toggle p-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span>
                                <p class="mb-0">Hi, <span class="fw-bold"><?php echo e(auth()->user()->name); ?></span></p>
                            </span>
                            <i class="bx bx-user"></i>
                            <!-- <img src="<?php echo e(asset('assets/img/avatar2.png')); ?>" width="40" height="40" class="rounded-circle mx-2" /> -->
                        </a>
                        <ul>
                            <li><a href="#">User Profile</a></li>
                            <li><a href="#">Setting</a></li>
                            <li><a href="#">Manage Profile</a></li>
                            <li><?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('logout')->html();
} elseif ($_instance->childHasBeenRendered('Nn1kvoF')) {
    $componentId = $_instance->getRenderedChildComponentId('Nn1kvoF');
    $componentTag = $_instance->getRenderedChildComponentTagName('Nn1kvoF');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('Nn1kvoF');
} else {
    $response = \Livewire\Livewire::mount('logout');
    $html = $response->html();
    $_instance->logRenderedChild('Nn1kvoF', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?></li>
                        </ul>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <main id="main">
        <section id="main-nav">
        <div class="container">
            <div class="main-nav">
                <div class="container" data-aos="fade-up">
                    <div class="faq-list">
                        <ul>
                            <li data-aos="fade-up">
                                <a href="<?php echo e(route('backend.about')); ?>">
                                    <div class="nav-title">
                                        <h6>
                                            <i class="bx bx-info-circle"></i>
                                            <?php echo e(__('About')); ?>

                                        </h6>
                                    </div>
                                </a>
                            </li>
                            <li data-aos="fade-up">
                                <a href="<?php echo e(route('backend.education')); ?>">
                                    <div class="nav-title">
                                        <h6>
                                            <i class="bx bxs-graduation"></i>
                                            <?php echo e(__('Education')); ?>

                                        </h6>
                                    </div>
                                </a>
                            </li>
                            <li data-aos="fade-up">
                                <a data-bs-toggle="collapse" class="collapsed" data-bs-target="#faq-list-1">
                                    <div class="nav-title-collapse">
                                        <h6>
                                            <i class="bx bx-stats"></i>
                                            <?php echo e(__('Economy')); ?>

                                        </h6>
                                        <div class="arrow">
                                            <i class="bx bxs-down-arrow icon-show"></i>
                                            <i class="bx bxs-down-arrow icon-close" data-aos="fade-up"></i>
                                        </div>
                                    </div>
                                </a>
                                <div id="faq-list-1" class="collapse sub-collapse" data-bs-parent=".faq-list">
                                    <div class="sub-alignment">
                                        <a href="<?php echo e(route('backend.economy.overview_of_the_economy')); ?>">
                                            <div class="nav-title-sub sub-active">
                                                <h6>
                                                    Overview of the Economy
                                                </h6>
                                            </div>
                                        </a>
                                        <a href="<?php echo e(route('backend.economy.overseas_employment_and_remittance')); ?>">
                                            <div class="nav-title-sub">
                                                <h6>
                                                    Overseas Employment and Remittance
                                                </h6>
                                            </div>
                                        </a>
                                        <a href="<?php echo e(route('backend.economy.import_export')); ?>">
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
                                    <a href="<?php echo e(route('backend.economy.overview_of_the_economy')); ?>">
                                        <div class="nav-title-sub sub-active">
                                            <h6>
                                                Overview of the Economy
                                            </h6>
                                        </div>
                                    </a>
                                    <a href="<?php echo e(route('backend.economy.overseas_employment_and_remittance')); ?>">
                                        <div class="nav-title-sub">
                                            <h6>
                                                Overseas Employment and Remittance
                                            </h6>
                                        </div>
                                    </a>
                                    <a href="<?php echo e(route('backend.economy.import_export')); ?>">
                                        <div class="nav-title-sub">
                                            <h6>
                                                Import and Export
                                            </h6>
                                        </div>
                                    </a>
                                    <a href="<?php echo e(route('backend.economy.banking_and_finance')); ?>">
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
                                        <?php echo e(__('Social Protection')); ?>

                                    </h6>
                                    <div class="arrow">
                                        <i class="bx bxs-down-arrow icon-show"></i>
                                        <i class="bx bxs-down-arrow icon-close" data-aos="fade-up"></i>
                                    </div>
                                </div>
                            </a>
                            <div id="faq-list-2" class="collapse sub-collapse" data-bs-parent=".faq-list">
                                <div class="sub-alignment">
                                    <a href="<?php echo e(route('backend.social_protection.index')); ?>">
                                        <div class="nav-title-sub sub-active">
                                            <h6>
                                                <?php echo e(__('Social Protection')); ?>

                                            </h6>
                                        </div>
                                    </a>
                                    <a href="<?php echo e(route('backend.social_protection.food_security')); ?>">
                                        <div class="nav-title-sub sub-active">
                                            <h6>
                                                <?php echo e(__('Food Security')); ?>

                                            </h6>
                                        </div>
                                    </a>
                                    <a href="<?php echo e(route('backend.social_protection.budget_and_coverage')); ?>">
                                        <div class="nav-title-sub sub-active">
                                            <h6>
                                                <?php echo e(__('Budget and Coverage')); ?>

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

        <?php echo $__env->yieldContent('content'); ?>
        <?php if(isset($slot)): ?> <?php echo e($slot); ?> <?php endif; ?>
    </main><!-- End #main -->
    
    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('edit-chart')->html();
} elseif ($_instance->childHasBeenRendered('y5HkV6k')) {
    $componentId = $_instance->getRenderedChildComponentId('y5HkV6k');
    $componentTag = $_instance->getRenderedChildComponentTagName('y5HkV6k');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('y5HkV6k');
} else {
    $response = \Livewire\Livewire::mount('edit-chart');
    $html = $response->html();
    $_instance->logRenderedChild('y5HkV6k', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

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
    <script src="<?php echo e(asset('assets/vendor/aos/aos.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/glightbox/js/glightbox.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/php-email-form/validate.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/purecounter/purecounter.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/vendor/swiper/swiper-bundle.min.js')); ?>"></script>

    <!-- Template Main JS File -->
    <script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>
    <?php echo \Livewire\Livewire::scripts(); ?>

    <?php echo $__env->yieldPushContent('scripts'); ?>
    <script>
     window.addEventListener('swal:modal', event => {
         swal({
             title: event.detail.message,
             text: event.detail.text,
             icon: event.detail.type,
         });
     });
 </script>
</body>

</html>
<?php /**PATH /var/www/html/design/resources/views/layouts/backend/app.blade.php ENDPATH**/ ?>