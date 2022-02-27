<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Email
        <small>Update</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>admin">Email</a></li>
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
		            <form role="form" action="<?php echo $this->config->item('base_url'); ?>email/action_update" method="post">
		            <input type="hidden" name="id" value="<?php echo $email[0]['id']; ?>">
		              <div class="box-body">
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Name</label>
		                  <input required type="email" class="form-control" id="email" placeholder="Enter email here" name="email" value="<?php echo $email[0]['email']; ?>">
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
<!-- End Content Wrapper. Contains page content -->