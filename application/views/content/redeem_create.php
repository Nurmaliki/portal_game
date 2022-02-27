<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Redeem
        <small>Create</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>redeem">Redeem</a></li>
        <li class="active">Create</li>
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
		            <form role="form" action="<?php echo $this->config->item('base_url'); ?>redeem/action_create" method="post">
		             	<div class="box-body">
		             		<div class="col-xs-12" style="padding-top: 10px;">
			              		<div class="col-xs-5">
								<label for="exampleInputEmail1">Program</label>
			                  	<select required readonly enable class="form-control" name="program_id">
			                  	<?php
			                  	if(count($program) > 0){
			                  		for($i=0; $i<count($program); $i++){
			                  	?>
			                  		<!-- <option value="<?php // echo $program[$i]['id']; ?>"><?php //echo $program[$i]['program_name']; ?></option> -->



									   <?php if($program[$i]['program_name'] == "BTN"){ ?>
											
											<option selected value="<?php echo $program[$i]['id']; ?>"><?php echo $program[$i]['program_name']; ?></option>
										<?php }else{?>
										<!-- <option value="<?php// echo $program[$i]['id']; ?>"><?php// echo $program[$i]['program_name']; ?></option> -->
										<?php }?>
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
			                		<?php //print_r($merchant); ?>
			                		
								<label for="exampleInputEmail1">Merchant</label>
			                  	<select required class="form-control" name="merchant_id">
			                  	<?php
			                  	if(count($merchant) > 0){
			                  		for($i=0; $i < count($merchant); $i++){
			                  	?>
			                  		<option value="<?php echo $merchant[$i]['id']; ?>"><?php echo $merchant[$i]['name']; ?></option>
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
			                <div class="col-xs-12" style="padding-top: 20px;">
			                <button class="btn btn-success btn-add" type="button">
							<span class="glyphicon glyphicon-plus"></span>
							</button>
			                </div>
		                	<div class="col-xs-12" id="myDivId">
		                		<div class="col-xs-12" style="padding-top: 10px;">
												<div class="col-xs-5">
												<label for="exampleInputEmail1">Point</label>
							                  	<input required type="number" class="form-control" id="point" placeholder="Enter point here" name="point[]">
							                	</div>
							                	<div class="col-xs-1" style="text-align: center;">
												<!-- <img src="<?php //echo $this->config->item('base_url'); ?>assets/images/double_arrow.png" width="50" height="50"> -->
							                	</div>
							                	<div class="col-xs-5">
												<label for="exampleInputEmail1">Amount</label>
							                  	<input required type="number" class="form-control" id="amount" placeholder="Enter Amount here" name="amount[]">
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
<script type="text/javascript">
var room = 1;
$(function()
{
    $(document).on('click', '.btn-add', function(e)
    { 
        //e.preventDefault();
        room++;
        var controlForm 	= $( "#myDivId" );
        var currentEntry	= $(this).parents('.entry:first');
        var newEntry 		= $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="glyphicon glyphicon-minus"></span>');
    $("#myDivId").append('<div class="col-xs-12 removeclass" style="padding-top: 10px;" id="removeclass'+room+'"><div class="col-xs-5"><label for="point">Point</label><input type="text" class="form-control" id="point[]" placeholder="Enter point here" name="point[]"></div><div class="col-xs-1" style="text-align: center;"></div><div class="col-xs-5"><label for="to_point">Amount</label><input type="text" class="form-control" id="program_code" placeholder="Enter mount here" name="amount[]"></div><div class="col-xs-1" style="text-align: center;"><button class="btn btn-danger btn-remove" type="button" onclick="remove_point_fields('+ room +');"><span class="glyphicon glyphicon-minus"></span></button></div></div>');
    });
});
function remove_point_fields(rid) {
	$('#removeclass'+rid).remove();
}
</script>
<style>
.entry:not(:first-of-type)
{
    margin-top: 10px;
}
</style>