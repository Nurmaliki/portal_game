<style>
    .navbar {
        overflow: hidden;
        /* background-color: #333; */
        background-image: url('<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/menubar2.png');
        background-size: contain;
  	background-repeat: no-repeat;
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

<body style=" overflow-x: hidden !important;max-width: 100% !important; background-size:contain;background-repeat: repeat-y; background-image: url(<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/halamanweb.png);
">

   



    <div class="container">
        <div class="row text-center">
            <img width="" style="margin-top:5px;    width: 188px;" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/logo.png" alt="">
        </div>
        <div style="margin-top:0px" class="row mt-5">
            <div class="col-6 col-md-6 col-lg-6 col-xs-6 col-sm-6">
              <!--  <a class="" style=" border:lawngreen; " href="<?php echo $this->config->item('base_url'); ?>login/logout">
                    <img width="140" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/logout.png" alt="">
                </a>
		-->
            </div>
            <div class="col-6 col-md-6 col-lg-6 col-xs-6 col-sm-6">
               <!-- <a class=" justify-content-center align-items-center" style="margin-top:20px;" href="">
                    <h3 style="margin-top:70px ;  margin-left: 72px;"> <?php
                                                                        echo $this->session->userdata['user_data_web']['poin'];
                                                                        ?> Poin</h3>
                </a>
		-->
            </div>
        </div>
    </div>


    <?php // print_r($data); ?>
    <div class="row">
        <!-- <div class="c"></div> -->
        <div class="col-md-12 col-sm-12 col-xs-12 center-block text-center">
            <div class="card mb-3" style="max-width: 100%; padding:20px">
                <div class="row no-gutters">
                    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                        <img style="    width: 150px" width="100" src=" <?php print_r($data['picture']); ?>" class="card-img" alt="...">
                    </div>
		</div>
		 <div style="margin-top: 10px;" class="row no-gutters">

                    <div  class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                        <div class="card-body">

                            <a style="width:50%; " href="<?php echo $this->config->item('base_url'); ?>welcome/detail_game_play/<?php echo $data['id'];  ?>?access=<?php echo $_GET['access']; ?>" class="btn btn-info">Play </a>
                        </div>
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                        <div style="padding: 20px" class="card-body text-center">
                            <h3 class="card-title"><?php print_r($data['title']); ?></h3>
                            <p class="card-text"><?php print_r($data['body']); ?></p>
                            <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <!-- </section> -->
    <!--  -->



    <!-- </div> -->
    <?php 
    $this->load->view('includes/navigation2');
    ?>
    <!-- /.content-wrapper -->

    <script type="text/javascript">
        // $('.alert').alert();
        $(document).ready(function() {


            $(document).on('click', ':not(form)[data-confirm]', function(e) {
                if (!confirm($(this).data('confirm'))) {
                    e.stopImmediatePropagation();
                    e.preventDefault();
                }
            });

            function sorting_data() {
                alert("wqdqwd");
            }
        });
    </script>
</body>