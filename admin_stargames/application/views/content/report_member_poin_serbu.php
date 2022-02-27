<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Report
        <small>Member Poin Serbu </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>">Report</a></li>
        <li class="active">Report Member Poin Serbu</li>
      </ol>
    </section>
    <!-- EndContent Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    	<div class="row">
	        <div class="col-xs-12">
            <a style="margin:20px;" href="<?php echo $this->config->item('base_url');?>report/download_report_member_regis" class="btn btn-success"> <i class="fa  fa-download"></i>	Download	</a>

	        	<div class="box">
		            <!-- /.box-header -->
		            <div class="box-body">


		              	<table  class="table table-bordered table-hover" cellspacing="0" width="100%" id="member_report">
                    <thead>
        		                <tr>
          		                  	<th>Nama</th>
          		                  	<th>email</th>
          		                  	<th>Date Of birthday</th>
                                  <th>CIF</th>
          		                  	<th>Phone</th>
                                  <th >Rekening</th>
                                  <th >Activation date</th>

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
	$('#member_report').DataTable( {

    "ordering": false,

        "DeferRender": true,
        "processing": true,
        "serverSide": true,
        "bFilter": true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Name, Cif or Phone Number",
            processing: "<div style='margin-top: 20%;     background-color: aquamarine;'><b>LOADING...</b></div>"
        },
        "ajax": "<?php echo $this->config->item('base_url'); ?>report/datatables_member",
		    "type": "GET"
    } );
} );
</script>
<!-- End Content Wrapper. Contains page content -->
