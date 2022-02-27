<style>
    #background {
        width: 100%;
        height: 10%;
        position: fixed;
        left: 0px;
        z-index: 0;
        bottom: 0;
    }

    .stretch {
        width: 100%;
        height: 100%;

    }
</style>
<div class="row text-center" style="margin-left: 0px;">

    <div id="background" style="background: #d4dde0;">

    </div>

    <div style="overflow: hidden;
    position: fixed;
    bottom: 0;
    width: 100%;">
        <a href="#" onclick="goBack()" class=""> <img width="65" height="auto" style="float:left" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/backbutton.png" alt="">
        </a>
        <a href="<?php echo $this->config->item('base_url'); ?>?access=<?php echo $_GET['access']; ?>"><img width="65" height="auto" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/home.png" alt="">

        </a>
        <a href="<?php echo $this->config->item('base_url'); ?>/welcome?access=<?php echo $_GET['access']; ?>" class="pill-right"> <img width="65" height="auto" style="float:right" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/nextbutton.png" alt="">
        </a>
    </div>
</div>
<script>
    function goForward() {
        window.history.forward();
    }

    function goBack() {
        window.history.back();
    }
</script>