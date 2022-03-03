<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Spesial Day
        <small>List</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>news_category">Spesial Day</a></li>
        <li class="active">List</li>
      </ol>
    </section>
    <!-- EndContent Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    	<div class="row">
	        <div class="col-xs-12">
	        	<div class="box">
		            <!-- /.box-header --> 
		            <div class="box-body">

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

						<?php if ($this->session->userdata['user_data']['role'] == 5) { ?>

						<?php }else{?>
		            		<div style="float: right"><a href="<?php echo $this->config->item('base_url')?>spesial_day/create" class="btn btn-app"><i class="fa  fa-plus"></i> Input </a></div>
		            	<?php } ?>
		              	<table class="table table-bordered table-hover" cellspacing="0" width="100%" id="member">
						  <thead>
							<tr><th>No</th>
								<th>Nama</th>
								<th>Value ( Jumlah Poin atau Jumlah Presentase )</th>
								<th>Bonus type</th>
                                <th>Event Date</th>
								<th>Action</th>
							</tr>
						  </thead>
						</table>
		            </div>
		            <!-- /.box-body -->
		        </div>
	        </div>
	    </div>
		<h3>
        Bonus Ulang Tahun
        <small>List</small>
      </h3>
		<div class="row">
	        <div class="col-xs-12">
	        	<div class="box">
		            <!-- /.box-header -->
		            <div class="box-body"><?php //  print_r($category[0])?>

		            	<!-- <div style="float: right"><a href="<?php //echo $this->config->item('base_url')?>spesial_day/create" class="btn btn-app"><i class="fa  fa-plus"></i> Input </a></div> -->
		              	<table class="table table-bordered table-hover" cellspacing="0" width="100%" id="member">
						  <thead>
							<tr><th>No</th>
								<th>Nama</th>
    							<th>Bonus (%)</th>
                                <!-- <th>Even Date</th> -->
                                <th>Rule Expire (Day)</th>
								<th>Action</th>
							</tr>
							<?php
							$s=1;
							if(count($category) > 0){
										for($i=0; $i<count($category); $i++){ ?>
						<tr>
							<?php if($category[$i]["name"] != 'bonus_ultah'){
								echo "";
							}else{?>
							<td><?php echo $s++; ?></td>
							<td><?php echo $category[$i]["name"]; ?></td>
							<td><?php echo $category[$i]["bonus"]; ?></td>
							<td><?php echo $category[$i]["rule_expire"]; ?></td>
							<!-- <td><?php // echo $category[$i]["even_date"]; ?></td> -->
							<td><?php if ($this->session->userdata['user_data']['role'] == 5) {
								# code...
			/*tambahkan else if di baris ini  */		}else if ($this->session->userdata['user_data']['role'] == 3) {
								# code...
							}else{echo '<a href="'.$this->config->item('base_url').'spesial_day/update/'.$category[$i]["id"].'" class="fa fa-fw fa-pencil">&nbsp;</a>&nbsp;'; ?></td>
							<?php } ?>


						</tr>
								<?php
									}
								}
							}?>
						  </thead>
						</table>
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
        language: {
            // search: "_INPUT_",
            // searchPlaceholder: "Name, Cif or Phone Number",
            processing: "<div style='    margin-top: 20%;   background-color: greenyellow;'><b>LOADING...</b></div>"
        },
		"bFilter": false,
        "ajax": "<?php echo $this->config->item('base_url'); ?>spesial_day/datatables",
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
