Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Setting sosial Media
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>setting">Setting</a></li>
        <li class="active"> Setting Sosial Media</li>
      </ol>
    </section>
    <!-- EndContent Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    	<div class="row">
	        <div class="col-xs-12">
	        	<div class="box box-primary">
		            <div class="box-header with-border">
		              <h3 class="box-title">Setting Sosial Media</h3>
		            </div>


                <!-- Alert Tentang -->
                <?php if($this->session->flashdata('sosialMediaFalse')){ ;?>
                  <div style="width: 61%;" id="alerts" class="alert alert-success" role="alert">
                      <strong><?php echo $this->session->flashdata('sosialMediaFalse');?></strong>
                  </div>
                <?php }else if($this->session->flashdata('sosialMediaTrue')){?>
                      <div style="background: #d4edda !important;color: #155724 !important;   width: 100%; " id="alerts" class="alert alert-success" role="alert">
                          <strong><?php echo $this->session->flashdata('sosialMediaTrue');?></strong>
                      </div>
                <?php } ?>


		            <!-- /.box-header -->
		            <!-- form start -->
		            <form role="form" action="<?php echo $this->config->item('base_url'); ?>sosial_media/action_update" method="post">
		              <div class="box-body">
		                <div class="form-group">
							<label for="exampleInputEmail1">You Tube</label>
		                    <input required type="text" class="form-control" id="name" placeholder="url you tube" name="youtube" value="<?php echo  $youtube["url"]?>">
		                </div>
                        <div class="form-group">
							<label for="exampleInputEmail1">Twitter</label>
		                    <input required type="text" class="form-control" id="name" placeholder="url twitter" name="twitter" value="<?php echo  $twitter["url"]?>">
		                </div>
                        <div class="form-group">
							<label for="exampleInputEmail1">Facebook</label>
		                    <input required type="text" class="form-control" id="name" placeholder="url facebook" name="facebook" value="<?php echo  $facebook["url"]?>">
		                </div>
                        <div class="form-group">
							<label for="exampleInputEmail1">Instagram</label>
		                    <input required type="text" class="form-control" id="name" placeholder="url instagram" name="instagram" value="<?php echo $instagram["url"]?>">
		                </div>

                        <div class="form-group">
							<label for="exampleInputEmail1">OJK</label>
		                    <input required type="text" class="form-control" id="name" placeholder="OJK" name="ojk" value="<?php echo $ojk["url"]?>">
		                </div>

                        <div class="form-group">
							<label for="exampleInputEmail1">Email</label>
		                    <input required type="text" class="form-control" id="name" placeholder="Email" name="email" value="<?php echo  $email["url"]?>">
		                </div>

                        <div class="form-group">
							<label for="exampleInputEmail1">Telepon</label>
		                    <input required type="text" class="form-control" id="name" placeholder="telepon" name="telepon" value="<?php echo  $telepon["url"]?>">
		                </div>
                        <div class="form-group">
							<label for="exampleInputEmail1">Google Play Store</label>
		                    <input required type="text" class="form-control" id="name" placeholder="Google Play" name="playstore" value="<?php echo  $playstore["url"]?>">
		                </div>

                        <div class="form-group">
							<label for="exampleInputEmail1">App Store</label>
		                    <input required type="text" class="form-control" id="name" placeholder="App Store" name="appstore" value="<?php  echo $appstore["url"]?>">
		                </div>




		              </div>
		              <!-- /.box-body -->

		              <div class="box-footer">
		                <button type="submit" class="btn btn-primary">Submit</button>
		              </div>
		            </form>
		          </div>
	        </div>
	    </div>
	</section>

    <!-- End Main content -->
</div>
<!-- End Content Wrapper. Contains page content
