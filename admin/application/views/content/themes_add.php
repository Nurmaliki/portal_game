<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<form method="post" enctype="multipart/form-data" action="<?php echo $this->config->item('base_url');?>themes/save">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row" style="display: flex;align-items: center;">
            <div class="col-sm-10">
                <h3>
                    Create New Theme
                    <small></small>
                </h3>
            </div>
            <div class="col-sm-2">
                <button style="float: right;margin-right: 5px;" type="submit" class="btn btn-primary">Create Theme</button>
            </div>
        </div>
	</section>

    <section class="content" style="background: rgb(255,255,255);margin: 20px;padding: 0px;padding-left: 20px !important; padding-right: 20px !important;padding-top: 20px !important;">
        <div class="row" style="padding: 20px;display:flex;align-items:center;">
            <div class="col-sm-2" style="border-right: 1px solid rgb(230,230,230)">
                <h4 style="line-height:160%;"> Theme Name </h4>
            </div>
            <div class="col-sm-7">
                <input style="margin-left: 30px;" class="form-control" type="text" name="themes_name" placeholder="Name">
            </div>
        </div>
        <hr>
         <div class="row" style="padding: 20px;display:flex;align-items:center;">
            <div class="col-sm-2" style="border-right: 1px solid rgb(230,230,230)">
                <h4 style="line-height:160%;"> Theme Accent Color </h4>
            </div>
            <div class="col-sm-7">
                <input style="margin-left: 30px;" class="form-control" type="text" name="themes_accent_color" placeholder="Color Value (HEX, RGB or RGBA)">
            </div>
        </div>
        <hr>
        <div class="row">
        <div class="row" style="padding: 20px;display:flex;align-items:center;">
            <div class="col-sm-2" style="border-right: 1px solid rgb(230,230,230)">
                <h4 style="line-height:160%;"> Logo </h4>
            </div>
            <div class="col-sm-7">
                <input style="margin-left: 30px;" class="form-control" type="file" name="themes_logo_file">
									<label  style="margin-left: 30px;" for="">file size (40 kb), image size (280 * 90 px) dan Tipe (PNG, JPG ,JEPG)  </label>
            </div>
        </div>
        <hr>
        <div class="row" style="padding: 20px;display:flex;align-items:center;">
            <div class="col-sm-2" style="border-right: 1px solid rgb(230,230,230)">
                <h4 style="line-height:160%;"> Home Banner </h4>
            </div>
            <div class="col-sm-7">
                <input style="margin-left: 30px;" class="form-control" type="file" name="themes_banner_file">
									<label  style="margin-left: 30px;" for="">file size (400 kb), image size (1061 * 893 px) dan Tipe (PNG, JPG ,JEPG)  </label>

            </div>
        </div>
				<hr>
				<div class="row" style="padding: 20px;display:flex;align-items:center;">
						<div class="col-sm-2" style="border-right: 1px solid rgb(230,230,230)">
								<h4 style="line-height:160%;"> Bendera Kiri  </h4>
						</div>
						<div class="col-sm-7">
								<input style="margin-left: 30px;" class="form-control" type="file" name="themes_bendera_kiri">
									<label  style="margin-left: 30px;" for="">file size (30 kb), image size (179 * 379 px) dan Tipe (PNG, JPG ,JEPG)  </label>

						</div>
				</div>  <hr>
	        <div class="row" style="padding: 20px;display:flex;align-items:center;">
	            <div class="col-sm-2" style="border-right: 1px solid rgb(230,230,230)">
	                <h4 style="line-height:160%;"> Bendera Kanan </h4>
	            </div>
	            <div class="col-sm-7">
	                <input style="margin-left: 30px;" class="form-control" type="file" name="themes_bendera_kanan">
										<label  style="margin-left: 30px;" for="">file size (30 kb), image size (179 * 379 px) dan Tipe (PNG, JPG ,JEPG)  </label>
	            </div>
	        </div>
        <!-- <hr>
        <div class="row" style="padding: 20px;display:flex;align-items:center;">
            <div class="col-sm-2" style="border-right: 1px solid rgb(230,230,230)">
                <h4 style="line-height:160%;"> Header Background </h4>
            </div>
            <div class="col-sm-7">
                <input style="margin-left: 30px;" class="form-control" type="file" name="themes_header_file">
									<label  style="margin-left: 30px;" for="">Ukuran 278 x 80 pixels </label>
            </div>
        </div> -->
        <hr>

        <div class="row" style="padding: 20px;display:flex;align-items:center;">
            <div class="col-sm-2" style="border-right: 1px solid rgb(230,230,230);">
                <h4 style="line-height:160%;">Content Divider</h4>
            </div>
            <div class="col-sm-7">
                <input style="margin-left: 30px;" class="form-control" type="file" name="themes_content_divider_file">
									<label  style="margin-left: 30px;" for="">file size (100 kb), image size (1600 * 328 px) dan Tipe (PNG, JPG ,JEPG)  </label>

            </div>
        </div>
        <!-- <hr>
        <div class="row" style="padding: 20px;display:flex;align-items:center;">
            <div class="col-sm-2" style="border-right: 1px solid rgb(230,230,230)">
                <h4 style="line-height:160%;"> Footer Background </h4>
            </div>
            <div class="col-sm-7">
                <input style="margin-left: 30px;" class="form-control" type="file" name="themes_footer_file">
            </div>
        </div> -->
        <hr>
        <div class="row" style="padding: 20px;display:flex;align-items:center;">
            <div class="col-sm-2" style="border-right: 1px solid rgb(230,230,230)">
                <h4 style="line-height:160%;"> Footer Left </h4>
            </div>
            <div class="col-sm-7">
                <input style="margin-left: 30px;" class="form-control" type="file" name="themes_footer_left_file">
								<label  style="margin-left: 30px;" for="">file size (40 kb), image size (224 * 235 px) dan Tipe (PNG, JPG ,JEPG)  </label>

            </div>
        </div>
        <hr>
        <div class="row" style="padding: 20px;display:flex;align-items:center;">
            <div class="col-sm-2" style="border-right: 1px solid rgb(230,230,230)">
                <h4 style="line-height:160%;"> Footer Right </h4>
            </div>
            <div class="col-sm-7">
                <input style="margin-left: 30px;" class="form-control" type="file" name="themes_footer_right_file">
									<label  style="margin-left: 30px;" for="">file size (40 kb), image size (509 * 234 px) dan Tipe (PNG, JPG ,JEPG)  </label>
            </div>
        </div>
        <hr>
				<div class="row" style="padding: 20px;display:flex;align-items:center;">

						<img style="    width: -webkit-fill-available;" src="<?php echo $this->config->item("assets_url") ?>/uploads/themes/themes1.png" alt="">
				</div>
				<hr>
				<div class="row" style="padding: 20px;display:flex;align-items:center;">

						<img style="    width: -webkit-fill-available;" src="<?php echo $this->config->item("assets_url") ?>/uploads/themes/themes2.png" alt="">
				</div>
				<hr>
				<div class="row" style="padding: 20px;display:flex;align-items:center;">

						<img style="    width: -webkit-fill-available;" src="<?php echo $this->config->item("assets_url") ?>/uploads/themes/themes3.png" alt="">
				</div>
				<hr>
				<div class="row" style="padding: 20px;display:flex;align-items:center;">

						<img style="    width: -webkit-fill-available;" src="<?php echo $this->config->item("assets_url") ?>/uploads/themes/themes4.png" alt="">
				</div>
				<hr>




    </section>
</form>
    <!-- End Main content -->
</div>
<!-- End Content Wrapper. Contains page content -->
