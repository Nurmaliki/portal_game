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
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $this->config->item('assets_url'); ?>assets/pwa/img/icons/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="167x167" href="<?php echo $this->config->item('assets_url'); ?>assets/pwa/img/icons/icon-167x167.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $this->config->item('assets_url'); ?>assets/pwa/img/icons/icon-180x180.png">
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
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
    </div>
    <!-- Internet Connection Status -->
    <!-- # This code for showing internet connection status -->
    <div class="internet-connection-status" id="internetStatus"></div>

    <!-- Login Wrapper Area -->
    <div class="login-wrapper d-flex align-items-center justify-content-center">
        <div class="custom-container">
            <div class="text-center px-4"><img class="login-intro-img" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/newgame.png" alt=""></div>
            <!-- Register Form -->
            <div class="register-form mt-4">
                <!-- <h6 class="mb-3 text-center">Log in to continue to Affan.</h6> -->
                <?php echo  $this->session->flashdata('msgalert'); ?>
                <form action="<?php echo $this->config->item('base_url'); ?>/login/authentication" method="post">

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">+62</span>
                        <input type="text" class="form-control" type="text" name="username" placeholder="851233444......" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="form-group position-relative">
                        <input class="form-control" id="psw-input" name="password" type="password" placeholder="Enter Password">
                        <div class="position-absolute" id="password-visibility"><i class="bi bi-eye"></i><i class="bi bi-eye-slash"></i></div>
                    </div>
                    <button class="btn btn-primary-ungu w-100" type="submit">Login</button>
                </form>
            </div>

        </div>
    </div>
    <!-- All JavaScript Files -->
    <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/slideToggle.min.js"></script>
    <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/internet-status.js"></script>
    <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/tiny-slider.js"></script>
    <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/baguetteBox.min.js"></script>
    <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/countdown.js"></script>
    <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/rangeslider.min.js"></script>
    <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/vanilla-dataTables.min.js"></script>
    <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/index.js"></script>
    <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/magic-grid.min.js"></script>
    <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/dark-rtl.js"></script>
    <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/active.js"></script>
    <!-- PWA -->
    <script src="<?php echo $this->config->item('assets_url'); ?>assets/pwa/js/pwa.js"></script>
</body>

</html>