<!-- Content Wrapper. Contains page content -->
   <!-- member terdaftar -->
   <!-- <div class="btn btn-info">member terdaftar :<?php // print_r($total_member);?></div> -->



  <div class="content-wrapper">
    <?php if($this->session->userdata['user_data']['role'] != 2 && $this->session->userdata['user_data']['role'] !=4
     ){ ?>
    <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>
            Dashboard
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
        </section>

        <!-- Main content -->
        <section class="content">



 <!-- Info boxes -->
 <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-rub"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Point Today</span>
              <span class="info-box-number" id="stats-point-today">
               	<center>234</center>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-bag"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Redeem Point <br> Today</span>
              <span class="info-box-number" id="stats-point-redeem">
               	<center><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></center>
                 </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa  fa-exchange"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Exchange Point <br> Today</span>
              <span class="info-box-number" id="stats-point-exchange">
               	<center><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></center>
                 </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa  fa-group"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Member Mobile</span>
              <span class="info-box-number" id="stats-point-member">
               	<center><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></center>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
            <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fa  fa-group"></i></span>

                    <div class="info-box-content">
                    <span class="info-box-text">Total Member Website</span>
                    <span class="info-box-number" id="stats-point-member_website">
                        <center><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div></center>
                    </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->






         


             <!-- member terdaftar -->
            <!-- <div class="bg-danger" style="margin-bottom:10px; width:300px; height:30px; text-align:center; border-radius:10px; background:yellow; border:solid 1px blue;">Jumlah Member Terdaftar :<?php echo  number_format($total_member,0,",",".");?></div> -->


             <!-- AREA CHART -->
            <div class="box box-primary">
                <div class="box-header with-border">
                <?php if(count($member_total_poin_perday)>0){ ?>
                    <h3 class="box-title">Daily Point Chart</h3>
                <?php }else if(count($member_total_poin_weekly)>0){ ?>
                    <h3 class="box-title">Weekly Point Chart</h3>
                <?php } else if(count($member_total_poin_monthly)>0){?>
                    <h3 class="box-title">Monthly Point Chart</h3>
                <?php } else if(count($get_distribution_exchange)>0){?>
                    <h3 class="box-title">Point Distribution Exchange</h3>
                <?php } else if(count($get_distribution_redeem)>0){?>
                    <h3 class="box-title">Point Distribution Redeem </h3>
                <?php }else { ?>
                    <h3 class="box-title">other Point Chart</h3>
                <?php } ?>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                </div>
                </div>
                <div class="box-body">
                   <div class="row" style="display: flex;margin-left: 0;margin-right: 0;border-bottom: 1px solid rgb(230,230,230);">
                            <form style="display: flex;" role="form" action="<?php echo $this->config->item('base_url'); ?>welcome/analitics" method="post">
                                <!-- <div class="row" style="text-align: left;"> -->

                                  <!--   <div  style="padding: 10px 0 10px 5px;margin-top: auto;margin-bottom: auto;">
                                    <?php //print_r($_SESSION["session_data"]['program_code']); ?>
                                    Filter by:
                                    </div> -->

                                    <div style="padding: 10px 0 10px 0;margin-top:auto;margin-bottom:auto;">
                                        <select class="form-control" name="program_code">
                                            <option value="" selected disabled="true">Filter By </option>
                                            <option value="point_daily" <?php if($_SESSION["session_data"]['program_code'] == 'point_daily'){ echo'selected'; } ?>>Daily Point</option>
                                            <option value="point_weekly" <?php if($_SESSION["session_data"]['program_code']== 'point_weekly'){ echo'selected'; } ?>>Weekly Point</option>
                                            <option value="point_monthly" <?php if($_SESSION["session_data"]['program_code']== 'point_monthly'){ echo'selected'; } ?>>Monthly Point</option>
                                            <option value="point_distribution_redeem" <?php if($_SESSION["session_data"]['program_code'] == 'point_distribution_redeem'){ echo'selected'; } ?>>Distribution Point Redeem</option>
                                            <option value="point_distribution_exchange" <?php if($_SESSION["session_data"]['program_code'] == 'point_distribution_exchange'){ echo'selected'; } ?>>Distribution Point Exchange</option>

                                        </select>
                                    </div>

                                   <!--  <div  style="padding: 10px 0 10px 5px;margin-top:auto;margin-bottom:auto;">
                                    Date Start:
                                    </div> -->

                                    <div style="padding: 10px 0 10px 5px;margin-top:auto;margin-bottom:auto;">
                                        <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" required  placeholder="Date Start" class="form-control pull-right" id="datepicker2" name="to_date" value="<?php if($to_date != ''){ echo $to_date; } ?>">
                                        </div>
                                    </div>

                                   <!--  <div  style="padding: 10px 0 10px 5px;margin-top:auto;margin-bottom:auto;">
                                    Date End:
                                    </div> -->

                                    <div style="padding: 10px 0 10px 5px;margin-top:auto;margin-bottom:auto;">
                                        <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" required placeholder="Date End" class="form-control pull-right" id="datepicker" name="from_date" value="<?php if($from_date != ''){ echo $from_date; } ?>">
                                        </div>
                                    </div>

                                    <div  style="padding: 10px 0 10px 5px;margin-top:auto;margin-bottom:auto;">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                <!-- </div> -->
                                        <!-- member terdaftar -->
                                <!-- <div class="btn btn-info">member terdaftar :<?php //echo count($get_member);?>:<?php //echo count($member);?></div> -->


                            </form>


                            <div style="text-align: right;">
                                <form role="form" action="<?php echo $this->config->item('base_url'); ?>welcome/download_analitics" method="post">
                                    <input type="hidden" class="form-control pull-right" id="program_code" name="program_code" value="<?php echo $program_code; ?>">
                                    <input type="hidden" class="form-control pull-right" id="from_date" name="from_date" value="<?php echo $explode_from_date; ?>">
                                    <input type="hidden" class="form-control pull-right" id="to_date" name="to_date" value="<?php echo $explode_to_date; ?>">
                                    <?php for ($i=0; $i<count($member_total_poin_perday); $i++){?>
                                        <input type="hidden" class="form-control pull-right" id="detail_point" name="detail_point[<?php echo $i; ?>]" value="<?php echo $member_total_poin_perday[$i][0]['Total']; ?>">
                                        <input type="hidden" class="form-control pull-right" id="detail_date" name="detail_date[<?php echo $i; ?>]" value="<?php echo $date[$i]; ?>">
                                    <?php };?>
                                    <?php for ($i=0; $i<count($member_total_poin_weekly); $i++){?>
                                        <input type="hidden" class="form-control pull-right" id="detail_point" name="detail_point[<?php echo $i; ?>]" value="<?php echo $member_total_poin_weekly[$i]['Total']; ?>">
                                        <input type="hidden" class="form-control pull-right" id="detail_date" name="detail_date[<?php echo $i; ?>]" value="<?php echo $member_total_poin_weekly[$i]['week']; ?>">
                                    <?php };?>
                                    <?php for ($i=0; $i<count($member_total_poin_monthly); $i++){?>
                                        <input type="hidden" class="form-control pull-right" id="detail_point" name="detail_point[<?php echo $i; ?>]" value="<?php echo $member_total_poin_monthly[$i]['Total']; ?>">
                                        <input type="hidden" class="form-control pull-right" id="detail_date" name="detail_date[<?php echo $i; ?>]" value="<?php echo $member_total_poin_monthly[$i]['month']; ?>">
                                    <?php };?>
                                    <?php for ($i=0; $i<count($get_distribution_exchange); $i++){?>
                                        <input type="hidden" class="form-control pull-right" id="detail_point" name="detail_point[<?php echo $i; ?>]" value="<?php echo $get_distribution_exchange[$i]['Total']; ?>">
                                        <input type="hidden" class="form-control pull-right" id="detail_date" name="detail_date[<?php echo $i; ?>]" value="<?php echo $get_distribution_exchange[$i]['month']; ?>">
                                    <?php };?> <?php for ($i=0; $i<count($get_distribution_redeem); $i++){?>
                                        <input type="hidden" class="form-control pull-right" id="detail_point" name="detail_point[<?php echo $i; ?>]" value="<?php echo $get_distribution_redeem[$i]['Total']; ?>">
                                        <input type="hidden" class="form-control pull-right" id="detail_date" name="detail_date[<?php echo $i; ?>]" value="<?php echo $get_distribution_redeem[$i]['month']; ?>">
                                    <?php };?>


                                    <button type="submit" class="btn btn-app" name="target" value="internal" style="font-size: 13px;margin-right: 3px;width: auto;height:auto;min-width: auto;padding: 0;padding-left: 30px;padding-right: 30px;padding-top: 7px;padding-bottom: 7px;float: right;position: absolute;right: 10px;margin-top: 8px;">
                                        <div class="row" style="display: flex;">
                                            <div>
                                                <i style="font-size: 13px;margin-right: 10px;vertical-align: -2px;" class="fa fa-download"></i>
                                            </div>
                                            <div>
                                                Download Analitics
                                            </div>
                                        </div>
                                    </button>
                                </form>
                            </div>



                   </div>
                <div class="chart">
                    <canvas id="areaChart" style="height:350px"></canvas>
                    <div id="point-today">
                    <?php
                    //echo"<pre>";print_r($member_total_poin_perday); echo "</pre></br>".count($member_total_poin_perday);
                    for ($i=0; $i<count($member_total_poin_perday); $i++){
                        echo "<br>Point ". $date[$i]." = ".number_format($member_total_poin_perday[$i][0]['Total'],0,",",".");
                    };
                    for ($i=0; $i<count($member_total_poin_weekly); $i++){
                        echo "<br>Point ". $member_total_poin_weekly[$i]['week']." = ".number_format($member_total_poin_weekly[$i]['Total'],0,",",".");
                    };
                    for ($i=0; $i<count($member_total_poin_monthly); $i++){
                        echo "<br>Point ". $member_total_poin_monthly[$i]['month']." = ".number_format($member_total_poin_monthly[$i]['Total'],0,",",".");
                    };
                    for ($i=0; $i<count($get_distribution_redeem); $i++){
                        echo "<br>Point Redeem = ".number_format($get_distribution_redeem[$i]['Total'],0,",",".");
                    };
                    for ($i=0; $i<count($get_distribution_exchange); $i++){
                        echo "<br>Point Exchange = ".number_format($get_distribution_exchange[$i]['Total'],0,",",".");
                    };
                    ?>
                </div>
                </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- DONUT CHART -->
            <!-- <div class="box box-danger">
            <div class="box-header with-border">

            </div>

            </div> -->












             <div class="box">
                <div class="box-header">
                <h3 class="box-title">10 Latest Member History Point</h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                    <th>No</th>
                    <th>CIFNO</th>
                    <th>ACCTNO</th>
                    <th>EXPIRE DATE</th>
                    <th>DATE RELATED</th>
                    <th>POINT</th>
                    <th>POINT CODE</th>
                    </tr>
                    <?php
                    if(count($member_history) > 0){
                    for($i=0; $i<count($member_history); $i++){
                    ?>
                    <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $member_history[$i]['CIFNO']; ?></td>
                    <td><?php echo $member_history[$i]['ACCTNO']; ?></td>
                    <td><?php echo $member_history[$i]['expire_date']; ?></td>
                    <td><?php echo $member_history[$i]['date_related']; ?></td>
                    <td><?php echo $member_history[$i]['point']; ?></td>
                    <td><?php echo $member_history[$i]['poin_code']; ?></td>
                    </tr>
                    <?php
                    }
                    }else{
                    ?>
                    <tr><td colspan="7">No transaction</td></tr>
                    <?php
                    }
                    ?>
                </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->


            <div class="box">
                <div class="box-header">
                <h3 class="box-title">10 Latest Member Transaction History Point</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                    <th>No</th>
                    <th>Member ID</th>
                    <!-- <th>Merchant </th> -->
                    <th>Program ID</th>
                    <th>Code BTN</th>
                    <!-- <th>Date Created</th> -->
                    <th>Redeem Code</th>
                    <th>Redeem Date</th>
                    <th>Redeem Point</th>
                    <th>Exchange Code</th>
                    <th>Exchange Date</th>
                    <th>Exchange Poin</th>
                    </tr>
                    <?php
                    if(count($member_transaction_history) > 0){
                    for($i=0; $i<count($member_transaction_history); $i++){
                    ?>
                    <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $member_transaction_history[$i]['member_id']; ?></td>
                    <!-- <td><?php echo $member_transaction_history[$i]['name']; ?></td> -->
                    <td><?php echo $member_transaction_history[$i]['program_id']; ?></td>
                    <td><?php echo $member_transaction_history[$i]['transcode_btn']; ?></td>
                    <!-- <td><?php // echo date('Y-m-d', strtotime($member_transaction_history[$i]['transcode_btn_date'])); ?></td> -->
                    <!-- <td><?php //echo $member_transaction_history[$i]['transcode_btn_date']; ?></td> -->
                    <td><?php echo $member_transaction_history[$i]['redeem_code']; ?></td>
                    <td><?php echo $member_transaction_history[$i]['redeem_date']; ?></td>
                    <td><?php echo $member_transaction_history[$i]['redeem_poin']; ?></td>
                    <td><?php echo $member_transaction_history[$i]['exchange_code']; ?></td>
                    <!-- <td><?php // echo date('Y-m-d', strtotime($member_transaction_history[$i]['exchange_date'])); ?></td> -->
                    <td><?php echo $member_transaction_history[$i]['exchange_date']; ?></td>

                    <td><?php echo $member_transaction_history[$i]['exchange_poin']; ?></td>
                    </tr>
                    <?php
                    }
                    }else{
                    ?>
                    <tr><td colspan="7">No transaction history</td></tr>
                    <?php
                    }
                    ?>
                </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- BAR CHART -->
            <div class="box box-success" style="visibility: hidden">
                <div class="box-header with-border">
                <h3 class="box-title">Bar Chart</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                </div>
                </div>
                <div class="box-body">
                    <!-- /.box -->
                    <div class="chart">
                        <canvas id="barChart" style="height:230px"></canvas>
                    </div>
                        <!-- /.box-body -->
                </div>
            </div>

        </section>
    <!-- /.content -->
   
    <?php } else{?>
        <section class="content-header">
        <h1>
            Approver
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
        </section>
   


    <?php } ?>
  </div>
  <!-- /.content-wrapper -->

   <!-- ChartJS -->
