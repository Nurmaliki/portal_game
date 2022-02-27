<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Themes <small></small></h1>
	</section>

    <section class="content" style="background: rgb(255,255,255);margin: 20px;padding: 0px;padding-left: 20px !important; padding-right: 20px !important;margin-top: 20px !important;">
        <?php if(isset($_SESSION["create_theme"])){ ?>
            <br>
            <?php if($_SESSION["create_theme"]["status"] == true){ ?>
                <div class="alert alert-success" role="alert" style="background: #d4edda !important;color: #155724 !important;">
                  <?php echo $_SESSION["create_theme"]["message"]; ?>
                </div>
            <?php }else{ ?>
                <div class="alert alert-danger" role="alert" style="background: #f8d7da !important;color: #721c24 !important;">
                  <?php echo $_SESSION["create_theme"]["message"]; ?>
                </div>
            <?php } ?>
        <?php }
            unset($_SESSION["create_theme"]);
        ?>

        <?php (isset($_SESSION["themes_banner_file_alert"])) ? print_r($_SESSION["themes_banner_file_alert"]) : print_r(""); ?>
        <br>
        <?php (isset($_SESSION["themes_bendera_kiri_alert"])) ? print_r( $_SESSION["themes_bendera_kiri_alert"]) : print_r("") ?>  <br>
        <?php (isset($_SESSION["themes_logo_file_alert"])) ? print_r( $_SESSION["themes_logo_file_alert"]) : print_r( "") ?>  <br>
        <?php (isset($_SESSION["themes_bendera_kanan_alert"])) ? print_r( $_SESSION["themes_bendera_kanan_alert"]) : print_r( "") ?>  <br>
        <?php (isset($_SESSION["themes_content_divider_file_alert"])) ? print_r( $_SESSION["themes_content_divider_file_alert"]) : print_r("") ?>  <br>
        <?php (isset($_SESSION["themes_footer_left_file_alert"])) ? print_r( $_SESSION["themes_footer_left_file_alert"]) : print_r("") ?>  <br>
        <?php (isset($_SESSION["themes_footer_right_file_alert"])) ? print_r( $_SESSION["themes_footer_right_file_alert"]) :  print_r("") ?>  <br>

        <div></div>
        <div class="row" style="padding: 20px;">
            <div class="col-sm-12" style="position: relative;">
                <a href="<?php echo $this->config->item('base_url');?>themes/create" class="theme_boxes add" style="cursor: pointer;margin: 10px;height: 200px;">
                     <center><i style="font-size: 45px;opacity: 0.3;margin: 75px;" class="fa fa-plus "></i></center>
                </a>
             </div>
            <?php foreach ($data as $key => $value) { ?>
                <div class="col-sm-6" style="position: relative;">
                    <div style="border: 1px solid rgb(230,230,230);height: 200px;margin: 10px;background-size: contain;background: url('<?php echo $this->config->item('assets_url_portal'); ?>/application/uploads/themes/<?php echo $value["directory"] ?>/themes_logo_file.png');    background-repeat: no-repeat;background-position: 45px 90px;">

                        <div>
                             <div style="background: rgb(240,240,240);position: absolute;padding: 15px;color: rgb(100,100,100);font-weight: bolder;border-radius: ;font-size: 13px;left: 25px;right: 25px;box-shadow: 0px 2px 1px rgba(150,150,150,0.3);">
                                <div class="row" style="display: flex;align-items: center;">
                                    <div class="col-sm-5" style="text-overflow: ellipsis;overflow-x: hidden;">
                                       <span style="font-size: 14px"> <?php print_r($value["theme_name"]); ?></span>
                                    </div>
                                    <div class="col-sm-6" style="display: flex;">
                                        <button  class="btn btn-danger" style="height: 35px;margin-right: 10px;margin-left: -17px;">
                                            <a href="<?php echo $this->config->item('base_url');  ?>themes/delete?id=<?php echo $value["id"] ?>" style="color: white;margin-right: -3px;"  class="fa fa-fw fa-trash" data-confirm="Are you sure you want to Delete this data?">&nbsp;</a>
                                        </button>
                                        <button  class="btn btn-info" style="height: 35px;margin-right: 10px;margin-left: 10px;">
                                            <a  href="<?php echo $this->config->item('base_url');  ?>themes/edit/<?php echo $value["id"] ?>" style="color: white;margin-right: -3px;"  class="fa fa-fw fa-pencil-square-o" >&nbsp;</a>
                                        </button>
                                        <?php if($value["is_default"] == 0){ ?>
                                            <a href="<?php echo $this->config->item('base_url');  ?>themes/apply?id=<?php echo $value["id"] ?>" class="btn btn-primary" style="height: 35px;margin-right: 10px;margin-left: px;">Terapkan</a>
                                        <?php }else{ ?>
                                            <a class="btn btn-success" style="height: 35px;margin-right: 10px;margin-left: px;cursor: no-drop;">Diterapkan</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                           <center>
                           </center>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <!-- End Main content -->
</div>
<!-- End Content Wrapper. Contains page content -->
