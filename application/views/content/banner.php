<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Upload Banner
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>news_content">News Content</a></li>
        <li class="active">Upload Banner</li>
      </ol>
    </section>
    <!-- EndContent Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    	<div class="row">
	        <div class="col-xs-12">
	        
            
            </div>
        </div>
        <div class="box" >
            <div class="box-header with-border">
                <h3 class="box-title">Home Banner Images</h3>
                <div class="box-tools pull-right">
                
                    <!-- <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button> -->
                    
                </div>
            </div>
            <div class="box-body" style="">
                <div class="row">
                <?php if(!empty($banner)){ 
                    foreach ($banner as $key => $value) {
                ?>
                    <div class="col-sm-4" style="height:256px; width:356px;position: relative;max-height: 256px;overflow-y: hidden;margin-bottom: 25px;">
                        <a href="<?php echo $this->config->item('base_url') ?>banner/banner_delete/<?php echo $value ?>">
                            <button style="background-color: rgb(240,30,30,1);padding: 10px;border: none;position: absolute;box-shadow: 0px 3px 4px rgb(50,50,50,0.5);width: 40px;right: 0;">
                                <i style="color: rgb(255,255,255);" class="fa fa-close"></i>
                            </button>
                        </a>
                        <div style="background:url('<?php echo  $this->config->item('asset_url') ?>/cms_btn/uploads/home-banner/<?php echo $value; ?>');background-size: cover;width: 100%;height: 100%;">
                        </div>
                    </div>
                <?php } ?>
                <?php } ?>
                </div>
            <hr>
                <form role="form" action="<?php echo $this->config->item('base_url'); ?>banner/do_upload" method="post"   id="banner" enctype="multipart/form-data" >

                <!-- <input type="file" name="userfile" size="20" form="banner" accept="image/*"/> -->
                <input type="file" name="userfile" size="20" form="banner"/>

                <br /><br />

                <input type="submit" value="upload" class="btn btn-primary"/>
                <?php //echo 'img = '.$img ;?>
               

                </form>
            </div> 
        </div>
	</section>

    <!-- End Main content -->
</div>
<!-- End Content Wrapper. Contains page content -->