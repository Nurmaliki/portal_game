<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Poin Serbu Btn
        <small>Setting</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>pagecontent">Page And Content</a></li>
        <li class="active">Setting</li>
      </ol>
    </section>
    <!-- EndContent Header (Page header) -->
    <!-- Main content -->
    <section class="content" style="background: rgb(255,255,255);margin: 20px;padding: 0px;padding-left: 20px !important; padding-right: 20px !important;margin-top: 20px !important;">
      <div class="row">
        <div class="col-md-12">


                <div class="box-body" style="background-color:">

                          <!-- Alert Tentang -->
                    <?php if($this->session->flashdata('Tentangfalse')){ ;?>
                      <div style="    width: 92%;" id="alerts" class="alert alert-success" role="alert">
                          <strong><?php echo $this->session->flashdata('Tentangfalse');?></strong>
                      </div>
                    <?php }else if($this->session->flashdata('Tentangtrue')){?>
                          <div style="background: #d4edda !important;color: #155724 !important;     width: 92%;" id="alerts" class="alert alert-success" role="alert">
                              <strong><?php echo $this->session->flashdata('Tentangtrue');?></strong>
                          </div>
                    <?php } ?>


                  <form action="<?php echo $this->config->item('base_url'); ?>pagecontent/tentangUpdate/<?php print_r($get_tentang_poin_serbu_title[0]['id'])?>" method="post">

                          <div class="row" style="padding:10px;">
                              <label for="exampleInputEmail1">Title Tentang</label>
                              <input style="width:100%" name="description" id="" cols="60" rows="10" value="<?php print_r($get_tentang_poin_serbu_title[0]['description'])?>">

                          </div>
                          <div class="row" style="padding:10px;">

                              <label for="exampleInputEmail1">Sub title Tentang</label>
                              <input class="form-control" style="width:100%" name="description_2" id="" cols="60" rows="10" value="<?php print_r($get_tentang_poin_serbu_title[0]['description_2'])?>">

                          </div>
                     <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                  </form>

                </div>
            </div>
      </div>
    </section>
  <section class="content" style="background: rgb(255,255,255);margin: 20px;padding: 0px;padding-left: 20px !important; padding-right: 20px !important;margin-top: 20px !important;">
    	<div class="row">
    		  <!-- <div class="col-xs-5"> -->
	        	<div style="margin: ;" class="">
		            <!-- /.box-header -->

                  <!-- Alert LINK yutube -->
                  <?php if($this->session->flashdata('linkfalse')){ ;?>
                    <div style="    width: 92%;" id="alerts" class="alert alert-success" role="alert">
                        <strong><?php echo $this->session->flashdata('linkfalse');?></strong>
                    </div>
                  <?php }else if($this->session->flashdata('linktrue')){?>
                        <div style="background: #d4edda !important;color: #155724 !important;     width: 92%;" id="alerts" class="alert alert-success" role="alert">
                            <strong><?php echo $this->session->flashdata('linktrue');?></strong>
                        </div>
                  <?php } ?>

                  <div id="linkyoutube" class="">

                  </div>

		            <?php for ($i=0; $i < count($get_tentang_poin_serbu_link) ; $i++) { ?>
                  <div class="col-md-6">
    			            <div class="box-body">
    			            	<form action="<?php echo $this->config->item('base_url'); ?>pagecontent/tentangUpdate/<?php print_r($get_tentang_poin_serbu_link[$i]['id'])?>" method="POST">
    		                        <div class="row" style="padding:10px;">

    		                            <label for="exampleInputEmail1">Link Video Youtube <?php echo $i+1; ?></label>
                                    <p style="font-size: 8px;">Contoh : https://www.youtube.com/watch?v=<span style="color:#f4110d" >cZRDYyC_cP8i</span></p>
    		                            <input class="form-control" type=""   style="width:100%" name="url_youtube" id="" cols="60" rows="10" value="<?php print_r($get_tentang_poin_serbu_link[$i]['url_youtube']) ?>">
    		                        </div>
    		                        <div class="box-footer">
    					                <button type="submit" class="btn btn-primary">Update</button>
    					                <a class="btn btn-warning"  href="<?php echo $this->config->item('base_url'); ?>pagecontent/deleteTentang/<?php print_r($get_tentang_poin_serbu_link[$i]['id'])?>"   id="delete<?php echo $i+1; ?>" data-confirm="Are you sure you want to Delete link Youtube <?php echo $i+1; ?>?" >Delete</a>
                            </div>
    			            	</form>
    		            	</div>
                  </div>

	            	<?php } ?>
                <div class="row" >

                  <div class="col-md-6">
                    <div class="box-body" >
                      <form action="<?php echo $this->config->item('base_url'); ?>pagecontent/addTentanglink" method="post">
                          <div class="row" style="padding:10px;">


                                <label for="exampleInputEmail1">Input Link Youtube</label>
                                <p style="font-size: 8px;">Contoh : https://www.youtube.com/watch?v=<span style="color:#f4110d" >cZRDYyC_cP8i</span></p>

                              <input class="form-control" type=""   style="width:100%" name="url_youtube" id="" cols="60" rows="10" value="">
                          </div>
                          <div class="box-footer" >
                            <button type="submit" class="btn btn-primary">Save</button>
                          </div>
                      </form>
                    </div>
                  </div>

                </div>
	        </div>

	    </div>
    </section>


    <section class="content" style="background: rgb(255,255,255);margin: 20px;padding: 0px;padding-left: 20px !important; padding-right: 20px !important;margin-top: 20px !important;">
        <div class="row" id="mekanisme">
        <center><h3>Mekanisme</h3></center>
        <!-- Alert Tentang -->
        <?php if($this->session->flashdata('mekanismefalse')){ ;?>
          <div style="    width: 92%;" id="alerts" class="alert alert-success" role="alert">
              <strong><?php echo $this->session->flashdata('mekanismefalse');?></strong>
          </div>
        <?php }else if($this->session->flashdata('mekanismetrue')){?>
              <div style="background: #d4edda !important;color: #155724 !important;     width: 92%;" id="alerts" class="alert alert-success" role="alert">
                  <strong><?php echo $this->session->flashdata('mekanismetrue');?></strong>
              </div>
        <?php } ?>

        <?php for ($i=0; $i < count($tentang_mekanisme) ; $i++) {  ?>
              <div class="col-md-6">

                                  <img style="margin-left: 41%;" width="100" height="100" class="img-respons img-thumbnail" src="<?php echo $this->config->item('assets_url'); ?>/uploads/mekanisme/<?php echo $tentang_mekanisme[$i]['img'] ?>">
                                  <div class="box-body">
                                    <form action="<?php echo $this->config->item('base_url'); ?>pagecontent/updateMekanisme/<?php echo $tentang_mekanisme[$i]['id'] ?>" method="post" enctype="multipart/form-data">


                                            <label for="exampleInputEmail1">Langkah <?php echo $i+1; ?></label>
                                            <div class="row" style="padding:10px;">

                                                <label for="exampleInputEmail1">Title </label>
                                               <input class="form-control" style="width:100%" name="title" id="" cols="25" rows="10" value="<?php echo $tentang_mekanisme[$i]['title'] ?>">
                                                 <label for="exampleInputEmail1">Sub Title</label>
                                                <input class="form-control" style="width:100%" name="sub_title" id="" cols="25" rows="10" value="<?php echo $tentang_mekanisme[$i]['sub_title'] ?>">
                                                  <div class="form-group">
                                                  <label for="exampleInputEmail1">Img</label>
                                                  <input class="form-control"  type="file" size="20" name="userfiles" accept="image/x-png,image/gif,image/jpeg">
                                                  <label style="font-weight: 70px!important;    font-size: x-small;" for="exampleInputEmail1">file size (300 kb), image size (467 px * 406 px) dan Tipe (PNG, JPG ,JEPG)</label>

                                                </div>
                                            </div>

                                            <div class="box-footer" >
                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <a class="btn btn-warning" data-confirm="Are you sure you want to Delete this data?" href="<?php echo $this->config->item('base_url'); ?>pagecontent/deleteTentangMekanisme/<?php print_r($tentang_mekanisme[$i]['id'])?>">Delete</a>
                                      </div>

                                         </form>
                                    </div>
              </div>


	    <?php } ?>

          <div class="col-md-6">
            <div class="box-body" style="margin-bottom:20%;">
                  <form action="<?php echo $this->config->item('base_url'); ?>pagecontent/addTentangMekanisme" method="post" enctype="multipart/form-data" id="inputSponsor">
                    <label for="exampleInputEmail1">Insert Langkah</label>
                    <div class="row" style="padding:10px;">

                       <label for="exampleInputEmail1">title </label>
                       <input class="form-control" style="width:100%" name="title" id="" cols="25" rows="10" value="">
                         <label for="exampleInputEmail1">Sub title</label>
                        <input class="form-control" style="width:100%" name="sub_title" id="" cols="25" rows="10" value="">
                       <div class="form-group">
                          <label for="exampleInputEmail1">Img</label>
                          <input class="form-control"  type="file" size="20" name="userfile" form="inputSponsor" accept="image/x-png,image/gif,image/jpeg">
                          <label style="font-weight: 70px!important;    font-size: x-small;" for="exampleInputEmail1">file size (100 kb),image size (111 px * 108 px) dan Tipe (PNG, JPG ,JEPG)</label>

                      </div>
                    </div>

                  <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>

                   </form>

            </div>
          </div>


	    </div>

	</section>

	<section id="perhitunganPoin"  style="background: rgb(255,255,255);margin: 20px;padding: 0px;padding-left: 20px !important; padding-right: 20px !important;margin-top: 20px !important;">
		<div style=" margin: 27px; background-color: #fff;" class="container ">

			   <center><h3>Perhitungan Poin</h3></center>
        <center>
		  <ul class="nav nav-tabs align-content-xl-center">
		    <li class="active"><a data-toggle="tab" href="#home">Akusisi dan Maintain Saldo</a></li>
		    <li><a data-toggle="tab" href="#menu1">Transaksional</a></li>
		</ul>
		</center>

    <!-- Alert Tentang -->
    <?php if($this->session->flashdata('perhitunganPoinFalse')){ ;?>
      <div style="    width: 92%;" id="alerts" class="alert alert-success" role="alert">
          <strong><?php echo $this->session->flashdata('perhitunganPoinFalse');?></strong>
      </div>
    <?php }else if($this->session->flashdata('perhitunganPoinTrue')){?>
          <div style="background: #d4edda !important;color: #155724 !important;     width: 92%;" id="alerts" class="alert alert-success" role="alert">
              <strong><?php echo $this->session->flashdata('perhitunganPoinTrue');?></strong>
          </div>
    <?php } ?>

		  <div style="margin-bottom : 56%; background-color:red;" class="tab-content">
		    <div id="home" class="tab-pane fade in active">

		    	<div class="col-xs-9">
			        	<div class="box" style="border-top: 3px solid #fff;">
				            <!-- /.box-header -->

				            <div class="box-body">
				            	<form action="<?php echo $this->config->item('base_url'); ?>pagecontent/updateGetDescription/<?php echo $get_description_akuisisi[0]["id"] ?>" method="post">
					            <label for="exampleInputEmail1"> Deskripsi Akusisi dan Maintain Saldo </label>
			                    <div class="row" style="padding:10px;">

			                      	<!-- <label for="exampleInputEmail1">Deskripsi</label> -->
			                       <input class="form-control" style="width:100%" name="description" id="" cols="25" rows="10" value="<?php echo $get_description_akuisisi[0]["description"] ?>">

			                    </div>
			                    <div class="box-footer" >
				                	<button type="submit" class="btn btn-primary">Update</button>

				              	</div>
				              	</form>
		              	  	</div>
				        </div>
			     </div>
		    	<?php for ($i=0; $i < count($tentang_perhitungan_poin_akuisisi) ; $i++) {  ?>
		      	<div class="col-xs-5">
	        	<!-- <div class="box"> -->
		            <!-- /.box-header -->

		            <!-- <div class="box-body"> -->
		            	<form action="<?php echo $this->config->item('base_url'); ?>pagecontent/updateTentangPerhitungan/<?php print_r($tentang_perhitungan_poin_akuisisi[$i]['id'])?>" method="post">
			            <label for="exampleInputEmail1"><?php echo $i+1; ?></label>
	                    <div class="row" style="padding:10px;">

	                      	<label for="exampleInputEmail1">Poin</label>
	                       <input class="form-control" style="width:100%" name="poin" id="" cols="25" rows="10" value="<?php echo($tentang_perhitungan_poin_akuisisi[$i]['poin']) ?>">
	                        <label for="exampleInputEmail1">description</label>
	                        <input class="form-control"  style="width:100%" name="description" id="" cols="25" rows="10" value="<?php echo($tentang_perhitungan_poin_akuisisi[$i]['description']) ?>">
	                    </div>
	                    <div class="box-footer" >
		                	<button type="submit" class="btn btn-primary">Update</button>
		                	<a class="btn btn-warning" data-confirm="Are you sure you want to Delete this data?"  href="<?php echo $this->config->item('base_url'); ?>pagecontent/deleteTentangPerhitungan/<?php print_r($tentang_perhitungan_poin_akuisisi[$i]['id'])?>">Delete</a>
		              	</div>
		              	</form>
              	  	<!-- </div> -->
		            <!-- /.box-body -->
		        <!-- </div> -->
	        </div>
	        <?php } ?>


	        <div class="col-xs-5">
	        	<div class="box" style=" border-top: 3px solid #fff;">
		            <!-- /.box-header -->

		            <!-- <div class="box-body" > -->
		            	<form action="<?php echo $this->config->item('base_url'); ?>pagecontent/addTentangPerhitungan" method="post">

			            <label for="exampleInputEmail1">Insert Perhitungan Poin</label>
	                    <div class="row" style="padding:10px;">

	                      	<label for="exampleInputEmail1">Poin</label>
	                       <input class="form-control" style="width:100%" name="poin" id="" cols="25" rows="10" value="">
	                        <label for="exampleInputEmail1">description</label>
	                        <input class="form-control"  style="width:100%" name="description" id="" cols="25" rows="10" value="">
	                        <input type="hidden" class="form-control"  style="width:100%" name="type" id="" cols="25" rows="10" value="1">
	                    </div>
	                    <div class="box-footer">
		                	<button type="submit" class="btn btn-primary">Save</button>
		              	</div>

		            	</form>
              	  	<!-- </div> -->
		            <!-- /.box-body -->
		        </div>
	        </div>


		    </div>
		    <div id="menu1" class="tab-pane fade">
		    	<div class="col-xs-9">
			        	<!-- <div class="box" style=" border-top: 3px solid #fff;" > -->
				            <!-- /.box-header -->


				            	<form action="<?php echo $this->config->item('base_url'); ?>pagecontent/updateGetDescription/<?php echo $get_description_transaksional[0]["id"] ?>" method="post">
					            <label for="exampleInputEmail1"> Deskripsi Transaksional</label>
			                    <div class="row" style="padding:10px;">

			                      	<!-- <label for="exampleInputEmail1">Deskripsi</label> -->
			                       <input class="form-control" style="width:100%" name="description" id="" cols="25" rows="10" value="<?php echo $get_description_transaksional[0]["description"] ?>">

			                    </div>
			                    <div class="box-footer"  >
				                	<button type="submit" class="btn btn-primary">Update</button>

				              	</div>
				              	</form>
				        <!-- </div> -->
			     </div>

		    	<?php for ($i=0; $i < count($tentang_perhitungan_poin_transaksional) ; $i++) {  ?>
			      <div class="col-xs-5">

		            	<form action="<?php echo $this->config->item('base_url'); ?>pagecontent/updateTentangPerhitungan/<?php print_r($tentang_perhitungan_poin_transaksional[$i]['id'])?>" method="post">
			            <label for="exampleInputEmail1"><?php echo $i+1; ?></label>
	                    <div class="row" style="padding:10px;">

	                      	<label for="exampleInputEmail1">Poin</label>
	                       <input class="form-control" style="width:100%" name="poin" id="" cols="25" rows="10" value="<?php echo($tentang_perhitungan_poin_transaksional[$i]['poin']) ?>">
	                        <label for="exampleInputEmail1">description</label>
	                        <input  class="form-control"  style="width:100%" name="description" id="" cols="25" rows="10" value="<?php echo($tentang_perhitungan_poin_transaksional[$i]['description']) ?>">
	                    </div>
	                    <div class="box-footer">
		                	<button type="submit" class="btn btn-primary">Update</button>
		                	<a class="btn btn-warning" data-confirm="Are you sure you want to Delete this data?"  href="<?php echo $this->config->item('base_url'); ?>pagecontent/deleteTentangPerhitungan/<?php print_r($tentang_perhitungan_poin_transaksional[$i]['id'])?>">Delete</a>
		              	</div>
		              	</form>

	        </div>
	    	<?php } ?>
	        <div class="col-xs-5" style="background-color:aliceblue; margin-buttom:20px;">
	        	<!-- <div class="box"> -->

		            <!-- <div class="box-body" > -->
		            	<form action="<?php echo $this->config->item('base_url'); ?>pagecontent/addTentangPerhitungan" method="post">

			            <label for="exampleInputEmail1">Insert Perhitungan Poin</label>
	                    <div class="row" style="padding:10px;">

	                      	<label for="exampleInputEmail1">Poin</label>
	                       <input class="form-control" style="width:100%" name="poin" id="" cols="25" rows="10" value="">
	                        <label for="exampleInputEmail1">description</label>
	                        <input class="form-control"  style="width:100%" name="description" id="" cols="25" rows="10" value="">
	                        <input type="hidden" class="form-control"  style="width:100%" name="type" id="" cols="25" rows="10" value="2">
	                    </div>
	                    <div class="box-footer">
		                	<button type="submit" class="btn btn-primary">Save</button>
		              	</div>

		            	</form>
              	  	<!-- </div> -->
		        <!-- </div> -->
	        </div>
		    </div>

		  </div>
		</div>

	</section>







	<section id="cek_jumlah_poinid"  style="background: rgb(255,255,255);margin: 20px;padding: 0px;padding-left: 20px !important; padding-right: 20px !important;margin-top: 20px !important;">
		<div style=" margin: 27px; background-color: #fff; "  class="container ">


			   <center><h3>Cek Jumlah Poin</h3></center>

         <!-- Alert Tentang -->
         <?php if($this->session->flashdata('cek_jumlah_poinfalse')){ ;?>
           <div style="width: 61%;" id="alerts" class="alert alert-success" role="alert">
               <strong><?php echo $this->session->flashdata('cek_jumlah_poinfalse');?></strong>
           </div>
         <?php }else if($this->session->flashdata('cek_jumlah_pointrue')){?>
               <div style="background: #d4edda !important;color: #155724 !important;   width: 61%;" id="alerts" class="alert alert-success" role="alert">
                   <strong><?php echo $this->session->flashdata('cek_jumlah_pointrue');?></strong>
               </div>
         <?php } ?>

			<div class="row" style="margin-bottom: 10%;">
				<div class="col-xs-10">
			        	<!-- <div class="box" > -->
				            <!-- /.box-header -->

				            <div class="box-body">
				            	<form action="<?php echo $this->config->item('base_url'); ?>pagecontent/update_cek_jumlah_poin/<?php echo $get_des_cek_jumlah_poin[0]["id"] ?>" method="post">
					            <label for="exampleInputEmail1"> Deskripsi Cek Jumlah Poin</label>
			                    <div class="row" style="padding:10px;">

			                      	<!-- <label for="exampleInputEmail1">Deskripsi</label> -->
			                       <input class="form-control" style="width:100%" name="description" id="" cols="25" rows="10" value="<?php echo $get_des_cek_jumlah_poin[0]["description"] ?>">

			                    </div>
			                    <div class="box-footer"  >
				                	<button type="submit" class="btn btn-primary">Update</button>

				              	</div>
				              	</form>
		              	  	</div>
				        <!-- </div> -->
			     </div>
				<?php for ($i=0; $i < count($tentang_cek_jumlah_poin); $i++) { ?>

							<div class="col-xs-5">
					        	<!-- <div class="box"> -->
						            <!-- /.box-header -->

						            <img style=" margin-left: 36%;" width="100" height="100" class="img-respons img-thumbnail" src="<?php echo $this->config->item('assets_url'); ?>/uploads/cek_jumlah_poin/<?php echo $tentang_cek_jumlah_poin[$i]['img'] ?>">


						            <!-- <div class="box-body"> -->
						            	<form action="<?php echo $this->config->item('base_url'); ?>pagecontent/updateCekJumlahPoin/<?php print_r($tentang_cek_jumlah_poin[$i]['id'])?>" method="post"  enctype="multipart/form-data" id="inputSponsorxx<?php print_r($tentang_cek_jumlah_poin[$i]['id'])?>">

					                        <div class="row" style="padding:10px;">
					                            <label for="exampleInputEmail1">Title cek jumlah poin</label>
					                            <input style="width:100%" name="title" id="" cols="60" rows="10" value="<?php echo $tentang_cek_jumlah_poin[$i]['title']; ?>">

					                        </div>
					                        <!-- <div class="row" style="padding:10px;">

					                            <label for="exampleInputEmail1">Sub title cek jumlah poin</label>
					                            <input class="form-control" style="width:100%" name="sub_title" id="" cols="60" rows="10" value="<?php echo $tentang_cek_jumlah_poin[$i]['sub_title']; ?>">

					                        </div> -->
					                         <div class="form-group">
					                            <label for="exampleInputEmail1">Img</label>
					                            <input class="form-control" type="file" size="20" name="userfile" form="inputSponsorxx<?php print_r($tentang_cek_jumlah_poin[$i]['id'])?>">
                                      <label style="font-weight: 70!important;    font-size: x-small;" for="exampleInputEmail1">file size (100 kb),image size (111 px * 108 px) dan Tipe (PNG, JPG ,JEPG)</label>

                                  </div>
						            	   <div class="box-footer">
							                	<button type="submit" class="btn btn-primary">Update</button>
							                	<a class="btn btn-warning" data-confirm="Are you sure you want to Delete this data?"  href="<?php echo $this->config->item('base_url'); ?>pagecontent/deleteCekJumlahpoin/<?php print_r($tentang_cek_jumlah_poin[$i]['id'])?>">Delete</a>
							              </div>
						            	</form>


						            <!-- </div> -->
						            <!-- /.box-body -->
						        <!-- </div> -->
					        </div>
				<?php } ?>
				<div class="col-xs-5">
	        	<!-- <div class="box"> -->
		            <!-- /.box-header -->
		            <!-- <div class="box-body"> -->
		            	<form action="<?php echo $this->config->item('base_url'); ?>pagecontent/addCekJumlahPoin" method="post"  enctype="multipart/form-data" id="inputSponsorxx">

	                        <div class="row" style="padding:10px;">
	                            <label for="exampleInputEmail1">Title cek jumlah poin</label>
	                            <input style="width:100%" name="title" id="" cols="60" rows="10" value="">

	                        </div>
	                        <!-- <div class="row" style="padding:10px;">

	                            <label for="exampleInputEmail1">Sub title cek jumlah poin</label>
	                            <input class="form-control" style="width:100%" name="sub_title" id="" cols="60" rows="10" value="">

	                        </div> -->
	                         <div class="form-group">
	                            <label for="exampleInputEmail1">Img</label>
	                            <input class="form-control" accept="image/x-png,image/gif,image/jpeg"  type="file" size="20" name="userfile" form="inputSponsorxx">
                              <label style="font-weight: 70px!important;    font-size: x-small;" for="exampleInputEmail1">file size (100 kb), image size (111 px * 108 px) dan Tipe (PNG, JPG ,JEPG)</label>

	                        </div>
		            	   <div class="box-footer">
			                	<button type="submit" class="btn btn-primary">Save</button>
			              </div>
		            	</form>


		            <!-- </div> -->
		            <!-- /.box-body -->
		        <!-- </div> -->
	        </div>

		</div>




		</div>



	</section>
    <!-- End Main content -->
</div>

<script type="text/javascript">

$(document).on('click', ':not(form)[data-confirm]', function(e){
        if(!confirm($(this).data('confirm'))){
            e.stopImmediatePropagation();
            e.preventDefault();
        }
});

</script>
