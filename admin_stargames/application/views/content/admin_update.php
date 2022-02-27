<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrator
        <small>Update</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>admin">Administrator</a></li>
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
		            <form role="form" action="<?php echo $this->config->item('base_url'); ?>admin/action_update" method="post">
		            <input type="hidden" name="id" value="<?php echo $admin[0]['id']; ?>">
		              <div class="box-body">
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Name</label>
		                  <input required type="text" class="form-control" id="name" placeholder="Enter name here" name="name" value="<?php echo $admin[0]['name']; ?>">
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Username</label>
		                  <input required type="text" class="form-control" id="username" placeholder="Enter username here" name="username" value="<?php echo $admin[0]['username']; ?>">
		                </div>

		          
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Role</label>
		                  	<select required class="form-control" name="role_id">
		            		<option value="1" <?php if($admin[0]['role_id'] == 1){ echo'selected'; } ?>>Administrator</option>
		            		<option value="2" <?php if($admin[0]['role_id'] == 2){ echo'selected'; } ?>>operation</option>
		            		<option value="3" <?php if($admin[0]['role_id'] == 3){ echo'selected'; } ?>>User</option>
		            		<option value="4" <?php if($admin[0]['role_id'] == 4){ echo'selected'; } ?>>Manager</option>
		            		<option value="5" <?php if($admin[0]['role_id'] == 5){ echo'selected'; } ?>>Admin Bisnis</option>
		            		</select>
		                </div>
		                <hr>
		                <?php// if($_SESSION["user_data"]["role"] == 1 && $_SESSION["user_data"]["id"] != $admin[0]["id"]){ ?> 
		                 <div class="form-group">
		                  <label for="exampleInputEmail1">Status Admin : </label>
		                  <select  name="status">
		                  	<option <?php if($admin[0]['status'] == 1){ echo "selected"; } ?> value="1">Aktif</option>
		                  	<option <?php if($admin[0]['status'] == 0){ echo "selected"; } ?> value="0">Tidak Aktif</option>
		                  </select>
		                </div>
		                <?php //} ?>
		                <hr>
		                <?php if(isset($_GET["edit-password"])){ ?>
			                <div class="form-group">
			                  <label for="exampleInputEmail1">Enter New Password</label>
			                  <input required type="password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password harus terdiri dari huruf kecil, huruf kapital, Angka dan minimal 10 karakter" class="form-control" id="password" minlength="10" placeholder="Enter password here" name="password">
			                </div>
		            	<?php }else{ ?>
			                <div class="form-group">
		            			<a href="?edit-password"> <i  class="fa fa-fw fa-key"></i> Edit Password</a>
		            		</div>
		            	<?php } ?>
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
<!-- End Content Wrapper. Contains page content -->