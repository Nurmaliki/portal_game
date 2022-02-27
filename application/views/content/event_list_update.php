<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create Grand Prize Content
        <small>Update</small>
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
                        <?php // print_r($data); ?>
                            <div class="box-body" style="">
                            <form role="form" action="<?php echo $this->config->item('base_url'); ?>event_list/action_update/<?php echo $data[0]['id']; ?>" method="post"
                                     id="news_content" enctype="multipart/form-data" >

                                   <div class="form-group">
                                     <img src="<?php echo $this->config->item('assets_url')."uploads/".$data[0]['img']; ?>" alt="">
                                   </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Grand Prize Event Title</label>
                                        <input required type="text" class="form-control" id="name" placeholder="Enter Grand Prize Event Title here" name="name" value="<?php echo $data[0]['name']; ?>">
                                    </div>
                                    <br>

                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Grand Prize Event Description</label>
                                    <input required type="text" class="form-control"  placeholder="Enter Grand Prize Event Description here" name="description" value="<?php echo $data[0]['description']; ?>">
                                    </div>
                                    <br>

                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Grand Prize Event Image</label>
                                    <input type="file" name="img" size="20"/>
                                    <label for="">file size : 200kb , resolusi 180x120 px, file type : png,jpg </label>
                                    </div>
                                    <br>

                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Grand Prize Event Date Start</label>
                                    <div class="raw">
                                      <input required type="time" name="time_start" value="<?php echo date("H:i", strtotime($data[0]['date_start']))?>">
                                      <input required type="date" name="date_start" value="<?php echo date("Y-m-d", strtotime($data[0]['date_start'])); ?>">
                                    </div>
                                    </div>
                                    <br>


                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Grand Prize Event Date End</label>
                                    <div class="raw">
                                      <input required type="time" name="time_end" value="<?php echo  date("H:i", strtotime($data[0]['date_end'])) ?>">
                                      <input required type="date" name="date_end" value="<?php echo date("Y-m-d", strtotime($data[0]['date_end'])); ?>">

                                    </div>
                                    </div>
                                    <br>

                                    <!-- <div class="form-group">
                                    <label for="exampleInputEmail1">Grand Prize Event Value</label>
                                    <input required type="number" class="form-control"  placeholder="Enter Sub title here" name="value" value="<?php echo $data[0]['value']; ?>">
                                    </div>
                                    <br>

                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Grand Prize Event Price</label>
                                    <input required type="number" class="form-control"  placeholder="Enter Sub title here" name="price" value="<?php echo $data[0]['price']; ?>">
                                    </div>
                                    <br> -->

                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Grand Prize Event Points</label>
                                    <input required type="number" class="form-control"  placeholder="Enter Grand Prize Event Points here" name="points"  value="<?php echo $data[0]['points']; ?>">
                                    </div>
                                    <br>

                                    <!-- <div class="form-group">
                                    <label for="exampleInputEmail1">Grand Prize Event Unit</label>
                                    <input required type="number" class="form-control"  placeholder="Enter Sub title here" name="unit"  value="<?php echo $data[0]['unit']; ?>">
                                    </div>
                                    <br> -->

                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Grand Prize Event Term. And Condition</label>
                                    <textarea required type="text" class="form-control editor"  style="resize: none;" placeholder="Enter Grand Prize Event Term. And Condition here" name="tc"><?php echo $data[0]['tc']; ?></textarea>
                                    </div>
                                    <br>

                                    <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                <!-- </form> -->
                            </div>
                        <!-- /.box-body -->

		          </div>
	        </div>
        </div>
	</section>
<style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    /* display: none; <- Crashes Chrome on hover */
    -webkit-appearance: none;
    margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
}

input[type=number] {
    -moz-appearance:textfield; /* Firefox */
}
</style>
    <!-- End Main content -->
</div>
<!-- End Content Wrapper. Contains page content -->
