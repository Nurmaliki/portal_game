Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Adjust Poin
     <!--    <small>List</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>member">  Adjust Poin</a></li>
        <!-- <li class="active">List</li> -->
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
                  <?php if($this->session->flashdata('msgalert')){ ;?>
        						<div class="alert alert-success" role="alert">
        						<strong><?php echo $this->session->flashdata('msgalert');?></strong>
        						</div>
                  <?php }else if($this->session->flashdata('alertSuccess')){ ;?>

                  <div class="alert " style="background-color: greenyellow;" role="alert">
                  <strong><?php echo $this->session->flashdata('alertSuccess');?></strong>
                  </div>
                <?php }else{} ?>
                        <?php // print_r($_SESSION['user_data_web']['role']);?>


                    <form role="form" action="<?php echo $this->config->item('base_url'); ?>adjust_poin/action_adjust_poin" method="post">
		              <div class="box-body">
		                <div class="form-group">

						<label for="exampleInputEmail1">Rule Code</label>
		                 <!--  <input required type="text" class="form-control" id="name" placeholder="" name="rule_code" value="<?php print_r($this->session->flashdata('field')['name']);?>"> -->

			                 	<select required class="form-control" name="rule_code">
								<?php //print_r($_SESSION)?>
			            			<option value="" selected disabled>Select Poin Code</option>
	                                <?php
				                   	if(count($get_poin_code) > 0){
				                   		for($i=0; $i<count($get_poin_code); $i++){
				                   			if (!empty(trim($get_poin_code[$i]['poin_code'], " "))) {
				                   	?>



										   <?php if(trim($get_poin_code[$i]['poin_code'], "") == " 1002"){  ?>
							  				<!-- <td>Debit BTN Online</td> -->
											<option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>"> Debit BTN Online</option>


										  <?php ?>
                    <?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "1001"){  ?>
							  				<!-- <td>Transaksi Pembayaran dan Pembelian</td> -->
											  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Transaksi Pembayaran dan Pembelian</option>

											<?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "1003"){  ?>
							  				<!-- <td>Penarikan Tunai Luar Negeri</td> -->
											  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Penarikan Tunai Luar Negeri</option>

											  <?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "1004"){  ?>
							  				<!-- <td>Transaksi Transfer Kerekening Bank Lain</td> -->
											  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Transaksi Transfer Kerekening Bank Lain</option>

											  <?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "1005"){  ?>
							  				<!-- <td>Setoran</td> -->
											  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Setoran</option>

											<?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "1006"){  ?>
							  				<!-- <td>Pencetakan Rekening Koran Melalui Mesin ATM</td> -->
											  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Pencetakan Rekening Koran Melalui Mesin ATM</option>

							  				<?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "add_point_manual"){  ?>
							  				<!-- <td>Penambahan poin manual</td> -->
											  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Penambahan poin manual</option>
							  				<?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "ultah"){  ?>
							  				<!-- <td>Poin Ulang Tahun</td> -->
											  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Poin Ulang Tahun</option>
							  				<?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "open_acc"){  ?>
							  				<!-- <td>Pembukaan Akun Baru</td> -->
											  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Pembukaan Akun Baru</option>

							  				<?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "akd"){  ?>
							  				<!-- <td>Aktivasi Kartu Debit</td> -->
											  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Aktivasi Kartu Debit</option>

							  				<?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "aib"){  ?>
							  				<!-- <td>Aktivasi Internet Banking</td> -->
											  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Aktivasi Internet Banking</option>

							  				<?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "agf"){  ?>
							  				<!-- <td>Aktivasi AGF</td> -->
											  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Aktivasi AGF</option>

							  				<?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "aft"){  ?>
							  				<!-- <td>Aktivasi AFT</td> -->
											  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Aktivasi AFT</option>

							  				<?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "mstr_mob"){  ?>
							  				<!-- <td>Master Mobile</td> -->
											  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Master Mobile</option>
											  <?php }else if(trim($get_poin_code[$i]['poin_code'], " ") == "balance"){  ?>
							  				<!-- <td>Master Mobile</td> -->
											  <option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>">Saldo Akhir Bulan</option>

										  	<?php }else{?>

											<!-- <td><?php // echo trim($get_poin_code[$i]['poin_code'], "");?></td> -->
											<option <?php if(isset($_SESSION["current_selected_program"])){ if($get_poin_code[$i]['poin_code'] == $_SESSION["current_selected_program"]["poin_code"]){ echo 'selected = "true"';} } ?>  value="<?php echo $get_poin_code[$i]['poin_code'];?>"><?php echo $get_poin_code[$i]['poin_code'];?></option>

										  	<?php }?>

							       	<?php
											}
				                   		}
				                   		}
				                   	?>
				                 </select>
		                </div>
		                <div class="form-group">
		                  <label for="exampleInputEmail1">Date start</label>
		                  <input required type="date" class="form-control" id="username" placeholder="Enter username here" name="date_start" value="<?php echo date('Y-m-d'); ?>">
		                </div>
		                   <div class="form-group">
		                  <label for="exampleInputEmail1">Date end</label>
		                  <input required type="date" class="form-control" id="username" placeholder="Enter username here" name="date_end" value="<?php echo date('Y-m-d'); ?>">

		                </div>

		              </div>
		              <!-- /.box-body -->

		              <div class="box-footer">
		                <button type="submit" class="btn btn-primary">Submit</button>
		              </div>
		            </form>
<br>
<br>
<br>
						<center> <h1>Log Adjust Poin</h1></center>

                      	<table class="table table-bordered table-hover" cellspacing="0" width="100%" id="member">
						  <thead>
							<tr>
								<th>Rule Code</th>
		            			<th>Tanggal</th>
		            			<th>User</th>
		            			<th>Message</th>
		       					<th>Status</th>
		       					<th>Date</th>
							</tr>
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
    // $('#member tfoot th').each( function(){
    //     var title =$(this).text();
    //     $(this).html('<input type="text" palceholder="search'+title+'"/>')
    // });
    // $('#member').dataTable( {
    //     language: {
    //         search: "_INPUT_",
    //         searchPlaceholder: "Search..."
    //     }
    // } );


   var table = $('#member').dataTable( {


        "DeferRender": true,
        "processing": true,
        "serverSide": true,
        "bFilter": true,

        "ajax": "<?php echo $this->config->item('base_url'); ?>adjust_poin/datatables",
        "type": "GET",

        "lengthMenu": [[25, 50, 200, -1], [25, 50, 200, "All"]],
        "blengthMenu": [[25, 50, 200, -1], [25, 50, 200, "All"]],
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Rule code Or User",
            processing: "<div style='    margin-top: 20%;   background-color: greenyellow;'><b>LOADING...</b></div>"
        },




    aaSorting: [[3, 'desc']],

    } );

    // table.columns().every(function (){
    //     var that =this;
    //     $('input',this.footer()).on('keyup change', function(){
    //         if(that.search()!==this.value){
    //             that.search(this.value).draw();
    //         }
    //     })
    // })

    // $('#member').dataTable( {
    //     language: {
    //         searchPlaceholder: "Search records"
    //     }
    // } );



} );
$(document).on('click', ':not(form)[data-confirm]', function(e){
        if(!confirm($(this).data('confirm'))){
            e.stopImmediatePropagation();
            e.preventDefault();
        }
    });
</script>
<!-- End Content Wrapper. Contains page content
