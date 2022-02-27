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

<body style="background-size:contain;  background-color: #dae4e8;
">

    <div class="container">

        <div id="margintoppoin" class="row text-center">
          <!--  <img width="" style="margin-top:15px;    width: 188px;" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/logo.png" alt="">
         -->
	</div>
        <div class="row " style="margin-top:-57px">
            <div class="col-6 col-md-6 col-lg-6 col-xs-6 col-sm-6">
              <!--  <a class="" style=" border:lawngreen; " href="<?php echo $this->config->item('base_url'); ?>login/logout">
                    <img width="140" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/logout.png" alt="">
                </a>-->
            </div> 
            <div class="col-6 col-md-6 col-lg-6 col-xs-6 col-sm-6">
             <!--   <a class=" justify-content-center align-items-center" style="margin-top:20px;" href="">
                    <h3 style="margin-top:70px ;  margin-left: 72px;"> <?php
                                                                        echo $this->session->userdata['user_data_web']['poin'];

                                                                        ?> Poin</h3>
                </a> 
		-->
            </div>
        </div>
        <div id="listgame" class="row" style="
    margin-top: 60px;
       height: 655px;
       border-radius: 15px;
    padding-top: 10px;
    margin-left: -8px;
    margin-right: -8px;
                overflow-x: hidden; 
                overflow-x: auto;">


            <?php for ($i = 0; $i < count($data); $i++) { ?>
                <div class="col-md-3 col-sm-6 col-xs-6 center-block text-center">

                    <div class="info-box " style="padding: 0px;    margin-bottom: 0px!important;">
                        <a href="<?php echo $this->config->item('base_url'); ?>welcome/detail_game/<?php echo $data[$i]['id'];  ?>?access=<?php echo $_GET['access']; ?>" style="text-decoration: none; color: inherit;">
                            <div class="card" style="width: 100%;">
                                <img class="imggame" style=" max-height: 150px;;   width: 150px;" src="<?php echo $data[$i]['picture']; ?>" class="card-img-top" alt="...">
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
    $this->load->view('includes/navigation_game');
    ?>
    <!-- <div class="navbar">
        <a style="    margin-right: 0px;" href="<?php echo $this->config->item('base_url'); ?>/welcome?access=<?php echo $_GET['access']; ?>&offset=<?php echo $offset-10;?>"  class=""> <img width="80" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/backbutton.png" alt=""> <?php echo $offset; ?>
        </a>
        <a href="<?php echo $this->config->item('base_url'); ?>"><img width="80" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/home.png" alt="">

        </a>
	<a style="    margin-left: 0px;" href="<?php echo $this->config->item('base_url'); ?>/welcome?access=<?php echo $_GET['access']; ?>&offset=<?php echo $offset+10;?>"  class="pill-right"> <img width="80" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/nextbutton.png" alt=""><?php echo $offset; ?>
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