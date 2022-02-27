Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Adjust Poin Member
     <!--    <small>List</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>member">  Adjust Poin Member</a></li>
        <!-- <li class="active">List</li> -->
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
          <?php }else if($this->session->flashdata('alertSuccess')){ ;?>

          <div class="alert " style="background-color: greenyellow;" role="alert">
          <strong><?php echo $this->session->flashdata('alertSuccess');?></strong>
          </div>
        <?php }else{} ?>


                        <?php // print_r($_SESSION['user_data_web']['role']);?>


                    <form id="cif" role="form" action="<?php echo $this->config->item('base_url'); ?>adjust_poin/show_member" method="post">
		              <div class="box-body">

		              	<div class="form-group">
		                  <label for="exampleInputEmail1">CIF / No rekening</label>
		                  <input required type="text" class="form-control" id="username" placeholder="CIF / No rekening / Telepon" name="cif" value="">
		                </div>



		              </div>
		              <!-- /.box-body -->

		              <div class="box-footer">
		                <button type="submit" class="btn btn-primary">Submit</button>
		              </div>
		            </form>
<br>
<br>
<br>


		            </div>
		            <!-- /.box-body -->
		        </div>
	        </div>
	    </div>
	</section>


	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel"></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">



	      			<center><h3 class="modal-title" id="name"></h3></center>

 		<div class="container">
			      	  <div class="row">

					 <div class="col-md-3 col-sm-3">
					 	<h6 class="card-text" id="email"> </h6>
					    <h6 class="card-text" id="cif_view"> </h6>
					  </div>

					  <div class="col-md-3 col-sm-3">
					    <h6 class="card-text" id="phone"> </h6>
					    <h6 class="card-text" id="rekening"> </h6>

					  </div>


					  </div>
		</div>

		 			<center>
					  			<h6 style="color: #3246A5;     font-size: x-large;" id="poin" class=""></h6>
					</center>

	      <!-- </div> -->
	      	<!-- <p id="name"></p>
	      	<p id="cif"></p>
	      	<p id="email"></p>
	      	<p id="phone"></p>
	      	<p id="poin"></p>
	      	<p id="rekening"></p> -->

	       <form role="form" action="<?php echo $this->config->item('base_url'); ?>adjust_poin/action_adjust_poin_member" method="post">
		              <div class="box-body">

		              	<!-- <div class="form-group"> -->
		                  <!-- <label for="exampleInputEmail1">CIF / No rekening</label> -->
		                  <input required type="hidden" class="form-control" id="noRekening" placeholder="Enter username here" name="cif" value="">
		                <!-- </div> -->

		                <div class="form-group">

						<label for="exampleInputEmail1">Penambahan Atau Pengurangan</label>
		                     	<select required class="form-control" name="konversi">

			            			<!-- <option value="" selected disabled></option> -->
			            			<option value="tambah"  selected >Tambah</option>
			            			<option value="kurang"  >Kurang</option>

				                 </select>
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Value</label>
		                  <input required type="number" class="form-control" id="username" placeholder="Value" name="value_adjust_poin" value="">
		                </div>


		              </div>
		              <!-- /.box-body -->

		              <div class="box-footer">
		                <button type="submit" class="btn btn-primary">Submit</button>
		                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		              </div>
		            </form>
	      </div>
	      <div class="modal-footer">
	        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button> -->
	      </div>
	    </div>
	  </div>
	</div>

    <!-- End Main content -->
</div>
<script type="text/javascript">
$(document).ready(function() {
	$('#member').DataTable( {
        "processing": true,
        "serverSide": true,
		"bFilter": false,
        "ajax": "<?php echo $this->config->item('base_url'); ?>adjust_poin/datatables",
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

<script type="text/javascript">

	function function_name(argument) {
		// body...
	}

	$("#cif").submit(function(event){
	event.preventDefault(); //prevent default action
	var post_url = $(this).attr("action"); //get form action url
	var request_method = $(this).attr("method"); //get form GET/POST method
	var form_data = $(this).serialize(); //Encode form elements for submission

	$.ajax({
		url : post_url,
		type: request_method,
		data : form_data
	}).done(function(response){
		res = JSON.parse(response);
		console.log(res);
		$("#name").html(res.first_name);
		$("#cif_view").html("CIF : "+res.cif);
		$("#email").html("Email : "+res.email);
		$("#phone").html("Phone : "+res.phone);
		$("#poin").html("Current Point : "+res.current_point);
		$("#rekening").html("Nomor Rekening : "+res.rekening);
		$("#noRekening").val(res.rekening);

		$('#exampleModal').modal('show');
		// console.log(res.id);
	});
	});
</script>
<!-- End Content Wrapper. Contains page content
