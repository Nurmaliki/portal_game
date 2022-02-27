

<!-- Content Wrapper. Contains page content -->
<style>
.mce-path-item,.mce-wordcount{
  display:none;
}
</style>
<style> 
.panelan:nth-child(odd) {
  background: red;
}

.panelan:nth-child(even) {
  background: blue;
}
</style>
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
          
          

	        	
		           
		      <?php if($this->session->flashdata('msgalert')){ ;?>
					<div id="alert" class="alert alert-success" role="alert">
					<strong><?php echo $this->session->flashdata('msgalert');?></strong>
					</div>
					<?php } ;?>
                <!-- /.box-header -->
                <?php 
                    $no = 1;
                    for ($c = 0 ; $c < count($data);$c++ ){
                        if ($data[$c]["parent_id_pertama"] == "" && $data[$c]["parent_id_kedua"] == "") {
                    ?>
                <div class="panel panel-default">
                  <div class="panel-heading"><?php print_r($data[$c]["description"]); ?><a class="btn btn-danger" style="float:right;" href="<?php echo $this->config->item('base_url'); ?>pagecontent/delete/<?php echo $data[$c]["id"]?>"><i class="fa fa-trash" aria-hidden="true"></i></a></div>
                  <div class="panel-body">
                  <form  role="form" action="<?php echo $this->config->item('base_url'); ?>pagecontent/action_update/<?php echo $data[$c]["id"]?>" method="post">
  <div class="form-group">
    <label for="exampleFormControlInput1">Judul</label>
    <input type="text" class="form-control" name="question" value="<?php print_r($data[$c]["description"]); ?>" onkeypress="$('#actionNo<?php echo $data[$c]["id"]?>').prop('disabled', false);">
  </div>
  <button type="submit" id="actionNo<?php echo $data[$c]["id"]?>" class="btn btn-warning updatedBtn<?php echo $data[$c]["id"]?> hidden" disabled>Update</button>  
</form>

<?php $getFaqListIdPer = $this->PageContent_model->getFaqListIdPer($data[$c]["id"]);
                                    for ($t=0; $t < count($getFaqListIdPer); $t++) { ?>  
                                                                      
<form role="form" style="margin-top: 20px" action="<?php echo $this->config->item('base_url'); ?>pagecontent/action_update/<?php echo $getFaqListIdPer[$t]["id"]?>" method="post">
  <div class="form-group">
    <label for="exampleFormControlInput1">Sub judul</label>
    <input type="text" class="form-control" name="question" value="<?php print_r($getFaqListIdPer[$t]["description"]); ?>" onkeypress="$('#actionNo<?php echo $getFaqListIdPer[$t]["id"]?>').prop('disabled', false);">
  </div>
  <div class="form-group">
  <button type="submit" id="actionNo<?php echo $getFaqListIdPer[$t]["id"]?>" class="btn btn-success mb-2 hidden updatedBtn<?php echo $data[$c]["id"]?>" disabled>Update sub judul</button>
  <a class="btn btn-danger hidden" href="<?php echo $this->config->item('base_url'); ?>pagecontent/delete/<?php echo $getFaqListIdPer[$t]["id"]?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
  </div>
</form>
<?php $getFaqListIdDua = $this->PageContent_model->getFaqListIdDua($getFaqListIdPer[$t]["id"]);
                                                for ($s=0; $s < count($getFaqListIdDua); $s++) { ?>
<form role="form" action="<?php echo $this->config->item('base_url'); ?>pagecontent/action_update/<?php echo $getFaqListIdDua[$s]["id"]?>" method="post">  
<div class="form-group">                                              
<textarea name="question" onkeypress="$('#actionNo<?php echo $getFaqListIdDua[$s]["id"]?>').prop('disabled', false);"> <?php print_r($getFaqListIdDua[$s]["description"]); ?></textarea>
<button type="submit" id="actionNo<?php echo $getFaqListIdDua[$s]["id"]?>" class="btn btn-success mb-2 hidden updatedBtn<?php echo $data[$c]["id"]?>" disabled>Update deskripsi</button>
<a class="btn btn-danger hidden" href="<?php echo $this->config->item('base_url'); ?>pagecontent/delete/<?php echo $getFaqListIdDua[$s]["id"]?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
</div>
</form>
                                                <?php } ?>
                                    <?php } ?>
<button type="button" class="btn btn-success mb-2" onclick="SubmitAll(<?php echo $data[$c]["id"]?>)" style="float:right">Update all</button>                                    
                  </div>                  
                </div>
              

                        <?php } }?>

                        <div class="box box-primary"></div>
                    <?php 
                    $no = 1;
                    for ($c = 0 ; $c < count($data);$c++ ){
                        if ($data[$c]["parent_id_pertama"] == "" && $data[$c]["parent_id_kedua"] == "") {
                    ?>
		            <!-- form start -->
                    <div class="accordion hidden" id="accordionExample">
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
                                                    <textarea class="editor" name="question" id="<?php echo $data[$c]["id"]?><?php echo $getFaqListIdDua[$s]["id"]?>" onkeypress="$('#actionNo<?php echo $data[$c]["id"]?><?php echo $getFaqListIdDua[$s]["id"]?>').prop('disabled', false);">
                                                        <?php print_r($getFaqListIdDua[$s]["description"]); ?>
                                                    </textarea>
                                                    <button type="submit" id="actionNo<?php echo $data[$c]["id"]?><?php echo $getFaqListIdDua[$s]["id"]?>" class="btn btn-success mb-2 hidden updatedBtn<?php echo $data[$c]["id"]?>" disabled>Update deskripsi</button>
                                                    <a class="btn btn-danger hidden" href="<?php echo $this->config->item('base_url'); ?>pagecontent/delete/<?php echo $getFaqListIdDua[$s]["id"]?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                </div>
                                            </form>
                                            <?php } } else { ?>
                                                <form role="form" action="<?php echo $this->config->item('base_url'); ?>pagecontent/action_create" method="post">
                                                    <div class="form-group">
                                                        <textarea class="editor" id="<?php echo $getFaqListIdPer[$t]["id"]?>-feri" name="question"> </textarea>
                                                        <input type="hidden" class="form-control" placeholder="" name="parent_id_kedua" value="<?php echo $getFaqListIdPer[$t]["id"]?>">
                                                    </div>
                                                    <!-- /.box-body -->
                                                    <div class="box-footer">
                                                        <button type="submit" id="actionNo<?php echo $getFaqListIdPer[$t]["id"]?>-feri" class="btn btn-primary hidden updatedBtn<?php echo $data[$c]["id"]?>" disabled>Submit</button>
                                                    </div>
                                                </form>
                                                <?php } } ?>
                                                    <div class="panel panel-success">
                                                        <div class="panel-heading">Tambah sub judul baru <button style="float:right" onclick="$('#panelJudulBaru<?php echo $data[$c]["id"]?>').toggle('slow')">+</button></div>
                                                        <div class="panel-body" id="panelJudulBaru<?php echo $data[$c]["id"]?>" style="display:none">
                                                            <form action="<?php echo $this->config->item('base_url'); ?>pagecontent/action_create" method="post">
                                                                <div class="box-body">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1"> Sub Judul</label>
                                                                        <input required type="text" class="form-control" id="fullname" placeholder="" name="question">
                                                                        <input type="hidden" class="form-control" id="fullname" placeholder="" name="parent_id_pertama" value="<?php echo $data[$c]["id"]?>">
                                                                    </div>
                                                                </div>

                                                                <div class="box-footer">
                                                                    <button id="submit<?php  echo $c;?>" name="submit<?php  echo $c;?>" value="submit" type="submit" class="btn btn-primary">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-success mb-2" onclick="SubmitAll(<?php echo $data[$c]["id"]?>)" style="float:right">Update</button>
                                </div>
                            </div>
                            <?php } }?>



                            <div id="input" class="panel panel-success">
                                <div class="panel-heading">Tambah judul baru <button style="float:right" onclick="$('#panelMenuBaru').toggle('slow')">+</button></div>
                                <div class="panel-body" id="panelMenuBaru" style="display:none">
                                    <form role="form" action="<?php echo $this->config->item('base_url'); ?>pagecontent/action_create" method="post">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Judul</label>
                                                <input required type="text" class="form-control" placeholder="" name="question">
                                            </div>
                                        </div>
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
            </div>
        </div>
</div>
</div>
</section>

<!-- End Main content -->
</div>
<script>
function SubmitAll(id){
  $('.updatedBtn' + id).click();
}
</script>
<script type="text/javascript">
var udahjalan = true;
$(document).ready(function() {
  $('form').submit(function (evt) {
   evt.preventDefault(); //prevents the default action
    var form = $(this);
    var url = form.attr('action');
    $.ajax({
           type: "POST",
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
             if(udahjalan){
              udahjalan = false;

                  if (data == 'true'){
                    location.href = "<?php echo $this->config->item('base_url'); ?>/pagecontent/faq#input";
                    window.location.reload();

                  } else {

                    location.href = "<?php echo $this->config->item('base_url'); ?>/pagecontent/faq#"+data;
                    window.location.reload();
                  }
             }
           }
         });

});
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
