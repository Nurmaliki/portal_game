<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Point Setting
        <small>Create</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>admin">Point Setting</a></li>
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
                <!-- Alert Tentang -->
                <?php if($this->session->flashdata('poinSettingFalse')){ ;?>
                  <div style="width: 100%;" id="alerts" class="alert alert-success" role="alert">
                      <strong><?php echo $this->session->flashdata('poinSettingFalse');?></strong>
                  </div>
                <?php }else if($this->session->flashdata('poinSettingTrue')){?>
                      <div style="background: #d4edda !important;color: #155724 !important;   width:100%;" id="alerts" class="alert alert-success" role="alert">
                          <strong><?php echo $this->session->flashdata('poinSettingTrue');?></strong>
                      </div>
                <?php } ?>
                 
		            <!-- /.box-header -->
		            <!-- form start contesso -->
		            <form role="form" action="<?php echo $this->config->item('base_url'); ?>giiftmanagement/action_create" method="post">
		             	<div class="box-body">
		             		<div class="col-xs-12" style="padding-top: 10px;">
			              		<div class="col-xs-5">

			                	</div>
			                	<div class="col-xs-1" style="text-align: center;">
								<!-- <img src="<?php //echo $this->config->item('base_url'); ?>assets/images/double_arrow.png" width="50" height="50"> -->
			                	</div>
			                	<div class="col-xs-5">

			                	</div>
			                	<div class="col-xs-1" style="text-align: center;">
								&nbsp;
			                	</div>
			                </div>
			                <div class="col-xs-12" style="padding-top: 20px;">
			                <!-- <button class="btn btn-success btn-add" type="button">
							<span class="glyphicon glyphicon-plus"></span>
							</button> -->
			                </div>
		                	<div class="col-xs-12" id="myDivId">
		                		<div class="col-xs-12" style="padding-top: 10px;">
												<div class="col-xs-5">
												<label for="exampleInputEmail1">Point Value</label>
							                  	<input required type="number" class="form-control" id="point_value" placeholder="Enter point value here" name="point_value">
							                	</div>
							                	<div class="col-xs-1" style="text-align: center;">
												<!-- <img src="<?php //echo $this->config->item('base_url'); ?>assets/images/double_arrow.png" width="50" height="50"> -->
							                	</div>
							                	<div class="col-xs-5">
												<label for="exampleInputEmail1">Mirgin</label>
							                  	<input required type="number" class="form-control" id="margin" placeholder="Enter margin here" name="margin">
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
    $("#myDivId").append('<div class="col-xs-12 removeclass" style="padding-top: 10px;" id="removeclass'+room+'"><div class="col-xs-5"><label for="from_ratio">Ratio</label><input type="text" class="form-control" id="from_ratio[]" placeholder="Enter Ratio here" name="from_ratio[]"></div><div class="col-xs-1" style="text-align: center;"></div><div class="col-xs-5"><label for="to_ratio">Ratio</label><input type="text" class="form-control" id="to_ratio" placeholder="Enter Ratio here" name="to_ratio[]"></div><div class="col-xs-1" style="text-align: center;"><button class="btn btn-danger btn-remove" type="button" onclick="remove_point_fields('+ room +');"><span class="glyphicon glyphicon-minus"></span></button></div></div>');
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
