<!-- Content Wrapper. Contains page content -->
<style type="text/css">
    #double_scroll{
        width: 400px;
    }
</style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Member Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>member">Member</a></li>
        <li class="active">profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
            <center><img width="100%" height="auto" style="border-radius: 250px" src="<?php echo $this->config->item('assets_url');?><?php echo $member[0]['img'] ? $member[0]['img'] : 'uploads/logo/foto-profil.png'; ?>"/></center>
              <h3 class="profile-username text-center"><?php echo $member[0]['first_name']; ?> <?php echo $member[0]['last_name']; ?></h3>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right d-flex"><?php echo $member[0]['email']; ?> </a>

                </li>
                <!-- <br> -->
                <li class="list-group-item">
                  <b>Phone</b> <a class="pull-right"><?php echo $member[0]['phone']; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Cif</b> <a class="pull-right"><?php echo $member[0]['cif']; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Rekening</b> <a class="pull-right"><?php echo $member[0]['rekening']; ?></a>
                </li>
              </ul>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#history" data-toggle="tab">Point History</a></li>
                 <li ><a href="#activity" data-toggle="tab">Point Exchange</a></li>

                <!-- <li><a href="#timeline" data-toggle="tab">Redeem</a></li> -->
                <li><a href="#redeem_giift" data-toggle="tab">Redeem Voucher</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane" id="activity">
                    <table class="table table-bordered">
                        <tr>
                        <th style="width: 10px">#</th>
                        <th>Program name</th>
                        <th>Exchange Point</th>
                        <th>No Ref</th>
                        <th>No tujuan</th>
                        <th>Current Point</th>
                        <th>Update by</th>
                        <th style="width: 40px">Exchange Date</th>
                        </tr>
                            <?php
                            if(count($point) > 0){
                                for($i=0; $i<count($point); $i++){
                            ?>
                            <tr>
                                <td><?php echo $i+1; ?></td>
                                <td><?php echo $point[$i]['name']; ?></td>
                                <td><?php echo $point[$i]['exchange_poin']; ?></td>
                                <!-- tambahan maliki -->
                                <td><?php echo $point[$i]['code_tujuan']; ?></td>
                                <td><?php echo $point[$i]['phone_tujuan']; ?></td>

                                <td><?php echo $point[$i]['current_point']; ?></td>
                                <td><?php echo $point[$i]['date_created']; ?></td>
                                <td><span><?php echo $point[$i]['exchange_date']; ?></span></td>
                            </tr>
                            <?php
                                }
                            }else{
                            ?>
                            <tr>
                                <td colspan="3">Point is null</td>
                            </tr>
                            <?php
                            }
                            ?>

                    </table>
                </div>

                <!-- /.tab-pane -->
