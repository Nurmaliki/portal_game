<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Merchant
        <small>Create</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>program">Merchant</a></li>
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
		            <!-- <form role="form" action="<?php // echo $this->config->item('base_url'); ?>merchant/action_create" method="post"> -->
		              <div class="box-body">

                                <?php if(empty($field)){ ?>
                                    <form role="form" action="<?php echo $this->config->item('base_url'); ?>merchant/do_upload" method="post" 
                                    id="merchant" enctype="multipart/form-data" >
                                <?php }else{?>
                                    <form role="form" action="<?php echo $this->config->item('base_url'); ?>merchant/action_create" method="post" 
                                     id="merchant" enctype="multipart/form-data" >
                                <?php } ?>

		              	<div class="form-group">
		                  <label for="exampleInputEmail1">Category</label>
		                  <select required class="form-control" name="category_id">
		                  	<?php
		                  	if(count($category) > 0){
		                  		for($i=0; $i<count($category); $i++){
		                  	?>
												<?php if($field['category_id'] == $category[$i]['id'] ){?>
													<option selected value="<?php echo $category[$i]['id']; ?>"><?php echo $category[$i]['name']; ?></option>
												
												<?php }else {?>
		                  		<option value="<?php echo $category[$i]['id']; ?>"><?php echo $category[$i]['name']; ?></option>
		                  	<?php
																		}
		                  		}
		                  	}
		                  	?>
		                    
		                  </select>
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Name</label>
		                  <input required type="text" class="form-control" id="program_code" placeholder="Enter name here" name="name" value="<?php echo $field['name']; ?>">
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">phone</label>
		                  <input required type="number" class="form-control" id="phone" placeholder="021889.." name="phone" value="<?php echo $field['phone']; ?>">
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Email</label>
		                  <input required type="email" class="form-control" id="email" placeholder="Enter email here" name="email" value="<?php echo $field['email']; ?>">
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Address</label>
		                  <textarea required class="form-control" rows="3" placeholder="Enter Address here" name="address"><?php echo $field['address']; ?></textarea>
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Province</label>
		                  <select required class="form-control" name="province_id">
		                  	<?php
		                  	if(count($province) > 0){
		                  		for($i=0; $i<count($province); $i++){
		                  	?>

												<?php if($field['province_id'] == $province[$i]['id'] ){?>
												
													<option selected value="<?php echo $province[$i]['id']; ?>"><?php echo $province[$i]['name']; ?></option>
												
												<?php }else{ ?>
		                  		<option value="<?php echo $province[$i]['id']; ?>"><?php echo $province[$i]['name']; ?></option>
		                  	<?php
															}
		                  		}
		                  	}
		                  	?>
		                    
		                  </select>
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Description</label>
		                  <textarea required class="form-control" rows="3" placeholder="Enter description here" name="description"><?php echo $field['description']; ?></textarea>
		                </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> image</label>
													
                            <br>
                            <textarea required readonly name="picture" id="picture" form="merchant" class="form-control" readonly><?php echo $field['picture']; ?></textarea>
                        </div>
		              </div>
		              <!-- /.box-body -->

		              <div class="box-footer">

                        <?php if(!empty($field)){ ?>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        <?php } ?>
		                <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
		              </div>
		            <!-- </form> -->
		          </div>
	        </div>
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

                <input type="file" name="userfile" form="merchant"/>
                <!-- <input type="text" name="userfile1" form="merchant"/> -->
                <br /><br />

                <input type="submit" value="upload" class="btn btn-primary"/>
                <?php //echo 'img = '.$img ;?>
                <?php if(!empty($field["picture"])){ ?>
                <img class="img-responsive pad" src="http://10.255.0.140/cms_btn/uploads/<?php echo $field['picture'];  ?>" alt="Photo">
            	<?php } ?>
                </form>
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
} );
</script>
<!-- End Content Wrapper. Contains page content -->