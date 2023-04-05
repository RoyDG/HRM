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

<body class="body-scroll d-flex flex-column h-100 theme-pink" data-page="signup">

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
    <main class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-11 col-sm-11 col-md-6 col-lg-5 col-xl-3 mx-auto align-self-center py-4">
                <h2 class="mb-4"><span class="text-secondary fw-light">Create</span><br />new account</h2>
                <div class="form-floating mb-3">
                    <select class="form-control is-valid" id="country">
                        <option selected>United States (+1)</option>
                        <option>United Kingdoms (+44)</option>
                    </select>
                    <label for="country">Contry</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control is-valid" value="info@maxartkiller.com" placeholder="Email or Phone" id="emailphone">
                    <label for="emailphone">Email or Phone</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control is-valid" value="maxartkiller" placeholder="Username" id="username">
                    <label for="username">Username</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control is-valid" value="asdasdasdsd" placeholder="Password" id="password">
                    <label for="password">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control is-invalid " placeholder="Confirm Password" id="confirmpassword">
                    <label for="confirmpassword">Confirm Password</label>
                    <button type="button" class="btn btn-link text-danger tooltip-btn" data-bs-toggle="tooltip" data-bs-placement="left" title="Enter valid Password" id="passworderror">
                        <i class="bi bi-info-circle"></i>
                    </button>
                </div>
                <p class="mb-3"><span class="text-muted">By clicking on Sign up button, you are agree to the our </span>
                    <a href="">Terms and Conditions</a>
                </p>
            </div>
            <div class="col-11 col-sm-11 mt-auto mx-auto py-4">
                <div class="row ">
                    <div class="col-12 d-grid">
                        <a href="verify.php" class="btn btn-default btn-lg shadow-sm btn-rounded">Sign Up</a>
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