<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Affan - PWA Mobile HTML Template">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#0134d4">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Title -->
    <title>Jetset</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/Jetset-sm.png">
    <link rel="apple-touch-icon" href="img/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/Jetset-sm.png">
    <link rel="apple-touch-icon" sizes="167x167" href="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/Jetset-sm.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/Jetset-sm.png">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>assets/pwa/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>assets/pwa/css/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>assets/pwa/css/tiny-slider.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>assets/pwa/css/baguetteBox.min.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>assets/pwa/css/rangeslider.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>assets/pwa/css/vanilla-dataTables.min.css">
    <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>assets/pwa/css/apexcharts.css">
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>assets/pwa/style.css">
    <!-- Web App Manifest -->
    <link rel="manifest" href="<?php echo $this->config->item('assets_url'); ?>assets/pwa/manifest.json">
    <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/alert/sweetalert2.min.js"></script>

    <link rel="stylesheet" href="<?php echo $this->config->item('assets_url'); ?>assets/pwa/alert/sweetalert2.min.css">
    <script src="<?php echo $this->config->item('assets_url'); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
</head>


<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
    </div>
    <!-- Internet Connection Status -->
    <!-- # This code for showing internet connection status -->
    <div class="internet-connection-status" id="internetStatus"></div>
    <!-- Dark mode switching -->
    <div class="dark-mode-switching">
        <div class="d-flex w-100 h-100 align-items-center justify-content-center">
            <div class="dark-mode-text text-center">
                <svg class="bi bi-moon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M14.53 10.53a7 7 0 0 1-9.058-9.058A7.003 7.003 0 0 0 8 15a7.002 7.002 0 0 0 6.53-4.47z"></path>
                </svg>
                <p class="mb-0">Switching to dark mode</p>
            </div>
            <div class="light-mode-text text-center">
                <svg class="bi bi-brightness-high" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"></path>
                </svg>
                <p class="mb-0">Switching to light mode</p>
            </div>
        </div>
    </div>
    <!-- RTL mode switching -->
    <div class="rtl-mode-switching">
        <div class="d-flex w-100 h-100 align-items-center justify-content-center">
            <div class="rtl-mode-text text-center">
                <svg class="bi bi-text-right" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-4-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm4-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-4-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"></path>
                </svg>
                <p class="mb-0">Switching to RTL mode</p>
            </div>
            <div class="ltr-mode-text text-center">
                <svg class="bi bi-text-left" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"></path>
                </svg>
                <p class="mb-0">Switching to default mode</p>
            </div>
        </div>
    </div>
    <!-- # Sidenav Left -->
    <!-- Offcanvas -->
    <div class="offcanvas offcanvas-start" id="affanOffcanvas" data-bs-scroll="true" tabindex="-1" aria-labelledby="affanOffcanvsLabel">
        <button class="btn-close btn-close-white text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        <div class="offcanvas-body p-0">
            <!-- Side Nav Wrapper -->
            <div class="sidenav-wrapper">
                <!-- Sidenav Profile -->
                <div class="sidenav-profile bg-gradient">
                    <div class="sidenav-style1"></div>
                    <!-- User Thumbnail -->
                    <div class="user-profile"><img src="img/bg-img/2.jpg" alt=""></div>
                    <!-- User Info -->
                    <div class="user-info">
                        <h6 class="user-name mb-0"><?php echo $this->session->userdata['user_data_web']['poin'];  ?> Poin</h6><span><?php print_r($this->session->userdata['user_data_web']['name']);  ?></span>
                    </div>
                </div>
                <!-- Sidenav Nav -->
                <ul class="sidenav-nav ps-0">
                    <li><a href="<?php echo $this->config->item('base_url'); ?>"><i class="bi bi-house-door"></i>Home</a></li>
                    <!-- <li><a href="elements.html"><i class="bi bi-folder2-open"></i>Elements<span class="badge bg-danger rounded-pill ms-2">220+</span></a></li>
                    <li><a href="pages.html"><i class="bi bi-collection"></i>Pages<span class="badge bg-success rounded-pill ms-2">100+</span></a></li> -->
                    <!-- <li><a href="#"><i class="bi bi-cart-check"></i>Shop</a>
                        <ul>
                            <li><a href="page-shop-grid.html">Shop Grid</a></li>
                            <li><a href="page-shop-list.html">Shop List</a></li>
                            <li><a href="page-shop-details.html">Shop Details</a></li>
                            <li><a href="page-cart.html">Cart</a></li>
                            <li><a href="page-checkout.html">Checkout</a></li>
                        </ul>
                    </li> -->
                    <!-- <li><a href="settings.html"><i class="bi bi-gear"></i>Settings</a></li> -->
                    <li>
                        <div class="night-mode-nav"><i class="bi bi-moon"></i>Night Mode
                            <div class="form-check form-switch">
                                <input class="form-check-input form-check-success" id="darkSwitch" type="checkbox">
                            </div>
                        </div>
                    </li>
                    <li><a href="<?php echo $this->config->item('base_url'); ?>login/logout"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
                </ul>
                <!-- Social Info -->
                <!-- <div class="social-info-wrap"><a href="#"><i class="bi bi-facebook"></i></a><a href="#"><i class="bi bi-twitter"></i></a><a href="#"><i class="bi bi-linkedin"></i></a></div> -->
                <!-- Copyright Info -->
                <div class="copyright-info">
                    <p>2022 &copy; Made with<a style="color:pink;" href="https://nurmaliki.github.io/"> <i class="bi bi-heart-fill"></i> </a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Area -->
    <div class="header-area" id="headerArea">
        <div class="container">
            <!-- Header Content -->
            <div class="header-content header-style-five position-relative d-flex align-items-center justify-content-between">
                <!-- Back Button -->
                <div class="navbar--toggler" id="affanNavbarToggler" data-bs-toggle="offcanvas" data-bs-target="#affanOffcanvas" aria-controls="affanOffcanvas"><span class="d-block"></span><span class="d-block"></span><span class="d-block"></span></div>


                <!-- Page Title -->
                <div class="page-heading">
                    <!-- <h6 class="mb-0">About</h6> -->
                    <img style="    width: 175px;" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/Jetset-sm.png" alt="">
                </div>

                <div class="back-button">
                    <!-- <a href="pages.html">
                        <svg class="bi bi-arrow-left-short" width="32" height="32" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"></path>
                        </svg></a> -->
                </div>
                <!-- Navbar Toggler -->
            </div>
        </div>
    </div>
    <!-- # Sidenav Left -->
    <!-- Offcanvas -->
    <div class="offcanvas offcanvas-start" id="affanOffcanvas" data-bs-scroll="true" tabindex="-1" aria-labelledby="affanOffcanvsLabel">
        <button class="btn-close btn-close-white text-reset" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        <div class="offcanvas-body p-0">
            <!-- Side Nav Wrapper -->
            <div class="sidenav-wrapper">
                <!-- Sidenav Profile -->
                <div class="sidenav-profile bg-gradient">
                    <div class="sidenav-style1"></div>
                    <!-- User Thumbnail -->
                    <div class="user-profile"><img src="img/bg-img/2.jpg" alt=""></div>
                    <!-- User Info -->
                    <div class="user-info">
                        <h6 class="user-name mb-0"><?php echo $this->session->userdata['user_data_web']['poin'];  ?> Poin</h6><span><?php print($this->session->userdata['user_data_web']);  ?></span>
                    </div>
                </div>
                <!-- Sidenav Nav -->
                <ul class="sidenav-nav ps-0">
                    <li><a href="page-home.html"><i class="bi bi-house-door"></i>Home</a></li>
                    <li><a href="elements.html"><i class="bi bi-folder2-open"></i>Elements<span class="badge bg-danger rounded-pill ms-2">220+</span></a></li>
                    <li><a href="pages.html"><i class="bi bi-collection"></i>Pages<span class="badge bg-success rounded-pill ms-2">100+</span></a></li>
                    <li><a href="#"><i class="bi bi-cart-check"></i>Shop</a>
                        <ul>
                            <li><a href="page-shop-grid.html">Shop Grid</a></li>
                            <li><a href="page-shop-list.html">Shop List</a></li>
                            <li><a href="page-shop-details.html">Shop Details</a></li>
                            <li><a href="page-cart.html">Cart</a></li>
                            <li><a href="page-checkout.html">Checkout</a></li>
                        </ul>
                    </li>
                    <li><a href="settings.html"><i class="bi bi-gear"></i>Settings</a></li>
                    <li>
                        <div class="night-mode-nav"><i class="bi bi-moon"></i>Night Mode
                            <div class="form-check form-switch">
                                <input class="form-check-input form-check-success" id="darkSwitch" type="checkbox">
                            </div>
                        </div>
                    </li>
                    <li><a href="<?php echo $this->config->item('base_url'); ?>login/logout"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
                </ul>
                <!-- Social Info -->
                <div class="social-info-wrap"><a href="#"><i class="bi bi-facebook"></i></a><a href="#"><i class="bi bi-twitter"></i></a><a href="#"><i class="bi bi-linkedin"></i></a></div>
                <!-- Copyright Info -->
                <div class="copyright-info">
                    <p>2021 &copy; Made by<a href="#">Designing World</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content-wrapper py-3">