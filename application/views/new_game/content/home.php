<div class="container">
    <div class="card image-gallery-card direction-rtl">
        <div class="card-body"><img class="mb-3 rounded" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/newgame.png" alt="">

            <?php if ($this->session->userdata['user_data_web']['is_first_login_today']) {      ?>


                <h5 class="text-center mb-3">Selamat Poin Kamu Bertambah</h5>

                <div style="    background-color: #a3cb38;" class="card card-round mb-3">
                    <div class="card-body d-flex justify-content-center direction-rtl">
                        <!-- <div class="card-img-wrap"><img src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/newgame.png" alt=""></div> -->
                        <div class="card-content">
                            <h5 style="    font-size: 2em;" class=" text-center"> <?php echo $this->session->userdata['user_data_web']['bonuspoin'];
                                                                                    echo " Poin";  ?></h5>
                        </div>
                    </div>
                </div>
            <?php } ?>


            <h5 class="text-center mb-5">Kumpulkan Poin Anda Dan Dapatkan Hadiah Juataan Rupiah</h5>
            <!-- <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. </p>
            <p>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p> -->


            <center>

                <a class="btn btn-primary-ungu mb-4 " href="<?php echo $this->config->item('base_url'); ?>info?access=<?php echo $_GET['access']; ?>" onclick="goBack()">Info Program</a>
                <a class="btn btn-primary-ungu mb-4 " href="<?php echo $this->config->item('base_url'); ?>hadiah?access=<?php echo $_GET['access']; ?>">Tukar Poin</a>
                <a class="btn btn-primary-ungu mb-4 " href="<?php echo $this->config->item('base_url'); ?>welcome?access=<?php echo $_GET['access']; ?>" onclick="goForward()">Pilih Game</a>
            </center>




        </div>
    </div>
</div>