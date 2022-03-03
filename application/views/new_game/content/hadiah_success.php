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


    <?php if ($this->session->flashdata('alert_hadiah_success')) { ?>




        <div class="container">
            <div class="card image-gallery-card direction-rtl">
                <div class="card-body"><img class="mb-3 rounded" src="<?php print_r($this->session->flashdata('picture')); ?>" alt="">
                    <h5 class="text-center"><?php echo $this->session->flashdata('alert_hadiah_success'); ?></h5>


                </div>
            </div>
        </div>

    <?php } elseif ($this->session->flashdata('alert_hadiah_falid')) { ?>

        <div class="container">
            <div class="card image-gallery-card direction-rtl">
                <div class="card-body">

                    <h5 class="text-center"> <?php echo $this->session->flashdata('alert_hadiah_falid');    ?> </h5>


                </div>
            </div>
        </div>


    <?php } ?>


<?php } ?>