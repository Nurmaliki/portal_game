<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Report
        <small>Exchange List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>">Report</a></li>
        <li class="active">Exchange List</li>
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
		            	<form role="form" action="<?php echo $this->config->item('base_url'); ?>report/exchange" method="post">
                            <div style="text-align: left;">
                                <div class="col-xs-1" style="padding: 10px 0 10px 5px;">
                                Filter by:
                                </div>
                                <div class="col-xs-2" style="padding: 10px 0 10px 0;">
                                <select required class="form-control" name="program_code">
                                    <option value="" selected>Select Program</option>
                                    <?php
                                    if(count($program) > 0){
                                        for($i=0; $i<count($program); $i++){
                                    ?>
                                        <option <?php if(isset($_SESSION["current_selected_program"])){ if($program[$i]['program_code'] == $_SESSION["current_selected_program"]["program_code"]){ echo 'selected = "true"';} } ?> value="<?php echo $program[$i]['program_code']; ?>" <?php if($program[$i]['program_code'] == $program_code){ echo'selected';} ?>><?php echo $program[$i]['program_name']; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                                </div>
                                <div class="col-xs-1" style="padding: 10px 0 10px 5px;">
                                Date From:
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
                                    <input required type="text" class="form-control pull-right" id="datepicker2" name="to_date" value="<?php if($to_date != ''){ echo $to_date; } ?>">
                                    </div>
                                </div>
                                <div class="col-xs-2" style="padding: 10px 0 10px 5px;">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
		            	</form>
		            	<div style="text-align: right;">
                            <form role="form" action="<?php echo $this->config->item('base_url'); ?>report/download_exchange" method="post">
                                <input type="hidden" class="form-control pull-right" id="program_code" name="program_code" value="<?php echo $program_code; ?>">
                                <input type="hidden" class="form-control pull-right" id="from_date" name="from_date" value="<?php echo $explode_from_date; ?>">
                                <input type="hidden" class="form-control pull-right" id="to_date" name="to_date" value="<?php echo $explode_to_date; ?>">
                                <button type="submit" class="btn btn-app" name="target" value="internal"><i class="fa  fa-download"></i> Download Internal</button>&nbsp;<button type="submit" class="btn btn-app" name="target" value="external"><i class="fa fa-cloud-download"></i> Download External</button>
                            </form>
		            	</div>
						<table class="table table-striped">
		                <tr>
		                	<th>Name</th>
		                  	<th>Program code</th>
							  <th>Transaction #</th>
							  <!-- <th>Transcode Date</th> -->
                              <!-- <th>No referensi #</th> -->
							<th>Exchange</th>
							<th>Amount PS</th>
							<th>Exchange Date</th>
							<th>Sisa PS</th>
		                </tr>
						<?php
						//print_r($report);
						// echo '<br>'.$program[0].['program_name'].'<br>';
						//echo '<br>'.$program_code.'<br>';  

						if(count($program) > 0 || ($program_code != 0|| $program_code !='') && ($from_date =='' || $from_date == 0 || $to_date =='' || $to_date == 0)){
							for($i=0; $i<count($program); $i++){
									if ($program[$i]['program_code'] == $report[$i]['program_id']){
										echo '<h2>'.$program[$i]['program_name'].' Exchange report</h2><br>';
										echo 'From - to : '.$from_date.' - '.$to_date; 
										
									}
							}
						}else{
							echo '<h2>Please Select Program & Date</h2>';
						}

						
						
								   
						if(count($report) > 0){
						  			for($i=0; $i<count($report); $i++){

						 ?>
						 		<tr>
						 			<td><?php echo $report[$i]['member']; ?></td>
						  			<td><?php echo $report[$i]['program_id']; ?></td>
									<td><?php echo $report[$i]['transcode_btn']; ?></td>
			                  		
			                  		<!-- <td><?php //echo $report[$i]['transcode_btn_date']; ?></td> -->
                                    <!-- <td><?php //echo $report[$i]['transcode_btn']; ?></td> -->
									<td><?php echo $report[$i]['exchange_code']; ?></td>
									<td class="badge bg-green"><?php echo $report[$i]['exchange_poin']; ?></td>
									<td><?php echo $report[$i]['exchange_date']; ?></td>
									<td class="badge bg-red"><?php echo $report[$i]['current_point']; ?></td>
								</tr>
						<?php
						  			}
						  	}else{
						?>
							<tr>
						  			<td colspan="7">No report exchange, please select filter.</td>
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
<!-- End Content Wrapper. Contains page content -->