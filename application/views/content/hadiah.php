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

<body style="background-color: #f3fbff;">
    <div class="container">

        <div class="row text-center">
            <img id="logoid" width="" style="margin-top:20px;    width: 188px;" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/NEWGAME.png" alt="">
        </div>
        <div id="margintoppoin" class="row " style="margin-top:-57px">
            <div class="col-6 col-md-6 col-lg-6 col-xs-6 col-sm-6">
                <a class="btn-info btn" style=" border:lawngreen; background-color: #fdcb6e; border-color: #fdcb6e; font-weight: bold;" href="<?php echo $this->config->item('base_url'); ?>login/logout">
                    Logout
                </a>
            </div>
            <div class="col-6 col-md-6 col-lg-6 col-xs-6 col-sm-6">
                <a class=" justify-content-center align-items-center" style="" href="">
                    <p id="infopoin" style=" color: #fdcb6e;    font-weight: bold; margin-left: 72px;     white-space: nowrap;  font-size: 1.5em;"> <?php
                                                                                                                                                    echo $this->session->userdata['user_data_web']['poin'];                                                                                                                         ?> Poin</p>
                </a>
            </div>
        </div>
        <div class="row" style=" height: 376px;   overflow-x: hidden;   overflow-x: auto;">

            <div class="container p-5">
                <table id="table-hadiah" style="border: 2px solid #26a9e0;" class="table">
                    <thead style="background-color: #26a9e0; color:white;">
                        <tr>

                            <th style="    border: 2px solid #26a9e0;" scope="col">Hadiah</th>
                            <th style="    border: 2px solid #26a9e0;" scope="col">Icon</th>
                            <th style="    border: 2px solid #26a9e0;" scope="col">Bonus Tersisa</th>
                            <th style="    border: 2px solid #26a9e0;" scope="col">Total Poin</th>
                            <th style="    border: 2px solid #26a9e0;" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($hadiah); $i++) { ?>
                            <tr style="    border: 2px solid #26a9e0;">

                                <!-- <th scope="row">1</th> -->
                                <td style="    border: 2px solid #26a9e0;"><?php echo $hadiah[$i]['name']; ?></td>
                                <td style="    border: 2px solid #26a9e0;"> <img src="<?php echo $hadiah[$i]['picture']; ?>" style="width:20px; height:20px;" alt=""> </td>
                                <td style="    border: 2px solid #26a9e0;"><?php echo $hadiah[$i]['jumlah']; ?></td>
                                <td style="    border: 2px solid #26a9e0;"><?php echo $hadiah[$i]['poin']; ?></td>
                                <td style="    border: 2px solid #26a9e0;">
                                    <center><a href="<?php echo $this->config->item('base_url'); ?>/hadiah/penukaran_hadiah/<?php echo $hadiah[$i]['id']; ?>?access=<?php echo $_GET['access']; ?>" class="btn btn-primary" style="background-color: #00b894;font-weight: bold;  border: none;">Tukar Poin</a></center>
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>
                </table>
            </div>



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
    <?php
    $this->load->view('includes/navigation_hadiah');
    ?>


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