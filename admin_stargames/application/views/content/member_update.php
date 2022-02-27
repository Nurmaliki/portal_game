<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Member
        <small>Update</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>member">Member</a></li>
        <li class="active">Update</li>
      </ol>
    </section>
    <!-- EndContent Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    	<div class="row">
	        <div class="col-xs-12">
	        	<div class="box box-primary">
		            <div class="box-header with-border">
		              <h3 class="box-title">Update data</h3>
		            </div>
		            <?php if($this->session->flashdata('msgalert')){ ;?>
					<div class="alert alert-success" role="alert">
					<strong><?php echo $this->session->flashdata('msgalert');?></strong>
					</div>
					<?php } ;?>
		            <!-- /.box-header -->
		            <!-- form start -->
                    <form role="form" action="<?php echo $this->config->item('base_url'); ?>member/action_update" method="post">
                    <input type="hidden" class="form-control" id="id"  name="id" value="<?php echo $member[0]['id']; ?>">
		              <div class="box-body">
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Fullname</label>
		                  <input required type="text" class="form-control" id="fullname" placeholder="Enter fullname here" name="fullname" value="<?php echo $member[0]['first_name']; ?> <?php echo $member[0]['last_name']; ?>">
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Email</label>
		                  <input required type="email" class="form-control" id="email" minlength="6" placeholder="Enter email here" name="email" value="<?php echo $member[0]['email']; ?>">
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Password</label>
		                  <input required readonly type="password" class="form-control" id="password" placeholder="Enter password here" name="password" value="<?php echo $member[0]['password']; ?>">
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Cif</label>
		                  <input required readonly type="text" class="form-control" id="cif" placeholder="A1111" name="cif" value="<?php echo $member[0]['cif']; ?>">
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Phone</label>
		                  <input required readonly type="number" class="form-control" id="phone" placeholder="Enter phone here" name="phone" value="<?php echo $member[0]['phone']; ?>">
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Rekening</label>
		                  <input required readonly type="number" class="form-control" id="rekening" placeholder="Enter rekening here" name="rekening" value="<?php echo $member[0]['rekening']; ?>">
		                </div>
                        <div class="form-group">
		                  <label for="exampleInputEmail1">Point</label>
		                  <input required type="text" class="form-control" id="Point" placeholder="Enter point here" name="point"
                           width="100" value="<?php echo $member[0]['point']; ?>" readonly>
                          <?php echo $action_link; ?>
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