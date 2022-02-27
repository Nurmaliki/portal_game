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
        background-color: #dae4e8;
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

<body test style="background-size:cover;  background-color: #dae4e8;
">

    <div class="container">

        <div class="row text-center">
            <img id="logoid" width="" style="margin-top:20px;    width: 188px;" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/newgame.png" alt="">
        </div>
        <div id="margintoppoin" style="margin-top: 10%;" class="row ">
            <div class="col-6 col-md-6 col-lg-6 col-xs-6 col-sm-6">
                <a class="btn-info btn" style=" border:lawngreen; background-color: #fdcb6e; border-color: #fdcb6e; font-weight: bold;" href="<?php echo $this->config->item('base_url'); ?>login/logout">
                    Logout
                </a>
            </div>
            <div class="col-6 col-md-6 col-lg-6 col-xs-6 col-sm-6">
                <a class=" justify-content-center align-items-center" style="" href="">
                    <p id="infopoin" style=" color: #fdcb6e;    font-weight: bold; margin-left: 72px;     white-space: nowrap;  font-size: 1.5em;"> <?php
                                                                                                                                                    echo $this->session->userdata['user_data_web']['poin'];
                                                                                                                                                    ?> Poin</p>
                </a>
            </div>
        </div>
        <div id="infoprotest" class="row" style="padding:10%">

            <p style="    font-size: 15px;">
                Layanan GASPOL : <br>


            </p>

            <ul style="list-style-type:square">
                <li>Layanan Games berbasis Portal khusus pelanggan Three</li>
                <li>Tarif Rp. 1100/2hr</li>
                <li>Pelanggan dapat mengumpulkan poin untuk mendapatkan Hadiah yang diinginkan.</li>
                <li>Akses ke portal Gaspol untuk tingkatkan poin.</li>
                <li>Informasi lebih lanjut bisa hubungi CS: 02156963403</li>
            </ul>

        </div>

        <br>
        <div class="row text-center">

        </div>




    </div>

    <?php
    $this->load->view('includes/navigation_info');
    ?>


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