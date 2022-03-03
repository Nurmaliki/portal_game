<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Point
        <small>Update</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>admin">Point</a></li>
        <li class="active">Update</li>
      </ol>
    </section>
    <!-- EndContent Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    	<div class="row">
	        <div class="col-xs-12">
	        	<div class="box box-primary">
		            <div class="box-header with-border">
		              <h3 class="box-title">Add data</h3>
		            </div>
		            <?php if($this->session->flashdata('msgalert')){ ;?>
					<div class="alert alert-success" role="alert">
					<strong><?php echo $this->session->flashdata('msgalert');?></strong>
					</div>
					<?php } ;?>
		            <!-- /.box-header -->
		            <!-- form start -->
		            <form role="form" action="<?php echo $this->config->item('base_url'); ?>point/action_update" method="post"><input type="hidden" name="id" value="<?php echo $get_point[0]['id']; ?>">
		             	<div class="box-body">
		             		<div class="col-xs-12" style="padding-top: 10px;">
			              		<div class="col-xs-5">
								<label for="exampleInputEmail1">From Program</label>
			                  	<select readonly required class="form-control" name="from_program">
			                  	<?php
			                  	// if(count($Poinserbu) > 0){
			                  	// 	for($i=0; $i<count($Poinserbu); $i++){
                                    if(count($program) > 0){
                                        for($i=0; $i<count($program); $i++){
			                  	?>
			                  				<?php if ($program[$i]['program_name'] != 'BTN') {
					                  			# code...
					                  		}else{ ?>
				                                  	<option value="<?php echo $program[$i]['id']; ?>" <?php if($program[$i]['id'] == $get_point[0]['from_program_id']){ echo'selected enable';} ?>><?php echo $program[$i]['program_name']; ?></option>
							                  		
					                  		<?php } ?>
			                  	<?php

			                  		}
			                  	}
			                  	?>
			                    
			                  	</select>
			                	</div>
			                	<div class="col-xs-1" style="text-align: center;">
								<!-- <img src="<?php // echo $this->config->item('base_url'); ?>assets/images/double_arrow.png" width="50" height="50"> -->
			                	</div>
			                	<div class="col-xs-5">
								<label for="exampleInputEmail1">To Program</label>
			                  	<select required class="form-control" name="to_program">
			                  	<?php
			                  	if(count($program) > 0){
			                  		for($i=0; $i<count($program); $i++){
			                  	?>

			                  		<?php if ($program[$i]['program_name'] == 'BTN') {
			                  			# code...
			                  		}else{ ?>
			                  		<option value="<?php echo $program[$i]['id']; ?>" <?php if($program[$i]['id'] == $get_point[0]['to_program_id']){ echo'selected';} ?>><?php echo $program[$i]['program_name']; ?></option>
			                  		<?php } ?>
			                  	<?php

			                  		}
			                  	}
			                  	?>
			                    
			                  	</select>
			                	</div>
			                	<div class="col-xs-1" style="text-align: center;">
								&nbsp;
			                	</div>
			                </div>
		                	<div class="col-xs-12" id="myDivId">
		                		<div class="col-xs-12" style="padding-top: 10px;">
												<div class="col-xs-5">
												<label for="exampleInputEmail1">Ratio</label>
							                  	<input required type="number" class="form-control" id="program_code" placeholder="Enter Ratio here" name="from_ratio" value="<?php echo $get_point[0]['from_ratio']; ?>">
							                	</div>
							                	<div class="col-xs-1" style="text-align: center;">
												<!-- <img src="<?php // echo $this->config->item('base_url'); ?>assets/images/double_arrow.png" width="50" height="50"> -->
							                	</div>
							                	<div class="col-xs-5">
												<label for="exampleInputEmail1">Ratio</label>
							                  	<input required type="number" class="form-control" name="to_ratio" value="<?php echo $get_point[0]['to_ratio']; ?>" placeholder="Enter Ratio here">
							                	</div>
							                	<div class="col-xs-1" style="text-align: center;">
												&nbsp;
							                	</div>
								</div>
							    </div>
						     <div>
		              	</div>
		              	<!-- /.box-body -->
		              	<div class="box-body">
		              		<div class="col-xs-12" style="padding-top: 10px;">
				            <button type="submit" class="btn btn-primary">Submit</button>
				            </div>
		              	</div>
		            </form>
		          </div>
	        </div>
	    </div>
	</section>

    <!-- End Main content -->
</div>
<!-- End Content Wrapper. Contains page content -->