<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Report
        <small>Rule </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>">Report</a></li>
        <li class="active">Report Rule</li>
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

						<form role="form" action="<?php echo $this->config->item('base_url'); ?>report/report_rule" method="post">
		            	<div style="text-align: left;">

			            	<div class="col-xs-1" style="padding: 15px;vertical-align: middle;margin-top: auto;margin-bottom: auto;">
			                Month:

			            	</div>
			             	<div class="col-xs-2" style="padding: 10px 0 10px 5px;vertical-align: middle;margin-top: auto;margin-bottom: auto;">
			                	<div class="input-group date">
				                  <div class="input-group-addon">
				                    <i class="fa fa-calendar"></i>
				                  </div>
				                  <input  type="month" class="form-control pull-right" required  name="date" value="<?php if($_SESSION["date"] != ''){ echo $_SESSION["date"]; }else{ echo date('Y-m'); } ?>">
								        </div>
                      </div>
                      <div class="col-xs-3" style="padding: 10px 0 10px 5px;vertical-align: middle;margin-top: auto;margin-bottom: auto;">

								       <div class="input-group date">
				                  <div class="input-group-addon">
				                    <i class="fa fa-exchange"></i>
				                  </div>
				                  <select class="form-control" name="order_by" id="">
          									  <option <?php if ($_SESSION["order_by"]=="desc") {
          										  echo"selected";}else{echo "";} ?> value="desc">Descending</option>
          									  <option <?php if ($_SESSION["order_by"]=="asc") {
          										  echo"selected";}else{echo "";} ?> value="asc">ascending</option>
          								  </select>
				                </div>
			            	</div>
			             	<div class="col-xs-2" style="padding: 10px 0 10px 5px;">
			                <button type="submit" style="margin-left:80px" class="btn btn-primary">Submit</button>
			            	</div>
		            	</div>
		            	</form>
		            	<div style="text-align: right;">
                    <form role="form" action="<?php echo $this->config->item('base_url'); ?>report/download_report_rule" method="post">
                    <div style="text-align: right;">

                  <div class="col-xs-2" style="padding: 10px 0 10px 5px;vertical-align: middle;margin-top: auto;margin-bottom: auto;">
                  </div>

                  <input name="date" type="hidden" value="<?php  echo $_SESSION["date"];  ?>">
                  <input name="order_by" type="hidden" value="<?php  echo $_SESSION["order_by"];  ?>">
                      <div class="col-xs-2" style="padding: 10px 0 10px 5px;">
                        <button type="submit" style="margin-left:0px" class="btn btn-success"> <i class="fa  fa-download"></i>	Download	</button>
                      </div>
                    </div>
                    </form>

		            	</div>
		              	<table class="table table-striped">
		                <tr>
		                  	<th>No</th>
		                  	<th>Poin code</th>
		                  	<th>Description</th>
		                  	<th>Total Poin</th>

		                </tr>
						<?php




						  	if(count($get_point_by_poincode) > 0){
						  		$no = 1;
						  		for($i=0; $i<count($get_point_by_poincode); $i++){
						  			if (!empty(trim($get_point_by_poincode[$i]['poin_code_ps'], " "))) {
						 ?>
						 		<tr>
						  			<td><?php echo $no++ ?></td>
									<td><?php echo trim($get_point_by_poincode[$i]['poin_code_ps'], " ") ;?></td>
									  <?php if(trim($get_point_by_poincode[$i]['poin_code_ps'], "") == " 1001"){  ?>
						  				<td>Debit BTN Online</td>
									  <?php ?>
									  <?php }else if(trim($get_point_by_poincode[$i]['poin_code_ps'], " ") == "1002"){  ?>
						  				<td>Transaksi Pembayaran dan Pembelian</td>
										<?php }else if(trim($get_point_by_poincode[$i]['poin_code_ps'], " ") == "1003"){  ?>
						  				<td>Penarikan Tunai Luar Negeri</td>
										  <?php }else if(trim($get_point_by_poincode[$i]['poin_code_ps'], " ") == "1004"){  ?>
						  				<td>Transaksi Transfer Kerekening Bank Lain</td>
										  <?php }else if(trim($get_point_by_poincode[$i]['poin_code_ps'], " ") == "1005"){  ?>
						  				<td>Setoran</td>
										<?php }else if(trim($get_point_by_poincode[$i]['poin_code_ps'], " ") == "1006"){  ?>
						  				<td>Pencetakan Rekening Koran Melalui Mesin ATM</td>
						  				<?php }else if(trim($get_point_by_poincode[$i]['poin_code_ps'], " ") == "add_point_manual"){  ?>
						  				<td>Penambahan poin manual</td>
						  				<?php }else if(trim($get_point_by_poincode[$i]['poin_code_ps'], " ") == "ultah"){  ?>
						  				<td>Poin Ulang Tahun</td>
						  				<?php }else if(trim($get_point_by_poincode[$i]['poin_code_ps'], " ") == "open_acc"){  ?>
						  				<td>Pembukaan Akun Baru</td>
						  				<?php }else if(trim($get_point_by_poincode[$i]['poin_code_ps'], " ") == "akd"){  ?>
						  				<td>Aktivasi Kartu Debit</td>
						  				<?php }else if(trim($get_point_by_poincode[$i]['poin_code_ps'], " ") == "aib"){  ?>
						  				<td>Aktivasi Internet Banking</td>
						  				<?php }else if(trim($get_point_by_poincode[$i]['poin_code_ps'], " ") == "agf"){  ?>
						  				<td>Aktivasi AGF</td>
						  				<?php }else if(trim($get_point_by_poincode[$i]['poin_code_ps'], " ") == "aft"){  ?>
						  				<td>Aktivasi AFT</td>
						  				<?php }else if(trim($get_point_by_poincode[$i]['poin_code_ps'], " ") == "mstr_mob"){  ?>
						  				<td>Master Mobile</td>
									  	<?php }else{?>
										<td><?php echo trim($get_point_by_poincode[$i]['poin_code_ps'], "");?></td>
									  	<?php }?>
									<td><?php echo number_format($get_point_by_poincode[$i]['Total'],0,",","."); ?></td>

								</tr>
						<?php
						  		}}
						  	}else{
						?>
								<tr>
						  			<td colspan="8">No Report Rule , please select filter.</td>
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
