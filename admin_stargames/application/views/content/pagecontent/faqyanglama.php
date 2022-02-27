

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Faq
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
					<div id="alert" class="alert alert-success" role="alert">
					<strong><?php echo $this->session->flashdata('msgalert');?></strong>
					</div>
					<?php } ;?>
		            <!-- /.box-header -->
                    <?php 
                    $no = 1;
                    for ($i = 0 ; $i < count($data);$i++ ){
                        if ($data[$i]["parent_id_pertama"] == "" && $data[$i]["parent_id_kedua"] == "") {
                    ?>
		            <!-- form start -->
                    <div class="accordion" id="accordionExample">
                        <form  role="form" action="<?php echo $this->config->item('base_url'); ?>pagecontent/action_update/<?php echo $data[$i]["id"]?>" method="post">
                            <div class="box-body">
                            <h1><?php print_r($no++)?></h1>
                                <div class="form-group">
                                <label for="exampleInputEmail1">Judul </label>
                                <input required type="text" class="form-control" id="fullname" placeholder="" value = "<?php print_r($data[$i]["description"]); ?>"name="question">
                                </div>
                                
                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">update</button>
                                <a class="btn btn-warning" href="<?php echo $this->config->item('base_url'); ?>pagecontent/delete/<?php echo $data[$i]["id"]?>">Delete</a>
                                <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseExample<?php echo $data[$i]["id"]?>" aria-expanded="false" aria-controls="collapseExample">Add Sub Judul</button>
                                 <div class="card-header" id="headingThree">
                                  <h2 class="mb-0">
                                    <button style="    background-color: yellow;  color: black;   border: 1px solid black;  text-decoration: none;" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree<?php echo $data[$i]["id"]?>" aria-expanded="false" aria-controls="collapseThree">
                                      Detail
                                    </button>
                                  </h2>
                                </div>
                            </div>
                        </form>
                         
                            <div class="collapse" id="collapseExample<?php echo $data[$i]["id"]?>">
                                <!-- form start -->
                                <form style ="background-color: burlywood;" role="form" action="<?php echo $this->config->item('base_url'); ?>pagecontent/action_create" method="post">
                                  <div class="box-body">
                                    <h1>Insert Sub judul</h1>
                                    <div class="form-group">
                                      <label for="exampleInputEmail1"> Sub Judul</label>
                                      <input required type="text" class="form-control" id="fullname" placeholder="" name="question">
                                       <input  type="hidden" class="form-control" id="fullname" placeholder="" name="parent_id_pertama" value="<?php echo $data[$i]["id"]?>">
                                    </div>
                                  </div>
                                  <!-- /.box-body -->

                                  <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                  </div>
                                </form>
                                <!-- form End -->
                            </div>

                              <div id="collapseThree<?php echo($data[$i]["id"]); ?>" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample<?php echo($data[$i]["id"]); ?>">

                        <?php $getFaqListIdPer = $this->PageContent_model->getFaqListIdPer($data[$i]["id"]);
                                    for ($x=0; $x < count($getFaqListIdPer); $x++) { ?>
                                       
     
                                              <form style="background: gray;"  role="form" action="<?php echo $this->config->item('base_url'); ?>pagecontent/action_update/<?php echo $getFaqListIdPer[$x]["id"]?>" method="post">
                                                <div class="box-body">
                                                <h1><?php print_r($x+1)?></h1>
                                                    <div class="form-group">
                                                    <label for="exampleInputEmail1">Sub Judul </label>
                                                    <input required type="text" class="form-control" id="fullname" placeholder="" value = "<?php print_r($getFaqListIdPer[$x]["description"]); ?>"name="question">
                                                    </div>
                                                     

                                                </div>
                                                <!-- /.box-body -->

                                                <div class="box-footer">
                                                    <button type="submit" class="btn btn-primary">update</button>
                                                    <a class="btn btn-warning" href="<?php echo $this->config->item('base_url'); ?>pagecontent/delete/<?php echo $getFaqListIdPer[$x]["id"]?>">Delete</a>
                                                    <button class="btn btn-success" type="button" data-toggle="collapse" data-target="#collapseExample<?php echo $getFaqListIdPer[$x]["id"]?>" aria-expanded="false" aria-controls="collapseExample">Add Description</button>
                                                </div>
                                            </form>
                                             <div class="collapse" id="collapseExample<?php echo $getFaqListIdPer[$x]["id"]?>">
                                            <!-- form start -->
                                            <form style ="background-color: burlywood;" role="form" action="<?php echo $this->config->item('base_url'); ?>pagecontent/action_create" method="post">
                                              <div class="box-body">
                                                <h1>Insert Description</h1>
                                                <div class="form-group">
                                                  <label for="exampleInputEmail1"> Description</label>
                                                  <textarea name="question">  </textarea>

                                                  <input  type="hidden" class="form-control" id="fullname" placeholder="" name="parent_id_kedua" value="<?php echo $getFaqListIdPer[$x]["id"]?>">
                                                </div>
                                              </div>
                                              <!-- /.box-body -->

                                              <div class="box-footer">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                              </div>
                                            </form>
                                            <!-- form End -->
                                            </div>

                                            <?php $getFaqListIdDua = $this->PageContent_model->getFaqListIdDua($getFaqListIdPer[$x]["id"]);
                                                for ($y=0; $y < count($getFaqListIdDua); $y++) { ?>
                                                            <form style="background: red;"  role="form" action="<?php echo $this->config->item('base_url'); ?>pagecontent/action_update/<?php echo $getFaqListIdDua[$y]["id"]?>" method="post">
                                                            <div class="box-body">
                                                            <h1><?php print_r($y+1)?></h1>
                                                                <div class="form-group">
                                                                <label for="exampleInputEmail1">Description </label>
                                                                <!-- <input required type="text" class="form-control" id="fullname" placeholder="" value = "<?php print_r($getFaqListIdDua[$y]["description"]); ?>"name="question"> -->

                                                                 <textarea name="question"> <?php print_r($getFaqListIdDua[$y]["description"]); ?></textarea>
                                                                </div>


                                                                </div>
                                                                <!-- /.box-body -->

                                                                <div class="box-footer">
                                                                    <button type="submit" class="btn btn-primary">update</button>
                                                                    <a class="btn btn-warning" href="<?php echo $this->config->item('base_url'); ?>pagecontent/delete/<?php echo $getFaqListIdDua[$y]["id"]?>">Delete</a>
                                                                    <!-- <button type="submit" class="btn btn-primary">update</button> -->
                                                                </div>
                                                            </form>

                                                    <?php }
                                                    // close description
                                                     ?>
                                                    
                                <?php  } 

                                    // close sub judul

                                 ?>
                                    </div>
                             
                    <?php    } ?>

                    <?php 
                    }                   
                    ?>

                </div>
                    <?php if(count($data) > 0){ ?>


                  
		            <!-- form start -->
		            <form style ="background-color: burlywood;" role="form" action="<?php echo $this->config->item('base_url'); ?>pagecontent/action_create" method="post">
		              <div class="box-body">
                        <h1>Insert</h1>
                        <div class="form-group">
		                  <label for="exampleInputEmail1">Judul</label>
		                  <input required type="text" class="form-control" id="fullname" placeholder="" name="question">
		                </div>
		              </div>
		              <!-- /.box-body -->

		              <div class="box-footer">
		                <button type="submit" class="btn btn-primary">Submit</button>
		              </div>
		            </form>
             

                     <?php } ?>
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