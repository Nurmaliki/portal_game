<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
    Gift Redemption
        <!-- <small>Redeem List</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>">Report</a></li>
        <li class="active">Gift Redemption</li>
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
						<form role="form" action="<?php echo $this->config->item('base_url'); ?>reportmember/penukaran_poin" method="post">
		            	<div style="text-align: left;">
		            		<!-- <div class="col-xs-1" style="padding: 10px 0 10px 5px;">
			                Filter by:
			            	</div>
		            		<div class="col-xs-2" style="padding: 10px 0 10px 0;">
		            		<select  required class="form-control" name="merchant_id">
		            			<option value="" selected>Select Merchant</option>
                                <?php
			                   	if(count($merchant) > 0){
			                   		for($i=0; $i<count($merchant); $i++){
			                   	?>
			                   		<option <?php if(isset($_SESSION["current_selected_merchant"])){ if($merchant[$i]['id'] == $_SESSION["current_selected_merchant"]["merchant_id"]){ echo 'selected = "true"';} } ?> value="<?php echo $merchant[$i]['id']; ?>"><?php echo $merchant[$i]['name']; ?></option>
			                   	<?php
			                   		}
			                   	}
			                   	?>
			                </select>
			             	</div> -->
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
		            	<form role="form" action="<?php echo $this->config->item('base_url'); ?>reportmember/download_penukaran_poin" method="post">
		            	<!-- <input type="hidden" class="form-control pull-right" id="merchant_id" name="merchant_id" value="<?php echo $merchant_id; ?>"> -->
		            	<input type="hidden" class="form-control pull-right" id="from_date" name="from_date" value="<?php echo (isset($explode_from_date))?$explode_from_date:''; ?>">
		            	<input type="hidden" class="form-control pull-right" id="to_date" name="to_date" value="<?php echo (isset($explode_to_date))?$explode_to_date:''; ?>">
		            	<button type="submit" class="btn btn-app" name="target" value="internal"><i class="fa  fa-download"></i> Download Internal</button>&nbsp;
                  <!-- <button type="submit" class="btn btn-app" name="target" value="external"><i class="fa  fa-cloud-download"></i> Download External</button> -->
		            	</form>
		            	</div>
		              	<table class="table table-striped">
		                <tr>
                      <th>Nomor handphone</th>
                      <th>Nama Barang</th>
                      <th>Kode Barang</th>
		                  	<th>Poin</th>
		                  	<th>Date</th>

		                </tr>
						<?php


							if($from_date =='' || $from_date == 0 || $to_date =='' || $to_date == 0){
								// for($i=0; $i<count($merchant); $i++){
									// if($merchant[$i]['name'] == $report[$i]['merchant']){
										// echo '<h2>'.$merchant[$i]['name'].' Redeem report</h2><br>';
										echo 'From - To : '.$from_date.' - '.$to_date;
									// }
								// }
							}else{
								echo '<h2>Please select  date range</h2>';
							}
							//print_r($merchant);

						  	if(count($report) > 0){
						  		for($i=0; $i<count($report); $i++){
						 ?>
						 		<tr>
						  			<td><?php echo $report[$i]['username']; ?></td>
                    <td><?php echo $report[$i]['nama_barang']; ?></td>
                    <td><?php echo $report[$i]['kode_barang']; ?></td>
                    <td><?php echo $report[$i]['poin']; ?></td>
						  			<td><?php echo $report[$i]['date_time']; ?></td>

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
