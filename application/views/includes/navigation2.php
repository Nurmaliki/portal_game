<div class="row text-center">
    <div style="overflow: hidden;
    background-color: transparent;
    background-image: url(http://gaspol.in/gaspol/web/assets/images/imggame/menubar2.png);
    background-position: center;
    background-size: contain;
    background-repeat: no-repeat;
    bottom: 0;
    width: 100%;">
        <a href="#" onclick="goBack()" class=""> <img width="50" height="auto" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/backbutton.png" alt="">
        </a>
        <a href="<?php echo $this->config->item('base_url'); ?>?access=<?php echo $_GET['access']; ?>"><img width="50" height="auto" src="<?php echo $this->config->item('assets_url'); ?>assets/images/imggame/home.png" alt="">

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