<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Program
        <small>Create</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>program">program</a></li>
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

								<?php //print_r($_SESSION['filed']);?>
		            <form role="form" action="<?php echo $this->config->item('base_url'); ?>program/action_create" method="post" enctype="multipart/form-data">
		              <div class="box-body">
		              	<div class="form-group">
		                  <label for="exampleInputEmail1">Category</label>
		                  <select required class="form-control" name="category_id">
		                  	<?php
		                  	if(count($category) > 0){
		                  		for($i=0; $i<count($category); $i++){
		                  	?>
													<?php if($_SESSION['filed']['category_id'] == $category[$i]['id'] ){?>
		                  		<option value="<?php echo $category[$i]['id']; ?>" selected><?php echo $category[$i]['name']; ?></option>
													<?php }else{?>

														<option value="<?php echo $category[$i]['id']; ?>"><?php echo $category[$i]['name']; ?></option>
		                  	<?php
													}
		                  		}
		                  	}
		                  	?>

		                  </select>
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Code Program</label>
		                  <input required type="text" class="form-control" id="program_code" placeholder="Enter code program here" name="program_code" value="<?php echo $_SESSION['filed']['program_code']?>">
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Name Program</label>
		                  <input required type="text" class="form-control" id="program_name" placeholder="Enter name program here" name="program_name" value="<?php echo $_SESSION['filed']['program_name']?>">
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">phone</label>
		                  <input required type="number" class="form-control" id="phone" placeholder="021889.." name="phone" value="<?php echo $_SESSION['filed']['phone']?>">
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Email</label>
		                  <input required type="email" class="form-control" id="email" placeholder="Enter email here" name="email" value="<?php echo $_SESSION['filed']['email']?>">
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Address</label>
		                  <!-- <textarea required class="form-control" rows="3" placeholder="Enter Address here" name="address"><?php echo $_SESSION['filed']['address']?></textarea> -->
                      <input required type="text" class="form-control" id="address" placeholder="Enter address here" name="address" value="<?php echo $_SESSION['filed']['address']?>">

		                </div>
                    <div class="form-group">
                     <label for="exampleInputEmail1">Image</label>
                      <input required type="file" class="form-control" id="address"  name="iconProgram" >

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
} );
</script>
<!-- End Content Wrapper. Contains page content -->