<script src="<?php echo $this->config->item('assets_url');?>assets/bower_components/chart.js/Chart.js" ></script>

<!-- page script -->
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
    //daily
    var labelsArr = new Array();
    <?php foreach($date as $key => $val){ ?>
        labelsArr.push('<?php echo $val; ?>');
    <?php } ?>
    var dataArr = new Array();

    <?php
        for ($i=0; $i<count($member_total_poin_perday); $i++){
            foreach($member_total_poin_perday[$i][0] as $key => $val){ ?>
                // var x = <?php //echo $val; ?>;
                // var c = x.toLocaleString('id-ID');
                dataArr.push('<?php echo $val; ?>');
    <?php   }
        } ?>

    //weekly
    <?php
        for ($i=0; $i<count($member_total_poin_weekly); $i++){
            //foreach($member_total_poin_weekly[$i] as $key => $val){
               ?>
                // var x = <?php //echo $member_total_poin_weekly[$i]['Total']; ?>;
                // var c = x.toLocaleString('id-ID');
                labelsArr.push('<?php echo $member_total_poin_weekly[$i]['week']; ?>');
                dataArr.push('<?php echo $member_total_poin_weekly[$i]['Total']; ?>');
        <?php  //}
    } ?>
    //mothly member_total_poin_monthly
    <?php
        for ($i=0; $i<count($member_total_poin_monthly); $i++){
            //foreach($member_total_poin_weekly[$i] as $key => $val){
               ?>
                // var x = <?php // echo $member_total_poin_monthly[$i]['Total']; ?>;
                // var c = x.toLocaleString('id-ID');
                labelsArr.push('<?php echo $member_total_poin_monthly[$i]['month']; ?>');
                dataArr.push('<?php echo $member_total_poin_monthly[$i]['Total']; ?>');
        <?php  //}
    } ?>

     <?php
        for ($i=0; $i<count($get_distribution_redeem); $i++){
            //foreach($member_total_poin_weekly[$i] as $key => $val){
               ?>
                // var x = <?php  //echo $get_distribution_redeem[$i]['Total']; ?>;
                // var c = x.toLocaleString('id-ID');
                labelsArr.push('<?php echo $get_distribution_redeem[$i]['month']; ?>');
                dataArr.push('<?php echo $get_distribution_redeem[$i]['Total']; ?>');
        <?php  //}
    } ?>
       <?php
        for ($i=0; $i<count($get_distribution_exchange); $i++){
            //foreach($member_total_poin_weekly[$i] as $key => $val){
               ?>
                // var x = <?php //echo $get_distribution_exchange[$i]['Total']; ?>;
                // var c = x.toLocaleString('id-ID');
                labelsArr.push('<?php echo $get_distribution_exchange[$i]['month']; ?>');
                dataArr.push('<?php echo $get_distribution_exchange[$i]['Total']; ?>');
        <?php  //}
    } ?>

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d');

    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas)
    var areaChartData = {
      labels  : labelsArr,
    //['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    //   labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : dataArr//[65, 59, 80, 81, 56, 55, 40]
        //   data                : [65, 59, 80, 81, 56, 55, 40]

        }
      ]
    }
    //console.log(areaChartData.labels.toString());
    var areaChartOptions = {
        responsive: true,
            maintainAspectRatio: false,
        // tooltips: {
        //   callbacks: {
        //         label: function(tooltipItem, data) {
        //             var value = data.datasets[0].data[tooltipItem.index];
        //             if(parseInt(value) >= 1000){
        //                        return '$' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        //                     } else {
        //                        return '$' + value;
        //                     }
        //         }
        //   } // end callbacks:
        // }, //end tooltips
        //     scales: {
        //         yAxes: [{
        //             ticks: {
        //                 beginAtZero:true,
        //                 callback: function(value, index, values) {
        //                     if(parseInt(value) >= 1000){
        //                        return '$' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        //                     } else {
        //                        return '$' + value;
        //                     }
        //                }
        //             }
        //         }]
        //     },
        animation: false,
        scaleLabel: function(labelsArr){
            return labelsArr.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            // return dataArr.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        },
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.08)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : true,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }
     //Create the line chart
     areaChart.Line(areaChartData, areaChartOptions);


    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    barChartData.datasets[1].fillColor   = '#00a65a'
    barChartData.datasets[1].strokeColor = '#00a65a'
    barChartData.datasets[1].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
    //   pointDot                : true,

      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    // var pieChart       = new Chart(pieChartCanvas)
    // var month = <?php //  echo $member_total_poin_monthly[$i]['Total']; ?>;
    // month = month.toLocaleString('id-ID');
    var PieData        = [
    //   {
    //     value    : <?php // echo $member_total_poin[0]['Total'];?>,//700,
    //     color    : '#f56954',
    //     highlight: '#f56954',
    //     label    : 'Total Point To date'
    //   },
    //   {
    //     value    : <?php //echo $member_total_poin_daily[0]['Total']; ?>,
    //     color    : '#00a65a',
    //     highlight: '#00a65a',
    //     label    : 'Total Point Today'
    //   },
    //   {
    //     value    :  <?php //  echo $member_total_poin_monthly[0]['Total']; ?>,
    //     color    : '#f39c12',
    //     highlight: '#f39c12',
    //     label    : 'Total Point Monthly'
    //   },
    //   {
    //     value    :  <?php // echo $get_distribution_redeem[0]['Total']; ?>,
    //     color    : '#f39c12',
    //     highlight: '#f39c12',
    //     label    : 'Total Point Monthly'
    //   },
    //   {
    //     value    :  <?php //echo $get_distribution[0]['Total']; ?>,
    //     color    : '#f39c12',
    //     highlight: '#f39c12',
    //     label    : 'Total Point Monthly'
    //   },



        //   {
        //     value    : 600,
        //     color    : '#00c0ef',
        //     highlight: '#00c0ef',
        //     label    : 'Safari'
        //   },
        //   {
        //     value    : 300,
        //     color    : '#3c8dbc',
        //     highlight: '#3c8dbc',
        //     label    : 'Opera'
        //   },
        //   {
        //     value    : 100,
        //     color    : '#d2d6de',
        //     highlight: '#d2d6de',
        //     label    : 'Navigator'
        //   }
    ]
    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : false,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions)
</script>

<script type="text/javascript">

	window.onload = function(){
		$.ajax({
			url : "<?php echo $this->config->item('base_url'); ?>dashboard",
			success : function(result){
				var res = JSON.parse(result);
        console.log(res);
				console.log(result);
				document.getElementById("stats-point-today").innerHTML = res.stats_member_total_poin_daily.toLocaleString('id-ID');
				document.getElementById("stats-point-exchange").innerHTML = res.get_poin_exchange_day.toLocaleString('id-ID');
				document.getElementById("stats-point-redeem").innerHTML = res.get_poin_redeem_day.toLocaleString('id-ID');
				document.getElementById("stats-point-member").innerHTML = res.total_member.toLocaleString('id-ID');
				document.getElementById("stats-point-member_website").innerHTML = res.total_member_register.toLocaleString('id-ID');
			}
		});
	}

    $(document).ready(function() {

        var table =$('#approval').DataTable( {
            "bDeferRender": true,
            "processing": true,
            "serverSide": true,
            "bFilter": true,
            "ajax": "<?php echo $this->config->item('base_url'); ?>welcome/datatables",
            "type": "GET",
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            }
        } );


    } );
</script>
