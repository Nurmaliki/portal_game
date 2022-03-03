<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Merchant Giift Detail
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo $this->config->item('base_url');?>member"> Merchant Giift </a></li>
        <li class="active">detail</li>
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
                  <b>Category</b> <a class="pull-right"><?php echo $merchantgiift[0]['category'];  ?></a>
                </li>
                <li class="list-group-item">
                  <b>Value</b> <a class="pull-right d-flex"><?php echo  number_format($merchantgiift[0]['value'],0,",","."); ?> </a>
                 
                </li>
                <!-- <br> -->
                <li class="list-group-item">
                  <b>Price</b> <a class="pull-right"><?php echo number_format($merchantgiift[0]['price'],0,",",".");?></a>
                </li>
                <li class="list-group-item">
                  <b>Points</b> <a class="pull-right"><?php echo  number_format($merchantgiift[0]['points'],0,",","."); ?></a>
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
  <!-- /.content-wrapper -->