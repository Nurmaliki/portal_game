<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Merchant BTN Detail
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>member"> Merchant BTN </a></li>
        <li class="active">Detail</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <h3 class="profile-username text-center"><?php echo $merchantgiift[0]['name']; ?> </h3>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Giift Dmo Id</b> <a class="pull-right"><?php echo $merchantgiift[0]['dmo_id']; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Category</b> <a class="pull-right"><?php echo $merchantgiift[0]['category'] == 'Entertainment and Leisure' ? mb_substr($merchantgiift[0]['category'], 0, 18) . '...' : $merchantgiift[0]['category'];  ?></a>
                </li>
                <!-- <li class="list-group-item">
                  <b>Value</b> <a class="pull-right d-flex"><?php echo  number_format($merchantgiift[0]['value'],0,",","."); ?> </a>

                </li> -->
                <!-- <br> -->
                <li class="list-group-item">
                  <b>Price</b> <a class="pull-right"><?php echo number_format($merchantgiift[0]['price'],0,",",".");?></a>
                </li>
                <li class="list-group-item">
                  <b>Points</b> <a class="pull-right"><?php echo  number_format($merchantgiift[0]['points'],0,",","."); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Available voucher</b> <a class="pull-right"><?php echo count($voucher_list_1); ?></a>
                </li>
                <li class="list-group-item">
                  <b>Used voucher</b> <a class="pull-right"><?php echo count($voucher_list_0); ?></a>
                </li>

              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <?php echo $merchantgiift[0]['tc']; ?>
        <div class="nav-tabs-custom">
        </div>
        </div>
        <div class="col-md-9">
        <div class="dropdown" style="float: right">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="">Filter berdasarkan
  <span class="caret"></span></button>
  <ul class="dropdown-menu">
    <li><a href="#" onclick="$('.table-striped').hide();$('#example-all').show();">Semua</a></li>
    <li><a href="#" onclick="$('.table-striped').hide();$('#example-0').show();">Terpakai</a></li>
    <li><a href="#" onclick="$('.table-striped').hide();$('#example-1').show();">Belum terpakai</a></li>
  </ul>
</div>
           <table id="example-all" class="table-striped table-hover table-condensed" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Voucher</th>
                                                <th>Expired date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
												  	if(count($voucher_list) > 0){
												  		$no = 1;
												  		for($i=0; $i<count($voucher_list); $i++){

												 ?>
                                                <tr>
                                                    <td>
                                                        <?php print_r($voucher_list[$i]['dec_voucher_code']); ?>
                                                    </td>
                                                    <td>
                                                    <?php echo $voucher_list[$i]['expired_date']; ?>
                                                    </td>
                                                    <td>
                                                    <?php echo $voucher_list[$i]['status'] == 0 ? 'Terpakai' : 'Belum terpakai' ?>
                                                    </td>

														</tr>
												<?php
												  		}
												  	}
												?>

						        </tbody>
						        <tfoot>

						        </tfoot>
                </table>

                <table id="example-0" class="table-striped table-hover table-condensed" style="width:100%;display:none">
                                        <thead>
                                            <tr>
                                                <th>Voucher</th>
                                                <th>Expired date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
												  	if(count($voucher_list_0) > 0){
												  		$no = 1;
												  		for($i=0; $i<count($voucher_list_0); $i++){

												 ?>
                                                <tr>
                                                    <td>
                                                        <?php print_r($voucher_list_0[$i]['dec_voucher_code']); ?>
                                                    </td>
                                                    <td>
                                                    <?php echo $voucher_list_0[$i]['expired_date']; ?>
                                                    </td>
                                                    <td>
                                                    <?php echo $voucher_list_0[$i]['status'] == 0 ? 'Terpakai' : 'Belum terpakai' ?>
                                                    </td>

														</tr>
												<?php
												  		}
												  	}
												?>

						        </tbody>
						        <tfoot>

						        </tfoot>
                </table>
                <table id="example-1" class="table-striped table-hover table-condensed" style="width:100%;display:none">
                                        <thead>
                                            <tr>
                                                <th>Voucher</th>
                                                <th>Expired date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
												  	if(count($voucher_list_1) > 0){
												  		$no = 1;
												  		for($i=0; $i<count($voucher_list_1); $i++){

												 ?>
                                                <tr>
                                                    <td>
                                                        <?php print_r($voucher_list_1[$i]['dec_voucher_code']); ?>
                                                    </td>
                                                    <td>
                                                    <?php echo $voucher_list_1[$i]['expired_date']; ?>
                                                    </td>
                                                    <td>
                                                    <?php echo $voucher_list_1[$i]['status'] == 0 ? 'Terpakai' : 'Belum terpakai' ?>
                                                    </td>

														</tr>
												<?php
												  		}
												  	}
												?>

						        </tbody>
						        <tfoot>

						        </tfoot>
						    </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <style>
  #example_filter,#example_length{
    display:none
  }
  </style>
  <script type="text/javascript">
$(document).ready(function() {
	$('#example').DataTable( {
        "pagingType": "full_numbers"
  } );
} );
  </script>
  <!-- /.content-wrapper -->
