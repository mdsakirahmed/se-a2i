<?php

 $baseurl="http://design.test/";
 
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Socioeconomic Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo $baseurl; ?>assets/img/favicon.png" rel="icon">
  <link href="<?php echo $baseurl; ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo $baseurl; ?>assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="<?php echo $baseurl; ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo $baseurl; ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php echo $baseurl; ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo $baseurl; ?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="<?php echo $baseurl; ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php echo $baseurl; ?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <link href="<?php echo $baseurl; ?>assets/css/style.css" rel="stylesheet">
  <link href="<?php echo $baseurl; ?>assets/css/main.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="index.html"><img src="<?php echo $baseurl; ?>assets/img/logo.png"/></a></h1>

      <nav id="navbar" class="navbar">
        <ul>
          <li class="mx-4">
            <div class="form-group has-search">
              <span class="bx bx-search form-control-feedback"></span>
              <input type="text" class="form-control" placeholder="Search"/>
            </div>
          </li>
          <li class="dropdown">
            <a class="nav-link dropdown-toggle p-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span><p class="mb-0">Hi, <span class="fw-bold">Maruf Huq</span></p></span>
              <img src="<?php echo $baseurl; ?>assets/img/avatar2.png" width="40" height="40" class="rounded-circle mx-2"/>
            </a>
            <ul>
              <li><a href="#">User Profile</a></li>
              <li><a href="#">Setting</a></li>
              <li><a href="#">Manage Profile</a></li>
              <li><a href="#">Log Out</a></li>
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
              <a>
                <div class="nav-title">
                  <h6>
                    <i class="bx bx-info-circle"></i>
                    About
                  </h6>
                </div>
              </a>
            </li>
            <li data-aos="fade-up">
                <a data-bs-toggle="collapse" class="collapsed" data-bs-target="#faq-list-1">
                  <div class="nav-title-collapse">
                    <h6>
                      <i class="bx bxs-graduation"></i>
                      Education
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

    <section id="about">
      <div class="content-area">
        <div class="container">
          <header>
            <h3>
              About Dashboard
            </h3>
          </header>
          <div class="card">
            <div class="block-group">
              <div class="block-70">
                <p class="mb-md-4">
                  <span class="c-primary fw-bold">The National Socioeconomic Dashboard</span>
                  is a policy-making critical tool that serves as a nexus between
                  policymakers and practitioners. It leverages government datasets to work as decision-making action items
                  that can be time-sensitive as well as demand driven through modular and intuitive visualizations.
                  The project is born of a goal to make official data on Bangladesh more accessible and easy-to-digest—to
                  make their insights seamlessly integrate into important policy conversations.
                </p>
                <p>
                  <span class="c-secondary fw-bold">Bangladesh</span>
                  is advancing in Sustainable Development Goals (SDGs). The aim of the Socioeconomic Dashboard is
                  to accelerate the growth of SDGs by assisting in policy implicating decision making. The dashboard will
                  serve the stakeholders in all sectors identified by experts that have a demand-driven approach to it.
                </p>
              </div>
              <div class="block-30">
                <img src="<?php echo $baseurl; ?>assets/img/about.png"/>
              </div>
            </div>
          </div>
          <div class="card-primary">
            <p>
              The poverty rate of Bangladesh fell by 1.3% points to 20.5% in FY-2019 which was estimated in FY-2018
              as 21.8% (Source: Bangladesh Bureau of Statistics, 2019).
            </p>
          </div>
          <div id="dataConcept">
            <header>
              <h3>
                Data and Policy Making Concept
              </h3>
            </header>
            <div class="block-group mt-5">
              <div class="block">
                <div class="desktop">
                  <img src="<?php echo $baseurl; ?>assets/img/demo.png"/>
                </div>
                <div class="mobile">
                  <img src="<?php echo $baseurl; ?>assets/img/demo-moblie.png"/>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

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
  <script src="<?php echo $baseurl; ?>assets/vendor/aos/aos.js"></script>
  <script src="<?php echo $baseurl; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo $baseurl; ?>assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?php echo $baseurl; ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?php echo $baseurl; ?>assets/vendor/php-email-form/validate.js"></script>
  <script src="<?php echo $baseurl; ?>assets/vendor/purecounter/purecounter.js"></script>
  <script src="<?php echo $baseurl; ?>assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo $baseurl; ?>assets/js/main.js"></script>

</body>

</html>
