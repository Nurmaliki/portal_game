<div class="container">
    <div class="card image-gallery-card direction-rtl">
        <div class="card-body ">
            <div class="row">
                <img class="mb-3 d-flex justify-content-center rounded" src="<?php print_r($data['picture']); ?>" alt="">

            </div>


            <center> <a class="btn btn-primary-ungu mb-4 " href="<?php echo $this->config->item('base_url'); ?>welcome/detail_game_play/<?php echo $data['id'];  ?>?access=<?php echo $_GET['access']; ?>" onclick="goForward()">play</a> </center>

            <h5 class="text-center"><?php print_r($data['title']); ?></h5>
            <p class="text-center"><?php print_r($data['body']); ?>.</p>


        </div>
    </div>
</div>