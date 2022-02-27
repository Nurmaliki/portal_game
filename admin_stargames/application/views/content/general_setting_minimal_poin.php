<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        General Setting
        <small>Minimal Poin</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>news_content">General Setting </a></li>
        <li class="active">Minimal Poin</li>
      </ol>
    </section>
    <!-- EndContent Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    	<div class="row">
	        <div class="col-xs-12">
	        	<div class="box box-primary">
		            <div class="box-header with-border">
		              <h3 class="box-title">Minimal Poin</h3>
		            </div>



                <!-- Alert Tentang -->
                <?php if($this->session->flashdata('minimalPoinFalse')){ ;?>
                  <div style="width: 61%;" id="alerts" class="alert alert-success" role="alert">
                      <strong><?php echo $this->session->flashdata('minimalPoinFalse');?></strong>
                  </div>
                <?php }else if($this->session->flashdata('minimalPoinTrue')){?>
                      <div style="background: #d4edda !important;color: #155724 !important;   width: 100%; " id="alerts" class="alert alert-success" role="alert">
                          <strong><?php echo $this->session->flashdata('minimalPoinTrue');?></strong>
                      </div>
                <?php } ?>



		            <!-- /.box-header -->
								<!-- form start -->

					<form role="form" action="<?php echo $this->config->item('base_url'); ?>setting/update_minimal_poin" method="post" enctype="multipart/form-data">
		            <input type="hidden" id="id" name="id" value="<?php echo $content['id'] ?>">
		              	<div class="box-body">
							<div class="form-group">
								<label for="exampleInputEmail1">Minimal Poin</label>
									<input type="number" name="value" class="form-control" placeholder="minimal_poin" value="<?php echo $content['value'] ?>">
									<p style="margin-left:10px;" for="exampleInputEmail1">Jumlah minimal poin untuk dapat melakunan penukaran poin serbu</p>

							</div>
						</div>
						<div class="box-footer">

							<button type="submit" class="btn btn-primary" value="update">Submit</button>
						</div>
		            </form>
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
        "ajax": "<?php echo $this->config->item('base_url'); ?>member/datatables",
		"type": "GET"
    } );


	$("button").click(function() {
    var fired_button = $(this).val();

		document.getElementById("upload").value = fired_button;
		$(".formData").val(fired_button)
		//alert(fired_button);

	});
} );
</script>
<!-- End Content Wrapper. Contains page content -->
