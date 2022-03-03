<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Grand Prize Event Data
        <small>List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>event_data">Grand Prize Data</a></li>
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
		            	<?php if($this->session->flashdata('msgalert')){ ;?>
						<div class="alert alert-success" role="alert">
						<strong><?php echo $this->session->flashdata('msgalert');?></strong>
						</div>
						<?php } ;?>
						<div style="float: right "><a href="<?php echo $this->config->item('base_url')?>event_data/downloadascsv" class="btn btn-app"><i class="fa  fa-download"></i> Download</a></div>
		              	<table class="table table-bordered table-hover" cellspacing="0" width="100%" id="member">
						  <thead>
							<tr>
								<th>Name Event</th>
								<th>Name</th>
								<th>CIF</th>
								<th>No. Telp</th>
								<th>Voucher code</th>
                                <th>Register date</th>
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
	$.fn.dataTable.ext.errMode = 'none';
	$('#member').DataTable( {

        "processing": true,
				"searching": false,
        "serverSide": true,
        language: {
            // search: "_INPUT_",
            // searchPlaceholder: "Name, Cif or Phone Number",
            processing: "<div style='    margin-top: 20%;   background-color: greenyellow;'><b>LOADING...</b></div>"
        },
				"bFilter": true,
        "ajax": "<?php echo $this->config->item('base_url'); ?>event_data/datatables",
		"type": "GET"
    } );
	// 	$("href").click(function() {
  //   var fired_button = $(this).val();
	// 	document.getElementById("view").value = fired_button;
	// 	//$(".formData").val(fired_button)
	// 	alert(fired_button);

	// });
	// var note =	document.getElementById("delete").value;
	// $('a[href="#delete"]').click(function(){
	// 		alert('hapus conten !!.');
	// });

// 	$('a[href="#delete"]').click(function(){
// 			alert('hapus conten !!.');
// });
// $(document).on('click', ':not(form)[data-confirm]', function(e){
//     if(!confirm($(this).data('confirm'))){
//         e.stopImmediatePropagation();
//         e.preventDefault();
//     }
// });





$(document).on('click', ':not(form)[data-confirm]', function(e){
        if(!confirm($(this).data('confirm'))){
            e.stopImmediatePropagation();
            e.preventDefault();
        }
});



});
</script>
<!-- End Content Wrapper. Contains page content -->
