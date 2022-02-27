<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Merchant
        <small>Update</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>member">Program</a></li>
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
                    <form role="form" action="<?php echo $this->config->item('base_url'); ?>merchant/do_upload_update" method="post" enctype="multipart/form-data">
		            <input required type="hidden" id="id" name="id" value="<?php echo $merchant[0]['id']; ?>">

		            <!-- <form role="form" action="<?php // echo $this->config->item('base_url'); ?>merchant/action_update" method="post">
		            <input type="hidden" id="id" name="id" value="<?php // echo $merchant[0]['id']; ?>"> -->
		              <div class="box-body">
		              	<div class="form-group">
		                  <label for="exampleInputEmail1">Category</label>
		                  <select required class="form-control" name="category_id">
		                  	<?php
		                  	if(count($category) > 0){
		                  		for($i=0; $i<count($category); $i++){
		                  			if($category[$i]['id'] == $merchant[0]['category_id']){
		                  	?>
		                  	<option value="<?php echo $category[$i]['id']; ?>" selected><?php echo $category[$i]['name']; ?></option>
		                  	<?php			
		                  			}else{
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
		                  <label for="exampleInputEmail1">Name</label>
		                  <input required type="text" class="form-control" id="name" placeholder="Enter Name here" name="name" value="<?php echo $merchant[0]['name']; ?>">
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">phone</label>
		                  <input required type="number" class="form-control" id="phone" placeholder="021889.." name="phone" value="<?php echo $merchant[0]['phone']; ?>">
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Email</label>
		                  <input required type="email" class="form-control" id="email" placeholder="Enter email here" name="email" value="<?php echo $merchant[0]['email']; ?>">
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Address</label>
		                  <textarea required class="form-control" rows="3" placeholder="Enter Address here" name="address"><?php echo $merchant[0]['address']; ?></textarea>
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Province</label>
		                  <select required class="form-control" name="province_id">
		                  	<?php
		                  	if(count($province) > 0){
		                  		for($i=0; $i<count($province); $i++){
		                  	?>
		                  		<option value="<?php echo $province[$i]['id']; ?>" <?php if($province[$i]['id'] == $merchant[0]['province_id']){ echo'selected'; } ?>><?php echo $province[$i]['name']; ?></option>
		                  	<?php

		                  		}
		                  	}
		                  	?>
		                    
		                  </select>
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Description</label>
		                  <textarea required class="form-control" rows="3" placeholder="Enter description here" name="description"><?php echo $merchant[0]['description']; ?></textarea>
		                </div>

                        <div class="form-group"> 
                            <label for="exampleInputEmail1"> image</label>
													
                            <?php // print_r($this->session->flashdata()); ?>
                            <?php // print_r($_SESSION['path']); ?>
                            <?php //print_r($path); ?>
                            <br>
                                <?php if (empty($_SESSION['path'])){ ?>
                                    <textarea name="picture" id="picture" class="form-control" readonly ><?php echo $merchant[0]['image']; ?></textarea>
                                <?php }else{ ?>
                                    <textarea name="picture" id="picture" class="form-control" readonly><?php echo $field['image']; ?></textarea>
                                <?php }?>
                        </div>
		              </div>
		              <!-- /.box-body -->




	                              <div class="box" >
											<div class="box-header with-border">
													<h3 class="box-title">Upload image</h3>
													<div class="box-tools pull-right">
															<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
															</button>
															
													</div>
											</div>
											<div class="box-body" style="">
													<?php //echo form_open_multipart('news_content/do_upload');?>

													<input type="file" name="userfile" size="20" />

													<br /><br />
													<input type="hidden" id="upload" name="upload" value="" class="upload">
													<button type="submit" value="upload" class="btn btn-primary">Upload</button>
													<?php //echo 'img = '.$img ;?>
													<?php if (empty($_SESSION['path'])){ ?>
                                                            <?php if (empty($merchant[0]['image'])){ ?>
                                                                <img src="a.gif" style="display: none;" >
                                                            <?php }else{?>
														        <img class="img-responsive pad" src="<?php echo $this->config->item('assets_url').'uploads/'. $merchant[0]['image']; ?>" alt="Photos">

                                                            <?php }?>
													<?php }else{ ?>

                                                  
														<img class="img-responsive pad" src="http://10.255.0.140/cms_btn/uploads/<?php echo $field['image']; ?>" alt="Photob">
														<!-- <textarea name="picture" id="picture" class="form-control" ><?php //echo $field['picture']; ?></textarea> -->
													<?php }?>
													

													<!-- </form> -->
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
    

	$("button").click(function() {
    var fired_button = $(this).val();
    
		document.getElementById("upload").value = fired_button;
		$(".formData").val(fired_button)
		//alert(fired_button);
		
	});
} );
</script>
<!-- End Content Wrapper. Contains page content -->