
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Program Periode
        <small>Update</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>admin">   Program Periode</a></li>
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
		              <h3 class="box-title">Update data</h3>
		            </div>
		            <?php if($this->session->flashdata('msgalert')){ ;?>
					<div class="alert alert-success" role="alert">
					<strong><?php echo $this->session->flashdata('msgalert');?></strong>
					</div>
					<?php } ;?>
		            <!-- /.box-header -->
		            <!-- form start -->
                    <form role="form" action="<?php echo $this->config->item('base_url'); ?>programperiod/action_update" method="post">
                    <input type="hidden" name="id" value="<?php echo $programperiode[0]['id']; ?>">
		             	<div class="box-body">
		             		<div class="col-xs-12" style="padding-top: 10px;">
			              		<div class="col-xs-5">
								<!-- <label for="exampleInputEmail1">Point Value</label> -->
			                  
			                	</div>
			                	<div class="col-xs-1" style="text-align: center;">
								<!-- <img src="<?php // echo $this->config->item('base_url'); ?>assets/images/double_arrow.png" width="50" height="50"> -->
			                	</div>
			                	<div class="col-xs-5">
								<!-- <label for="exampleInputEmail1">Margin</label> -->
			                  	
			                	</div>
			                	<div class="col-xs-1" style="text-align: center;">
								&nbsp;
			                	</div>
			                </div>
		                	<div class="col-xs-12" id="myDivId">
		                		<div class="col-xs-12" style="padding-top: 10px;">
													<div class="col-xs-5">
																<label for="exampleInputEmail1">Start date</label>
																		<input required type="date" class="form-control" id="program_code" placeholder="Enter start date here" name="startdate" value="<?php echo $programperiode[0]['start_date']; ?>">
													</div>
													<div class="col-xs-5">
																<label for="exampleInputEmail1">End date</label>
																		<input required type="date" class="form-control" id="program_code" placeholder="Enter start date here" name="enddate" value="<?php echo $programperiode[0]['end_date']; ?>">
													</div>
																	<div class="col-xs-1" style="text-align: center;">
													<!-- <img src="<?php // echo $this->config->item('base_url'); ?>assets/images/double_arrow.png" width="50" height="50"> -->
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
<!-- End Content Wrapper. Contains page content