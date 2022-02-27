<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Branch
        <small>Create</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>branch">Branch</a></li>
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
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            
                        </div>
		            </div>
		            <?php if($this->session->flashdata('msgalert')){ ;?>
					<div class="alert alert-success" role="alert">
					<strong><?php echo $this->session->flashdata('msgalert');?></strong>
					</div>
					<?php } ;?>
		            <!-- /.box-header -->
                        <!-- form start -->
                        
                            <div class="box-body" style="">
                                    <form role="form" action="<?php echo $this->config->item('base_url'); ?>branch/action_create" method="post" 
                                     id="branch" enctype="multipart/form-data" >
                                
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Branch</label>
                                        <input maxlength="100" required type="text" class="form-control" id="name" placeholder="Enter name here" name="name">
                                    
                                    </div>
                                    <br>

                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Kode Prefix Rekening</label>
                                    <input  maxlength="160" required type="number" class="form-control" id="sub_title" placeholder="Enter Sub title here" name="prefix_number">
                   
                                    </div>
                                    
                                    <div >
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        <!-- /.box-body -->
                    
		          </div>
	        </div>
        </div>

	</section>

    <!-- End Main content -->
</div>
<!-- End Content Wrapper. Contains page content -->