<!--                 <div class="tab-pane" id="timeline">
                    <table class="table table-bordered">
                        <tr>
                        <th style="width: 10px">#</th>
                        <th>Program name</th>
                        <th>Redeem Point</th>
                        <th>Current Point</th>
                        <th style="width: 40px">Redeem Date</th>
                        </tr>
                            <?php
                            if(count($point) > 0){
                                for($i=0; $i<count($redeem); $i++){
                            ?>
                            <tr>
                                <td><?php echo $i+1; ?></td>
                                <td><?php echo $redeem[$i]['name']; ?></td>
                                <td><?php echo $redeem[$i]['redeem_poin']; ?></td>
                                <td><?php echo $redeem[$i]['current_point']; ?></td>
                                <td><span><?php echo $redeem[$i]['redeem_date']; ?></span></td>
                            </tr>
                            <?php
                                }
                            }else{
                            ?>
                            <tr>
                                <td colspan="3">Point is null</td>
                            </tr>
                            <?php
                            }
                            ?>

                    </table>
                </div> -->
                <!-- /.tab-pane -->
                 <!-- /.tab-pane -->
                <div class="tab-pane" id="redeem_giift">
                    <!-- The timeline -->
                    <div  style="overflow-x: auto;" >
                    <table class="table table-borderedtable-hover">
                        <?php// print_r($redeem_giift);  ?>
                        <tr>
                        <th style="width: 10px">#</th>
                        <th>Nama Merchant</th>
                        <th>Voucher Value</th>
                        <th>Redeem Point</th>
                        <th>Email Tujuan </th>
                        <th>Kode Referensi </th>
                        <!-- <th>Kode Merchant </th> -->
                        <th>Current Point</th>
                        <th>Giift Order Id</th>
                        <th style="width: 40px">Redeem Date</th>
                        <th>Status </th>

                        </tr>
                            <?php
                            if(count($redeem_giift) > 0){
                                for($i=0; $i<count($redeem_giift); $i++){
                            ?>
                            <tr>
                                <td><?php echo $i+1; ?></td>
                                <td><?php echo $redeem_giift[$i]['giift_name']; ?></td>
                                <td><?php echo $redeem_giift[$i]['giift_value']; ?></td>
                                <td><?php echo $redeem_giift[$i]['redeem_poin']; ?></td>
                                <td><?php echo $redeem_giift[$i]['email_tujuan']; ?></td>
                                <td><?php echo $redeem_giift[$i]['transcode_btn']; ?></td>
                                <!-- <td><?php echo $redeem_giift[$i]['giift_dmo_id']; ?></td> -->
                                <td><?php echo $redeem_giift[$i]['current_point']; ?></td>
                                <td><?php echo $redeem_giift[$i]['giift_order_id']; ?></td>
                                <td><span><?php echo $redeem_giift[$i]['redeem_date']; ?></span></td>
                                <td><?php echo $redeem_giift[$i]['status']; ?></td>

                            </tr>
                            <?php
                                }
                            }else{
                            ?>
                            <tr>
                                <td colspan="3">Point is null</td>
                            </tr>
                            <?php
                            }
                            ?>

                    </table>
                    </div>
                </div>
                <!-- /.tab-pane -->

                <div class="active tab-pane" id="history">
                   <!-- The history -->
                   <table class="table table-bordered">
                        <tr>
                        <th style="width: 10px">#</th>
                        <th>Point code name</th>
                        <th>Point</th>
                        <th > Date Related</th>
                        <th>Point Expire</th>
                        <th>Expire Date</th>
                        <!-- <th > Date Related</th> -->
                        </tr>
                                <tr>
                                    <h4>Total Point :  <?php  echo number_format($total_poin[0]['total']?? 0,0,",","."); ?></h4>
                                </tr>
                            <?php
                            //print_r($history);
                            if(count($history) > 0){
                                $x=0;
                                for($i=0; $i<count($history); $i++){
                            ?>
                            <tr>
                                <td><?php echo $i+1; ?></td>
                                <td><?php echo $history[$x]['poin_code']; ?></td>
                                <td><?php echo number_format($history[$x]['point']?? 0,0,",","."); ?></td>
                                <td><span><?php echo $history[$x]['date_related']; ?></span></td>
                                <td><?php echo number_format($history[$x]['expire_point']?? 0,0,",","."); ?></td>
                                <td><?php echo date('Y-m-d',strtotime($history[$x]['expire_date'])); ?></td>
                            </tr>

                            <?php
                                $x++;} ?>
                                <tr>
                                    <!-- <h4>Total Point : 4 <?php  //echo number_format($history[0]['total']?? 0,0,",","."); ?></h4> -->
                                </tr>
                            <?php
                            }else{
                            ?>
                            <tr>
                                <td colspan="3">History is null</td>
                            </tr>
                            <?php
                            }
                            ?>

                    </table>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>

          <!-- /.nav-tabs-custom -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!--  /.content-wrapper -->



    <script type="text/javascript">
        $(document).ready(function(){
            $('#double_scroll').double_scroll();
        });
    </script>
