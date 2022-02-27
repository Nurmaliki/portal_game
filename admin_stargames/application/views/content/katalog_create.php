<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Katalog
			<small>Create</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo $this->config->item('base_url'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo $this->config->item('base_url'); ?>category">Katalog</a></li>
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
					<form role="form" action="<?php echo $this->config->item('base_url'); ?>katalog/action_create" method="post">
						<div class="box-body">
							<!-- <div class="form-group">
								<label for="exampleInputEmail1">Code Konfigurasi</label>
								<input required type="text" class="form-control" id="name" placeholder="Enter name here" name="code_conf" value="<?php echo $category[0]['code_conf']; ?>">
							</div> -->
							<div class="form-group">
								<label for="exampleInputEmail1">Name</label>
								<input required type="text" class="form-control" id="name" placeholder="Enter name here" name="name" value="">
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1">Deskripsi</label>
								<input required type="text" class="form-control" id="name" placeholder="Enter name here" name="descripsi" value="">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Poin</label>
								<input required type="text" class="form-control" id="name" placeholder="Enter name here" name="poin" value="">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Harga</label>
								<input required type="text" class="form-control" id="harga" placeholder="Enter name here" name="harga" value="">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Jumlah</label>
								<input required type="text" class="form-control" id="jumlah" placeholder="Enter name here" name="jumlah" value="">
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1">Prize Code</label>
								<input required type="text" class="form-control" id="prize_code" placeholder="Enter name here" name="prize_code" value="">
							</div>


							<div class="form-group">
								<label for="exampleInputEmail1">Aktive</label>
								<select class="form-control" name="aktive">

									<option value="1">Aktive</option>
									<option value="0">Tidak</option>

								</select>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Image</label>
								<input  type="text" class="form-control"  id="b64" placeholder="Enter name here" name="picture" value="">
								<input type="file" class="form-control" id="inp" placeholder="Enter name here" name="" value="">
								<img src="" id="img" alt="">
							</div>

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