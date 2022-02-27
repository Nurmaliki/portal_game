<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        News Content
        <small>Detail News</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>news_content">News Content</a></li>
        <li class="active">detail</li>
      </ol>
    </section>
    <!-- EndContent Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    	<div class="row">
	        <div class="col-xs-12">
	        	<div class="box box-primary">
		            <div class="box-header with-border">
		              <h3 class="box-title">Detail news</h3>
		            </div>
		            <?php if($this->session->flashdata('msgalert')){ ;?>
					<div class="alert alert-success" role="alert">
					<strong><?php echo $this->session->flashdata('msgalert');?></strong>
					</div>
					<?php } ;?>
		            <!-- /.box-header -->
								<!-- form start -->
								<?php //if($field['picture']!= $content[0]['picture']){ ?>
										<!-- <form role="form" action="<?php echo $this->config->item('base_url'); ?>news_content/do_upload" method="post" 
										id="news_content" enctype="multipart/form-data" > -->
								<?php //}else{?>
									<!-- <form role="form" action="<?php echo $this->config->item('base_url'); ?>news_content/action_update" method="post"> -->
								<?php // } ?>
								<form role="form" action="<?php echo $this->config->item('base_url'); ?>news_content/do_upload_update" method="post" enctype="multipart/form-data">
		            <input type="hidden" id="id" name="id" value="<?php echo $content[0]['id']; ?>">
		              <div class="box-body">
		              	<div class="form-group">
		                  <label for="exampleInputEmail1">Category name</label>
		                  <select class="form-control" name="category_id" readonly>
		                  	<?php
		                  	if(count($category) > 0){
		                  		for($i=0; $i<count($category); $i++){
		                  			if($category[$i]['id'] == $content[0]['category_id']){
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
		                  <label for="exampleInputEmail1">title</label>
		                  <input readonly type="text" class="form-control" id="name" placeholder="Enter Name here" name="name" value="<?php echo $content[0]['title']; ?>">
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Body</label>
		                  <input readonly type="textarea" class="form-control" id="body" placeholder="your story" name="body" value="<?php echo $content[0]['body']; ?>">
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Status</label>
		                  <input readonly type="text" class="form-control" id="status" placeholder="publih / un publish" name="status" value="<?php echo $content[0]['status']; ?>">
		                </div>
                    <div class="form-group">
		                  <label for="exampleInputEmail1">Publish by</label>
		                  <input readonly type="text" class="form-control" id="status" placeholder="publih / un publish" name="status" value="<?php echo $content[0]['publish_by']; ?>">
										</div>
										<div class="form-group"> 
											<label for="exampleInputEmail1"> image</label>
											<br>
												<?php if (empty($field['picture'])){ ?>
													<textarea readonly name="picture" id="picture" class="form-control" ><?php echo $content[0]['picture']; ?></textarea>
												<?php }else{ ?>
													<textarea readonly name="picture" id="picture" class="form-control" ><?php echo $field['picture']; ?></textarea>
												<?php }?>
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Video link</label>
											<input readonly type="text" class="form-control" id="video" placeholder="Enter name here" name="video" value="<?php echo $content[0]['video']; ?>">
										
										</div>
		                <?php //print_r($content[0]); ?>
		                
									</div>
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
													<!-- <button type="submit" value="upload" class="btn btn-primary">Upload</button> -->
													<?php //echo 'img = '.$img ;?>
													<?php if (empty($field['picture'])){ ?>
														<img class="img-responsive pad" src="<?php echo $this->config->item('assets_url').'uploads/'. $content[0]['picture']; ?>" alt="Photo">
													<?php }else{ ?>
														<img class="img-responsive pad" src="<?php echo $this->config->item('assets_url').'uploads/' ?>/uploads/<?php echo $field['picture']; ?>" alt="Photo">
														<!-- <textarea name="picture" id="picture" class="form-control" ><?php //echo $field['picture']; ?></textarea> -->
													<?php }?>
													

													<!-- </form> -->
											</div> 
									</div>
									<!-- /.box-body -->
									

		              <div class="box-footer">
										
		                <!-- <button type="submit" class="btn btn-primary" value="update">Submit</button> -->
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
