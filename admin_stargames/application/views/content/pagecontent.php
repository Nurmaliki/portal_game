<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Page And Content
        <small>Setting</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>member">Page And Content</a></li>
        <li class="active">Setting</li>
      </ol>
    </section>
    <!-- EndContent Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    	<div class="row">
	        <div class="col-xs-8">
            <a href="<?php echo $this->config->item('base_url');?>pagecontent/beranda" >
	        	<div class="box">
		            <!-- /.box-header -->
		            <div class="box-body">
                        <div class="row" style="padding:10px;">

                            <h1>Beranda</h1>
                            <!-- <a href="<?php echo $this->config->item('base_url');?>pagecontent/beranda" class="btn btn-info">Edit</a> -->
                        </div>



		            </div>
		            <!-- /.box-body -->
		        </div>
          </a>
	        </div>
	    </div>

        <div class="row">
	        <div class="col-xs-8">
              <a href="<?php echo $this->config->item('base_url');?>pagecontent/tentang" >
	        	<div class="box">
		            <!-- /.box-header -->
		            <div class="box-body">
                        <div class="row" style="padding:10px;">

                            <h1>Tentang</h1>
                            <!-- <a href="<?php echo $this->config->item('base_url');?>pagecontent/tentang" class="btn btn-info">Edit</a> -->
                        </div>



		            </div>
		            <!-- /.box-body -->
		        </div>
          </a>
	        </div>
	    </div>

        <div class="row">
	        <div class="col-xs-8">
              <a href="<?php echo $this->config->item('base_url');?>pagecontent/syaratketentuan">
	        	<div class="box">
		            <!-- /.box-header -->
		            <div class="box-body">
                        <div class="row" style="padding:10px;">

                            <h1>Syarat Dan Ketentuan</h1>
                            <!-- <a href="<?php echo $this->config->item('base_url');?>pagecontent/syaratketentuan" class="btn btn-info">Edit</a> -->
                        </div>



		            </div>
		            <!-- /.box-body -->
		        </div>
          </a>
	        </div>
	    </div>

        <div class="row">
	        <div class="col-xs-8">
            <a href="<?php echo $this->config->item('base_url');?>pagecontent/faq#input" >
	        	<div class="box">
		            <!-- /.box-header -->
		            <div class="box-body">
                        <div class="row" style="padding:10px;">

                            <h1>FAQ</h1>
                            <!-- <a href="<?php echo $this->config->item('base_url');?>pagecontent/faq" class="btn btn-info">Edit</a> -->
                        </div>



		            </div>
		            <!-- /.box-body -->
		        </div>
          </a>
	        </div>
	    </div>

	    <div class="row">
	        <div class="col-xs-8">
              <a href="<?php echo $this->config->item('base_url');?>pagecontent/sponsor">
	        	<div class="box">
		            <!-- /.box-header -->
		            <div class="box-body">
                        <div class="row" style="padding:10px;">

                            <h1>Logo Merchant Footer</h1>
                            <!-- <a href="<?php echo $this->config->item('base_url');?>pagecontent/sponsor" class="btn btn-info">Edit</a> -->
                        </div>



		            </div>
		            <!-- /.box-body -->
		        </div>
            </a>
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
