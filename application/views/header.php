<header class="main-header">

  <!-- Logo -->
  <a href="<?php echo $this->config->item('base_url'); ?>" class="logo">
    <span class="logo-mini"><b>A</b>LT</span>
    <span class="logo-lg"><b>Gaspol Game</b></span>
  </a>

  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <!-- <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a> -->
    <!-- Navbar Right Menu -->


    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        <li class="dropdown messages-menu">
          <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>-->
          <ul class="dropdown-menu">
            <li class="header">You have 4 messages</li>
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu">
                <li>
                  <!-- start message -->
                  <a href="#">
                    <div class="pull-left">
                      <!-- tandai -->
                      <!-- <img src="<?php //echo $this->config->item('assets_url');
                                      ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
                    </div>
                    <h4>
                      Support Team
                      <small><i class="fa fa-clock-o"></i> 5 mins</small>
                    </h4>
                    <p>Why not buy a new awesome theme?</p>
                  </a>
                </li>
                <!-- end message -->
                <li>
                  <a href="#">
                    <div class="pull-left">
                      <!-- tandai -->
                      <!-- <img src="<?php //echo $this->config->item('assets_url');
                                      ?>assets/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image"> -->
                    </div>
                    <h4>
                      AdminLTE Design Team
                      <small><i class="fa fa-clock-o"></i> 2 hours</small>
                    </h4>
                    <p>Why not buy a new awesome theme?</p>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="pull-left">
                      <!-- tandai -->
                      <!-- <img src="<?php // echo $this->config->item('assets_url');
                                      ?>assets/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image"> -->
                    </div>
                    <h4>
                      Developers
                      <small><i class="fa fa-clock-o"></i> Today</small>
                    </h4>
                    <p>Why not buy a new awesome theme?</p>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="pull-left">
                      <!-- tandai -->
                      <!-- <img src="<?php // echo $this->config->item('assets_url');
                                      ?>assets/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image"> -->
                    </div>
                    <h4>
                      Sales Department
                      <small><i class="fa fa-clock-o"></i> Yesterday</small>
                    </h4>
                    <p>Why not buy a new awesome theme?</p>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="pull-left">
                      <!-- tandai -->
                      <!-- <img src="<?php //echo $this->config->item('assets_url');
                                      ?>assets/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image"> -->
                    </div>
                    <h4>
                      Reviewers
                      <small><i class="fa fa-clock-o"></i> 2 days</small>
                    </h4>
                    <p>Why not buy a new awesome theme?</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="footer"><a href="#">See All Messages</a></li>
          </ul>
        </li>
        <!-- Notifications: style can be found in dropdown.less -->
        <li class="dropdown notifications-menu">
          <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>-->
          <ul class="dropdown-menu">
            <li class="header">You have 10 notifications</li>
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu">
                <li>
                  <a href="#">
                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                    page and may cause design problems
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-users text-red"></i> 5 new members joined
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                  </a>
                </li>
                <li>
                  <a href="#">
                    <i class="fa fa-user text-red"></i> You changed your username
                  </a>
                </li>
              </ul>
            </li>
            <li class="footer"><a href="#">View all</a></li>
          </ul>
        </li>
        <!-- Tasks: style can be found in dropdown.less -->
        <li class="dropdown tasks-menu <?php if ($this->uri->segment(1) == 'hadiah'){echo "active";} ?>">
          <a href="<?php echo $this->config->item('base_url');
                    ?>hadiah" class="dropdown-toggle" data-toggle="">
            <!-- <i class="fa fa-flag-o"></i> -->
            <!-- <span class="label label-danger">9</span> -->
            Hadiah
          </a>

        </li >
        <!-- User Account: style can be found in dropdown.less -->
        <!-- <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-poin"></i>
              <?php
              echo $this->session->userdata['user_data_web']['poin'];
              // print_r($this->session->userdata['user_data_web']);
              ?> Poin
           
          </a>
        </li> -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- tandai -->
            <!-- <img src="<?php //echo $this->config->item('assets_url');
                            ?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
            <span class="hidden-l" style="    font-weight: bold;">
              <?php
              echo $this->session->userdata['user_data_web']['poin'];
              ?> Poin
            </span>
          </a>
        </li>
        <li class="dropdown user user-menu">

          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- tandai -->
            <!-- <img src="<?php //echo $this->config->item('assets_url');
                            ?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
            <!-- <span class="hidden-xs">
              <?php
              echo $this->session->userdata['user_data_web']['name'];
              ?>
            </span> -->
            <?php
            echo $this->session->userdata['user_data_web']['name'];
            ?>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <!-- tandai -->
              <!-- <img src="\
                <?php //echo $this->config->item('assets_url');
                ?>
                assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->

              <p>
                <?php
                echo $this->session->userdata['user_data_web']['username'];
                ?>
                <small>
                  <?php
                  echo $this->session->userdata['user_data_web']['poin'];
                  ?>
                </small>
              </p>
            </li>
            <!-- Menu Body -->
            <!--<li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
              </li>-->
            <!-- /.row -->
            <!-- Menu Footer-->
            <li class="user-footer">
              <!--<div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>-->
              <div class="pull-right">
                <a href="<?php echo $this->config->item('base_url'); ?>login/logout" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <!-- <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li> -->
      </ul>
    </div>

  </nav>
</header>