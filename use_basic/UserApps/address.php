<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>oneuiux V2.0 - Mobile HTML template</title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="manifest" href="manifest.json" />

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="assets/img/favicon180.png" sizes="180x180">
    <link rel="icon" href="assets/img/favicon32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="assets/img/favicon16.png" sizes="16x16" type="image/png">

    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- swiper carousel css -->
    <link rel="stylesheet" href="assets/vendor/swiperjs-6.6.2/swiper-bundle.min.css">

    <!-- style css for this template -->
    <link href="assets/scss/style.css" rel="stylesheet" id="style">
</head>

<body class="body-scroll theme-pink" data-page="">

    <!-- loader section -->
    <div class="container-fluid loader-wrap">
        <div class="row h-100">
            <div class="col-10 col-md-6 col-lg-5 col-xl-3 mx-auto text-center align-self-center">
                <div class="circular-loader">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <p class="mt-4"><span class="text-secondary">Shopping Experience Unlimited</span><br><strong>Please
                        wait...</strong></p>
            </div>
        </div>
    </div>
    <!-- loader section ends -->

    <!-- Begin page -->
    <main class="h-100">

        <!-- Header -->
        <header class="header position-fixed header-filled">
            <div class="row">
                <div class="col-auto">
                    <button type="button" class="btn btn-light btn-44 back-btn btn-rounded">
                        <i class="bi bi-arrow-left"></i>
                    </button>
                </div>
                <div class="col">
                    <div class="logo-small rounded-circle">
                        <img src="assets/img/logo.png" alt="" class="rounded-circle" />
                        <h5>OneUIUX<br /><span class="text-secondary fw-light">Shopping</span></h5>
                    </div>
                </div>
                <div class="col-auto">
                    <a href="profile.php" target="_self" class="btn btn-light btn-44 btn-rounded">
                        <i class="bi bi-person-circle"></i>
                        <span class="count-indicator"></span>
                    </a>
                </div>
            </div>
        </header>
        <!-- Header ends -->

        <!-- main page content -->
        <div class="main-container container">
            <!-- addresss -->
            <div class="row mb-3">
                <div class="col align-self-center">
                    <h6 class="title">Address Details</h6>
                </div>
                <div class="col-auto">
                    <a href="addresses.php" class="small">Change <i class="bi bi-chevron-right vm"></i></a>
                </div>
            </div>

            <!-- selected address -->
            <div class="row mb-2">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card shadow-sm mb-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col align-self-center">
                                    <h6 class="mb-0">Maxartkiller<br />
                                        <span class="text-secondary size-12 fw-light">Primary</span>
                                    </h6>
                                </div>
                                <div class="col-auto align-self-center">
                                    <a href="addaddress.php" class="btn btn-44 btn-light"><i class="bi bi-pencil "></i></a>
                                    <a href="addaddress.php" class="btn btn-44 btn-light"><i class="bi bi-plus size-24"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <img src="assets/img/map@2x.png" alt="" class="mw-100 mb-3" />
                            <div class="row">
                                <div class="col text-secondary">
                                    B 32, maker street 4, Beside Train Tower, Algobbaalsa,<br>California- 25468 (US)
                                </div>
                                <div class="col-auto text-end">
                                    <i class="bi bi-arrow-up-right-circle text-color-theme size-22"></i><br>
                                    <small class="text-secondary">2.5km <i class="bi bi-geo-alt"></i></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- pricing -->
            <div class="row mb-4">
                <div class="col align-self-center">
                    <h6 class="title">Pricing</h6>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <p>Shipping Cost</p>
                </div>
                <div class="col-auto">$ 10.00</div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <p>Subtotal</p>
                </div>
                <div class="col-auto">$ 32.00</div>
            </div>
            <div class="row fw-bold mb-4">
                <div class="mb-3 col-12">
                    <div class="dashed-line"></div>
                </div>
                <div class="col">
                    <p>Total</p>
                </div>
                <div class="col-auto">$ 42.00</div>
            </div>
            <div class="row mb-4">
                <div class="col-12">
                    <a href="payment.php" class="btn btn-default shadow-sm btn-lg w-100 btn-rounded">Payment</a>
                </div>
            </div>
        </div>
        <!-- main page content ends -->


    </main>
    <!-- Page ends-->


    <!-- Required jquery and libraries -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/vendor/bootstrap-5/js/bootstrap.bundle.min.js"></script>

    <!-- Customized jquery file  -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/color-scheme.js"></script>

    <!-- PWA app service registration and works -->
    <script src="assets/js/pwa-services.js"></script>

    <!-- Chart js script -->
    <script src="assets/vendor/chart-js-3.3.1/chart.min.js"></script>

    <!-- Progress circle js script -->
    <script src="assets/vendor/progressbar-js/progressbar.min.js"></script>

    <!-- swiper js script -->
    <script src="assets/vendor/swiperjs-6.6.2/swiper-bundle.min.js"></script>

    <!-- page level custom script -->
    <script src="assets/js/app.js"></script>

</body>

</html>