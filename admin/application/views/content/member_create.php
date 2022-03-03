<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Member
        <small>Create</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>member">Member</a></li>
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
		            <?php if($this->session->flashdata('msgalert')){ ;?>
					<div class="alert alert-success" role="alert">
					<strong><?php echo $this->session->flashdata('msgalert');?></strong>
					</div>
					<?php } ;?>
		            <!-- /.box-header -->
		            <!-- form start -->
		            <form role="form" action="<?php echo $this->config->item('base_url'); ?>member/action_create" method="post">
		              <div class="box-body">
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Fullname</label>
		                  <input required type="text" class="form-control" id="fullname" placeholder="Enter fullname here" name="fullname">
		                </div>
		                <!-- <div class="form-group">
		                  <label for="exampleInputEmail1">Email</label>
		                  <input required type="email" class="form-control" id="email" placeholder="Enter email here" name="email">
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Password</label>
		                  <input required type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}" title="Password harus terdiri dari huruf kecil, huruf kapital, Angka dan minimal 10 karakter" class="form-control" id="password" minlength="6"  placeholder="Enter password here" name="password">
		                </div> -->
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Cif</label>
		                  <input required type="text" class="form-control" id="cif" placeholder="A1111" name="cif">
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Phone</label>
		                  <input required type="number" class="form-control" id="phone" placeholder="Enter phone here" name="phone">
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Rekening</label>
		                  <input required type="number" class="form-control" id="rekening" placeholder="Enter rekening here" name="rekening">
		                </div>
		              </div>
		              <!-- /.box-body -->

		              <div class="box-footer">
		                <button type="submit" class="btn btn-primary">Submit</button>
		              </div>
		            </form>
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