<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Beranda
        <small>Setting</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>pagecontent">Beranda</a></li>
        <li class="active">Setting</li>
      </ol>
    </section>

    <section class="content">
    	<div class="row">
	        <div class="col-xs-12">


            </div>
        </div>
        <div class="box" >
            <!-- <div class="box-header with-border">
                <h3 class="box-title">Home Banner Images</h3>
            <div class="box-tools pull-right">

            </div>
            </div>
            <div class="box-body" style="">

                <?php if($this->session->flashdata('msgalert')){ ;?>
                        <div id="alert" class="alert alert-success" role="alert">
                        <strong><?php echo $this->session->flashdata('msgalert');?></strong>
                        </div>
                <?php } ;?>


                <div class="row">
                <?php if(!empty($banner)){
                    foreach ($banner as $key => $value) {
                ?>
                    <div class="col-sm-4" style="height:256px; width:356px;position: relative;max-height: 256px;overflow-y: hidden;margin-bottom: 25px;">
                        <a href="<?php echo $this->config->item('base_url') ?>pagecontent/banner_delete/<?php echo $value ?>">
                            <button style="background-color: rgb(240,30,30,1);padding: 10px;border: none;position: absolute;box-shadow: 0px 3px 4px rgb(50,50,50,0.5);width: 40px;right: 0;">
                                <i style="color: rgb(255,255,255);" class="fa fa-close"></i>
                            </button>
                        </a>
                        <div style="background:url('<?php echo  $this->config->item('assets_url') ?>uploads/home-banner/<?php echo $value; ?>');background-size: cover;width: 100%;height: 100%;">
                        </div>
                    </div>
                <?php } ?>
                <?php } ?>
                </div>
            <hr>
                <form role="form" action="<?php echo $this->config->item('base_url'); ?>pagecontent/do_upload" method="post"   id="banner" enctype="multipart/form-data" >

                <input type="file" name="userfile" size="20" form="banner"/>

                <br /><br />

                <input type="submit" value="upload" class="btn btn-primary"/>



                </form>
            </div>  -->





            <div class="box-body" style="">

            <hr>
          <form action="<?php echo $this->config->item('base_url'); ?>pagecontent/update_beranda_title/<?php print_r($this->PageContent_model->beranda_title()[0]['id'])?>" method="post"  enctype="multipart/form-data" id="inputSponsorxx<?php print_r($this->PageContent_model->beranda_title()[0]['id'])?>">
			<div class="row" style="padding:10px;">
                <!-- <label for="exampleInputEmail1">Title beranda</label>
                <input style="width:100%" name="text" id="" cols="60" rows="10" value="<?php print_r($this->PageContent_model->beranda_title()[0]['text'])?>"> -->

            </div>
            <div class="row" style="padding:10px;">
                <label for="exampleInputEmail1">Title beranda</label>
                <!-- <input style="width:100%" name="text" id="" cols="60" rows="10" value="<?php // print_r($this->PageContent_model->beranda_title()[0]['text'])?>"> -->
                <textarea class="editor" name="text" rows="8" cols="80"><?php print_r($this->PageContent_model->beranda_title()[0]['text'])?></textarea>
            </div>
            <div class="row" style="padding:10px;">

                <label for="exampleInputEmail1">Sub title beranda</label>
                <!-- <input class="form-control" style="width:100%" name="text_2" id="" cols="60" rows="10" value="<?php // print_r($this->PageContent_model->beranda_title()[0]['text_2'])?>"> -->
                <textarea class="editor" name="text_2" rows="8" cols="80"><?php print_r($this->PageContent_model->beranda_title()[0]['text_2'])?></textarea>

            </div>

    	   <div class="box-footer">
            	<button type="submit" class="btn btn-primary">Update</button>

          </div>
    	</form>
            </div>

        </div>
	</section>
</div>

<!-- End Content Wrapper. Contains page content -->

<!-- <script type="text/javascript">
    // setTimeout(function(){ document.getElementById('alert').fadeOut(); }, 3000);
     $("#alert").fadeOut();
</script>  -->
