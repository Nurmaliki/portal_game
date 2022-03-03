<div class="container">
    <div class="card image-gallery-card direction-rtl">
        <div class="card-body"><img class="mb-3 rounded" src="<?php print_r($hadiah['picture']); ?>" alt="">
            <h5 class="text-center mb-3"><?php print_r($hadiah['name']); ?></h5>

            <center> <a onclick="tukar_hadiah('<?php echo $this->config->item('base_url'); ?>/hadiah/penukaran_hadiah_act/<?php echo $hadiah['id']; ?>?access=<?php echo $_GET['access']; ?>','Tukar <?php echo $hadiah['poin']; ?> poin dengan hadiah ini?')" class="btn btn-primary-ungu mb-4 " href="#">Tukar Poin</a> </center>

        </div>
    </div>
</div>