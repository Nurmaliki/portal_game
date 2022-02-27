<!-- <div class="content-wrapper"> -->

<!-- Content Header (Page header) -->
<!-- <section class="content-header">
            <h1>
                Dashboard
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Game</li>
            </ol>
        </section> -->

<!-- Main content -->


<style>
    .navbar {
        overflow: hidden;
        /* background-color: #333; */
        background-image: url('<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/menubar2.png');
        background-size: cover;
        position: fixed;
        bottom: 0;
        width: 100%;
    }

    .navbar a {
        float: left;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    .navbar a:hover {
        background: #f1f1f1;
        color: black;
    }

    .navbar a.active {
        background-color: #4CAF50;
        color: white;
    }

    .main {
        padding: 16px;
        margin-bottom: 30px;
    }
</style>

<!-- Info boxes -->

<body style=" background-color: #f3fbff;">

    <div class="container">

        <div class="row text-center">
            <img id="logoid" width="" style="margin-top:20px;    width: 188px;" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/newgame.png" alt="">
        </div>
        <div id="margintoppoin" style="margin-top: 10%;" class="row ">


            <div class="col-6 col-md-6 col-lg-6 col-xs-6 col-sm-6">
                <a style="    background-color: #fdcb6e;    font-weight: bold; border-color: #fdcb6e;" class="btn btn-info" style=" border:lawngreen; " href="<?php echo $this->config->item('base_url'); ?>login/logout">
                    Logout
                </a>
            </div>
            <div class="col-6 col-md-6 col-lg-6 col-xs-6 col-sm-6">
                <a class=" justify-content-center align-items-center" style="" href="">
                    <p id="infopoin" style="  color: #fdcb6e;    font-weight: bold; margin-left: 72px;     white-space: nowrap;  font-size: 1.5em;"> <?php echo $this->session->userdata['user_data_web']['poin'];  ?> Poin</p>
                </a>
            </div>
        </div>
        <?php if ($this->session->userdata['user_data_web']['is_first_login_today']) {
        ?>
            <div class="row text-center">

                <p id="infotitle" style="    font-size: 20px;">Selamat Poin Kamu Bertambah </p>
            </div>
            <div style="align-items: center;   text-align: -webkit-center;" class="row ">
                <p class="" style=" border-top-left-radius: 2px;  border-top-right-radius: 0; border-bottom-right-radius: 0; border-bottom-left-radius: 2px;
                height: 50px;
                width: 86px;
                text-align: center;
                font-size: 20px;
                line-height: 50px;
                     background: #a29bfe;
                color: #fff;
                font-weight:bold;
                border-radius: 10px;
    ">
                    <?php
                    echo $this->session->userdata['user_data_web']['bonuspoin'];
                    echo " Poin";
                    ?>
                </p>
            </div>
            <br>
        <?php }
        ?>

        <div style="margin:2%;" class="row text-center">
            <p id="infotitle" style="    font-size: 20px;">Kumpulkan Poin Anda Dan Dapatkan Hadiah Juataan Rupiah</p>

        </div>

        <div class="row text-center" style="    ">
            <a href="<?php echo $this->config->item('base_url'); ?>info?access=<?php echo $_GET['access']; ?>" onclick="goBack()" class="btn btn-info" style="    background-color: #00b894;
    font-weight: bold;
    border: none;
">

                Info Program
            </a>
            <a href="<?php echo $this->config->item('base_url'); ?>hadiah?access=<?php echo $_GET['access']; ?>" style="    background-color: #00b894;
    font-weight: bold;
    border: none;
" class="btn btn-info">
                Tukar Poin
            </a>
            <a href="<?php echo $this->config->item('base_url'); ?>welcome?access=<?php echo $_GET['access']; ?>" onclick="goForward()" class="pill-right btn btn-info" style="    background-color: #00b894;
    font-weight: bold;
    border: none;
">
                Pilih Game
            </a>

        </div>

        <!-- <div style="background-image:url(<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/menubar.png)" class="row mt-5">
            <div class="col-4 col-md-4 col-lg-4 col-xs-4 col-sm-4">
                <a class="" style=" border:lawngreen; " href="<?php echo $this->config->item('base_url'); ?>login/logout">
                    <img width="100" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/backbutton.png" alt="">
                </a>
            </div>
            <div class="col-4 col-md-4 col-lg-4 col-xs-4 col-sm-4">
                <a class=" justify-content-center align-items-center" style="margin-top:20px;" href="">
                    <img width="100" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/home.png" alt="">

            </div>
            <div class="col-4 col-md-4 col-lg-4 col-xs-4 col-sm-4">
                <a class=" justify-content-center align-items-center" style="margin-top:20px;" href="">
                    <img width="100" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/nextbutton.png" alt="">

            </div>
        </div> -->


    </div>

    <!-- 
    <div class="navbar">
        <a href="#" onclick="goBack()" class=""> <img width="80" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/backbutton.png" alt="">
        </a>
        <a href="<?php echo $this->config->item('base_url'); ?>"><img width="80" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/home.png" alt="">

        </a>
        <a href="#" onclick="goForward()" class="pill-right"> <img width="80" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/nextbutton.png" alt="">
        </a>
    </div> -->

    <!-- <div class="main">
        <h1>Bottom Navigation Bar</h1>
        <p>Some text some text some text.</p>
    </div> -->

    <script>
        function goForward() {
            window.history.forward();
        }

        function goBack() {
            window.history.back();
        }
    </script>
</body>








<!-- </div> -->
<!-- /.content-wrapper -->