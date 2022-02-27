<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Grand Prize Event List
        <small>List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>event_list">Grand Prize Event List</a></li>
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
                  <?php if($this->session->flashdata('msggrandPrizeFalse')){ ;?>
                    <div style="width: 100%;" id="alerts" class="alert alert-success" role="alert">
                        <strong><?php echo $this->session->flashdata('msggrandPrizeFalse');?></strong>
                    </div>
                  <?php }else if($this->session->flashdata('msggrandPrizeTrue')){?>
                        <div style="background: #d4edda !important;color: #155724 !important;   width:100%;" id="alerts" class="alert alert-success" role="alert">
                            <strong><?php echo $this->session->flashdata('msggrandPrizeTrue');?></strong>
                        </div>
                  <?php } ?>

						<?php if ($this->session->userdata['user_data']['role'] == 5) {
							# code...
						}else{ ?>
		            	<div style="float: right"><a href="<?php echo $this->config->item('base_url')?>event_list/create" class="btn btn-app"><i class="fa  fa-plus"></i> Input</a></div>
		            	<?php } ?>
		              	<table class="table table-bordered table-hover" cellspacing="0" width="100%" id="member">
						  <thead>
							<tr>
								<th>Title</th>
                                <!-- <th>Category</th> -->
                                <th>Status</th>
                                <th>Publish date</th>
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
        "ajax": "<?php echo $this->config->item('base_url'); ?>event_list/datatables",
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
