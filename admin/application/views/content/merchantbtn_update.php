<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Merchant BTN Update
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>merchantgiift"> Merchant Giift </a></li>
        <li class="active">detail</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">
        <?php echo form_open_multipart($this->config->item('base_url').'/merchant/updateBTN');?>
          <!-- Profile Image -->
          <?php if($this->session->flashdata('merchant_btn')){ ;?>
            <div class="alert alert-success" role="alert">
            <strong><?php echo $this->session->flashdata('merchant_btn');?></strong>
            </div>
            <?php } ;?>
          <div class="box box-primary">
            <div class="box-body box-profile">
              <h3 class="profile-username text-center"><?php echo $merchantgiift[0]['name']; ?> </h3>

              <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                  <img src="<?php echo str_replace('index.php/','',base_url()).$merchantgiift[0]['img'];?>" width=300 height=auto />
                </li>
              <li class="list-group-item">
                  <b>Image</b>
                  <input class="form-control" name="img" type="file" value="<?php echo $merchantgiift[0]['img'];?>">
                  <label for="">file size : 200kb , resolusi 180x120 px, file type : png,jpg </label>
                </li>
              <li class="list-group-item">
                  <b>Name</b>
                  <input class="form-control" name="name" type="text" value="<?php echo $merchantgiift[0]['name'];?>">
                </li>
                <li class="list-group-item">
                  <b>Category</b>

                  <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" onchange="$('#category').val($(this).find(':selected').text());" data-select2-id="1" tabindex="-1" aria-hidden="true">
                  <option selected="selected" data-select2-id="3" disabled>Select category</option>
                 <?php for($i=0; $i<count($category); $i++){ ?>
                  <option data-select2-id="27" <?php echo $category[$i]['category'] == $merchantgiift[0]['category'] ? 'selected' : '';?>><?php echo $category[$i]['category'];?></option>
                 <?php } ?>
                </select>
                  <input class="form-control hidden" name="id" type="text" value="<?php echo $merchantgiift[0]['id'];  ?>">
                  <input class="form-control hidden" name="category" id="category" type="text" value="<?php echo $merchantgiift[0]['category'];?>">
                </li>
                <li class="list-group-item hidden">
                  <b>Value</b>
                  <input class="form-control numbers" name="value" type="text" value="<?php echo  number_format($merchantgiift[0]['value'],0,",","."); ?>">
                </li>
                <!-- <br> -->
                <li class="list-group-item">
                  <b>Price</b>
                  <input class="form-control numbers" name="price" type="text" value="<?php echo number_format($merchantgiift[0]['price'],0,",",".");?>">
                </li>
                <li class="list-group-item">
                  <b>Points</b>
                  <input class="form-control numbers" name="points" type="text" value="<?php echo  number_format($merchantgiift[0]['points'],0,",","."); ?>">
                </li>
                <li class="list-group-item">
                  <b>Term and condition</b>
                  <textarea class="editor" name='tc' style="width:100%;resize:none;" rows="5"><?php echo $merchantgiift[0]['tc']; ?></textarea>
                </li>
                <li class="list-group-item">
                  <b>Description</b>
                  <textarea name='description' style="width:100%;resize:none;" rows="5"><?php echo $merchantgiift[0]['description']; ?></textarea>
                </li>
                <li class="list-group-item">
                <button type="submit" class="btn btn-success">Submit</button>&nbsp;<a href="<?php echo $this->config->item('base_url');?>merchantbtn" class="btn btn-warning">Cancel</a>
                </li>

              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <?php echo form_close(); ?>
        </div>
        <!-- /.col -->
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <script>
  $(document).ready(function(){
    $("input.numbers").blur(function(){
  	  if(isNaN(new Number(this.value))){
  		this.value = this.value;
  	  } else {
  		var d = new Number(this.value);
  	  	this.value = d.toLocaleString('de');
  	  }
    });
  });
  </script>
