<?php // print_r($reportreddem); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Report
        <small>Redeem List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>">Report</a></li>
        <li class="active">Redeem List</li>
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
						
		            	
		              	<table class="table table-striped">
		                <tr>
		                  	<th>msisdn</th>
		                  	<th>Redeem Date</th>
		                  	<th>Redeem Poin</th>
		                  	<th>Kode Transaksi</th>
							<th>Nama Hadiah</th>
							<th>Prize Code</th>
							
		                </tr>
						<?php
							
							
							
							//print_r($reportreddem);
							//die();
							
						  	if(count($reportreddem) > 0){
						  		for($i=0; $i<count($reportreddem); $i++){
						 ?>
						 		<tr>
						  			<td><?php echo $reportreddem[$i]['username']; ?></td>
						  			<td><?php echo $reportreddem[$i]['date']; ?></td>
									<td><?php echo $reportreddem[$i]['poin_dipakai']; ?></td>
			                  		<td class="badge bg-red"><?php echo $reportreddem[$i]['id']; ?></td>
			                  		<td><?php echo $reportreddem[$i]['name']; ?></td>
									<td><?php echo $reportreddem[$i]['prize_code']; ?></td>
									
								</tr>
						<?php
						  		}
						  	}else{
						?>
								<tr>
						  			<td colspan="8">No report redeem, please select filter.</td>
								</tr>
						<?php
							}
						?>
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
        "ajax": "<?php echo $this->config->item('base_url'); ?>admin/datatables",
		"type": "GET"
    } );
} );
</script>
<!-- End Content Wrapper. Contains page content -->