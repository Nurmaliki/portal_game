<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transcode
        <small>Create</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>rule_new">Role</a></li>
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


                <?php if($this->session->flashdata('ruleNewDetailFalse')){ ?>
                  <div style="width: 61%;" id="alerts" class="alert alert-success" role="alert">
                      <strong><?php echo $this->session->flashdata('ruleNewDetailFalse');?></strong>
                  </div>
                <?php }else if($this->session->flashdata('ruleNewDetailTrue')){?>
                      <div style="background: #d4edda !important;color: #155724 !important;   width: 61%;" id="alerts" class="alert alert-success" role="alert">
                          <strong><?php echo $this->session->flashdata('ruleNewDetailTrue');?></strong>
                      </div>
                <?php } ?>

		            <!-- /.box-header -->
		            <!-- form start -->
		            <form role="form" action="<?php echo $this->config->item('base_url'); ?>rule_new/action_create_transcode/<?php echo $this->uri->segment(3); ?>" method="post">
		             	<div class="box-body">

			            	<div class="form-group">
			                  <label for="exampleInputEmail1">Transcode</label>
			                  <input type="number" required class="form-control" id="transcode" placeholder="Enter transcode here" name="transcode" value="">
			                  <input type="hidden" required class="form-control" id="rule_id" name="rule_id" value="<?php echo $this->uri->segment(3); ?>">
			                </div>


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
<style>
.entry:not(:first-of-type)
{
    margin-top: 10px;
}
</style>
<script>

	document.getElementsByTagName("BODY")[0].onload = function() {changeKelipatan()};
	function changeKelipatan(){
		var kelipatan = document.getElementById('kelipatan').value;
		// console.log(kelipatan);
		if(kelipatan == 1){
			document.getElementById('nominalKelipatan').style.display = "block";
			document.getElementById('maxPoin').style.display = "block";
			document.getElementById('max_poin').type = "number";
			document.getElementById('nominal_kelipatan').type = "number";
		}else{
			document.getElementById('nominalKelipatan').style.display = "none";
			document.getElementById('maxPoin').style.display = "none";
			document.getElementById('max_poin').type = "hidden";
			document.getElementById('nominal_kelipatan').type = "hidden";

		}
	}
</script>
