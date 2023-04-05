<!doctype html>
<html lang="en" class="h-100">

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

    <!-- style css for this template -->
    <link href="assets/scss/style.css" rel="stylesheet" id="style">
</head>

<body class="body-scroll d-flex flex-column h-100 theme-pink" data-page="verify">

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

    <!-- Header -->
    <header class="header position-fixed header-filled">
        <div class="row">
            <div class="col">
                <div class="logo-small">
                    <img src="assets/img/logo.png" alt="" class="rounded-circle" />
                    <h5>OneUIUX<br /><span class="text-secondary fw-light">Shopping</span></h5>
                </div>
            </div>
            <div class="col-auto">
                <a href="signin.php" target="_self">
                    Sign in
                </a>
            </div>
        </div>
    </header>
    <!-- Header ends -->

    <!-- Begin page content -->
    <main class="container-fluid h-100 ">
        <div class="row h-100">
            <div class="col-11 col-sm-11 col-md-6 col-lg-5 col-xl-3 mx-auto align-self-center py-4">
                <h1 class="mb-3"><span class="text-secondary fw-light">Verify your</span><br />Email ID</h1>
                <p class="text-secondary mb-4">We have send you an email with OTP with instruction.</p>

                <div class="form-group form-floating mb-3 is-valid">
                    <input type="text" class="form-control" value="125486" id="OTP" placeholder="Enter OTP">
                    <label class="form-control-label" for="OTP">Enter OTP</label>
                </div>
            </div>
            <div class="col-11 col-sm-11 mt-auto mx-auto py-4">
                <div class="row ">
                    <div class="col-auto text-center mx-auto">
                        <span class="progressstimer">
                            <img src="assets/img/progress.png" alt="">
                            <span class="timer" id="timer">0:30</span>
                        </span>
                        <br />
                        <p class="mb-3"><span class="text-muted">Didn't received yet?</span> <a href="">Resend OTP</a>
                        </p>
                    </div>
                    <div class="col-12 d-grid">
                        <a href="thankyou2.php" class="btn btn-default btn-lg shadow-sm btn-rounded">Verify Account</a>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <!-- Required jquery and libraries -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/vendor/bootstrap-5/js/bootstrap.bundle.min.js"></script>

    <!-- Customized jquery file  -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/color-scheme.js"></script>

    <!-- PWA app service registration and works -->
    <script src="assets/js/pwa-services.js"></script>

    <!-- page level custom script -->
    <script src="assets/js/app.js"></script>
</body>

</html>