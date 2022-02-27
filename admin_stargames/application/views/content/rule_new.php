Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Feeder Rule New
        <small>List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>rule_new">Role</a></li>
        <li class="active">List</li>
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

                                  <!-- Alert Tentang -->

                                  <?php if($this->session->flashdata('ruleNewFalse')){ ;?>
                                    <div style="width: 100%;" id="alerts" class="alert alert-success" role="alert">
                                        <strong><?php echo $this->session->flashdata('ruleNewFalse');?></strong>
                                    </div>
                                  <?php }else if($this->session->flashdata('ruleNewTrue')){?>
                                        <div style="background: #d4edda !important;color: #155724 !important;   width: 100%;" id="alerts" class="alert alert-success" role="alert">
                                            <strong><?php echo $this->session->flashdata('ruleNewTrue');?></strong>
                                        </div>
                                  <?php } ?>

                          <?php  if ($_SESSION['user_data']['role'] == 4){
                                echo "";
                            }else if ($_SESSION['user_data']['role'] == 5){ ?>

                            	<div style="float: right"><a href="<?php echo $this->config->item('base_url')?>rule_new/download_role" class="btn btn-app"><i class="fa fa-download"></i> Export Data Exel</a></div>
                         <?php   }else{ ?>

								<div style="float: right"><a href="<?php echo $this->config->item('base_url')?>rule_new/download_role" class="btn btn-app"><i class="fa fa-download"></i> Export Data Exel</a></div>
                                <div style="float: right"><a href="<?php echo $this->config->item('base_url')?>rule_new/create" class="btn btn-app"><i class="fa fa-plus"></i> Input</a></div>

                            <?php
                            } ?>
		            		<table class="table table-bordered table-hover" cellspacing="0" width="100%" id="redeem">
						  <thead>
							<tr>
                <!-- <th>Program name</th> -->
								<th>Name</th>
                <th>Rule Code</th>
                <th>Point</th>
								<th>Kelipatan</th>
                <th>Min Amount (IDR)</th>
                <th>Nominal Kelipatan</th>
								<th>Max Poin</th>
								<!-- <th>Rule type</th> -->
								<!-- <th>Rule Expire</th>
								<th>Rule Expire Type</th> -->
								<th>Date create</th>
								<th>Action</th>
							</tr>
						  </thead>
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
	$('#redeem').DataTable( {
        "processing": true,
        "serverSide": true,
        language: {
            // search: "_INPUT_",
            // searchPlaceholder: "Name, Cif or Phone Number",
            processing: "<div style='    margin-top: 20%;   background-color: greenyellow;'><b>LOADING...</b></div>"
        },
		"bFilter": false,
        "ajax": "<?php echo $this->config->item('base_url'); ?>rule_new/datatables",
		"type": "GET"
    } );
} );
$(document).on('click', ':not(form)[data-confirm]', function(e){
        if(!confirm($(this).data('confirm'))){
            e.stopImmediatePropagation();
            e.preventDefault();
        }
    });
</script>
<!-- End Content Wrapper. Contains page content
