<?php

if ($this->session->flashdata('alert_hadiah_success') == "") {

    header("location: " . $this->config->item('base_url') . "hadiah?access=" . $_GET['access']);
    die;

    // || !isset($this->session->flashdata('alert_hadiah_success'))){ 
} elseif ($this->session->flashdata('alert_hadiah_success') == "") {

    header("location: " . $this->config->item('base_url') . "hadiah?access=" . $_GET['access']);
    die;
?>

<?php } else { ?>


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
            <div class="row" style=" height: 270px; 
                overflow-x: hidden; 
                overflow-x: auto; 
">



                <div class="container p-5" style="padding: 20px">

                    <div class="col-md-12 col-sm-6 col-xs-12 center-block text-center">
                        <div class="card mb-3">

                            <?php if ($this->session->flashdata('alert_hadiah_success')) {; ?>


                                <p class="card-text"><?php echo $this->session->flashdata('alert_hadiah_success'); ?></p>

                                <img src=" <?php print_r($this->session->flashdata('picture')); ?>" width="100" class="card-img-top" alt="...">

                                <p class="card-text"><?php echo $this->session->flashdata('alert_hadiah_success2'); ?></p>



                            <?php } elseif ($this->session->flashdata('alert_hadiah_falid')) { ?>


                                <?php echo $this->session->flashdata('alert_hadiah_falid');

                                ?>


                            <?php } ?>
                            <!-- <a href="<?php echo $this->config->item('base_url'); ?>/hadiah/penukaran_hadiah_act/<?php echo $hadiah['id']; ?>"  data-confirm="Are you sure you want to Delete this data?">
                            <img src=" <?php print_r($hadiah['picture']); ?>" width="100" class="card-img-top" alt="...">
                        </a> -->
                            <!-- <div class="card-body">
                                <h5 class="card-title"> <?php print_r($hadiah['name']); ?></h5>
                                <p class="card-text"><?php print_r($hadiah['descripsi']); ?>.</p>
                                <p class="card-text"><small class="text-muted">Dapat di tukarkan dengan <?php print_r($hadiah['poin']); ?> Senilai Rp.<?php print_r($hadiah['harga']); ?></small></p>
                                <a href="<?php echo $this->config->item('base_url'); ?>/hadiah/penukaran_hadiah_act/<?php echo $hadiah['id']; ?>" class="btn btn-primary" data-confirm="Are you sure you want to Delete this data?">Tukar Poin</a>
                            </div> -->
                        </div>
                    </div>

                </div>



            </div>




        </div>

        <?php
        $this->load->view('includes/navigation_hadiah');
        ?>

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

<?php } ?>