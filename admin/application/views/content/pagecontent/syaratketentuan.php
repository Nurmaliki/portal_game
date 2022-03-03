


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->

  <!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>tinymce.init({selector:'textarea'});</script> -->
    <section class="content-header">
      <h1>
        Syarat & Ketentuan
        <small>Setting</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>pagecontent">Page And Content</a></li>
        <li class="active">Setting</li>
      </ol>
    </section>
    <!-- EndContent Header (Page header) -->

    <section class="content">
    	<div class="row">
	        <div class="col-xs-12">
	        	<div class="box box-primary">

		      <?php if($this->session->flashdata('msgalert')){ ;?>
					<div id="alert" class="alert alert-info" role="alert">
					       <strong><?php echo $this->session->flashdata('msgalert');?></strong>
					</div>
        <?php }elseif ($this->session->flashdata('alertwarning')) {?>


        <div id="alert"  class="alert alert-success" role="alert">
               <strong><?php echo $this->session->flashdata('alertwarning');?></strong>
        </div>
      <?php }else{}?>
		            <!-- /.box-header -->
                         <!-- form start -->
		            <form style ="background-color: #87dea2;" role="form" action="<?php echo $this->config->item('base_url'); ?>pagecontent/updateDescriptionSyarat/<?php echo $desc[0]["id"]?>" method="post">
		              <div class="box-body">
                        <h1>Insert</h1>
                        <div class="form-group">
		                  <label for="exampleInputEmail1">Description</label>
		                   <textarea class="editor" style="width:100%" name="description" id="" cols="100" rows="10"><?php echo $desc[0]["description"] ?></textarea>

		                </div>


		              </div>
		              <!-- /.box-body -->

		              <div class="box-footer">
		                <button type="submit" class="btn btn-primary">Update</button>
		              </div>
		            </form>
                    <!-- form End -->




                    <?php
                    // print_r($data);
                    if(empty($data)){

                    }else{
                    for ($i = 0 ; $i < count($data);$i++ ){
                    ?>
		            <!-- form start -->


                        <form id="<?php print_r($data[$i]["id"]); ?>"  role="form" action="<?php echo $this->config->item('base_url'); ?>pagecontent/actionUpdateSyaratKetentuan/<?php echo $data[$i]["id"]?>" method="post">
                            <div class="box-body">
                            <h1><?php print_r($i+1)?></h1>
                            <!-- <?php if($this->session->flashdata('msgalert'.$data[$i]["id"])){ ;?>
                               <div  class="alert alert-info" role="alert">
                                      <strong><?php echo $this->session->flashdata('msgalert'.$data[$i]["id"]);?></strong>
                               </div>
                             <?php }elseif ($this->session->flashdata('alertwarning'.$data[$i]["id"])) {?>


                              <div   class="alert alert-success" role="alert">
                                     <strong><?php echo $this->session->flashdata('alertwarning'.$data[$i]["id"]);?></strong>
                              </div>
                            <?php }else{}?>

                             -->
                                <div class="form-group">
                                <label for="exampleInputEmail1">Syarat</label>
                                <input required type="text" class="form-control" id="fullname" placeholder="" value = "<?php print_r($data[$i]["syarat"]); ?>"name="syarat">
                                </div>

                                <div class="form-group">
                                <label for="exampleInputEmail1">Ketentuan</label>
                                <textarea class="editor" style="width:100%" name="ketentuan" id="" cols="100" rows="10"><?php echo $data[$i]["ketentuan"] ?></textarea>

                                </div>


                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">update</button>
                                <a class="btn btn-warning"  data-confirm="Are you sure you want to Delete <?php  print_r($data[$i]["syarat"]); ?> ?"  href="<?php echo $this->config->item('base_url'); ?>pagecontent/deleteSyaratKetentuan/<?php echo $data[$i]["id"]?>">Delete</a>
                                <!-- <button type="submit" class="btn btn-primary">update</button> -->
                            </div>
                        </form>
                            <!-- form End -->


                    <?php
                    }
                    }
                    ?>

		            <!-- form start -->
		            <form style ="background-color: burlywood;" role="form" action="<?php echo $this->config->item('base_url'); ?>pagecontent/actionCreateSyaratKetentuan" method="post">
		              <div class="box-body">
                        <h1>Insert</h1>
                        <div class="form-group">
		                  <label for="exampleInputEmail1">Syarat</label>
		                  <input required type="text" class="form-control" id="fullname" placeholder="" name="syarat">
		                </div>

		                <div class="form-group">
		                  <label for="exampleInputEmail1">Ketentuan</label>
		                   <textarea class="editor" style="width:100%" name="ketentuan" id="" cols="100" rows="10"></textarea>

		                </div>


		              </div>
		              <!-- /.box-body -->

		              <div class="box-footer">
		                <button type="submit" class="btn btn-primary">Submit</button>
		              </div>
		            </form>
                    <!-- form End -->
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
        "ajax": "<?php echo $this->config->item('base_url'); ?>admin/datatables",
		"type": "GET"
    } );
} ); 
$(document).on('click', ':not(form)[data-confirm]', function(e){
        if(!confirm($(this).data('confirm'))){
            e.stopImmediatePropagation();
            e.preventDefault();
        }
    });
</script>
<!-- End Content Wrapper. Contains page content -->
