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

<!-- Info boxes -->

<body style="background-color: #f3fbff;">

    <div class="container">

        <div class="row text-center">
            <img id="logoid" width="" style="margin-top:20px;    width: 188px;" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/newgame.png" alt="">
        </div>
        <div id="margintoppoin" class="row " style="margin-top:-57px">
            <div class="col-6 col-md-6 col-lg-6 col-xs-6 col-sm-6">

            </div>
            <div class="col-6 col-md-6 col-lg-6 col-xs-6 col-sm-6">

            </div>
        </div>
        <div class="row" style="margin-top:50px;">



            <div class="container p-5" style="padding: 20px">

                <div class="col-md-12 col-sm-6 col-xs-12 center-block text-center">
                    <div class="card mb-3">
                        <a href="#" data-confirm="Tukar <?php echo $hadiah['poin']; ?> dengan hadiah ini?">
                            <img src=" <?php print_r($data['picture']); ?>" width="150px" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <br>
                            <!-- <a style="    width: 150px;" href="<?php echo $this->config->item('base_url'); ?>welcome/detail_game_play/<?php echo $data['id'];  ?>?access=<?php echo $_GET['access']; ?>" class="btn btn-primary" data-confirm="Tukar <?php echo $hadiah['poin']; ?> dengan hadiah ini?">Play</a> -->
                            <a style=" background-color: #00b894;font-weight: bold;  border: none;   width: 150px;" href="<?php echo $this->config->item('base_url'); ?>welcome/detail_game_play/<?php echo $data['id'];  ?>?access=<?php echo $_GET['access']; ?>" class="btn btn-primary">Play</a>

                            <h5 class="card-title"> <?php print_r($data['title']); ?></h5>
                            <p style="    overflow-x: hidden; height: 210px;
                overflow-x: auto; " class="card-text"><?php print_r($data['body']); ?>.</p>

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php
    $this->load->view('includes/navigation_hadiah');
    ?>









    <!-- </div> -->
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