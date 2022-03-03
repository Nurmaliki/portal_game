<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <!-- tandi -->
          <img src="<?php echo $this->config->item('assets_url');?>assets/dist/img/admin1.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <?php if($this->session->userdata['user_data']['role'] == 1 ){
                        echo ' <p>BTN Administrator</p><a href="#"><i class="fa fa-circle text-success"></i> Online</a>';
                        }else if( $this->session->userdata['user_data']['role'] == 2){
                            //echo "operation";
                            echo ' <p>Operation</p><a href="#"><i class="fa fa-circle text-success"></i> Online</a>';
                        }else if($this->session->userdata['user_data']['role'] == 3){
                            //user/rfsd
                            echo ' <p>user</p><a href="#"><i class="fa fa-circle text-success"></i> Online</a>';
                        }else{
                        //approver/manager-kadiv
                        echo ' <p>Manager - KaDept.</p><a href="#"><i class="fa fa-circle text-success"></i> Online</a>';
                        }
            ?>
         
        </div>
        
      </div>
        <!-- <div>
                <a href="<?php echo $this->config->item('base_url');?>/login/authentication" method="post">Logout </a>
        </div> -->
        
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?php if($this->session->userdata['user_data']['role'] == 1 ){ ?>

            <ul class="sidebar-menu" data-widget="tree">

                <li class="header">MAIN NAVIGATION</li>
                <li>
                    <a href="<?php echo $this->config->item('base_url');?>">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="treeview <?php if($this->uri->segment(1) == 'admin' || $this->uri->segment(1) == 'province'){echo'active';} ?>">
                <a href="#">
                    <i class="fa fa-th"></i> <span>Administrator</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($this->uri->segment(1) == 'admin'){echo'class="active"';} ?>>
                    <a href="<?php echo $this->config->item('base_url');?>admin"><i class="fa fa-circle-o"></i> <span>Account admin</span></a>
                    </li>
                    <li <?php if($this->uri->segment(1) == 'province'){echo'class="active"';} ?>>
                    <a href="<?php echo $this->config->item('base_url');?>province"><i class="fa fa-circle-o"></i> <span>Province</span></a>
                    </li>
                    <!-- <li <?php if($this->uri->segment(1) == 'category'){echo'class="active"';} ?>>
                    <a href="<?php echo $this->config->item('base_url');?>category"><i class="fa fa-circle-o"></i> <span>Category</span></a>
                    </li> -->
                </ul>
                </li>
                <li class="treeview <?php if($this->uri->segment(1) == 'program' || $this->uri->segment(1) == 'point'){echo'active';} ?>">
                <a href="#">
                    <i class="fa fa-rub"></i> <span>Point</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li <?php if($this->uri->segment(1) == 'program'){echo'class="active"';} ?>>
                    <a href="<?php echo $this->config->item('base_url');?>program"><i class="fa fa-circle-o"></i> <span>Point Serbu</span></a>
                    </li>
                    <li <?php if($this->uri->segment(1) == 'point'){echo'class="active"';} ?>>
                    <a href="<?php echo $this->config->item('base_url');?>point"><i class="fa fa-circle-o"></i> <span>Point Exchange Management</span></a>
                    </li>
                </ul>
                </li>

                <li class="treeview <?php if($this->uri->segment(1) == 'member'){echo'active';} ?>">
                <li <?php if($this->uri->segment(1) == 'member'){echo'class="active"';} ?>>
                            <a href="<?php echo $this->config->item('base_url');?>member"><i class="fa  fa-group"></i> <span>Member</span></a>
                        </li>
                </li>




                    <!-- <li <?php if($this->uri->segment(1) == 'merchant'){echo'class="active"';} ?>>
                    <a href="<?php echo $this->config->item('base_url');?>merchant"><i class="fa  fa-coffee"></i> <span>Merchant</span></a>
                    </li> -->

                      <li class="treeview <?php if($this->uri->segment(1) == 'merchant' || $this->uri->segment(1) == 'category' ){echo'active';} ?>">
                            <a href="#">
                                <i class="fa fa-coffee"></i> <span>Merchant</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li <?php  if($this->uri->segment(1) == 'merchant'){echo'class="active"';} ?>>
                                    <a href="<?php echo $this->config->item('base_url');?>merchant"><i class="fa  fa-circle-o"></i> <span>Merchant</span></a>
                                </li>
                                <li <?php if($this->uri->segment(1) == 'category'){echo'class="active"';} ?>>
                                    <a href="<?php echo $this->config->item('base_url');?>category"><i class="fa  fa-circle-o"></i> <span>Category</span></a>
                                </li>
                            </ul>
                        </li>





                    <li <?php if($this->uri->segment(1) == 'redeem'){echo'class="active"';} ?>>
                    <a href="<?php echo $this->config->item('base_url');?>redeem"><i class="fa fa-refresh"></i> <span>Redeem Management</span></a>
                    </li>
                    <li <?php if($this->uri->segment(1) == 'role'){echo'class="active"';} ?>>
                    <a href="<?php echo $this->config->item('base_url');?>role"><i class="fa   fa-plus-square-o"></i> <span>Rule Management</span></a>
                    </li>
                    <li>
                    <li class="treeview <?php if($this->uri->segment(1) == 'news_category' || $this->uri->segment(1) == 'news_content' ){echo'active';} ?>">
                        <a href="#">
                            <i class="fa fa-newspaper-o"></i> <span>News</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li <?php if($this->uri->segment(1) == 'news_category'){echo'class="active"';} ?>>
                                <a href="<?php echo $this->config->item('base_url');?>news_category"><i class="fa fa-circle-o"></i> <span>News Category</span></a>
                            </li>
                            <li <?php if($this->uri->segment(1) == 'news_content'){echo'class="active"';} ?>>
                                <a href="<?php echo $this->config->item('base_url');?>news_content"><i class="fa fa-circle-o"></i> <span>News Content</span></a>
                            </li>
                        </ul>
                    </li>

                     <li class="treeview <?php if($this->uri->segment(1) == 'report' || $this->uri->segment(1) == 'report' ){echo'active';} ?>">
                        <a href="#">
                            <i class="fa fa-files-o"></i> <span>Report</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                          
                            <li <?php if($this->uri->segment(1) == 'report' && $this->uri->segment(2) == 'exchange'){echo'class="active"';} ?>>
                            <a href="<?php echo $this->config->item('base_url');?>report/exchange"><i class="fa  fa-circle-o"></i> <span> Exchange</span></a>
                            </li>
                            <li <?php if($this->uri->segment(1) == 'report' && $this->uri->segment(2) == 'redeem'){echo'class="active"';} ?>>
                            <a href="<?php echo $this->config->item('base_url');?>report/redeem"><i class="fa  fa-circle-o"></i> <span> Redeem</span></a>
                            </li>
                            <li <?php if($this->uri->segment(1) == 'report' && $this->uri->segment(2) == 'report_rule'){echo'class="active"';} ?>>
                            <a href="<?php echo $this->config->item('base_url');?>report/report_rule"><i class="fa  fa-circle-o"></i> <span> Rule Monthly</span></a>
                            </li>
                            <li <?php if($this->uri->segment(1) == 'report' && $this->uri->segment(2) == 'report_rule_all'){echo'class="active"';} ?>>
                            <a href="<?php echo $this->config->item('base_url');?>report/report_rule_all"><i class="fa  fa-circle-o"></i> <span> Rule Daily</span></a>
                            </li>
                        </ul>
                    </li>
                    <li <?php if($this->uri->segment(1) == 'banner'){echo'class="active"';} ?>>
                    <a href="<?php echo $this->config->item('base_url');?>banner"><i class="fa   fa-tv"></i> <span>Banner</span></a>
                    </li>

                   
            </ul>
        
        <?php }else if( $this->session->userdata['user_data']['role'] == 2){ ?>

            <ul class="sidebar-menu" data-widget="tree">

                <li class="header">MAIN NAVIGATION</li>
                
                
                <li class="treeview <?php if($this->uri->segment(1) == 'admin' || $this->uri->segment(1) == 'province'){echo'active';} ?>">
                <!-- <a href="#">
                    <i class="fa fa-th"></i> <span>Administrator</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a> -->
                <ul class="treeview-menu">
                    <li <?php if($this->uri->segment(1) == 'admin'){echo'class="active"';} ?>>
                    <a href="<?php echo $this->config->item('base_url');?>admin"><i class="fa fa-circle-o"></i> <span>Account admin</span></a>
                    </li>
                    <li <?php if($this->uri->segment(1) == 'province'){echo'class="active"';} ?>>
                    <a href="<?php echo $this->config->item('base_url');?>province"><i class="fa fa-circle-o"></i> <span>Province</span></a>
                    </li>
                    <!-- <li <?php if($this->uri->segment(1) == 'province'){echo'class="active"';} ?>>
                    <a href="<?php echo $this->config->item('base_url');?>category"><i class="fa fa-circle-o"></i> <span>Category</span></a>
                    </li> -->
                </ul>
                </li>

                
                <li class="treeview <?php if($this->uri->segment(1) == 'program' || $this->uri->segment(1) == 'point'){echo'active';} ?>">
                    <a href="#">
                        <i class="fa  fa-rub"></i> <span>Point</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if($this->uri->segment(1) == 'program'){echo'class="active"';} ?>>
                        <a href="<?php echo $this->config->item('base_url');?>program"><i class="fa fa-circle-o"></i> <span>Point Serbu</span></a>
                        </li>
                        <li <?php if($this->uri->segment(1) == 'point'){echo'class="active"';} ?>>
                        <a href="<?php echo $this->config->item('base_url');?>point"><i class="fa fa-circle-o"></i> <span>Point Exchange Management</span></a>
                        </li>
                    </ul>
                </li>
                <!-- <li <?php if($this->uri->segment(1) == 'merchant'){echo'class="active"';} ?>>
                    <a href="<?php echo $this->config->item('base_url');?>merchant"><i class="fa  fa-coffee"></i> <span>Merchant</span></a>
                </li> -->

                        <li class="treeview <?php if($this->uri->segment(1) == 'merchant' || $this->uri->segment(1) == 'category' ){echo'active';} ?>">
                            <a href="#">
                                <i class="fa fa-coffee"></i> <span>Merchant</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li <?php  if($this->uri->segment(1) == 'merchant'){echo'class="active"';} ?>>
                                    <a href="<?php echo $this->config->item('base_url');?>merchant"><i class="fa  fa-circle-o"></i> <span>Merchant</span></a>
                                </li>
                                <!-- <li <?php if($this->uri->segment(1) == 'category'){echo'class="active"';} ?>>
                                    <a href="<?php echo $this->config->item('base_url');?>category"><i class="fa  fa-circle-o"></i> <span>Category</span></a>
                                </li> -->
                            </ul>
                        </li>
                <li <?php if($this->uri->segment(1) == 'redeem'){echo'class="active"';} ?>>
                    <a href="<?php echo $this->config->item('base_url');?>redeem"><i class="fa fa-refresh"></i> <span>Redeem Management</span></a>
                </li>
                <li <?php if($this->uri->segment(1) == 'role'){echo'class="active"';} ?>>
                    <a href="<?php echo $this->config->item('base_url');?>role"><i class="fa   fa-plus-square-o"></i> <span>Rule Management</span></a>
                </li>
                <li>


                <li <?php if($this->uri->segment(1) == 'report' && $this->uri->segment(2) == 'exchange'){echo'class="active"';} ?>>
                    <a href="<?php echo $this->config->item('base_url');?>report/exchange"><i class="fa fa-files-o"></i> <span>Report Exchange</span></a>
                </li>
                <li <?php if($this->uri->segment(1) == 'report' && $this->uri->segment(2) == 'redeem'){echo'class="active"';} ?>>
                    <a href="<?php echo $this->config->item('base_url');?>report/redeem"><i class="fa fa-files-o"></i> <span>Report Redeem</span></a>
                </li>
            </ul>

        <?php } else if($this->session->userdata['user_data']['role'] == 3){ ?>
            <ul class="sidebar-menu" data-widget="tree">

                <li class="header">MAIN NAVIGATION</li>
                <li>
                    <a href="<?php echo $this->config->item('base_url');?>">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="treeview <?php if($this->uri->segment(1) == 'member'){echo'active';} ?>">
                <li <?php if($this->uri->segment(1) == 'member'){echo'class="active"';} ?>>
                            <a href="<?php echo $this->config->item('base_url');?>member"><i class="fa  fa-group"></i> <span>Member</span></a>
                        </li>
                </li>
                <li class="treeview <?php if($this->uri->segment(1) == 'news_category' || $this->uri->segment(1) == 'news_content' ){echo'active';} ?>">
                    <a href="#">
                        <i class="fa fa-newspaper-o"></i> <span>News</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if($this->uri->segment(1) == 'news_category'){echo'class="active"';} ?>>
                            <a href="<?php echo $this->config->item('base_url');?>news_category"><i class="fa  fa-circle-o"></i> <span>News Category</span></a>
                        </li>
                        <li <?php if($this->uri->segment(1) == 'news_content'){echo'class="active"';} ?>>
                            <a href="<?php echo $this->config->item('base_url');?>news_content"><i class="fa fa-circle-o"></i> <span>News Content</span></a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?php if($this->uri->segment(1) == 'report' || $this->uri->segment(1) == 'report' ){echo'active';} ?>">
                    <a href="#">
                        <i class="fa fa-files-o"></i> <span>Report</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        
                        <li <?php if($this->uri->segment(1) == 'report' && $this->uri->segment(2) == 'exchange'){echo'class="active"';} ?>>
                        <a href="<?php echo $this->config->item('base_url');?>report/exchange"><i class="fa  fa-circle-o"></i> <span> Exchange</span></a>
                        </li>
                        <li <?php if($this->uri->segment(1) == 'report' && $this->uri->segment(2) == 'redeem'){echo'class="active"';} ?>>
                        <a href="<?php echo $this->config->item('base_url');?>report/redeem"><i class="fa  fa-circle-o"></i> <span> Redeem</span></a>
                        </li>
                        <li <?php if($this->uri->segment(1) == 'report' && $this->uri->segment(2) == 'report_rule'){echo'class="active"';} ?>>
                        <a href="<?php echo $this->config->item('base_url');?>report/report_rule"><i class="fa  fa-circle-o"></i> <span> Rule Monthly</span></a>
                        </li>
                        <li <?php if($this->uri->segment(1) == 'report' && $this->uri->segment(2) == 'report_rule_all'){echo'class="active"';} ?>>
                        <a href="<?php echo $this->config->item('base_url');?>report/report_rule_all"><i class="fa  fa-circle-o"></i> <span> Rule Daily</span></a>
                        </li>
                    </ul>
                </li>

                   
            </ul>
        <?php }else if($this->session->userdata['user_data']['role'] == 4 ){ ?>

                <ul class="sidebar-menu" data-widget="tree">

                    <li class="header">MAIN NAVIGATION</li>
                    <li>
                        <a href="<?php echo $this->config->item('base_url');?>">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>


                    <li class="treeview <?php if($this->uri->segment(1) == 'admin' || $this->uri->segment(1) == 'province' ){echo'active';} ?>">
                    <!-- <a href="#">
                        <i class="fa fa-th"></i> <span>Administrator</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a> -->
                    <ul class="treeview-menu">
                        <!-- <li <?php if($this->uri->segment(1) == 'admin'){echo'class="active"';} ?>>
                        <a href="<?php echo $this->config->item('base_url');?>admin"><i class="fa fa-circle-o"></i> <span>Account admin</span></a>
                        </li>
                        <li <?php if($this->uri->segment(1) == 'province'){echo'class="active"';} ?>>
                        <a href="<?php echo $this->config->item('base_url');?>province"><i class="fa fa-circle-o"></i> <span>Province</span></a>
                        </li> -->
                        <!-- <li <?php if($this->uri->segment(1) == 'province'){echo'class="active"';} ?>>
                        <a href="<?php echo $this->config->item('base_url');?>category"><i class="fa fa-circle-o"></i> <span>Category</span></a>
                        </li> -->
                    </ul>
                    </li>

                    
                    <li class="treeview <?php if($this->uri->segment(1) == 'program' || $this->uri->segment(1) == 'point'){echo'active';} ?>">
                    <a href="#">
                        <i class="fa fa-rub"></i> <span>Point</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if($this->uri->segment(1) == 'program'){echo'class="active"';} ?>>
                        <a href="<?php echo $this->config->item('base_url');?>program"><i class="fa fa-circle-o"></i> <span>Point Serbu</span></a>
                        </li>
                        <li <?php if($this->uri->segment(1) == 'point'){echo'class="active"';} ?>>
                        <a href="<?php echo $this->config->item('base_url');?>point"><i class="fa fa-circle-o"></i> <span>Point Exchange Management</span></a>
                        </li>
                    </ul>
                    </li>

                    <li class="treeview <?php if($this->uri->segment(1) == 'member'){echo'active';} ?>">
                    <li <?php if($this->uri->segment(1) == 'member'){echo'class="active"';} ?>>
                                <a href="<?php echo $this->config->item('base_url');?>member"><i class="fa  fa-group"></i> <span>Member</span></a>
                            </li>
                    </li>




                        <!-- <li <?php if($this->uri->segment(1) == 'merchant'){echo'class="active"';} ?>>
                        <a href="<?php echo $this->config->item('base_url');?>merchant"><i class="fa  fa-coffee"></i> <span>Merchant</span></a>
                        </li> -->

                                <li class="treeview <?php if($this->uri->segment(1) == 'merchant' || $this->uri->segment(1) == 'category' ){echo'active';} ?>">
                                    <a href="#">
                                        <i class="fa fa-coffee"></i> <span>Merchant</span>
                                        <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li <?php  if($this->uri->segment(1) == 'merchant'){echo'class="active"';} ?>>
                                            <a href="<?php echo $this->config->item('base_url');?>merchant"><i class="fa  fa-circle-o"></i> <span>Merchant</span></a>
                                        </li>
                                        <!-- <li <?php if($this->uri->segment(1) == 'category'){echo'class="active"';} ?>>
                                            <a href="<?php echo $this->config->item('base_url');?>category"><i class="fa  fa-circle-o"></i> <span>Category</span></a>
                                        </li> -->
                                    </ul>
                                </li>





                        <li <?php if($this->uri->segment(1) == 'redeem'){echo'class="active"';} ?>>
                        <a href="<?php echo $this->config->item('base_url');?>redeem"><i class="fa fa-refresh"></i> <span>Redeem Management</span></a>
                        </li>
                        <li <?php if($this->uri->segment(1) == 'role'){echo'class="active"';} ?>>
                        <a href="<?php echo $this->config->item('base_url');?>role"><i class="fa   fa-plus-square-o"></i> <span>Rule Management</span></a>
                        </li>
                        <li>
                        <li class="treeview <?php if($this->uri->segment(1) == 'news_category' || $this->uri->segment(1) == 'news_content' ){echo'active';} ?>">
                            <!-- <a href="#">
                                <i class="fa fa-newspaper-o"></i> <span>News</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a> -->
                            <ul class="treeview-menu">
                                <!-- <li <?php  if($this->uri->segment(1) == 'news_category'){echo'class="active"';} ?>>
                                    <a href="<?php echo $this->config->item('base_url');?>news_category"><i class="fa  fa-circle-o"></i> <span>News Category</span></a>
                                </li>
                                <li <?php if($this->uri->segment(1) == 'news_content'){echo'class="active"';} ?>>
                                    <a href="<?php echo $this->config->item('base_url');?>news_content"><i class="fa  fa-circle-o"></i> <span>News Content</span></a>
                                </li> -->
                            </ul>
                        </li>
                        <li class="treeview <?php if($this->uri->segment(1) == 'report' || $this->uri->segment(1) == 'report' ){echo'active';} ?>">
                        <a href="#">
                            <i class="fa fa-files-o"></i> <span>Report</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                          
                            <li <?php if($this->uri->segment(1) == 'report' && $this->uri->segment(2) == 'exchange'){echo'class="active"';} ?>>
                            <a href="<?php echo $this->config->item('base_url');?>report/exchange"><i class="fa  fa-circle-o"></i> <span> Exchange</span></a>
                            </li>
                            <li <?php if($this->uri->segment(1) == 'report' && $this->uri->segment(2) == 'redeem'){echo'class="active"';} ?>>
                            <a href="<?php echo $this->config->item('base_url');?>report/redeem"><i class="fa  fa-circle-o"></i> <span> Redeem</span></a>
                            </li>
                            <li <?php if($this->uri->segment(1) == 'report' && $this->uri->segment(2) == 'report_rule'){echo'class="active"';} ?>>
                            <a href="<?php echo $this->config->item('base_url');?>report/report_rule"><i class="fa  fa-circle-o"></i> <span> Rule Monthly</span></a>
                            </li>
                            <li <?php if($this->uri->segment(1) == 'report' && $this->uri->segment(2) == 'report_rule_all'){echo'class="active"';} ?>>
                            <a href="<?php echo $this->config->item('base_url');?>report/report_rule_all"><i class="fa  fa-circle-o"></i> <span> Rule Daily</span></a>
                            </li>
                        </ul>
                    </li>

                   
                </ul>
        
        <?php }else{?>

        <?php } ?>

     
    </section>
    <!-- /.sidebar -->
  </aside>
