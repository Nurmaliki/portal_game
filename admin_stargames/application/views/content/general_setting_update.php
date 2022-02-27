<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        General Setting
        <small>Update <?php echo $content[0]['parameter'];  ?></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>news_content">General Setting </a></li>
        <li class="active">Update <?php echo $content[0]['parameter'];  ?></li>
      </ol>
    </section>
    <!-- EndContent Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    	<div class="row">
	        <div class="col-xs-12">
	        	<div class="box box-primary">
		            <div class="box-header with-border">
		              <h3 class="box-title"><?php echo $content[0]['parameter'];  ?></h3>
		            </div>
		            <?php if($this->session->flashdata('msgalert')){ ;?>
					<div class="alert alert-success" role="alert">
					<strong><?php echo $this->session->flashdata('msgalert');?></strong>
					</div>
					<?php } ;?>
		            <!-- /.box-header -->
								<!-- form start -->
							
					<form role="form" action="<?php echo $this->config->item('base_url'); ?>setting/action_update/<?php echo $content[0]['id']; ?>" method="post" enctype="multipart/form-data">
		            <input type="hidden" id="id" name="id" value="<?php echo $content[0]['id']; ?>">
		              	<div class="box-body">
							<div class="form-group">
								<label for="exampleInputEmail1"><?php echo $content[0]['parameter'];  ?></label>
									<select class="form-control" id="value" name="value">
											<option <?php if($content[0]['value'] == 1){ echo "selected"; }; ?> value="1" selected="true">Aktif</option>
											<option <?php if($content[0]['value'] == 0){ echo "selected"; }; ?> value="0">Tidak Aktif</option>
									</select>
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
