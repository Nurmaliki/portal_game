<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Role
        <small>Create</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>role">Role</a></li>
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
                <?php if($this->session->flashdata('ruleFalse')){ ;?>
                  <div style="width: 100%;" id="alerts" class="alert alert-success" role="alert">
                      <strong><?php echo $this->session->flashdata('ruleFalse');?></strong>
                  </div>
                <?php }else if($this->session->flashdata('ruleTrue')){?>
                      <div style="background: #d4edda !important;color: #155724 !important;   width:100%;" id="alerts" class="alert alert-success" role="alert">
                          <strong><?php echo $this->session->flashdata('ruleTrue');?></strong>
                      </div>
                <?php } ?>
		            <!-- /.box-header -->
		            <!-- form start -->
		            <form role="form" action="<?php echo $this->config->item('base_url'); ?>role/action_create" method="post">
		             	<div class="box-body">
                      <div class="form-group">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" required class="form-control" id="description" placeholder="name" name="description" value="<?php echo $_SESSION['faild']['description']; ?>">
                     </div>
		              		<div class="form-group">
		                  	<label for="exampleInputEmail1">Program</label>  
												<?php // print_r($_SESSION['faild'])?>
		                  	<select class="form-control" name="program_id" required>
			                  	<?php
			                  	if(count($program) > 0){
			                  		for($i=0; $i<count($program); $i++){
			                  	?>
													<?php if( $program[$i]['program_code'] == "BTNC098"){ ?>
			                  		<option selected value="<?php echo $program[$i]['id']; ?>"><?php echo $program[$i]['program_name']; ?></option>

														<?php } ?>


			                  	<?php

			                  		}
			                  	}
			                  	?>

			                </select>
			            	</div>
			            	<div class="form-group">
			                  <label for="exampleInputEmail1">Transcode</label>
			                  <input type="text" required class="form-control" id="transcode" placeholder="Enter transcode here" name="transcode" value="<?php echo $_SESSION['faild']['transcode']; ?>">
			                </div>
			                <div class="form-group">
			                  <label for="exampleInputEmail1">Point</label>
			                  <input type="number" required class="form-control" id="Point" placeholder="Enter point here" name="point" value="<?php echo $_SESSION['faild']['point']; ?>">
											</div>
											<!-- <div class="form-group">
			                  <label for="exampleInputEmail1">Nominal</label>
			                  <input type="number" required class="form-control numbers" id="Nominal" placeholder="Enter nominal here" name="nominal" value="<?php echo $_SESSION['faild']['nominal']; ?>">
			                </div> -->
			                <div class="form-group">
			                  <label for="exampleInputEmail1">Rule Type</label>
			                  <select required class="form-control" name="rule_type">
			                	<option value="feeder_daily"  <?php if ( $_SESSION['faild']['rule_type'] == "feeder_daily"){echo "selected";} ?>>Feeder Daily</option>
			                	<option value="feeder_monthly"  <?php if ( $_SESSION['faild']['rule_type'] == "feeder_monthly"){echo "selected";} ?>>Feeder Monthly</option>
			                	<option value="event_special"  <?php if ( $_SESSION['faild']['rule_type'] == "event_special"){echo "selected";} ?>>Event Special</option>
			                	<option value="event_other"  <?php if ( $_SESSION['faild']['rule_type'] == "event_other"){echo "selected";} ?>>Event Other</option>
			                  </select>
			                </div>
							<div class="form-group">
			                  <label for="exampleInputEmail1">Rule Code</label>
			                  <input type="text" required class="form-control" id="rule_code" placeholder="Enter rule code here" name="rule_code" value="<?php echo $_SESSION['faild']['rule_code']; ?>">
							</div>
			                <!-- <div class="form-group">
			                  <label for="exampleInputEmail1">Rule Expire</label>
			                  <input type="text" required class="form-control" id="rule_expire" placeholder="Enter rule expire here" name="rule_expire" value="<?php echo $_SESSION['faild']['rule_expire']; ?>">
							         </div>
							        <div class="form-group">
			                  <label for="exampleInputEmail1">Rule Expire Type</label>
			                  <select required class="form-control" name="rule_expire_type">
												<option value="day" 	<?php if ( $_SESSION['faild']['rule_expire_type'] == "day"){echo "selected";} ?>>		Day</option>
												<option value="week"  <?php if ( $_SESSION['faild']['rule_expire_type'] == "week"){echo "selected";} ?>>	Week</option>
			                	<option value="month" <?php if ( $_SESSION['faild']['rule_expire_type'] == "month"){echo "selected";} ?>>Month</option>
			                	<option value="year"  <?php if ( $_SESSION['faild']['rule_expire_type'] == "year"){echo "selected";} ?>>Year</option>

			                  </select>
			                </div> -->

							<div class="form-group">
			                  <label for="exampleInputEmail1">Min Amount (IDR)</label>
			                  <input type="text" required class="form-control numbers" id="min_amount" placeholder="Min Amount" name="min_amount" value="<?php echo $_SESSION['faild']['min_amount']; ?>">
							</div>
							<div class="form-group">
			                  <label for="exampleInputEmail1">Kelipatan</label>
			                  <select onchange="changeKelipatan()" required class="form-control" name="kelipatan"  id="kelipatan">
												<option value="0" 	<?php if ( $_SESSION['faild']['kelipatan'] == "0"){echo "selected";} ?>>Tidak</option>
												<option value="1"  <?php if ( $_SESSION['faild']['kelipatan'] == "1"){echo "selected";} ?>>Ya</option>
			                  </select>
			                </div>
							<div   class="form-group" >
			                  <label style="display:none;" id="nominalKelipatan" for="exampleInputEmail1">Nominal Kelipatan (IDR)</label>
			                  <input type="hidden" required class="form-control numbers" id="nominal_kelipatan" placeholder="Nominal Kelipatan (IDR)" name="nominal_kelipatan" value="<?php echo $_SESSION['faild']['nominal_kelipatan']; ?>">
							</div>
							<div  class="form-group" >
			                  <label style="display:none;" id="maxPoin" for="exampleInputEmail1">Max Poin </label>
			                  <input type="hidden" required class="form-control numbers" id="max_poin" placeholder="Max Poin" name="max_poin" value="<?php echo $_SESSION['faild']['max_poin']; ?>">
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
			document.getElementById('max_poin').type = "text";
			document.getElementById('nominal_kelipatan').type = "text";
		}else{
			document.getElementById('nominalKelipatan').style.display = "none";
			document.getElementById('maxPoin').style.display = "none";
			document.getElementById('max_poin').type = "hidden";
			document.getElementById('nominal_kelipatan').type = "hidden";

		}
	}
</script>

<script>
$(document).ready(function(){
  $("input.numbers").blur(function(){
	  if(isNaN(new Number(this.value))){
		this.value = this.value;
	  } else {
		var d = new Number(this.value);
	  	this.value = d.toLocaleString('de');
	  }
  });
});
</script>
