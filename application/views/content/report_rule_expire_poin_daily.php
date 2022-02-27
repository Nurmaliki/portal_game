<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Report
        <small>Expire Poin </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>">Report</a></li>
        <li class="active">Expire Poin </li>
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

						<form role="form" action="<?php echo $this->config->item('base_url'); ?>report/report_rule_expire_poin_daily" method="post">
		            	<div style="text-align: left;">
		            		<div class="col-xs-1" style="padding: 10px 0 10px 5px;">
			                Filter by:
			            	</div>
		            		<div class="col-xs-2" style="padding: 10px 0 10px 0;">
		            		<select required class="form-control" name="poin_code">
							<?php //print_r($_SESSION)?>
		            			<option value="" selected disabled>Select Poin Code</option>
                                <?php
			                   	if(count($get_poin_code) > 0){
			                   		for($i=0; $i<count($get_poin_code); $i++){
			                   			if (!empty(trim($get_poin_code[$i]['poin_code'], " "))) {
			                   	?>



									   <?php if(trim($get_poin_code[$i]['poin_code'], "") == " 1002"){  ?>
						  				<!-- <td>Debit BTN Online</td> -->
										<option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>"> Debit BTN Online</option>


									  <?php ?>
                  <?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "1001"){  ?>
						  				<!-- <td>Transaksi Pembayaran dan Pembelian</td> -->
										  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Transaksi Pembayaran dan Pembelian</option>

										<?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "1003"){  ?>
						  				<!-- <td>Penarikan Tunai Luar Negeri</td> -->
										  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Penarikan Tunai Luar Negeri</option>

										  <?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "1004"){  ?>
						  				<!-- <td>Transaksi Transfer Kerekening Bank Lain</td> -->
										  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Transaksi Transfer Kerekening Bank Lain</option>

										  <?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "1005"){  ?>
						  				<!-- <td>Setoran</td> -->
										  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Setoran</option>

										<?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "1006"){  ?>
						  				<!-- <td>Pencetakan Rekening Koran Melalui Mesin ATM</td> -->
										  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Pencetakan Rekening Koran Melalui Mesin ATM</option>

						  				<?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "add_point_manual"){  ?>
						  				<!-- <td>Penambahan poin manual</td> -->
										  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Penambahan poin manual</option>
						  				<?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "ultah"){  ?>
						  				<!-- <td>Poin Ulang Tahun</td> -->
										  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Poin Ulang Tahun</option>
						  				<?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "open_acc"){  ?>
						  				<!-- <td>Pembukaan Akun Baru</td> -->
										  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Pembukaan Akun Baru</option>

						  				<?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "akd"){  ?>
						  				<!-- <td>Aktivasi Kartu Debit</td> -->
										  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Aktivasi Kartu Debit</option>

						  				<?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "aib"){  ?>
						  				<!-- <td>Aktivasi Internet Banking</td> -->
										  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Aktivasi Internet Banking</option>

						  				<?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "agf"){  ?>
						  				<!-- <td>Aktivasi AGF</td> -->
										  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Aktivasi AGF</option>

						  				<?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "aft"){  ?>
						  				<!-- <td>Aktivasi AFT</td> -->
										  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Aktivasi AFT</option>

						  				<?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "mstr_mob"){  ?>
						  				<!-- <td>Master Mobile</td> -->
										  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Master Mobile</option>
										  <?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "balance"){  ?>
						  				<!-- <td>Master Mobile</td> -->
										  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Saldo Akhir Bulan</option>

									  	<?php }else{?>

										<!-- <td><?php // echo trim($get_poin_code[$i]['poin_code'], "");?></td> -->
										<option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>"><?php echo $get_poin_code[$i]['poin_code'];?></option>

									  	<?php }?>

						       	<?php
										}
			                   		}
			                   		}
			                   	?>
			                 </select>
			             	</div>
			             	<div class="col-xs-1" style="padding: 10px 0 10px 5px;" style="margin-left:100px;">
			                Date from:
			            	</div>
			             	<div class="col-xs-2" style="padding: 10px 0 10px 5px;">
			                	<div class="input-group date">
				                  <div class="input-group-addon">
				                    <i class="fa fa-calendar"></i>
				                  </div>
				                  <input type="text" class="form-control pull-right" id="datepicker" required name="from_date" value="<?php if($from_date != ''){ echo $from_date; } ?>">
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
				                  <input  type="text" class="form-control pull-right" id="datepicker2" required name="to_date" value="<?php if($to_date != ''){ echo $to_date; } ?>">
				                </div>
			            	</div>
			             	<div class="col-xs-2" style="padding: 10px 0 10px 5px;">
			                <button type="submit" class="btn btn-primary">Submit</button>
			            	</div>
		            	</div>
		            	</form>

						<form role="form" action="<?php echo $this->config->item('base_url'); ?>report/download_report_expire_poin_daily" method="post">
		            	<div style="text-align: right;">

						<div class="col-xs-2" style="padding: 10px 0 10px 5px;vertical-align: middle;margin-top: auto;margin-bottom: auto;">
						</div>

							<input name="expire_poin_daily_date_start" type="hidden" value="<?php echo $_SESSION['expire_poin_daily_date_start'];  ?>">
							<input name="expire_poin_daily_date_end" type="hidden" value="<?php echo $_SESSION['expire_poin_daily_date_end'];  ?>">
							<input name="expire_poin_daily_poin_code" type="hidden" value="<?php echo $_SESSION['expire_poin_daily_poin_code'];  ?>">
							<!-- <input name="order_by" type="hidden" value="<?php  echo $_SESSION["order_by"];  ?>"> -->
			             	<div class="col-xs-2" style="padding: 10px 0 10px 5px;    margin-left: -15%;">
							 <?php if($_SESSION['expire_poin_daily_date_start'] != ""){?>
			                <button type="submit" style="" class="btn btn-app"> <i class="fa  fa-download"></i>	Download	</button>
							 <?php }?>
							</div>
		            	</div>
		            	</form>

		              	<table class="table table-striped">
		                <tr>
		                  	<th>No</th>
		                  	<th>Date</th>
		                  	<th>Poin Code</th>
		                  	<th>Total Poin</th>
		                  	<!-- <th>Transcode Point</th>
							<th>Transcode Date</th>
							<th>Redeem</th>
							<th>Redeem Point</th>
							<th>Redeem Date</th> -->
		                </tr>
						<?php


							// if(count($merchant) > 0 || ($merchant_id != 0 || $merchant_id =='' ) && ($from_date =='' || $from_date == 0 || $to_date =='' || $to_date == 0) ){
							// 	for($i=0; $i<count($merchant); $i++){
							// 		if($merchant[$i]['name'] == $report[$i]['merchant']){
							// 			echo '<h2>'.$merchant[$i]['name'].' Redeem report</h2><br>';
							// 			echo 'From - To : '.$from_date.' - '.$to_date;
							// 		}
							// 	}
							// }else{
							// 	echo '<h2>Please select Merchant & Date</h2>';
							// }
							//print_r($merchant);

						  	if(count($get_poin_poincode_bydate) > 0){
						  		for($i=0; $i<count($get_poin_poincode_bydate); $i++){
						 ?>
						 		<tr>
						  			<td><?php echo $i+1 ?></td>
						  			<td><?php echo $get_poin_poincode_bydate[$i]['date_related']; ?></td>
									<td><?php echo $get_poin_poincode_bydate[$i]['poin_code']; ?></td>
									<td><?php echo number_format($get_poin_poincode_bydate[$i]['Total'],0,",","."); ?></td>
			                  		<!--  -->
								</tr>
						<?php
						  		}
						  	}else{
						?>
								<tr>
						  			<td colspan="8">No Report Poin Code, please select filter.</td>
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
