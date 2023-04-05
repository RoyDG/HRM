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
            <div class="row">
                <div class="col-12 mb-3">
                    <div class="rounded d-block overlfow-hidden">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d53231.962811927515!2d-117.15726395005734!3d33.5014375970648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80db6252f51abe23%3A0x68bc0e88a03806a8!2sTemecula%2C%20CA%2C%20USA!5e0!3m2!1sen!2sin!4v1623665123540!5m2!1sen!2sin" class="h-190 w-100 rounded shadow-sm" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 mx-auto">
                    <div class="card card-light shadow-sm mb-4">
                        <div class="card-body">
                            <form class="">

                                <div class="form-floating mb-3">
                                    <select class="form-select form-control" id="select">
                                        <option>Austrailia</option>
                                        <option>Austria</option>
                                        <option>Brazil</option>
                                        <option>Bulgaria</option>
                                        <option>Chile</option>
                                        <option>Canada</option>
                                        <option>Egypt</option>
                                        <option>Germany</option>
                                        <option>India</option>
                                        <option>United Kingdom</option>
                                        <option selected>United Stats</option>
                                    </select>
                                    <label for="select">Country</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="pincode" placeholder="Pincode" value="55685246">
                                    <label for="pincode">Pincode</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select form-control" id="select2">
                                        <option selected>California</option>
                                        <option>San Jose</option>
                                        <option>New York</option>
                                    </select>
                                    <label for="select2">States</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="city" placeholder="City" value="San Jose">
                                    <label for="city">City</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="street" placeholder="Street" value="San Carlos - 23B">
                                    <label for="city">Street</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="homeblock" placeholder="Home/Block" value="B 15">
                                    <label for="city">Home/Block</label>
                                </div>
                            </form>
                            <div class="d-grid"><a href="addaddress.php" class="btn btn-lg btn-default shadow-sm btn-rounded">Add/Update</a></div>
                        </div>
                    </div>
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