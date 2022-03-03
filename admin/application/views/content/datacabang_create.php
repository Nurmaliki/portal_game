<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Cabang
        <small>Create</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>admin">Data Cabang</a></li>
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
		            <form role="form" action="<?php echo $this->config->item('base_url'); ?>datacabang/action_create" method="post">
		              <div class="box-body">
		                <div class="form-group">
										<label for="exampleInputEmail1">Nama Cabang</label>
		                  <input required type="text" class="form-control" id="name" placeholder="nama cabang" name="nama_cabang" value="<?php print_r($this->session->flashdata('field')['nama_cabang']);?>">
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Prefix Rekening</label>
		                  <input required type="text" class="form-control" id="username" placeholder="Prefix Rekening" name="prefix_rek" value="<?php print_r($this->session->flashdata('field')['prefix_rek']);?>">
		                </div>
                    <div class="form-group">
		                  <label for="exampleInputEmail1">Description</label>
		                  <input required type="text" class="form-control" id="username" placeholder="Description" name="des" value="<?php print_r($this->session->flashdata('field')['des']);?>">
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
