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

    <!-- Sidebar main menu -->
    <div class="sidebar-wrap  sidebar-overlay">
        <!-- Add pushcontent or fullmenu instead overlay -->
        <div class="closemenu text-secondary">Close Menu</div>
        <div class="sidebar ">
            <!-- user information -->
            <div class="row">
                <div class="col-12 profile-sidebar">
                    <div class="row">
                        <div class="col-auto">
                            <figure class="avatar avatar-100 rounded-20 shadow-sm">
                                <img src="assets/img/user1.jpg" alt="">
                            </figure>
                        </div>
                        <div class="col px-0 align-self-center">
                            <h5 class="mb-2">John Winsels</h5>
                            <p class="text-muted size-12">New York City,<br />United States</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- user emnu navigation -->
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">
                                <div class="avatar avatar-40 icon"><i class="bi bi-house-door"></i></div>
                                <div class="col">Shop</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                <div class="avatar avatar-40 icon"><i class="bi bi-cart"></i></div>
                                <div class="col">Shop pages</div>
                                <div class="arrow"><i class="bi bi-chevron-down plus"></i> <i class="bi bi-chevron-up minus"></i>
                                </div>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item nav-link" href="products.php">
                                        <div class="avatar avatar-40 icon"><i class="bi bi-box-seam"></i>
                                        </div>
                                        <div class="col align-self-center">All Products</div>
                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item nav-link" href="product.php">
                                        <div class="avatar avatar-40 icon"><i class="bi bi-box-seam"></i>
                                        </div>
                                        <div class="col align-self-center">Product</div>
                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item nav-link" href="cart.php">
                                        <div class="avatar avatar-40 icon"><i class="bi bi-bag"></i>
                                        </div>
                                        <div class="col align-self-center">Cart</div>
                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item nav-link" href="myorders.php">
                                        <div class="avatar avatar-40 icon"><i class="bi bi-view-list"></i>
                                        </div>
                                        <div class="col align-self-center">My Orders</div>
                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item nav-link" href="payment.php">
                                        <div class="avatar avatar-40 icon"><i class="bi bi-cash-stack"></i>
                                        </div>
                                        <div class="col align-self-center">Payment</div>
                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item nav-link" href="invoice.php">
                                        <div class="avatar avatar-40 icon"><i class="bi bi-receipt"></i>
                                        </div>
                                        <div class="col align-self-center">Invoice</div>
                                        <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="chat.php" tabindex="-1">
                                <div class="avatar avatar-40 icon"><i class="bi bi-chat-text"></i></div>
                                <div class="col">Messages</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="notifications.php" tabindex="-1">
                                <div class="avatar avatar-40 icon"><i class="bi bi-bell"></i></div>
                                <div class="col">Notification</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="blog.php" tabindex="-1">
                                <div class="avatar avatar-40 icon"><i class="bi bi-newspaper"></i></div>
                                <div class="col">Blogs</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="style.php" tabindex="-1">
                                <div class="avatar avatar-40 icon"><i class="bi bi-palette"></i></div>
                                <div class="col">Style <i class="bi bi-star-fill text-warning small"></i></div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="pages.php" tabindex="-1">
                                <div class="avatar avatar-40 icon"><i class="bi bi-file-earmark-text"></i></div>
                                <div class="col">Pages <span class="badge bg-info fw-light">new</span></div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="signin.php" tabindex="-1">
                                <div class="avatar avatar-40 icon"><i class="bi bi-box-arrow-right"></i></div>
                                <div class="col">Logout</div>
                                <div class="arrow"><i class="bi bi-chevron-right"></i></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Sidebar main menu ends -->

    <!-- Begin page -->
    <main class="h-100">

        <!-- Header -->
        <header class="header position-fixed header-filled">
            <div class="row">
                <div class="col-auto">
                    <button type="button" class="btn btn-light btn-44 btn-rounded menu-btn">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
                <div class="col">
                    <div class="logo-small">
                        <img src="assets/img/logo.png" alt="" class="rounded-circle" />
                        <h5>OneUIUX<br /><span class="text-secondary fw-light">Shopping</span></h5>
                    </div>
                </div>
                <div class="col-auto">
                    <a href="notifications.php" target="_self" class="btn btn-light btn-44 btn-rounded">
                        <i class="bi bi-bell"></i>
                        <span class="count-indicator"></span>
                    </a>
                    <a href="profile.php" target="_self" class="btn btn-light btn-44 btn-rounded ms-2">
                        <i class="bi bi-person-circle"></i>
                    </a>
                </div>
            </div>
        </header>
        <!-- Header ends -->

        <!-- main page content -->
        <div class="main-container container">
            <!-- products -->
            <div class="row mb-2">
                <div class="col-12 col-md-6 ">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto pe-0 position-relative">
                                    <div class="position-absolute end-0 top-0 z-index-1 align-self-start p-1">
                                        <button class="btn btn-sm btn-light btn-26 roudned-circle shadow-sm shadow-danger text-danger">
                                            <i class="bi bi-heart size-10 vm"></i>
                                        </button>
                                    </div>
                                    <div class="avatar avatar-80 rounded-15 border">
                                        <img src="assets/img/categories1.png" alt="" class="w-100">
                                    </div>
                                </div>
                                <div class="col align-self-center">
                                    <p class="mb-0"><small class="text-muted size-12">LAVA B500</small>
                                    </p>
                                    <h5 class="mb-1">$ 265.00</h5>
                                    <p class="size-10"><span class="text-success">30% OFF</span> /158 discount</p>
                                </div>
                                <div class="col-auto align-self-center">
                                    <div class="counter-number vertical">
                                        <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                            <i class="bi bi-dash size-22"></i>
                                        </button>
                                        <span>2</span>
                                        <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                            <i class="bi bi-plus size-22"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 ">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto pe-0 position-relative">
                                    <div class="position-absolute end-0 top-0 z-index-1 align-self-start p-1">
                                        <button class="btn btn-sm btn-light btn-26 roudned-circle shadow-sm shadow-danger text-danger">
                                            <i class="bi bi-heart size-10 vm"></i>
                                        </button>
                                    </div>
                                    <figure class="avatar avatar-80 rounded-15 border">
                                        <img src="assets/img/categories3.png" alt="" class="w-100">
                                    </figure>
                                </div>
                                <div class="col align-self-center">
                                    <p class="mb-0"><small class="text-muted size-12">Whirpools SM5500</small></p>
                                    <h5>$ 165.00</h5>
                                    <p class="size-10"><span class="text-success">15% OFF</span> /164 discount</p>
                                </div>
                                <div class="col-auto align-self-center">
                                    <div class="counter-number vertical">
                                        <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                            <i class="bi bi-dash size-22"></i>
                                        </button>
                                        <span>1</span>
                                        <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                            <i class="bi bi-plus size-22"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 ">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-auto pe-0 position-relative">
                                    <div class="position-absolute end-0 top-0 z-index-1 align-self-start p-1">
                                        <button class="btn btn-sm btn-light btn-26 roudned-circle shadow-sm shadow-danger text-danger">
                                            <i class="bi bi-heart size-10 vm"></i>
                                        </button>
                                    </div>
                                    <figure class="avatar avatar-80 rounded-15 border">
                                        <img src="assets/img/categories2.png" alt="" class="w-100">
                                    </figure>
                                </div>
                                <div class="col align-self-center">
                                    <p class="mb-0"><small class="text-muted size-12">Top Cloths</small>
                                    </p>
                                    <h5>$ 59.00</h5>
                                    <p class="size-10"><span class="text-success">530% OFF</span> /25 discount</p>
                                </div>
                                <div class="col-auto align-self-center">
                                    <div class="counter-number vertical">
                                        <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                            <i class="bi bi-dash size-22"></i>
                                        </button>
                                        <span>1</span>
                                        <button class="btn btn-sm avatar avatar-30 p-0 rounded-circle">
                                            <i class="bi bi-plus size-22"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- coupon  -->
            <div class="row mb-3">
                <div class="col-12 overflow-hidden">
                    <!-- input -->
                    <div class="row">
                        <div class="col position-relative align-self-center">
                            <div class="form-group form-floating mb-3 is-valid">
                                <input type="text" class="form-control" value="" id="coupon" placeholder="Search">
                                <label class="form-control-label" for="coupon">Coupon Code</label>
                            </div>
                        </div>
                        <div class="col-auto align-self-center">
                            <button class="btn btn-default btn-rounded shadow-sm shadow-default">
                                Apply
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row mb-4">
                <div class="col align-self-center">
                    <h6 class="title">Pricing</h6>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <p>Shipping Cost</p>
                </div>
                <div class="col-auto">$ 192.00</div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <p>Subtotal</p>
                </div>
                <div class="col-auto">$ 18.00</div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <p>Delivery Charge </p>
                </div>
                <div class="col-auto">$ 2.00</div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <p>Discount </p>
                </div>
                <div class="col-auto text-success">-$ 50.00</div>
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
                    <a href="address.php" class="btn btn-default shadow-sm btn-lg w-100 btn-rounded">Next</a>
                </div>
            </div>
        </div>
        <!-- main page content ends -->


    </main>
    <!-- Page ends-->

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <ul class="nav nav-pills nav-justified">
                <li class="nav-item">
                    <a class="nav-link " href="index.php">
                        <span>
                            <i class="nav-icon bi bi-house"></i>
                            <span class="nav-text">Home</span>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="stats.php">
                        <span>
                            <i class="nav-icon bi bi-binoculars"></i>
                            <span class="nav-text">Statistics</span>
                        </span>
                    </a>
                </li>
                <li class="nav-item centerbutton active">
                    <a href="cart.php" class="nav-link" id="centermenubtn">
                        <span class="theme-linear-gradient">
                            <i class="bi bi-basket size-22"></i>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="myorders.php">
                        <span>
                            <i class="nav-icon bi bi-bag"></i>
                            <span class="nav-text">Orders</span>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="wallet.php">
                        <span>
                            <i class="nav-icon bi bi-wallet2"></i>
                            <span class="nav-text">Wallet</span>
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </footer>
    <!-- Footer ends-->

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