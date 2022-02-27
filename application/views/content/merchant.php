<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Merchant
        <small>List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>member">Merchant</a></li>
        <li class="active">List</li>
      </ol>
    </section>
    <!-- EndContent Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    	<div class="row">
	        <div class="col-xs-12">
	        	<div class="box">
		            <!-- /.box-header -->
		            <div class="box-body">
		            	<?php if($this->session->flashdata('msgalert')){ ;?>
						<div class="alert alert-success" role="alert">
						<strong><?php echo $this->session->flashdata('msgalert');?></strong>
						</div>
						<?php } ;?>

                         <?php  if ($_SESSION['user_data_web']['role'] == 4){
                                echo "";
                            }else{ ?>
                                
                                <div style="float: right"><a href="<?php echo $this->config->item('base_url')?>merchant/create" class="btn btn-app"><i class="fa fa-plus"></i> Input</a></div>
		              

                            <?php    
                            } ?>
		            	<table class="table table-bordered table-hover" cellspacing="0" width="100%" id="member">
						  <thead>
							<tr>
								<th>Name</th>
								<th>Category</th>
		                  		<th>Phone</th>
		                  		<th>Email</th>
		                  		<th>Address</th>
								<th>Action</th>
							</tr>
						  </thead>
						</table>
		            </div>
		            <!-- /.box-body -->
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
        "ajax": "<?php echo $this->config->item('base_url'); ?>merchant/datatables",
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