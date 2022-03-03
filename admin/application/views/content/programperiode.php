
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Program Periode
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>member"> Program Periode</a></li>
        <li class="active"></li>
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
                    <?php if($this->session->flashdata('programPeriodeFalse')){ ;?>
                      <div style="width: 100%;" id="alerts" class="alert alert-success" role="alert">
                          <strong><?php echo $this->session->flashdata('programPeriodeFalse');?></strong>
                      </div>
                    <?php }else if($this->session->flashdata('programPeriodeTrue')){?>
                          <div style="background: #d4edda !important;color: #155724 !important;   width:100%;" id="alerts" class="alert alert-success" role="alert">
                              <strong><?php echo $this->session->flashdata('programPeriodeTrue');?></strong>
                          </div>
                    <?php } ?>

          <table class="table table-bordered table-hover" cellspacing="0" width="100%" id="member">
						  <thead>
							<tr>
					<th>Start Date </th>
					<th>End Date </th>
		            <th>Last Update</th>
		            <th>Updated by</th>
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
	$('#member').DataTable( {
        "processing": true,
        "serverSide": true,
        language: {
            // search: "_INPUT_",
            // searchPlaceholder: "Name, Cif or Phone Number",
            processing: "<div style='    margin-top: 20%;   background-color: greenyellow;'><b>LOADING...</b></div>"
        },
		"bFilter": false,
        "ajax": "<?php echo $this->config->item('base_url'); ?>programperiod/datatables",
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
