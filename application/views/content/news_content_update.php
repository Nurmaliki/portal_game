<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			News Content
			<small>Update News</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo $this->config->item('base_url'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="<?php echo $this->config->item('base_url'); ?>news_content">News Content</a></li>
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
					<?php //if($field['picture']!= $content[0]['picture']){ 
					?>
					<!-- <form role="form" action="<?php echo $this->config->item('base_url'); ?>news_content/do_upload" method="post" 
										id="news_content" enctype="multipart/form-data" > -->
					<?php //}else{
					?>
					<!-- <form role="form" action="<?php echo $this->config->item('base_url'); ?>news_content/action_update" method="post"> -->
					<?php // } 
					?>
					<form role="form" action="<?php echo $this->config->item('base_url'); ?>news_content/do_upload_update" method="post" enctype="multipart/form-data">
						<input type="hidden" id="id" name="id" value="<?php echo $content[0]['id']; ?>">
						<div class="box-body">
							<div class="form-group">
								<label for="exampleInputEmail1">Category name</label>
								<select class="form-control" name="category_id">

									<?php
									if (count($category) > 0) {
										for ($i = 0; $i < count($category); $i++) {
											if ($category[$i]['id'] == $content[0]['category_id']) {
									?>
												<option value="<?php echo $category[$i]['id']; ?>" selected><?php echo $category[$i]['name']; ?></option>
											<?php
											} else {
											?>
												<option value="<?php echo $category[$i]['id']; ?>"><?php echo $category[$i]['name']; ?></option>
											<?php
											}
											?>

									<?php

										}
									}
									?>

								</select>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">title</label>
								<input maxlength="100" required type="text" class="form-control" id="name" placeholder="Enter Title here" name="name" value="<?php echo $content[0]['title']; ?>">
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1">sub title</label>
								<input maxlength="160" required type="text" class="form-control" id="sub_title" placeholder="Enter Sub title here" name="sub_title" value="<?php echo $content[0]['sub_title']; ?>">
							</div>

							<div class="form-group">
								<label for="exampleInputEmail1">Body</label>
								<textarea required name="body" id="body" class="form-control"><?php echo $content[0]['body']; ?></textarea>
								<!-- <input type="textarea" class="form-control tinymce" id="body" placeholder="your story" name="body" value="<?php // echo $content[0]['body']; 
																																				?>"> -->
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Status</label>
								<select class="form-control" id="status" name="status">
									<option <?php if ($content[0]['status'] == 1) {
												echo "selected";
											}; ?> value="1" selected="true">Aktif</option>
									<option <?php if ($content[0]['status'] == 0) {
												echo "selected";
											}; ?> value="0">Tidak Aktif</option>
								</select>
								<!-- <input type="text" class="form-control" id="status" placeholder="publih / un publish" name="status" value="<?php echo $content[0]['status']; ?>"> -->
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Publish by</label>
								<input type="text" class="form-control" id="publish_by" placeholder="publih / un publish" name="publish_by" value="<?php echo $content[0]['publish_by']; ?>">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1"> image</label>
								<br>
								<?php if (empty($field['picture'])) { ?>
									<textarea name="picture" id="picture" class="form-control"><?php echo $content[0]['picture']; ?></textarea>
								<?php } else { ?>
									<textarea name="picture" id="picture" class="form-control"><?php echo $field['picture']; ?></textarea>
								<?php } ?>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Video link</label>
								<input type="text" class="form-control" id="video" placeholder="Enter name here" name="video" value="<?php echo $content[0]['video']; ?>">

							</div>
							<?php //print_r($content[0]); 
							?>

						</div>
						<div class="box">
							<div class="box-header with-border">
								<h3 class="box-title">Upload image</h3>
								<p style="font-size: 10px">Ukuran image sebaiknya (360 x 188 px) </p>
								<div class="box-tools pull-right">
									<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
									</button>

								</div>
							</div>

							<div class="box-body" style="">
								<?php //echo form_open_multipart('news_content/do_upload');
								?>

								<input type="file" name="userfile" size="20" />

								<br /><br />
								<input type="hidden" id="upload" name="upload" value="" class="upload">
								<button type="submit" value="upload" class="btn btn-primary">Upload</button>
								<?php //echo 'img = '.$img ;
								?>
								<?php if (empty($field['picture'])) { ?>
									<img class="img-responsive pad" src="<?php echo $this->config->item('assets_url') . 'uploads/' . $content[0]['picture']; ?>" alt="Photo">
								<?php } else { ?>
									<img class="img-responsive pad" src="http://10.255.0.140/cms_btn/uploads/<?php echo $field['picture']; ?>" alt="Photo">
									<!-- <textarea name="picture" id="picture" class="form-control" ><?php //echo $field['picture']; 
																										?></textarea> -->
								<?php } ?>


								<!-- </form> -->
							</div>
						</div>
						<!-- /.box-body -->


						<div class="box-footer">

							<button type="submit" class="btn btn-primary" value="update">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

	<!-- End Main content -->
</div>

<!-- End Content Wrapper. Contains page content -->
<script type="text/javascript">
	function readFile() {

		if (this.files && this.files[0]) {

			var FR = new FileReader();

			FR.addEventListener("load", function(e) {
				document.getElementById("img").src = e.target.result;
				document.getElementById("b64").innerHTML = e.target.result;
			});

			FR.readAsDataURL(this.files[0]);
		}

	}

	document.getElementById("inp").addEventListener("change", readFile);
</script>