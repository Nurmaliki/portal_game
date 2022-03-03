

<div class="content-wrapper">

    <section class="content-header">
      <h1>
        Logo
        <small>Merchant</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>pagecontent">Page And Content</a></li>
        <li class="active">Logo Merchant</li>
      </ol>
    </section>
    <!-- EndContent Header (Page header) -->

    <section class="content">
    	<div class="row">
	        <div class="col-xs-12">
	        	<div class="box box-primary">

              <!-- Alert Tentang -->
              <?php if($this->session->flashdata('msgLogoMerchantF')){ ;?>
                <div style="width: 61%;" id="alerts" class="alert alert-success" role="alert">
                    <strong><?php echo $this->session->flashdata('msgLogoMerchantF');?></strong>
                </div>
              <?php }else if($this->session->flashdata('msgLogoMerchantT')){?>
                    <div style="background: #d4edda !important;color: #155724 !important;   width: 61%;" id="alerts" class="alert alert-success" role="alert">
                        <strong><?php echo $this->session->flashdata('msgLogoMerchantT');?></strong>
                    </div>
              <?php } ?>
		            <!-- /.box-header -->

                    <!-- form start -->
                    <form  role="form" action="<?php echo $this->config->item('base_url'); ?>pagecontent/actionlogo" method="POST" enctype="multipart/form-data" id="inputSponsor">
                      <div class="box-body">
                        <h1>Insert</h1>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input required type="text" class="form-control" id="fullname" placeholder="" name="name">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Url</label>
                                    <input required value=""  class="form-control" type="url" name="url">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Img</label>
                                    <input required class="form-control"  type="file" size="20" name="userfile" form="inputSponsor">
                                    <label style="font-weight: 70px!important;    font-size: x-small;" for="exampleInputEmail1">file size (100 kb), image size (160 px * 45 px) dan Tipe (PNG, JPG ,JEPG)</label>

                                </div>


                      </div>
                      <!-- /.box-body -->

                      <div class="box-footer">
                        <input value="Upload"  type="submit" class="btn btn-primary">
                      </div>
                    </form>
                    <!-- form End -->
                    <!-- <div style="margin-top: 20%" class="box-body"> -->


                                    </div>
                              </div>
                      </div>

                    <div class="row">
              	        <div class="col-xs-12">
              	        	<div class="box box-warning">

                    <div class="row">
                                <?php
                                if(empty($data)){

                                }else{
                                for ($i = 0 ; $i < count($data);$i++ ){
                                ?>
                                <div class="col-md-6">
                                  <form  role="form2" action="<?php echo $this->config->item('base_url'); ?>pagecontent/actionUpdatelogo/<?php echo $data[$i]["id"]?>" method="post" enctype="multipart/form-data" id="editsponsor">
                                      <div class="box-body">
                                      <h1><?php print_r($i+1)?></h1>
                                      <div class="form-group">
                                          <img width="100" height="50" src="<?php echo  $this->config->item('assets_url'); ?>uploads/logo/<?php echo $data[$i]["img"]?>">
                                      </div>
                                          <div class="form-group">
                                              <label for="exampleInputEmail1">Name</label>
                                              <input required type="text" class="form-control" id="fullname" placeholder="" value = "<?php print_r($data[$i]["name"]); ?>"name="name">
                                          </div>

                                          <div class="form-group">
                                              <label for="exampleInputEmail1">Url</label>
                                              <input value = "<?php print_r($data[$i]["url"]); ?>" class="form-control" type="url" name="url">
                                          </div>

                                          <div class="form-group">
                                              <label for="exampleInputEmail1">Img</label>
                                              <input class="form-control"  type="file" size="20" name="userfile" form2="editsponsor">
                                              <label style="font-weight: 70px!important;    font-size: x-small;" for="exampleInputEmail1">file size (100 kb), image size (160 px * 45 px) dan Tipe (PNG, JPG ,JEPG)</label>

                                          </div>


                                      </div>

                                      <div class="box-footer">
                                          <button type="submit" class="btn btn-primary">update</button>
                                          <a class="btn btn-warning"  data-confirm="Are you sure you want to Delete this data?" href="<?php echo $this->config->item('base_url'); ?>pagecontent/actionLogoDelete/<?php echo $data[$i]["img"]?>">Delete</a>
                                      </div>
                                  </form>
                                </div>


                                <?php
                                }
                                }
                                ?>
                    </div>


                      <!-- </div> -->

		          </div>
	        </div>
	    </div>
	</section>

    <!-- End Main content -->
</div>
<script type="text/javascript">
$(document).ready(function() {
	$('#member').DataTable( {
        "processing": true,
        "serverSide": true,
		"bFilter": false,
        "ajax": "<?php echo $this->config->item('base_url'); ?>admin/datatables",
		"type": "GET"
    } );
} );
$(document).on('click', ':not(form)[data-confirm]', function(e){
        if(!confirm($(this).data('confirm'))){
            e.stopImmediatePropagation();
            e.preventDefault();
        }
    });
</script>
<!-- End Content Wrapper. Contains page content -->
