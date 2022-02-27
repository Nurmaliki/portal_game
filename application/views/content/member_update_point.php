<?php error_reporting(0); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Adjust Point
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>member">Member</a></li>
        <li class="active">Update point</li>
      </ol>
    </section>
    <!-- EndContent Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    	<div class="row">
	        <div class="col-xs-12">
	        	<div class="box box-primary">
		            <div class="box-header with-border">
		              <h3 class="box-title"></h3>
		            </div>
		            <?php if($this->session->flashdata('msgalert')){ ;?>
                        <div class="alert alert-success" role="alert">
                        <strong><?php echo $this->session->flashdata('msgalert');?></strong>
                        </div>
					<?php } ;?>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <?php if($this->session->userdata['user_data_web']['role'] == 1){?>
                            <form role="form" action="<?php echo $this->config->item('base_url'); ?>member/action_update_point" method="post">
                            <input type="hidden" class="form-control" id="id"  name="id" value="<?php echo $member[0]['id']; ?>">
                                <div class="box-body">
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Fullname</label>
                                    <input type="text" class="form-control" id="fullname" placeholder="Enter fullname here" name="fullname" value="<?php echo $member[0]['first_name']; ?> <?php echo $member[0]['last_name']; ?>" readonly>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Cif</label>
                                    <input type="text" class="form-control" id="cif" placeholder="1111" name="cif" value="<?php echo $member[0]['cif']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Phone</label>
                                    <input type="text" class="form-control" id="phone" placeholder="Enter phone here" name="phone" value="<?php echo $member[0]['phone']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Rekening</label>
                                    <input type="text" class="form-control" id="rekening" placeholder="Enter rekening here" name="rekening" value="<?php echo $member[0]['rekening']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Rule Type</label>
                                        <select class="form-control" name="rule_type">
                                            <!-- <option value="feeder_daily" <?php //if($role[0]['rule_type'] == 'feeder_daily'){echo'selected';} ?>>Feeder Daily</option>
                                            <option value="feeder_monthly" <?php //if($role[0]['rule_type'] == 'feeder_monthly'){echo'selected';} ?>>Feeder Monthly</option>
                                            <option value="event_special" <?php //if($role[0]['rule_type'] == 'event_special'){echo'selected';} ?>>Event Special</option> -->
                                            <option value="event_other" <?php if($role[0]['rule_type'] == 'event_other'){echo'selected';} ?>>Event Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Rule Code</label>
                                        <?php //print_r($role_code); ?>
                                        <select class="form-control" name="rule_code">





                                                <?php  for($i=0; $i<count($role_code); $i++){ ?>
                                                <?php // if($role_code[$i]['rule_code'] == "ultah"){echo "";}else{?>
                                                    <option value=" <?php  echo $role_code[$i]['rule_code'] ; ?>"  
                                                    ><?php  echo $role_code[$i]['rule_code']; ?></option>
                                                <?php } //} ?>

                                                
                                        </select>
                                      
                                      
                                        <!-- <label for="exampleInputEmail1">Rule Expire</label>
                                        <input type="text" class="form-control" id="rule_expire" placeholder="Enter rule expire here" name="rule_expire"  value="<?php echo $role[0]['rule_expire']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                        <label for="exampleInputEmail1">Rule Expire Type</label>
                                        <select class="form-control" name="rule_expire_type">
                                                            <option value="day" <?php if($role[0]['rule_expire_type'] == 'day'){echo'selected';} ?>>Day</option>
                                                            <option value="week" <?php if($role[0]['rule_expire_type'] == 'week'){echo'selected';} ?>>Week</option>
                                            <option value="month" <?php if($role[0]['rule_expire_type'] == 'month'){echo'selected';} ?>>Month</option>
                                            <option value="year" <?php if($role[0]['rule_expire_type'] == 'year'){echo'selected';} ?>>Year</option>
                                            
                                        </select> -->
                                        
                                        
                                    </div>
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Current Point</label>
                                    <input type="text" class="form-control" id="Point"  name="current_point"
                                    width="100" value="<?php echo $member[0]['point']; ?>" readonly>
                                    
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Adjust Point</label>
                                        
                                            <input required type="text" class="form-control" id="Point" placeholder="Enter point here" name="point"
                                            width="100" value="" >
                                        
                                    </div>
                                    
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        <?php } else if($this->session->userdata['user_data_web']['role'] == 4){?>
                            <form role="form" action="<?php echo $this->config->item('base_url'); ?>member/action_update_point" method="post">
                         
                            <input type="hidden" class="form-control" id="id"  name="id" value=" <?php print_r($this->uri->segment('3'))  ?>">
                            <input type="hidden" class="form-control" id="id"  name="member_id" value="<?php echo $member[0]['id']; ?>">
                                <div class="box-body">
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Fullname</label>
                                    <input type="text" class="form-control" id="fullname" placeholder="Enter fullname here" name="fullname" value="<?php echo $member[0]['first_name']; ?> <?php echo $member[0]['last_name']; ?>" readonly>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Cif</label>
                                    <input type="text" class="form-control" id="cif" placeholder="1111" name="cif" value="<?php echo $member[0]['cif']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <!-- <label for="exampleInputEmail1">Phone</label> -->
                                        <input type="hidden" class="form-control" id="phone" placeholder="Enter phone here" name="phone" value="<?php echo $member[0]['phone']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Rekening</label>
                                        <input type="text" class="form-control" id="rekening" placeholder="Enter rekening here" name="rekening" value="<?php echo $member[0]['rekening']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <!-- <label for="exampleInputEmail1">Rule Type</label> -->
                                        <select class="form-control" name="rule_type"  style="visibility:hidden;">
                                            <!-- <option value="feeder_daily" <?php //if($role[0]['rule_type'] == 'feeder_daily'){echo'selected';} ?>>Feeder Daily</option>
                                            <option value="feeder_monthly" <?php //if($role[0]['rule_type'] == 'feeder_monthly'){echo'selected';} ?>>Feeder Monthly</option>
                                            <option value="event_special" <?php //if($role[0]['rule_type'] == 'event_special'){echo'selected';} ?>>Event Special</option> -->
                                            <option value="event_other" <?php if($role[0]['rule_type'] == 'event_other'){echo'selected';} ?>>Event Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Current Point</label>
                                        <input type="text" class="form-control" id="Point"  name="current_point"
                                        width="100" value="<?php echo $member[0]['point']; ?>" readonly>
                                    
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Adjust Point</label>
                                        
                                        
                                            <input required type="text" class="form-control" id="Point" placeholder="Enter point here" name="point"
                                            width="100" value="<?php echo $_GET["point"] ?>" readonly>
                                           
                                            <?php // print_r($point_adjust) ?>
                                        
                                    </div>
                                    <div class="form-group">
                                        <!-- <label for="exampleInputEmail1">Rule Code</label> -->
                                        <?php //print_r($role_code); ?>
                                        <select class="form-control" name="rule_code" style="visibility:hidden;">
                                        





                                 
                                                    <option value=" <?php echo $_GET["poin_code"]; ?>"  
                                                    ><?php echo $_GET["poin_code"]; ?></option>
                                           




                                        </select>
                                        <!-- <label for="exampleInputEmail1">Rule Expire</label> -->
                                            <input type="hidden" class="form-control" id="rule_expire" placeholder="Enter rule expire here" name="rule_expire"  value="<?php echo $role[0]['rule_expire']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <!-- <label for="exampleInputEmail1">Rule Expire Type</label> -->
                                        <select class="form-control" name="rule_expire_type" style="visibility:hidden;">
                                                            <option value="day" <?php if($role[0]['rule_expire_type'] == 'day'){echo'selected';} ?>>Day</option>
                                                            <option value="week" <?php if($role[0]['rule_expire_type'] == 'week'){echo'selected';} ?>>Week</option>
                                            <option value="month" <?php if($role[0]['rule_expire_type'] == 'month'){echo'selected';} ?>>Month</option>
                                            <option value="year" <?php if($role[0]['rule_expire_type'] == 'year'){echo'selected';} ?>>Year</option>
                                            
                                        </select>
                                        
                                        
                                    </div>
                                    
                                    
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Approve</button>
                                </div>
                            </form>   
                        <?php } ?>
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
        "ajax": "<?php echo $this->config->item('base_url'); ?>member/datatables",
		"type": "GET"
    } );
} );
</script>
<!-- End Content Wrapper. Contains page content -->