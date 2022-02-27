Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Reedem Report
        <small>List</small>
      </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo $this->config->item('base_url');?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo $this->config->item('base_url');?>member">Merchant BTN</a></li>
            <li class="active">List</li>
        </ol>
    </section>
    <!-- EndContent Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <h5 style="margin-left: 12px;" class="btn-actions">Last Update :<?php echo $merchant[0]['last_update']; ?></h5>
        <div class="row">

            <div class="col-xs-12">
                <!-- <div class="row"> -->
                <!-- <div class="col"> -->

                <!-- </div> -->
                <!-- <div class="col"> -->
                <div style="float: right"><a class="btn btn-app btn-actions" onclick="$('#addVoucher').show();$('#voucherList,.btn-actions').hide();"><i class="fa fa-sync"></i>Add Merchant</a></div>
                <!-- </div> -->
                <!-- <div class="col"></div> -->
                <!-- </div> -->

                <!-- <a href="<?php echo $this->config->item('base_url')?>sync_giift_list" class="fa fa-fw fa-trash" data-confirm="Are you sure you want to Sync Giift Merchant ?">&nbsp;</a> -->

                <div class="col-xs-12" id="voucherList" style="display:block">
                    <?php if($this->session->flashdata('msgalert')){ ;?>
                        <div class="alert <?php if ($_GET == " success ") { echo"alert-info ";} else{ echo"alert-success "; } ?>" role="alert">
                            <strong><?php echo $this->session->flashdata('msgalert');?></strong>
                        </div>
                        <?php } ;?>
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">

                                    <table id="example" class="table-striped table-hover table-condensed" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Expired date</th>
                                                <th>Status</th>
                                                <th>Used date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <!-- <?php print_r($category); ?> -->
                                            <?php
												  	if(count($voucher_list) > 0){
												  		$no = 1;
												  		for($i=0; $i<count($voucher_list); $i++){

												 ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $voucher_list[$i]['name']; ?>
                                                    </td>
                                                    <td>
                                                    <?php echo $voucher_list[$i]['expired_date']; ?>
                                                    </td> 
                                                    <td>
                                                    <?php echo $voucher_list[$i]['status'] == 0 ? 'Terpakai' : 'Belum terpakai' ?>
                                                    </td>  
                                                    <td>
                                                    <?php echo $voucher_list[$i]['used_date']; ?>
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
		            <!-- /.box-body -->
		        </div>
            </div>

            <div class="col-md-12" id="addVoucherMerchantBTN" style="display:none">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title" id="addvoucherheader">Add data</h3>
            </div>
            <div class="box-body">
            <div class="col-md-6">
            <?php echo form_open_multipart($this->config->item('base_url').'/voucher/input', array('id' => 'inputVoucher'));?>

            <div class="form-group" id="csvfiles">
								<label for="name">Pilih file CSV <a href="<?php echo str_replace('index.php/','',base_url()); ?>uploads/csv/dumpcsv.csv">Download contoh csv</a></label>
								<input class="form-control-file <?php echo form_error('csvfile') ? 'is-invalid':'' ?>"
								 type="file" name="csvfile" id="csvfile"/>
								<div class="invalid-feedback">
									<?php echo form_error('csvfile') ?>
								</div>
						</div>

            <div class="form-group" id="voucher_codes" style="display:block">
                <label>Atau ketik kode voucher</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-ticket"></i>
                  </div>
                  <input type="text" name="voucher_code" id="voucher_code_val" class="form-control pull-right">
                </div>
                <!-- /.input group -->
              </div>

              <!-- Date range -->
              <!-- <div class="form-group voucherinsert" data-select2-id="25" id="merchant_ids" style="display:none">
                <label>Merchant</label>
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" onchange="$('#merchant_id').val($(this).find(':selected').val());" data-select2-id="1" tabindex="-1" aria-hidden="true">
                  <option selected="selected" value="" data-select2-id="3" disabled>Select merchant</option>
                 <?php for($i=0; $i<count($merchant_btn); $i++){ ?>
                  <option value="<?php echo $merchant_btn[$i]['dmo_id'];?>" data-select2-id="27"><?php echo $merchant_btn[$i]['name'];?></option>
                 <?php } ?>
                </select>
              </div> -->
              <!-- /.form group -->

              <!-- Date and time range -->
              <div class="form-group" style="display:none">
                <label></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                  </div>
                  <input type="text" name="merchant_id" id="merchant_id" class="form-control pull-right">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- /.input group -->
			        <!-- <div class="form-group voucherinsert" id="pointss" style="display:none">
                <label>Poin</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-ticket"></i>
                  </div>
                  <input type="text" name="points" class="form-control pull-right vouchinsert">
                </div>
              </div> -->
              <!-- /.form group -->

              <!-- <div class="form-group voucherinsert" id="prices" style="display:none">
                <label>Amount</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-ticket"></i>
                  </div>
                  <input type="text" name="price" class="form-control pull-right vouchinsert">
                </div>
              </div> -->
              <!-- /.form group -->

            </div>
            <div class="col-md-6">
              <!-- Date -->
              <div class="form-group voucherinsert" id="expired_dates" style="display:none">
                <label>Expired date</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="expired_date" class="form-control pull-right vouchinsert" data-date-format="yyyy-mm-dd" id="datepicker">
                </div>
                <!-- /.input group -->
              </div>

              <!-- <div class="form-group voucherinsert" id="max_counts" style="display:none">
                <label>Max count</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-ticket"></i>
                  </div>
                  <input type="text" name="max_count" class="form-control pull-right vouchinsert">
                </div>
              </div> -->
              <!-- /.form group -->

			      <!-- <div class="form-group voucherinsert" id="descriptions" style="display:none">
                  <label>Description</label>
                  <textarea class="form-control vouchinsert" name="description" rows="3" style="resize: none;" placeholder="Enter ..."></textarea>
            </div> -->

			<?php echo form_close(); ?>
            </div>

          </div>
            <div class="box-footer">
              <a class="btn btn-success" style="float:left" onclick="$('#addVoucherMerchantBTN').hide();$('#voucherList,.btn-actions').show();$('#inputVoucher').submit();">
                      <i class="fa fa-save"></i> Submit
              </a>
              <a class="btn btn-warning" style="float:left;margin-left:15px;" onclick="$('#addVoucherMerchantBTN').hide();$('#voucherList,.btn-actions').show();">
                      <i class="fa fa-undo"></i> Cancel
              </a>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</div>

      </div>

				<div class="col-md-12" id="addVoucher" style="display:none">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Add merchant</h3>
            </div>
            <div class="box-body">
      <?php echo form_open_multipart($this->config->item('base_url').'/voucher/create', array('id' => 'manualVoucher'));?>
              <!-- Date
              <div class="form-group">
                <label>Voucher code:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-ticket"></i>
                  </div>
                  <input type="text" name="voucher_code" class="form-control pull-right">
                </div>
              </div>
              <!-- /.form group -->

			<!-- Date -->
			   <div class="form-group">
                <label>Name:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-ticket"></i>
                  </div>
                  <input type="text" name="name" class="form-control pull-right">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

			      <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="description" rows="3" style="resize: none;" placeholder="Enter ..."></textarea>
            </div>

            <div class="form-group">
								<label for="name">Photo</label>
								<input class="form-control-file <?php echo form_error('userfile') ? 'is-invalid':'' ?>"
								 type="file" name="userfile" />
								<div class="invalid-feedback">
									<?php echo form_error('userfile') ?>
								</div>
							</div>

              <!-- Date range -->
			      <div class="form-group" data-select2-id="25">
                <label>Category</label>
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" onchange="$('#category').val($(this).find(':selected').text());" data-select2-id="1" tabindex="-1" aria-hidden="true">
                  <option selected="selected" data-select2-id="3">Select category</option>
                 <?php for($i=0; $i<count($category); $i++){

?>
                  <option data-select2-id="27"><?php echo $category[$i]['category'];?></option>
                 <?php } ?>
                </select>
              </div>
              <!-- /.form group -->

              <!-- Date and time range -->
              <div class="form-group" style="display:none">
                <label>Category:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                  </div>
                  <input type="text" name="category" id="category" class="form-control pull-right">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- Date and time range 
              <div class="form-group">
                <label>Values:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                  </div>
                  <input type="text" name="value" class="form-control pull-right">
                </div>
              </div>
              <!-- /.form group -->

              <!-- Date and time range -->
              <div class="form-group">
                <label>Price:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-dollar"></i>
                  </div>
                  <input type="text"  name="price" class="form-control pull-right">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- Date and time range -->
              <div class="form-group">
                <label>Points:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-circle"></i>
                  </div>
                  <input type="text"  name="points" class="form-control pull-right">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->




			  <div class="form-group">
                  <label>Term and Condition</label>
                  <textarea class="form-control" name="tc" rows="3" style="resize: none;" placeholder="Enter ..."></textarea>
            </div>

			<?php echo form_close(); ?>
            </div>
			<div class="box-footer">
			 <a class="btn btn-app" style="float:right" onclick="$('#addVoucher').hide();$('#voucherList,.btn-actions').show();$('#manualVoucher').submit();">
                <i class="fa fa-save"></i> Save
              </a>
			  <a class="btn btn-app" style="float:right" onclick="$('#addVoucher').hide();$('#voucherList,.btn-actions').show();">
                <i class="fa fa-undo"></i> Cancel
              </a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          </div>
          <!-- /.box -->
        </div>
	        </div>
	    </div>
	</section>

    <!-- End Main content -->
</div>
<script type="text/javascript">
	$(document).ready(function() {
		// this is the id of the form
  $("#voucher_code_val").keyup(function(e) {
    setTimeout(function(){
    var valength = $("#voucher_code_val").val().length;
      if(valength > 0){
        $("#csvfile").val('');
        $('#csvfiles').hide('slow');
        $(".voucherinsert").show('slow');
      } else {
        $("#csvfile").val('');
        $('#csvfiles').show('slow');
        $(".voucherinsert").hide('slow');
      }
    }, 500);
  });

  $("#csvfile").change(function(e) {
   // alert('test');
  e.preventDefault();
  var form = $(this);
  var url = "<?php echo $this->config->item('base_url').'/voucher/checkCSV'; ?>";
  var formData = new FormData();
  var file = $("#csvfile")[0].files[0];
  formData.set("csvfile", file);
	$.ajax({
		   type: "POST",
		   url: url,
	     mimeType: "multipart/form-data",
	     data:formData, //penggunaan FormData
	      processData:false,
	      contentType:false,
	      cache:false,
	      async:false,
		   success: function(success)
		   {
        $('.voucherinsert').hide();
        $('.vouchinsert').val('');
        $('#voucher_codes').show();
        var resp = JSON.parse(success);
        console.log(resp['data']);
        if(!resp['data'].includes('voucher_code')) {
            alert("Data is not valid. CSV file must have voucher_code coloumn.")
            $("#csvfile").val('');
            return false;
          } else {
            $('#voucher_codes').hide('slow');
            if(resp['data'].includes('voucher_code') && !resp['data'].includes('merchant')) {
              $("#merchant_ids").show('slow');
            }
            // if(resp['data'].includes('voucher_code') && !resp['data'].includes('points')) {
            //   $("#pointss").show('slow');
            // }
            // if(resp['data'].includes('voucher_code') && !resp['data'].includes('amount')) {
            //   $("#prices").show('slow');
            // }
            // if(resp['data'].includes('voucher_code') && !resp['data'].includes('description')) {
            //   $("#descriptions").show('slow');
            // }
            // if(resp['data'].includes('voucher_code') && !resp['data'].includes('max_count')) {
            //   $("#max_counts").show('slow');
            // }
            if(resp['data'].includes('voucher_code') && !resp['data'].includes('expired_date')) {
              $("#expired_dates").show('slow');
            }
          }
        if(resp['ext'] == 'csv'){
          resp['data'].forEach(function (item, index) {
          console.log(item);
        });
        } else {
          alert("File is not valid")
          $("#csvfile").val('');
        }

		   }
		 });
  });

  $("#inputVoucher").submit(function(e) {
	e.preventDefault();
	var form = $(this);
	var url = form.attr('action');
	$.ajax({
		   type: "POST",
		   url: url,
	     mimeType: "multipart/form-data",
	     data:new FormData(this), //penggunaan FormData
	      processData:false,
	      contentType:false,
	      cache:false,
	      async:false,
		   success: function(success)
		   {
        var resp = JSON.parse(success);
        $('#addVoucherMerchantBTN').hide();
        $('#voucherList,.btn-actions').show();
        alert(resp['message']);
			  location.reload();
		   }
		 });
  });

	});
	// $(document).on('click', ':not(form)[data-confirm]', function(e){
	//         if(!confirm($(this).data('confirm'))){
	//             e.stopImmediatePropagation();
	//             e.preventDefault();
	//         }
	// });
</script>
<script type="text/javascript">
function saveMerchantId(name, mrchnt){
  localStorage.setItem("merchant_id", mrchnt);
  localStorage.setItem("merchant_name", name);
  $("#merchant_id").val(mrchnt);
  $('#addVoucherMerchantBTN').show();
  $('#voucherList,.btn-actions').hide();
  $("#addvoucherheader").text("Add data voucher for merchant " + localStorage.getItem("merchant_name"))
  // alert(localStorage.getItem("merchant_id"));
}
</script>
<script type="text/javascript">
$(document).ready(function() {
	$('#example').DataTable( {
        "pagingType": "full_numbers"
	} );
	// this is the id of the form
$("#manualVoucher").submit(function(e) {
e.preventDefault();
var form = $(this);
var url = form.attr('action');
$.ajax({
	   type: "POST",
	   url: url,
     mimeType: "multipart/form-data",
     data:new FormData(this), //penggunaan FormData
      processData:false,
      contentType:false,
      cache:false,
      async:false,
	   success: function(success)
	   {
      var resp = JSON.parse(success);
		  alert(resp['message']);
		  location.reload();
	   }
	 });
});
});
$(document).on('click', ':not(form)[data-confirm]', function(e){
        if(!confirm($(this).data('confirm'))){
            e.stopImmediatePropagation();
            e.preventDefault();
        }
    });
</script>
<!-- End Content Wrapper. Contains page content
