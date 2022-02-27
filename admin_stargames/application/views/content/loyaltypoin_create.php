<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			konfigurasi
			<small>Create</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo $this->config->item('base_url'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo $this->config->item('base_url'); ?>category">konfigurasi</a></li>
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
					<?php if ($this->session->flashdata('msgalert')) {; ?>
						<div class="alert alert-success" role="alert">
							<strong><?php echo $this->session->flashdata('msgalert'); ?></strong>
						</div>
					<?php }; ?>
					<!-- /.box-header -->
					<!-- form start -->
					<form role="form" action="<?php echo $this->config->item('base_url'); ?>loyaltypoin/action_create" method="post">
						<div class="box-body">
							<div class="form-group">
								<label for="exampleInputEmail1">Code Konfigurasi</label>
								<input required type="text" class="form-control" id="name" placeholder="Enter name here" name="code_conf" value="">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Name</label>
								<input required type="text" class="form-control" id="name" placeholder="Enter name here" name="name" value="">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Poin</label>
								<input required type="text" class="form-control" id="name" placeholder="Enter name here" name="poin" value="">
							</div>
							<select class="form-control" name="aktiv">

								<option value="1" >Aktive</option>
								<option value="0">Tidak</option>

							</select>
						</div>

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