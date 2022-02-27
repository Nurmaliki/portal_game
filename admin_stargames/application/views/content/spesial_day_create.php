<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Spesial Day
        <small>Create</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>news_category">  Spesial Day</a></li>
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

                <!-- Alert Tentang -->
                <?php if($this->session->flashdata('spesialDayFalse')){ ;?>
                  <div style="width: 100%;" id="alerts" class="alert alert-success" role="alert">
                      <strong><?php echo $this->session->flashdata('spesialDayFalse');?></strong>
                  </div>
                <?php }else if($this->session->flashdata('spesialDayTrue')){?>
                      <div style="background: #d4edda !important;color: #155724 !important;   width:100%;" id="alerts" class="alert alert-success" role="alert">
                          <strong><?php echo $this->session->flashdata('spesialDayTrue');?></strong>
                      </div>
                <?php } ?>

		            <!-- /.box-header -->
		            <!-- form start -->
		            <form role="form" action="<?php echo $this->config->item('base_url'); ?>spesial_day/action_create" method="post">
		              <div class="box-body">
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Nama</label>
		                  <input type="text" required class="form-control" id="name" placeholder="Enter name here" name="name" value="<?php print_r($this->session->flashdata('data')['name']);?>">

		                </div>
		              </div>

		            <div class="box-body">
					  	<div class="form-group">
			                  <label for="exampleInputEmail1">Bonus Type</label>
			                  <select required class="form-control" name="bonus_type">
												<option value="0" 	<?php if(!empty($_SESSION['faild']['bonus_type'])){ if ( $_SESSION['faild']['bonus_type'] == "0"){echo "selected";} }?>>Penambahan</option>
												<option value="1"  <?php if(!empty($_SESSION['faild']['bonus_type'])){  if ( $_SESSION['faild']['bonus_type'] == "1"){echo "selected";} }?>>Persentase</option>

			                  </select>
			        	</div>
			        </div>

					  <div class="box-body">
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Value ( Jumlah Poin atau Jumlah Presentase )</label>
		                  <input type="number" required class="form-control" id="bonus" placeholder="Enter Bonus here" name="bonus" value="<?php print_r($this->session->flashdata('data')['bonus']);?>">

		                </div>
		              </div>
					  <div class="box-body">
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Event Date</label>
		                  <input type="date" required class="form-control" id="event_date" placeholder="Enter Event Date here" name="event_date" value="<?php print_r($this->session->flashdata('data')['event_date']);?>">

		                </div>
		              </div>
                      <!-- <div class="box-body">
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Rule Expire</label> -->
		                  <input type="hidden" required class="form-control" id="rule_expire" placeholder="Enter Rule Expire here" name="rule_expire" value="365">
                          <!--
		                </div>
		              </div> -->
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
