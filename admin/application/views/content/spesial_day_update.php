<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
			<?php if($spesial_day['name']  == 'bonus_ultah'){
				echo "Bonus Ultah";
			}else{
				echo "Spesial Day";
			}
			?>

        <small>Update</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>news_category">Special Day</a></li>
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
		              <h3 class="box-title"></h3>
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
								<?php //print_r($spesial_day); ?>
		            <form role="form" action="<?php echo $this->config->item('base_url'); ?>spesial_day/action_update" method="post">
		            <input type="hidden" name="id" value="<?php echo $spesial_day['id']; ?>">
		              	<div class="box-body">


										<?php if($spesial_day['name']  == 'bonus_ultah'){ ?>
														<!-- echo ""; -->
														<input type="hidden" required class="form-control" id="name" placeholder="Enter name here" name="name" value="<?php echo $spesial_day['name']?>">


										<?php			}else{ ?>
														<div class="box-body">
															<div class="form-group">
																<label for="exampleInputEmail1">Nama</label>
																<input type="text" required class="form-control" id="name" placeholder="Enter name here" name="name" value="<?php echo $spesial_day['name']?>">

															</div>
														</div>
														<!-- echo "Spesial Day"; -->

										<?php	}	?>

						<div class="box-body">

						<div class="form-group">
							<label for="exampleInputEmail1">Bonus Type</label>
							<select required class="form-control" name="bonus_type">
												<option value="0" 	<?php if(!empty($spesial_day['bonus_type'])){ if ($spesial_day['bonus_type'] == "0"){echo "selected";} }?>>Penambahan</option>
												<option value="1"  <?php if(!empty($spesial_day['bonus_type'])){  if ($spesial_day['bonus_type'] == "1"){echo "selected";} }?>>Persentase</option>

							</select>
						</div>

		                <div class="form-group">
		                  <label for="exampleInputEmail1">Value ( Jumlah Poin atau Jumlah Presentase )</label>
		                  <input type="number" required class="form-control" id="bonus" placeholder="Enter bonus here" name="bonus" value="<?php echo $spesial_day['bonus']?>">

		                </div>
		              </div>

									<?php if($spesial_day['name']  == 'bonus_ultah'){ ?>
													<!-- echo ""; -->
													<input type="hidden" required class="form-control" id="event_date" placeholder="Enter Event Date here" name="event_date" value="<?php echo $spesial_day['event_date']?>">

										<?php		}else{ ?>

											<div class="box-body">
												<div class="form-group">
													<label for="exampleInputEmail1">Event Date</label>
													<input type="date" required class="form-control" id="event_date" placeholder="Enter Event Date here" name="event_date" value="<?php echo $spesial_day['event_date']?>">

												</div>
											</div>
									<?php	}	?>
                      <!-- <div class="box-body">
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Rule Expire</label> -->
		                  <input type="hidden" required class="form-control" id="rule_expire" placeholder="Enter Rule Expire here" name="rule_expire" value="365">

		                <!-- </div>
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
