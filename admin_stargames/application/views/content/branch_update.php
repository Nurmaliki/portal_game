<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        News Content
        <small>Update News</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>news_content">News Content</a></li>
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
		              <div class="box-body">

                                    <form role="form" action="<?php echo $this->config->item('base_url'); ?>branch/action_update/<?php echo $data[0]['id']; ?>" method="post" 
                                     id="branch" enctype="multipart/form-data" >
							
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama Branch</label>
                                        <input maxlength="100" required type="text" class="form-control" id="name" placeholder="Enter name here" name="name" value="<?php echo $data[0]['name']; ?>">
                                    
                                    </div>
                                    <br>

                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Kode Prefix Rekening</label>
                                    <input  maxlength="160" required type="number" class="form-control" id="sub_title" placeholder="Enter Sub title here" name="prefix_number" value="<?php echo $data[0]['prefix_number']; ?>">
                   
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
