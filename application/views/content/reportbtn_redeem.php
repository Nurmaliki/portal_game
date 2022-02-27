<style type="text/css">
	td.q{
		white-space: nowrap;
		width: 10px;
		overflow: hidden;
		text-overflow: ellipsis;
		border: 1px solid #000000;

	}
	table{
		border-collapse: collapse;
		border-spacing: 0;
		width: 100%;
		border: 1px solid #ddd;
	}
	td, th{
		text-align: left;
		padding: 8px;
	}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Report redeem
        <small> </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>">Report redeem</a></li>
        <li class="active"></li>
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
						<form role="form" action="<?php echo $this->config->item('base_url'); ?>reportbtn/redeem" method="post">
		            	<div style="text-align: left;">
		            		<div class="col-xs-1" style="padding: 10px 0 10px 5px;">
			                Filter by:
			            	</div>
		            		
			             	<div class="col-xs-1" style="padding: 10px 0 10px 5px;">
			                Date from:
			            	</div>
			             	<div class="col-xs-2" style="padding: 10px 0 10px 5px;">
			                	<div class="input-group date">
				                  <div class="input-group-addon">
				                    <i class="fa fa-calendar"></i>
				                  </div>
				                  <input required type="text" class="form-control pull-right" id="datepicker" name="from_date" value="<?php if($from_date != ''){ echo $from_date; } ?>">
				                </div>
			            	</div>
			            	<div class="col-xs-1" style="padding: 10px 0 10px 5px;">
			                Date to:
			            	</div>
			             	<div class="col-xs-2" style="padding: 10px 0 10px 5px;">
			                	<div class="input-group date">
				                  <div class="input-group-addon">
				                    <i class="fa fa-calendar"></i>
				                  </div>
				                  <input required  type="text" class="form-control pull-right" id="datepicker2" name="to_date" value="<?php if($to_date != ''){ echo $to_date; } ?>">
				                </div>
			            	</div>
			             	<div class="col-xs-2" style="padding: 10px 0 10px 5px;">
			                <button type="submit" class="btn btn-primary">Submit</button>
			            	</div>
		            	</div>
		            	</form>
		            	<div style="text-align: right;">

                        <?php // echo $merchant_id; ?>
                        <?php // echo $explode_from_date; ?>
                        <?php // echo $explode_to_date; ?>
		            	<form role="form" action="<?php echo $this->config->item('base_url'); ?>reportbtn/download_redeem" method="post">
		            	<input type="hidden" class="form-control pull-right" id="merchant_id" name="merchant_id" value="<?php echo $merchant_id; ?>">
		            	<input type="hidden" class="form-control pull-right" id="from_date" name="from_date" value="<?php echo $explode_from_date; ?>">
		            	<input type="hidden" class="form-control pull-right" id="to_date" name="to_date" value="<?php echo $explode_to_date; ?>">
		            	<button type="submit" class="btn btn-app" name="target" value="internal"><i class="fa  fa-download"></i> Download Internal</button>&nbsp;<button type="submit" class="btn btn-app" name="target" value="external"><i class="fa  fa-cloud-download"></i> Download External</button>
		            	</form>
		            	</div>
		            	<div style="overflow-x: auto;">
		              	<table class="table table-bordered table-hover" cellspacing="0" width="10%" >
		                <tr>
		                  	
		                  	<th >Name</th>
		                  	<th >Cif</th>
		                  	<th >Rekening</th>
		                  	<th >Phone</th>
		                  	<th >Status</th>
		                  	<th >Keterangan Status</th>
		                  	<th >Transcode btn</th>
		                  	<th >Transcode btn date</th>
		                  	<th >Redeem poin</th>
							<th >Email tujuan</th>
							<th >Merchant dmo id</th>
							<th >Merchant name</th>
							<th >Merchant order_id</th>
							<th >Merchant value</th>
		                </tr>
						<?php
							
							
							
						  	if(count($report) > 0){
						  		for($i=0; $i<count($report); $i++){
						 ?>
						 		<tr>
						  		
						  			<td class="q"><?php echo $report[$i]['first_name']; ?></td>
						  			<td><?php echo $report[$i]['cif']; ?></td> 
						  			<td class="q"><?php echo $report[$i]['rekening']; ?></td>
						  			<td class="q"><?php echo $report[$i]['phone']; ?></td>
						  			<td class="q"><?php echo $report[$i]['status']; ?></td>
						  			<td class="q"><?php echo $report[$i]['status_msg']; ?></td>
									<td class="q"><?php echo $report[$i]['transcode_btn']; ?></td>
			                  		<td class="q"><?php echo $report[$i]['transcode_btn_date']; ?></td>
									<td  class="badge bg-green "><?php echo $report[$i]['redeem_poin']; ?></td>
						  			<td class="q"><?php echo $report[$i]['email_tujuan']; ?></td>
									<td class="q"><?php echo $report[$i]['giift_dmo_id']; ?></td>
									<td class="q"><?php echo $report[$i]['giift_name']; ?></td>
									<td><?php echo $report[$i]['giift_order_id']; ?></td> 
									<td><?php echo $report[$i]['giift_value']; ?></td> 
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