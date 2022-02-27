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
    .navbar {     overflow: hidden;
        /* background-color: #333; */
        background-image: url('<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/menubar2.png');
        background-size: contain;
    background-repeat: no-repeat;
        position: fixed;
        bottom: 0;
        width: 100%;    }

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

<body style="background-size:cover; background-image: url(<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/halamanweb.png);
">

    <div class="container">

        <div class="row text-center">
            <img width="" style="margin-top:20px;    width: 188px;" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/logo.png" alt="">
        </div>
        <div class="row " style="margin-top:-57px">
            <div class="col-6 col-md-6 col-lg-6 col-xs-6 col-sm-6">
                <a class="" style=" border:lawngreen; " href="<?php echo $this->config->item('base_url'); ?>login/logout">
                    <img width="100" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/logout.png" alt="">
                </a>
            </div>
            <div class="col-6 col-md-6 col-lg-6 col-xs-6 col-sm-6">
                <a class=" justify-content-center align-items-center" style="margin-top:20px;" href="">
                    <h3 style="margin-top:40px ;  margin-left: 72px;"> <?php
                                                                        echo $this->session->userdata['user_data_web']['poin'];
                                                                        ?> Poin</h3>
                </a>
            </div>
        </div>
        <div class="row" style=" height: 270px; 
                overflow-x: hidden; 
                overflow-x: auto;">


            <?php for ($i = 0; $i < count($data); $i++) { ?>
                <div class="col-md-3 col-sm-6 col-xs-6 center-block text-center">

                    <div class="info-box " style="padding: 10px;">
                        <a href="<?php echo $this->config->item('base_url'); ?>welcome/detail_game/<?php echo $data[$i]['id'];  ?>?access=<?php echo $_GET['access']; ?>" style="text-decoration: none; color: inherit;">
                            <div class="card" style="width: 100%;">
                                <img width="100" src="<?php echo $data[$i]['picture']; ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <p class="card-text"><?php echo $data[$i]['title']; ?></p>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            <?php } ?>

        </div>




    </div>

    <?php 
    $this->load->view('includes/navigation');
    ?>
    <!-- <div class="navbar">
        <a style="    margin-right: 0px;" href="#" onclick="goBack()" class=""> <img width="80" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/backbutton.png" alt="">
        </a>
        <a href="<?php echo $this->config->item('base_url'); ?>"><img width="80" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/home.png" alt="">

        </a>
        <a style="    margin-left: 0px;" href="#" onclick="goForward()" class="pill-right"> <img width="80" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/nextbutton.png" alt="">
        </a>
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