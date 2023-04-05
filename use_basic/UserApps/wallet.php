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

<body class="body-scroll theme-pink" data-page="wallet">

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
            <!-- balance -->
            <div class="row my-4 text-center">
                <div class="col-12">
                    <h1 class="fw-light mb-2">$ 1,050.00</h1>
                    <p class="text-secondary"><a href="addmoney.php">+ Add Balance</a></p>
                </div>
            </div>

            <!-- income expense-->
            <div class="row mb-4">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="avatar avatar-50 p-1 shadow-sm shadow-default rounded-15 bg-theme text-white">
                                        <div class="icons">
                                            <i class="bi bi-cash-coin"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col align-self-center ps-0">
                                    <p class="size-10 text-secondary mb-0">Cashback</p>
                                    <p>1542k</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="avatar avatar-50 shadow-sm shadow-warning rounded-15 bg-warning text-white">
                                        <div class="icons ">
                                            <i class="bi bi-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col align-self-center ps-0">
                                    <p class="size-10 text-secondary mb-0">Points</p>
                                    <p>1212k</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Send Money paybills -->
            <div class="row mb-2">
                <div class="col">
                    <h6 class="title">Make your payment</h6>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card bg-theme text-white">
                        <div class="card-body pb-0">
                            <div class="row justify-content-between gx-0 mx-0 pb-3">
                                <div class="col-auto text-center">
                                    <a href="pay.php" class="avatar avatar-60 p-1 shadow-sm rounded-15 bg-opac mb-2">
                                        <div class="icons text-white rounded-12 bg-opac">
                                            <i class="bi bi-receipt-cutoff size-22"></i>
                                        </div>
                                    </a>
                                    <p class="size-10">Pay</p>
                                </div>

                                <div class="col-auto text-center">
                                    <a href="sendmoney.php" class="avatar avatar-60 p-1 shadow-sm rounded-15 bg-opac mb-2">
                                        <div class="icons text-white rounded-12 bg-opac">
                                            <i class="bi bi-arrow-up-right size-22"></i>
                                        </div>
                                    </a>
                                    <p class="size-10">Send</p>
                                </div>

                                <div class="col-auto text-center">
                                    <a href="receivemoney.php" class="avatar avatar-60 p-1 shadow-sm rounded-15 bg-opac mb-2">
                                        <div class="icons text-white rounded-12 bg-opac">
                                            <i class="bi bi-arrow-down-left size-22"></i>
                                        </div>
                                    </a>
                                    <p class="size-10">Receive</p>
                                </div>

                                <div class="col-auto text-center">
                                    <a href="withdraw.php" class="avatar avatar-60 p-1 shadow-sm rounded-15 bg-opac mb-2">
                                        <div class="icons text-white rounded-12 bg-opac">
                                            <i class="bi bi-bank size-22"></i>
                                        </div>
                                    </a>
                                    <p class="size-10">Withdraw</p>
                                </div>
                            </div>

                            <div class="row justify-content-between gx-0 mx-0 collapse" id="collpasemorelink">
                                <div class="col-auto text-center">
                                    <a href="bills.php" class="avatar avatar-60 p-1 shadow-sm rounded-15 bg-opac mb-2">
                                        <div class="icons text-white rounded-12 bg-opac">
                                            <i class="bi bi-tv size-22"></i>
                                        </div>
                                    </a>
                                    <p class="size-10">TV</p>
                                </div>

                                <div class="col-auto text-center">
                                    <a href="addmoney.php" class="avatar avatar-60 p-1 shadow-sm rounded-15 bg-opac mb-2">
                                        <div class="icons text-white rounded-12 bg-opac">
                                            <i class="bi bi-wallet2 size-22"></i>
                                        </div>
                                    </a>
                                    <p class="size-10">Add Money</p>
                                </div>

                                <div class="col-auto text-center">
                                    <a href="shop.php" class="avatar avatar-60 p-1 shadow-sm rounded-15 bg-opac mb-2">
                                        <div class="icons text-white rounded-12 bg-opac">
                                            <i class="bi bi-cart size-22"></i>
                                        </div>
                                    </a>
                                    <p class="size-10">Buy</p>
                                </div>

                                <div class="col-auto text-center">
                                    <a href="rewards.php" class="avatar avatar-60 p-1 shadow-sm rounded-15 bg-opac mb-2">
                                        <div class="icons text-white rounded-12 bg-opac">
                                            <i class="bi bi-cash-coin size-22"></i>
                                        </div>
                                    </a>
                                    <p class="size-10">Cashback</p>
                                </div>
                            </div>

                            <button class="btn btn-link mt-0 py-1 w-100 bar-more collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collpasemorelink" aria-expanded="false" aria-controls="collpasemorelink">
                                <span class=""></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rewards -->
            <div class="row mb-2">
                <div class="col">
                    <h6 class="title">Rewards</h6>
                </div>
                <div class="col-auto align-self-center">
                    <a href="rewards.php" class="small">View All</a>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-12 px-0">
                    <!-- swiper categories -->
                    <div class="swiper-container connectionwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="tag active">
                                    <i class="bi bi-building"></i>
                                    <span class="text-uppercase">All</span>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="tag">
                                    <i class="bi bi-tv"></i>
                                    <span class="text-uppercase">Electronics</span>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="tag ">
                                    <i class="bi bi-truck"></i>
                                    <span class="text-uppercase">Transport</span>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="tag">
                                    <i class="bi bi-speaker"></i>
                                    <span class="text-uppercase">Music</span>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="tag">
                                    <i class="bi bi-wallet2"></i>
                                    <span class="text-uppercase">Accessories</span>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="tag">
                                    <i class="bi bi-camera"></i>
                                    <span class="text-uppercase">Camera</span>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="tag">
                                    <i class="bi bi-gem"></i>
                                    <span class="text-uppercase">Jwellery</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-1 justify-content-center">
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-auto align-self-center">
                                    <div class="avatar avatar-50 bg-warning text-white shadow-sm rounded-15">
                                        <img src="assets/img/company2-50.png" alt="">
                                    </div>
                                </div>
                                <div class="col align-self-center ps-0">
                                    <p class="mb-0 text-color-theme">20<small>% Off</small></p>
                                    <div class="tag tag-small bg-warning border-warning text-white px-2">50 pts</div>
                                </div>
                            </div>
                            <p class="size-12">
                                <span class="text-secondary">minimum spend 1220 USD and maximum discount 240 USD</span>
                                <br /><a href="">view details</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-auto align-self-center">
                                    <div class="avatar avatar-50 bg-warning text-white shadow-sm rounded-15">
                                        <img src="assets/img/company4.jpg" alt="">
                                    </div>
                                </div>
                                <div class="col align-self-center ps-0">
                                    <p class="mb-0 text-color-theme">60<small>% Off</small></p>
                                    <div class="tag tag-small bg-warning border-warning text-white px-2">100 pts</div>
                                </div>
                            </div>
                            <p class="size-12">
                                <span class="text-secondary">minimum spend 4520 USD and maximum discount 600 USD</span>
                                <br /><a href="">view details</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-auto align-self-center">
                                    <div class="avatar avatar-50 bg-warning text-white shadow-sm rounded-15">
                                        <img src="assets/img/company5.png" alt="">
                                    </div>
                                </div>
                                <div class="col align-self-center ps-0">
                                    <p class="mb-0 text-color-theme">17<small>% Off</small></p>
                                    <div class="tag tag-small bg-warning border-warning text-white px-2">250 pts</div>
                                </div>
                            </div>
                            <p class="size-12">
                                <span class="text-secondary">minimum spend 1220 USD and maximum discount 480 USD</span>
                                <br /><a href="">view details</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-auto align-self-center">
                                    <div class="avatar avatar-50 bg-warning text-white shadow-sm rounded-15">
                                        <img src="assets/img/company3.jpg" alt="">
                                    </div>
                                </div>
                                <div class="col align-self-center ps-0">
                                    <p class="mb-0 text-color-theme">55<small>% Off</small></p>
                                    <div class="tag tag-small bg-warning border-warning text-white px-2">150 pts</div>
                                </div>
                            </div>
                            <p class="size-12">
                                <span class="text-secondary">minimum spend 4520 USD and maximum discount 680 USD</span>
                                <br /><a href="">view details</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>


            <!-- currency -->
            <div class="row mb-2">
                <div class="col">
                    <h6 class="title">Currency</h6>
                </div>
                <div class="col-auto align-self-center">
                    <a href="addcurrency.php" class="small">Add New</a>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush bg-none">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-44 shadow-sm card rounded-15">
                                                <img src="assets/img/company6.png" alt="">
                                            </div>
                                        </div>
                                        <div class="col align-self-center ps-0">
                                            <p class="text-secondary size-10 mb-0">BitCoin BTC</p>
                                            <p>Zomato</p>
                                        </div>
                                        <div class="col-auto align-self-center text-end">
                                            <canvas class="areachartsmall"></canvas>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-44 shadow-sm card rounded-15">
                                                <img src="assets/img/company7.jpg" alt="">
                                            </div>
                                        </div>
                                        <div class="col align-self-center ps-0">
                                            <p class="text-secondary size-10 mb-0">Etherium ETH</p>
                                            <p>Uber</p>
                                        </div>
                                        <div class="col-auto align-self-center text-end">
                                            <canvas class="areachartsmall"></canvas>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-auto">
                                            <div class="avatar avatar-44 shadow-sm shadow-warning rounded-15 bg-warning text-white">
                                                <div class="icons ">
                                                    <i class="bi bi-star"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col align-self-center ps-0">
                                            <p class="text-secondary size-10 mb-0">Super Coin</p>
                                            <p>15000.00</p>
                                        </div>
                                        <div class="col-auto align-self-center text-end">
                                            <canvas class="areachartsmall"></canvas>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- cards expense data  -->
            <div class="row mb-2">
                <div class="col">
                    <h6 class="title">My Credit available</h6>
                </div>
                <div class="col-auto align-self-center">
                    <a href="" class="small">Add New</a>
                </div>
            </div>
            <!-- swiper credit cards -->
            <div class="row mb-3">
                <div class="col-12 px-0">
                    <div class="swiper-container cardswiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="card theme-bg shadow-sm shadow-purple mb-3">
                                    <div class="card-body">
                                        <div class="row mb-4">
                                            <div class="col-auto align-self-center">
                                                <img src="assets/img/maestro.png" alt="">
                                            </div>
                                            <div class="col align-self-center text-end">
                                                <p class="small">
                                                    <span class="text-muted size-10">City Bank</span><br>
                                                    <span class="">Credit Card</span>
                                                </p>
                                            </div>
                                        </div>
                                        <h6 class="fw-normal mb-3">
                                            000 0000 0001 546598
                                        </h6>
                                        <div class="row">
                                            <div class="col-auto">
                                                <p class="mb-0 text-muted size-10">Expiry</p>
                                                <p>09/023</p>
                                            </div>
                                            <div class="col text-end">
                                                <p class="mb-0 text-muted size-10">Card Holder</p>
                                                <p>Maxartkiller</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-auto">
                                        <p class="mb-0 text-secondary size-10">Expense</p>
                                        <p>1500.00
                                            <small class="text-success">18.2
                                                <i class="bi bi-arrow-up"></i>
                                            </small>
                                        </p>
                                    </div>
                                    <div class="col text-end">
                                        <p class="mb-0 text-secondary size-10">Limit Remain</p>
                                        <p>13500.00</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card bg-danger shadow-sm shadow-danger mb-3">
                                    <div class="card-body">
                                        <div class="row mb-4">
                                            <div class="col-auto align-self-center">
                                                <img src="assets/img/visa.png" alt="">
                                            </div>
                                            <div class="col align-self-center text-end">
                                                <p class="small">
                                                    <span class="text-muted size-10">City Bank</span><br>
                                                    <span class="">Credit Card</span>
                                                </p>
                                            </div>
                                        </div>
                                        <h6 class="fw-normal mb-3">
                                            000 0000 0001 546598
                                        </h6>
                                        <div class="row">
                                            <div class="col-auto">
                                                <p class="mb-0 text-muted size-10">Expiry</p>
                                                <p>09/023</p>
                                            </div>
                                            <div class="col text-end">
                                                <p class="mb-0 text-muted size-10">Card Holder</p>
                                                <p>Maxartkiller</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-auto">
                                        <p class="mb-0 text-secondary size-10">Expense</p>
                                        <p>3500.00
                                            <small class="text-danger">10.2
                                                <i class="bi bi-arrow-down"></i>
                                            </small>
                                        </p>
                                    </div>
                                    <div class="col text-end">
                                        <p class="mb-0 text-secondary size-10">Limit Remain</p>
                                        <p>13500.00</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card theme-radial-gradient border-0 mb-3">
                                    <div class="card-body">
                                        <div class="row mb-4">
                                            <div class="col-auto align-self-center">
                                                <img src="assets/img/maestro.png" alt="">
                                            </div>
                                            <div class="col align-self-center text-end">
                                                <p class="small">
                                                    <span class="text-muted size-10">City Bank</span><br>
                                                    <span class="">Credit Card</span>
                                                </p>
                                            </div>
                                        </div>
                                        <h6 class="fw-normal mb-3">
                                            000 0000 0001 546598
                                        </h6>
                                        <div class="row">
                                            <div class="col-auto">
                                                <p class="mb-0 text-muted size-10">Expiry</p>
                                                <p>09/023</p>
                                            </div>
                                            <div class="col text-end">
                                                <p class="mb-0 text-muted size-10">Card Holder</p>
                                                <p>Maxartkiller</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-auto">
                                        <p class="mb-0 text-secondary size-10">Expense</p>
                                        <p>1254.00
                                            <small class="text-success">18.2
                                                <i class="bi bi-arrow-up"></i>
                                            </small>
                                        </p>
                                    </div>
                                    <div class="col text-end">
                                        <p class="mb-0 text-secondary size-10">Limit Remain</p>
                                        <p>13500.00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <a class="nav-link" href="index.php">
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
                <li class="nav-item centerbutton">
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
                    <a class="nav-link active" href="wallet.php">
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