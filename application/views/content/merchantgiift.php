Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Merchant Giift
        <small>List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>member">Merchant Giift</a></li>
        <li class="active">List</li>
      </ol>
    </section>
    <!-- EndContent Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    	<div class="row">
	        <div class="col-xs-12">
	        	<center>
	        	<!-- <a href="<?php echo $this->config->item('base_url')?>sync_giift_list" class="fa fa-fw fa-trash" data-confirm="Are you sure you want to Sync Giift Merchant ?">&nbsp;</a> -->

	        	<div style="float: right"><a  data-confirm="Are you sure you want to Sync Giift Merchant ?" href="<?php echo $this->config->item('base_url')?>merchantgiift/sync_giift_list" class="btn btn-app"><i class="fa fa-sync"></i> Sync Giift</a></div>
	        	</center>
	        <div class="col-xs-12">

	        	<div class="box">
		            <!-- /.box-header -->
		            <div class="box-body">


		            	<table class="table table-bordered table-hover" cellspacing="0" width="100%" id="member">
						  <thead>
							<tr>
								<th>Name</th>
								<th>Category</th>
		                  		<th>Value</th>
		                  		<th>Price</th>
		                  		<th>point</th>
								<th>Action</th>
							</tr>
						  </thead>
						</table>
		            </div>
		            <!-- /.box-body -->
		        </div>
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
        language: {
            // search: "_INPUT_",
            // searchPlaceholder: "Name, Cif or Phone Number",
            processing: "<div style='    margin-top: 20%;   background-color: greenyellow;'><b>LOADING...</b></div>"
        },
		"bFilter": true,
        "ajax": "<?php echo $this->config->item('base_url'); ?>merchantgiift/datatables",
		"type": "GET",
		 "order": [[ 3, "desc" ]]
    } );
} );
$(document).on('click', ':not(form)[data-confirm]', function(e){
        if(!confirm($(this).data('confirm'))){
            e.stopImmediatePropagation();
            e.preventDefault();
        }
    });
</script>
<!-- End Content Wrapper. Contains page content
