<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Email
        <small>List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>email">Email</a></li>
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
                  <?php if($this->session->flashdata('emailFalse')){ ;?>
                    <div style="width: 100%;" id="alerts" class="alert alert-success" role="alert">
                        <strong><?php echo $this->session->flashdata('emailFalse');?></strong>
                    </div>
                  <?php }else if($this->session->flashdata('emailTrue')){?>
                        <div style="background: #d4edda !important;color: #155724 !important;   width:100%;" id="alerts" class="alert alert-success" role="alert">
                            <strong><?php echo $this->session->flashdata('emailTrue');?></strong>
                        </div>
                  <?php } ?>


						<?php if ($this->session->userdata['user_data_web']['role'] == 5) {
							echo "";
						}else{ ?>
		            	<div style="float: right"><a href="<?php echo $this->config->item('base_url')?>emailsubscribe/download_email_letter_sub" class="btn btn-app"><i class="fa fa-download"></i> Download</a></div>
		            	<?php } ?>
		              	<table class="table table-bordered table-hover" cellspacing="0" width="100%" id="member">
						  <thead>
							<tr>
								<th>email</th>
		            <th>Date Subscribe</th>

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
	$('#member').DataTable( {
        "processing": true,
        "serverSide": true,
        language: {
            search: "_INPUT_",
            // searchPlaceholder: "Name, Cif or Phone Number",
            processing: "<div style='    margin-top: 20%;   background-color: greenyellow;'><b>LOADING...</b></div>"
        },
		"bFilter": false,
        "ajax": "<?php echo $this->config->item('base_url'); ?>emailsubscribe/datatables",
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
<!-- End Content Wrapper. Contains page content -->
