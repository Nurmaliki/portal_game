<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Katalog
			<small>Update</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo $this->config->item('base_url'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo $this->config->item('base_url'); ?>category">Katalog</a></li>
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
					<?php if ($this->session->flashdata('msgalert')) {; ?>
						<div class="alert alert-success" role="alert">
							<strong><?php echo $this->session->flashdata('msgalert'); ?></strong>
						</div>
					<?php }; ?>
					<!-- /.box-header -->
					<!-- form start -->
					<form role="form" action="<?php echo $this->config->item('base_url'); ?>katalog/action_update" method="post">
						<input type="hidden" name="id" value="<?php echo $category[0]['id']; ?>">
						<div class="box-body">
							<!-- <div class="form-group">
								<label for="exampleInputEmail1">Code Konfigurasi</label>
								<input required type="text" class="form-control" id="name" placeholder="Enter name here" name="code_conf" value="<?php echo $category[0]['code_conf']; ?>">
							</div> -->
							<div class="form-group">
								<label for="exampleInputEmail1">Name</label>
								<input required type="text" class="form-control" id="name" placeholder="Enter name here" name="name" value="<?php echo $category[0]['name']; ?>">
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1">Deskripsi</label>
								<input required type="text" class="form-control" id="name" placeholder="Enter name here" name="descripsi" value="<?php echo $category[0]['descripsi']; ?>">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Poin</label>
								<input required type="text" class="form-control" id="name" placeholder="Enter name here" name="poin" value="<?php echo $category[0]['poin']; ?>">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Harga</label>
								<input required type="text" class="form-control" id="harga" placeholder="Enter name here" name="harga" value="<?php echo $category[0]['harga']; ?>">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Jumlah</label>
								<input required type="text" class="form-control" id="jumlah" placeholder="Enter name here" name="jumlah" value="<?php echo $category[0]['jumlah']; ?>">
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1">Prize Code</label>
								<input required type="text" class="form-control" id="prize_code" placeholder="Enter name here" name="prize_code" value="<?php echo $category[0]['prize_code']; ?>">
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1">Aktive</label>
								<select class="form-control" name="aktive">

									<option value="1" <?php if ($category[0]['poin'] == 1) {
															echo "selected";
														} else {
															echo "";
														} ?>>Aktive</option>
									<option value="0" <?php if ($category[0]['poin'] == 0) {
															echo "selected";
														} else {
															echo "";
														} ?>>Tidak</option>

								</select>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Picture</label>
								<input type="file" id="inp" name="">
								<input type="text" id="b64" name="picture">
								<img id="img" src="<?php echo $category[0]['picture']; ?>" alt="">
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


<script>
	function readFile() {

		if (this.files && this.files[0]) {

			var FR = new FileReader();

			FR.addEventListener("load", function(e) {
				document.getElementById("img").src = e.target.result;
				// document.getElementById("imgext").src = "";
				document.getElementById("b64").value = e.target.result;
			});

			FR.readAsDataURL(this.files[0]);
		}

	}

	document.getElementById("inp").addEventListener("change", readFile);
</script>
<!-- End Content Wrapper. Contains page content -->