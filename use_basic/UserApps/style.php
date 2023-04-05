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

            <p class="text-opac text-center mb-4">Select best color scheme matches to your brand and application
                concepts. All available in two layout color mode Light & Dark mode. Also change screens background
                images & menu styles.</p>

            <!-- layout modes selection -->
            <div class="row mb-3">
                <div class="col-12">
                    <h6 class="mb-0">Layout Mode</h6>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-6 d-grid">
                    <input type="radio" class="btn-check" name="layout-mode" checked id="btn-layout-modes-light">
                    <label class="btn btn-outline-warning shadow-sm " for="btn-layout-modes-light"><i class="bi bi-sun fs-4 mb-2 d-block"></i>Light
                        Mode</label>
                </div>
                <div class="col-6 d-grid">
                    <input type="radio" class="btn-check" name="layout-mode" id="btn-layout-modes-dark">
                    <label class="btn btn-outline-dark shadow-sm bg-dark text-white" for="btn-layout-modes-dark"><i class="bi bi-moon-stars fs-4 mb-2 d-block"></i>Dark
                        Mode</label>
                </div>
            </div>

            <!-- color scheme selection -->
            <div class="row mb-3">
                <div class="col-12">
                    <h6 class="mb-0">Color scheme</h6>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">

                    <input type="radio" class="btn-check mb-2" name="color-scheme" id="btn-color-blue" data-title="">
                    <label class="btn bg-blue shadow-sm avatar avatar-44 p-0 mb-3 me-2 text-white" for="btn-color-blue">BL</label>

                    <input type="radio" class="btn-check mb-2" name="color-scheme" id="btn-color-indigo" data-title="theme-indigo">
                    <label class="btn bg-indigo shadow-sm avatar avatar-44 p-0 mb-3 me-2 text-white" for="btn-color-indigo">IN</label>

                    <input type="radio" class="btn-check mb-2" name="color-scheme" id="btn-color-purple" data-title="theme-purple">
                    <label class="btn bg-purple shadow-sm avatar avatar-44 p-0 mb-3 me-2 text-white" for="btn-color-purple">PL</label>

                    <input type="radio" class="btn-check mb-2" name="color-scheme" checked id="btn-color-pink" data-title="theme-pink">
                    <label class="btn bg-pink shadow-sm avatar avatar-44 p-0 mb-3 me-2 text-white" for="btn-color-pink">PK</label>

                    <input type="radio" class="btn-check mb-2" name="color-scheme" id="btn-color-red" data-title="theme-red">
                    <label class="btn bg-red shadow-sm avatar avatar-44 p-0 mb-3 me-2 text-white" for="btn-color-red">RD</label>

                    <input type="radio" class="btn-check mb-2" name="color-scheme" id="btn-color-orange" data-title="theme-orange">
                    <label class="btn bg-orange shadow-sm avatar avatar-44 p-0 mb-3 me-2 text-white" for="btn-color-orange">OG</label>

                    <input type="radio" class="btn-check mb-2" name="color-scheme" id="btn-color-yellow" data-title="theme-yellow">
                    <label class="btn bg-yellow shadow-sm avatar avatar-44 p-0 mb-3 me-2 text-white" for="btn-color-yellow">YL</label>

                    <input type="radio" class="btn-check mb-2" name="color-scheme" id="btn-color-green" data-title="theme-green">
                    <label class="btn bg-green shadow-sm avatar avatar-44 p-0 mb-3 me-2 text-white" for="btn-color-green">GN</label>

                    <input type="radio" class="btn-check mb-2" name="color-scheme" id="btn-color-teal" data-title="theme-teal">
                    <label class="btn bg-teal shadow-sm avatar avatar-44 p-0 mb-3 me-2 text-white" for="btn-color-teal">TL</label>

                    <input type="radio" class="btn-check mb-2" name="color-scheme" id="btn-color-cyan" data-title="theme-cyan">
                    <label class="btn bg-cyan shadow-sm avatar avatar-44 p-0 mb-3 me-2 text-white" for="btn-color-cyan">CN</label>
                </div>
            </div>

            <!-- layout modes selection -->
            <div class="row mb-3">
                <div class="col-12">
                    <h6 class="mb-0">RTL -LTR Layout</h6>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-6 d-grid">
                    <input type="radio" class="btn-check" name="layout-mode" checked id="btn-ltr">
                    <label class="btn btn-outline-primary shadow-sm btn-rounded" for="btn-ltr">Left to Right</label>
                </div>
                <div class="col-6 d-grid">
                    <input type="radio" class="btn-check" name="layout-mode" id="btn-rtl">
                    <label class="btn btn-outline-primary shadow-sm btn-rounded" for="btn-rtl">Right to Left</label>
                </div>
            </div>

            <!-- background selection -->
            <div class="row mb-3">
                <div class="col-12">
                    <h6 class="mb-1">Background Image</h6>
                    <p class="text-secondary">Background images are visible on <code>main</code> tag used
                        in each screen. Also <a href="signin.php">Click here</a> to see sing in page preview after
                        selecting below
                        image.</p>
                </div>
            </div>

            <div class="row ">
                <div class="col mb-4">
                    <input type="radio" class="btn-check" name="background-select" checked id="btn-bg1" data-src="bg-1">
                    <label class="btn btn-outline-primary background-btn p-1 text-center" for="btn-bg1">
                        <img src="assets/img/darkbg-1.png" alt="" class="mw-100 border rounded-15"><br><span class="py-2 d-block small">Geomatric</span>
                    </label>
                </div>
                <div class="col mb-4">
                    <input type="radio" class="btn-check" name="background-select" id="btn-bg2" data-src="bg-2">
                    <label class="btn btn-outline-primary background-btn p-1 text-center" for="btn-bg2">
                        <img src="assets/img/darkbg-2.png" alt="" class="mw-100 border rounded-15"><br><span class="py-2 d-block small">Modern</span>
                    </label>
                </div>
                <div class="col mb-4">
                    <input type="radio" class="btn-check" name="background-select" id="btn-bg3" data-src="bg-3">
                    <label class="btn btn-outline-primary background-btn p-1 text-center" for="btn-bg3">
                        <img src="assets/img/darkbg-3.png" alt="" class="mw-100 border rounded-15"><br><span class="py-2 d-block small">Bubble</span>
                    </label>
                </div>
            </div>

            <!-- menu style selection -->
            <div class="row mb-3">
                <div class="col-12">
                    <h6 class="my-1">Menu Style</h6>
                    <p class="text-secondary">This will just add class to sidebar and its done. Nothing to do change in
                        structure. Get your favorite class <code>sidebar-pushcontent</code>,
                        <code>sidebar-overlay</code>,
                        <code>sidebar-fullmenu</code>, and add to <code>sidebar-wrap</code> div.
                    </p>
                </div>
            </div>

            <div class="row ">
                <div class="col mb-4">
                    <input type="radio" class="btn-check" name="menu-select" checked id="btn-menu1" data-title="overlay">
                    <label class="btn btn-outline-primary background-btn p-1 text-center" for="btn-menu1">
                        <img src="assets/img/setting-menu-1@2x.png" alt="" class="mw-100 border rounded-15"><br><span class="py-2 d-block small">Popover</span>
                    </label>
                </div>
                <div class="col mb-4">
                    <input type="radio" class="btn-check" name="menu-select" id="btn-menu2" data-title="pushcontent">
                    <label class="btn btn-outline-primary background-btn p-1 text-center" for="btn-menu2">
                        <img src="assets/img/setting-menu-2@2x.png" alt="" class="mw-100 border rounded-15"><br><span class="py-2 d-block small">Push
                            Page</span>
                    </label>
                </div>
                <div class="col mb-4">
                    <input type="radio" class="btn-check" name="menu-select" id="btn-menu3" data-title="fullmenu">
                    <label class="btn btn-outline-primary background-btn p-1 text-center" for="btn-menu3">
                        <img src="assets/img/setting-menu-3@2x.png" alt="" class="mw-100 border rounded-15"><br><span class="py-2 d-block small">Fullscreen</span>
                    </label>
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