<!-- Content Wrapper. Contains page content -->
   <!-- member terdaftar -->
   <!-- <div class="btn btn-info">member terdaftar :<?php // print_r($total_member);?></div> -->



  <div class="content-wrapper">
    <?php if($this->session->userdata['user_data_web']['role'] != 2 && $this->session->userdata['user_data_web']['role'] !=4
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

  

            <?php if($this->session->flashdata('msgalert')){ ;?>
                <div class="alert alert-success" role="alert">
                    <strong><?php echo $this->session->flashdata('msgalert');?></strong>
                </div>
            <?php } ;?>
            <form role="form" action="<?php echo $this->config->item('base_url'); ?>welcome/analitics" method="post">
                <div style="text-align: left;">
                    <div class="col-xs-1" style="padding: 10px 0 10px 5px;">
                    Filter by:
                    </div>
                    <div class="col-xs-2" style="padding: 10px 0 10px 0;">
                    <select class="form-control" name="program_code">
                        <option value="" selected>Select Program</option>
                        <option value="point_daily" >Daily Point</option>
                        <option value="point_weekly" >Weekly Point</option>
                        <option value="point_monthly" >Monthly Point</option>
                        <option value="point_distribution" >Distribution Point</option>
                        <?php if($program_code != '' ) { ?>
                        <option selected value="<?php if($program_code != ''){ echo $program_code; } ?>" ><?php if($program_code != ''){ echo $program_code; } ?></option>
                        <?php }?>
                        <?php
                       // if(count($program) > 0){
                         //   for($i=0; $i<count($program); $i++){
                        ?>
                            <!-- <option value="<?php // echo $program[$i]['program_code']; ?>" <?php // if($program[$i]['program_code'] == $program_code){ echo'selected';} ?>><?php //echo $program[$i]['program_name']; ?></option> -->
                        <?php
                        //   }
                        //}
                        ?>
                    </select>
                    </div>
                    <div class="col-xs-1" style="padding: 10px 0 10px 5px;">
                    Date Start:
                    </div>
                    <div class="col-xs-2" style="padding: 10px 0 10px 5px;">
                        <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker2" name="to_date" value="<?php if($to_date != ''){ echo $to_date; } ?>">
                        </div>
                    </div>
                    <div class="col-xs-1" style="padding: 10px 0 10px 5px;">
                    Date End:
                    </div>
                    <div class="col-xs-2" style="padding: 10px 0 10px 5px;">
                        <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker" name="from_date" value="<?php if($from_date != ''){ echo $from_date; } ?>">
                        </div>
                    </div>
                    
                    <div class="col-xs-2" style="padding: 10px 0 10px 5px;">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
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
                    
                    
                    <button type="submit" class="btn btn-app" name="target" value="internal">
                        <i class="fa fa-download"></i> Download Analitics</button>&nbsp;
                </form>
            </div>
            
             <!-- member terdaftar -->
            <div class="btn btn-info" style="margin-bottom:10px;">Jumlah Member Terdaftar :<?php echo  number_format($total_member);?></div>



             <!-- AREA CHART -->
            <div class="box box-primary">
                <div class="box-header with-border">
                <?php if(count($member_total_poin_perday)>0){ ?>
                    <h3 class="box-title">Daily Point Chart</h3>
                <?php }else if(count($member_total_poin_weekly)>0){ ?>
                    <h3 class="box-title">Weekly Point Chart</h3>
                <?php } else if(count($member_total_poin_monthly)>0){?>
                    <h3 class="box-title">Monthly Point Chart</h3>
                <?php }else { ?>
                    <h3 class="box-title">other Point Chart</h3>
                <?php } ?>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                </div>
                <div class="box-body">
                <div class="chart">
                    <canvas id="areaChart" style="height:250px"></canvas>
                    <div>
                    <?php 
                    //echo"<pre>";print_r($member_total_poin_perday); echo "</pre></br>".count($member_total_poin_perday);
                    for ($i=0; $i<count($member_total_poin_perday); $i++){
                        echo "<br>Point ". $date[$i]." = ".number_format($member_total_poin_perday[$i][0]['Total']);
                    };
                    for ($i=0; $i<count($member_total_poin_weekly); $i++){
                        echo "<br>Point ". $member_total_poin_weekly[$i]['week']." = ".number_format($member_total_poin_weekly[$i]['Total']);
                    };
                    for ($i=0; $i<count($member_total_poin_monthly); $i++){
                        echo "<br>Point ". $member_total_poin_monthly[$i]['month']." = ".number_format($member_total_poin_monthly[$i]['Total']);
                    };
                    ?>
                </div>
                </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- DONUT CHART -->
            <div class="box box-danger">
            <div class="box-header with-border">
             
            </div>
           
             <!-- /.box-body -->
            </div>
        
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
                    <th>Merchant ID</th>
                    <th>program ID</th>
                    <th>code btn</th>
                    <th>date created</th>
                    <th>redeem code</th>
                    <th>redeem date</th>
                    <th>redeem point</th>
                    <th>exchange code</th>
                    <th>exchange date</th>
                    <th>exchange poin</th>
                    </tr>
                    <?php
                    if(count($member_transaction_history) > 0){
                    for($i=0; $i<count($member_transaction_history); $i++){
                    ?>
                    <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $member_transaction_history[$i]['member_id']; ?></td>
                    <td><?php echo $member_transaction_history[$i]['merchant_id']; ?></td>
                    <td><?php echo $member_transaction_history[$i]['program_id']; ?></td>
                    <td><?php echo $member_transaction_history[$i]['transcode_btn']; ?></td>
                    <td><?php echo date('Y-m-d', strtotime($member_transaction_history[$i]['transcode_btn_date'])); ?></td>
                    <td><?php echo $member_transaction_history[$i]['redeem_code']; ?></td>
                    <td><?php echo $member_transaction_history[$i]['redeem_date']; ?></td>
                    <td><?php echo $member_transaction_history[$i]['redeem_poin']; ?></td>
                    <td><?php echo $member_transaction_history[$i]['exchange_code']; ?></td>
                    <td><?php echo date('Y-m-d', strtotime($member_transaction_history[$i]['exchange_date'])); ?></td>
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
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
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
    <?php }else if($this->session->userdata['user_data_web']['role'] == 2){ ?>
        <section class="content-header">
        <h1>
            Operation
        </h1>
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
        <section class="content">
            <?php if($this->session->flashdata('msgalert')){ ;?>
                <div class="alert alert-success" role="alert">
                    <strong><?php echo $this->session->flashdata('msgalert');?></strong>
                </div>
            <?php } ;?>
            <div class="box">
                <div class="box-header">
                <h3 class="box-title">Latest Point Approval Request</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover" cellspacing="0" width="100%" id="approval">
                        <thead>
                            <tr>
                            <th>No</th>
                            <th>Member ID</th>
                            <th>Account No</th>
                            <th>Point adjust</th>
                            <th>Request by</th>
                            <th>Poin Code</th>
                            <th>Status</th>
                            <th>Date Request</th>
                            <th>Approve by</th>
                            <th>Date Approved</th>
                            <th> approve </th>
                            </tr>
                        </thead>
                          
					</table>
                    
                </div>
                <!-- /.box-body -->
            </div>
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
                dataArr.push('<?php echo $val; ?>');
    <?php   }
        } ?>

    //weekly
    <?php 
        for ($i=0; $i<count($member_total_poin_weekly); $i++){
            //foreach($member_total_poin_weekly[$i] as $key => $val){ 
               ?>

                labelsArr.push('<?php echo $member_total_poin_weekly[$i]['week']; ?>');
                dataArr.push('<?php echo $member_total_poin_weekly[$i]['Total']; ?>');
        <?php  //}
    } ?>
    //mothly member_total_poin_monthly
    <?php 
        for ($i=0; $i<count($member_total_poin_monthly); $i++){
            //foreach($member_total_poin_weekly[$i] as $key => $val){ 
               ?>

                labelsArr.push('<?php echo $member_total_poin_monthly[$i]['month']; ?>');
                dataArr.push('<?php echo $member_total_poin_monthly[$i]['Total']; ?>');
        <?php  //}
    } ?>

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas)
    var areaChartData = {
      labels  : labelsArr,//['January', 'February', 'March', 'April', 'May', 'June', 'July'],
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
        }
      ]
    }
   
    //console.log(areaChartData.labels.toString()); 
    var areaChartOptions = {
        animation: false,
        scaleLabel:
        function(labelsArr){return labelsArr.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        },
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
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
      pointDot                : false,
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
     areaChart.Line(areaChartData, areaChartOptions)


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
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
      {
        value    : <?php echo $member_total_poin[0]['Total'];?>,//700,
        color    : '#f56954',
        highlight: '#f56954',
        label    : 'Total Point To date'
      },
      {
        value    : <?php echo $member_total_poin_daily[0]['Total']; ?>,
        color    : '#00a65a',
        highlight: '#00a65a',
        label    : 'Total Point Today'
      },
      {
        value    :  <?php echo $get_all_poin_permonth[0]['Total']; ?>,
        color    : '#f39c12',
        highlight: '#f39c12',
        label    : 'Total Point Monthly'
      },
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
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions)
</script>

<script type="text/javascript">
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
