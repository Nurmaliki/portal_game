<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <!-- tandi -->
                <img src="<?php echo $this->config->item('assets_url'); ?>assets/dist/img/admin1.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <?php if ($this->session->userdata['user_data']['role'] == 1) {
                    echo ' <p>Administrator</p><a href="#"><i class="fa fa-circle text-success"></i> Online</a>';
                } else if ($this->session->userdata['user_data']['role'] == 2) {
                    //echo "operation";
                    echo ' <p>Operation</p><a href="#"><i class="fa fa-circle text-success"></i> Online</a>';
                } else if ($this->session->userdata['user_data']['role'] == 3) {
                    //user/rfsd
                    echo ' <p>user</p><a href="#"><i class="fa fa-circle text-success"></i> Online</a>';
                } else if ($this->session->userdata['user_data']['role'] == 5) {
                    echo ' <p>Admin Bisnis</p><a href="#"><i class="fa fa-circle text-success"></i> Online</a>';
                } else {
                    //approver/manager-kadiv
                    echo ' <p>Manager - KaDept.</p><a href="#"><i class="fa fa-circle text-success"></i> Online</a>';
                }
                ?>

            </div>

        </div>
        <!-- <div>
                <a href="<?php echo $this->config->item('base_url'); ?>/login/authentication" method="post">Logout </a>
        </div> -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?php if ($this->session->userdata['user_data']['role'] == 1) { ?>

            <ul class="sidebar-menu" data-widget="tree">

                <li class="header">MAIN NAVIGATION</li>
                <li>
                    <a href="<?php echo $this->config->item('base_url'); ?>">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'admin' || $this->uri->segment(1) == 'province') {
                                        echo 'active';
                                    } ?>">
                    <a href="#">
                        <i class="fa fa-th"></i> <span>Administrator</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if ($this->uri->segment(1) == 'admin') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>admin"><i class="fa fa-circle-o"></i> <span>Account admin</span></a>
                        </li>

                        <li <?php if ($this->uri->segment(1) == 'category') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>category"><i class="fa fa-circle-o"></i> <span>Category</span></a>
                        </li>
                    </ul>
                </li>








                <li <?php if ($this->uri->segment(1) == 'loyaltypoin') {
                        echo 'class="active"';
                    } ?>>
                    <a href="<?php echo $this->config->item('base_url'); ?>loyaltypoin"><i class="fa fa-circle-o"></i> <span>Konfigurasi Loyalty Poin</span></a>
                </li>
                <li <?php if ($this->uri->segment(1) == 'katalog') {
                        echo 'class="active"';
                    } ?>>
                    <a href="<?php echo $this->config->item('base_url'); ?>katalog"><i class="fa fa-circle-o"></i> <span>Input Katalog Barang</span></a>
                </li>





                <!-- <li class="treeview <?php if ($this->uri->segment(1) == 'news_category' || $this->uri->segment(1) == 'news_content') {
                                        echo 'active';
                                    } ?>">
                    <a href="#">
                        <i class="fa fa-newspaper-o"></i> <span>Game</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if ($this->uri->segment(1) == 'news_category') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>news_category"><i class="fa fa-circle-o"></i> <span>Game Category</span></a>
                        </li>
                        <li <?php if ($this->uri->segment(1) == 'news_content') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>news_content"><i class="fa fa-circle-o"></i> <span>List Game</span></a>
                        </li>
                    </ul>
                </li> -->
                <li <?php if ($this->uri->segment(1) == 'news_content') {
                        echo 'class="active"';
                    } ?>>
                    <a href="<?php echo $this->config->item('base_url'); ?>news_content"><i class="fa fa-circle-o"></i> <span>List Game</span></a>
                </li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'reportmember' || $this->uri->segment(1) == 'reportmember') {
                                        echo 'active';
                                    } ?>">
                    <a href="#">
                        <i class="fa fa-newspaper-o"></i> <span>Report</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if ($this->uri->segment(1) == 'reportmember') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>reportmember"><i class="fa fa-circle-o"></i> <span>Poin Member</span></a>
                        </li>
                        <!-- <li <?php if ($this->uri->segment(1) == 'reportmember') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>reportmember"><i class="fa fa-circle-o"></i> <span>Poin Permember</span></a>
                        </li> -->
                        <li <?php if ($this->uri->segment(2) == 'akt_login_user') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>reportmember/akt_login_user"><i class="fa fa-circle-o"></i> <span>User Login Activity</span></a>
                        </li>
                        <li <?php if ($this->uri->segment(2) == 'per_poin_user') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>reportmember/per_poin_user"><i class="fa fa-circle-o"></i> <span>User Poin Activity</span></a>
                        </li>
                        <li <?php if ($this->uri->segment(2) == 'penukaran_poin') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>reportmember/penukaran_poin"><i class="fa fa-circle-o"></i> <span>Gift Redemption</span></a>
                        </li>

                    </ul>
                </li>



                </li>
            </ul>

        <?php } else if ($this->session->userdata['user_data']['role'] == 2) { ?>


            <ul class="sidebar-menu" data-widget="tree">

                <li class="header">MAIN NAVIGATION</li>

                <li class="treeview <?php if ($this->uri->segment(1) == 'admin' || $this->uri->segment(1) == 'province') {
                                        echo 'active';
                                    } ?>">
                    <a href="#">
                        <i class="fa fa-th"></i> <span>Administrator</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if ($this->uri->segment(1) == 'admin') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>admin"><i class="fa fa-circle-o"></i> <span>Account admin</span></a>
                        </li>

                        <li <?php if ($this->uri->segment(1) == 'category') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>category"><i class="fa fa-circle-o"></i> <span>Category</span></a>
                        </li>
                    </ul>
                </li>









                <li <?php if ($this->uri->segment(1) == 'spesial_day') {
                        echo 'class="active"';
                    } ?>>
                    <a href="<?php echo $this->config->item('base_url'); ?>spesial_day"><i class="fa    fa-heart"></i> <span>Special Day</span></a>
                </li>

                <li class="treeview <?php if ($this->uri->segment(1) == 'merchantgiift' || $this->uri->segment(1) == 'giiftmanagement' || $this->uri->segment(1) == 'reportgiift' || $this->uri->segment(1) == 'email') {
                                        echo 'active';
                                    } ?>">
                    <a href="#">
                        <i class="fa fa-files-o"></i> <span>Giift</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">

                        <li <?php if ($this->uri->segment(1) == 'merchantgiift') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>merchantgiift"><i class="fa    fa-heart"></i> <span>Merchant List</span></a>
                        </li>
                        <li <?php if ($this->uri->segment(1) == 'giiftmanagement') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>giiftmanagement"><i class="fa    fa-heart"></i> <span>Point Setting</span></a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'burndate') {
                                        echo 'active';
                                    } ?>">
                <li <?php if ($this->uri->segment(1) == 'burndate') {
                        echo 'class="active"';
                    } ?>>
                    <a href="<?php echo $this->config->item('base_url'); ?>burndate"><i class="fa  fa-group"></i> <span>Burn Date</span></a>
                </li>
                </li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'reportpoin') {
                                        echo 'active';
                                    } ?>">

                </li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'programperiod') {
                                        echo 'active';
                                    } ?>">
                <li <?php if ($this->uri->segment(1) == 'programperiod') {
                        echo 'class="active"';
                    } ?>>
                    <a href="<?php echo $this->config->item('base_url'); ?>programperiod"><i class="fa  fa-group"></i> <span>Program Period</span></a>
                </li>
                </li>
            </ul>


        <?php } else if ($this->session->userdata['user_data']['role'] == 3) { ?>
            <ul class="sidebar-menu" data-widget="tree">

                <li class="header">MAIN NAVIGATION</li>
                <li>
                    <a href="<?php echo $this->config->item('base_url'); ?>">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'member') {
                                        echo 'active';
                                    } ?>">
                <li <?php if ($this->uri->segment(1) == 'member') {
                        echo 'class="active"';
                    } ?>>
                    <a href="<?php echo $this->config->item('base_url'); ?>member"><i class="fa  fa-group"></i> <span>Member</span></a>
                </li>
                </li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'news_category' || $this->uri->segment(1) == 'news_content') {
                                        echo 'active';
                                    } ?>">
                    <a href="#">
                        <i class="fa fa-newspaper-o"></i> <span>News</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if ($this->uri->segment(1) == 'news_category') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>news_category"><i class="fa  fa-circle-o"></i> <span>News Category</span></a>
                        </li>
                        <li <?php if ($this->uri->segment(1) == 'news_content') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>news_content"><i class="fa fa-circle-o"></i> <span>News Content</span></a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'news_category' || $this->uri->segment(1) == 'news_content') {
                                        echo 'active';
                                    } ?>">
                    <a href="#">
                        <i class="fa fa-newspaper-o"></i> <span>Grand Prize</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if ($this->uri->segment(1) == 'event_list') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>event_list"><i class="fa  fa-circle-o"></i> <span>Grand Prize List</span></a>
                        </li>
                        <li <?php if ($this->uri->segment(1) == 'event_data') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>event_data"><i class="fa fa-circle-o"></i> <span>Grand Prize Data</span></a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'report' || $this->uri->segment(1) == 'report') {
                                        echo 'active';
                                    } ?>">
                    <a href="#">
                        <i class="fa fa-files-o"></i> <span>Report</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">

                        <li <?php if ($this->uri->segment(1) == 'report' && $this->uri->segment(2) == 'exchange') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>report/exchange"><i class="fa  fa-circle-o"></i> <span> Exchange</span></a>
                        </li>

                        <li <?php if ($this->uri->segment(1) == 'report' && $this->uri->segment(2) == 'report_rule') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>report/report_rule"><i class="fa  fa-circle-o"></i> <span> Rule Monthly</span></a>
                        </li>
                        <li <?php if ($this->uri->segment(1) == 'report' && $this->uri->segment(2) == 'report_rule_all') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>report/report_rule_all"><i class="fa  fa-circle-o"></i> <span> Rule Daily</span></a>
                        </li>
                    </ul>
                </li>
                <!-- <li <? php // if($this->uri->segment(1) == 'banner'){echo'class="active"';}
                            ?>>
                <a href="<?php //echo $this->config->item('base_url');
                            ?>banner"><i class="fa   fa-plus-square-o"></i> <span>Banner</span></a>
                </li> -->
                <li <?php if ($this->uri->segment(1) == 'spesial_day') {
                        echo 'class="active"';
                    } ?>>
                    <a href="<?php echo $this->config->item('base_url'); ?>spesial_day"><i class="fa    fa-heart"></i> <span>Special Day</span></a>
                </li>

                <li class="treeview <?php if ($this->uri->segment(1) == 'merchantgiift' || $this->uri->segment(1) == 'giiftmanagement' || $this->uri->segment(1) == 'reportgiift' || $this->uri->segment(1) == 'email') {
                                        echo 'active';
                                    } ?>">
                    <a href="#">
                        <i class="fa fa-files-o"></i> <span>Giift</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">

                        <li <?php if ($this->uri->segment(1) == 'merchantgiift') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>merchantgiift"><i class="fa    fa-heart"></i> <span>Merchant List</span></a>
                        </li>
                        <li <?php if ($this->uri->segment(1) == 'giiftmanagement') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>giiftmanagement"><i class="fa    fa-heart"></i> <span>Point Setting</span></a>
                        </li>
                        <li <?php if ($this->uri->segment(1) == 'reportgiift') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>reportgiift/redeem"><i class="fa    fa-heart"></i> <span>Redeem Report</span></a>
                        </li>
                        <li <?php if ($this->uri->segment(1) == 'email') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>email"><i class="fa    fa-heart"></i> <span>Email</span></a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'burndate') {
                                        echo 'active';
                                    } ?>">
                <li <?php if ($this->uri->segment(1) == 'burndate') {
                        echo 'class="active"';
                    } ?>>
                    <a href="<?php echo $this->config->item('base_url'); ?>burndate"><i class="fa  fa-group"></i> <span>Burn Date</span></a>
                </li>
                </li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'reportpoin') {
                                        echo 'active';
                                    } ?>">
                <li <?php if ($this->uri->segment(1) == 'reportpoin') {
                        echo 'class="active"';
                    } ?>>
                    <a href="<?php echo $this->config->item('base_url'); ?>reportpoin"><i class="fa  fa-group"></i> <span>Report Poin</span></a>
                </li>
                </li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'programperiod') {
                                        echo 'active';
                                    } ?>">
                <li <?php if ($this->uri->segment(1) == 'programperiod') {
                        echo 'class="active"';
                    } ?>>
                    <a href="<?php echo $this->config->item('base_url'); ?>programperiod"><i class="fa  fa-group"></i> <span>Program Period</span></a>
                </li>
                </li>


            </ul>
        <?php } else if ($this->session->userdata['user_data']['role'] == 4) { ?>

            <ul class="sidebar-menu" data-widget="tree">

                <li class="header">MAIN NAVIGATION</li>
                <li>
                    <a href="<?php echo $this->config->item('base_url'); ?>">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>





                <li class="treeview <?php if ($this->uri->segment(1) == 'program' || $this->uri->segment(1) == 'point') {
                                        echo 'active';
                                    } ?>">
                    <a href="#">
                        <i class="fa fa-rub"></i> <span>Point</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if ($this->uri->segment(1) == 'program') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>program"><i class="fa fa-circle-o"></i> <span>Point Serbu</span></a>
                        </li>
                        <li <?php if ($this->uri->segment(1) == 'point') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>point"><i class="fa fa-circle-o"></i> <span>Point Exchange Management</span></a>
                        </li>
                    </ul>
                </li>

                <li class="treeview <?php if ($this->uri->segment(1) == 'member') {
                                        echo 'active';
                                    } ?>">
                <li <?php if ($this->uri->segment(1) == 'member') {
                        echo 'class="active"';
                    } ?>>
                    <a href="<?php echo $this->config->item('base_url'); ?>member"><i class="fa  fa-group"></i> <span>Member</span></a>
                </li>
                </li>




                <!-- <li <?php if ($this->uri->segment(1) == 'merchant') {
                                echo 'class="active"';
                            } ?>>
                        <a href="<?php echo $this->config->item('base_url'); ?>merchant"><i class="fa  fa-coffee"></i> <span>Merchant</span></a>
                        </li> -->
                <!--
                                <li class="treeview <?php if ($this->uri->segment(1) == 'merchant' || $this->uri->segment(1) == 'category') {
                                                        echo 'active';
                                                    } ?>">
                                    <a href="#">
                                        <i class="fa fa-coffee"></i> <span>Merchant</span>
                                        <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li <?php if ($this->uri->segment(1) == 'merchant') {
                                                echo 'class="active"';
                                            } ?>>
                                            <a href="<?php echo $this->config->item('base_url'); ?>merchant"><i class="fa  fa-circle-o"></i> <span>Merchant</span></a>
                                        </li>

                                    </ul>
                                </li>
 -->





                <li <?php if ($this->uri->segment(1) == 'role') {
                        echo 'class="active"';
                    } ?>>
                    <a href="<?php echo $this->config->item('base_url'); ?>role"><i class="fa   fa-plus-square-o"></i> <span>Rule Management</span></a>
                </li>
                <li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'news_category' || $this->uri->segment(1) == 'news_content') {
                                        echo 'active';
                                    } ?>">
                    <!-- <a href="#">
                                <i class="fa fa-newspaper-o"></i> <span>News</span>
                                <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a> -->
                    <ul class="treeview-menu">
                        <!-- <li <?php if ($this->uri->segment(1) == 'news_category') {
                                        echo 'class="active"';
                                    } ?>>
                                    <a href="<?php echo $this->config->item('base_url'); ?>news_category"><i class="fa  fa-circle-o"></i> <span>News Category</span></a>
                                </li>
                                <li <?php if ($this->uri->segment(1) == 'news_content') {
                                        echo 'class="active"';
                                    } ?>>
                                    <a href="<?php echo $this->config->item('base_url'); ?>news_content"><i class="fa  fa-circle-o"></i> <span>News Content</span></a>
                                </li> -->
                    </ul>
                </li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'news_category' || $this->uri->segment(1) == 'news_content') {
                                        echo 'active';
                                    } ?>">
                    <a href="#">
                        <i class="fa fa-newspaper-o"></i> <span>Grand Prize</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if ($this->uri->segment(1) == 'event_list') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>event_list"><i class="fa  fa-circle-o"></i> <span>Grand Prize List</span></a>
                        </li>
                        <li <?php if ($this->uri->segment(1) == 'event_data') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>event_data"><i class="fa fa-circle-o"></i> <span>Grand Prize Data</span></a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'report' || $this->uri->segment(1) == 'report') {
                                        echo 'active';
                                    } ?>">
                    <a href="#">
                        <i class="fa fa-files-o"></i> <span>Report</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">

                        <li <?php if ($this->uri->segment(1) == 'report' && $this->uri->segment(2) == 'exchange') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>report/exchange"><i class="fa  fa-circle-o"></i> <span> Exchange</span></a>
                        </li>

                        <li <?php if ($this->uri->segment(1) == 'report' && $this->uri->segment(2) == 'report_rule') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>report/report_rule"><i class="fa  fa-circle-o"></i> <span> Rule Monthly</span></a>
                        </li>
                        <li <?php if ($this->uri->segment(1) == 'report' && $this->uri->segment(2) == 'report_rule_all') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>report/report_rule_all"><i class="fa  fa-circle-o"></i> <span> Rule Daily</span></a>
                        </li>
                    </ul>
                </li>
                <!-- <li <?php // if($this->uri->segment(1) == 'banner'){echo'class="active"';}
                            ?>>
                    <a href="<?php  //echo $this->config->item('base_url');
                                ?>banner"><i class="fa   fa-plus-square-o"></i> <span>Banner</span></a>
                    </li> -->
                <li <?php if ($this->uri->segment(1) == 'spesial_day') {
                        echo 'class="active"';
                    } ?>>
                    <a href="<?php echo $this->config->item('base_url'); ?>spesial_day"><i class="fa    fa-heart"></i> <span>Special Day</span></a>
                </li>

                <li class="treeview <?php if ($this->uri->segment(1) == 'merchantgiift' || $this->uri->segment(1) == 'giiftmanagement' || $this->uri->segment(1) == 'reportgiift' || $this->uri->segment(1) == 'email') {
                                        echo 'active';
                                    } ?>">
                    <a href="#">
                        <i class="fa fa-files-o"></i> <span>Giift</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">

                        <li <?php if ($this->uri->segment(1) == 'merchantgiift') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>merchantgiift"><i class="fa    fa-heart"></i> <span>Merchant List</span></a>
                        </li>
                        <li <?php if ($this->uri->segment(1) == 'giiftmanagement') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>giiftmanagement"><i class="fa    fa-heart"></i> <span>Point Setting</span></a>
                        </li>
                        <li <?php if ($this->uri->segment(1) == 'reportgiift') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>reportgiift/redeem"><i class="fa    fa-heart"></i> <span>Redeem Report</span></a>
                        </li>
                        <li <?php if ($this->uri->segment(1) == 'email') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>email"><i class="fa    fa-heart"></i> <span>Email</span></a>
                        </li>
                    </ul>

                <li class="treeview <?php if ($this->uri->segment(1) == 'burndate') {
                                        echo 'active';
                                    } ?>">
                <li <?php if ($this->uri->segment(1) == 'burndate') {
                        echo 'class="active"';
                    } ?>>
                    <a href="<?php echo $this->config->item('base_url'); ?>burndate"><i class="fa  fa-group"></i> <span>Burn Date</span></a>
                </li>
                </li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'reportpoin') {
                                        echo 'active';
                                    } ?>">
                <li <?php if ($this->uri->segment(1) == 'reportpoin') {
                        echo 'class="active"';
                    } ?>>
                    <a href="<?php echo $this->config->item('base_url'); ?>reportpoin"><i class="fa  fa-group"></i> <span>Report Poin</span></a>
                </li>
                </li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'programperiod') {
                                        echo 'active';
                                    } ?>">
                <li <?php if ($this->uri->segment(1) == 'programperiod') {
                        echo 'class="active"';
                    } ?>>
                    <a href="<?php echo $this->config->item('base_url'); ?>programperiod"><i class="fa  fa-group"></i> <span>Program Period</span></a>
                </li>
                </li>
                </li>
            </ul>

        <?php } else if ($this->session->userdata['user_data']['role'] == 5) { ?>

            <ul class="sidebar-menu" data-widget="tree">

                <li class="header">MAIN NAVIGATION</li>
                <li>
                    <a href="<?php echo $this->config->item('base_url'); ?>">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'admin' || $this->uri->segment(1) == 'province') {
                                        echo 'active';
                                    } ?>">
                    <a href="#">
                        <i class="fa fa-th"></i> <span>Administrator</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if ($this->uri->segment(1) == 'admin') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>admin"><i class="fa fa-circle-o"></i> <span>Account admin</span></a>
                        </li>

                        <li <?php if ($this->uri->segment(1) == 'category') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>category"><i class="fa fa-circle-o"></i> <span>Category</span></a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'program' || $this->uri->segment(1) == 'point') {
                                        echo 'active';
                                    } ?>">
                    <a href="#">
                        <i class="fa fa-rub"></i> <span>Point</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if ($this->uri->segment(1) == 'program') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>program"><i class="fa fa-circle-o"></i> <span>Point Serbu</span></a>
                        </li>
                        <li <?php if ($this->uri->segment(1) == 'point') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>point"><i class="fa fa-circle-o"></i> <span>Point Exchange Management</span></a>
                        </li>
                    </ul>
                </li>

                <li class="treeview <?php if ($this->uri->segment(1) == 'member') {
                                        echo 'active';
                                    } ?>">
                <li <?php if ($this->uri->segment(1) == 'member') {
                        echo 'class="active"';
                    } ?>>
                    <a href="<?php echo $this->config->item('base_url'); ?>member"><i class="fa  fa-group"></i> <span>Member</span></a>
                </li>
                </li>



                <li <?php if ($this->uri->segment(1) == 'role') {
                        echo 'class="active"';
                    } ?>>
                    <a href="<?php echo $this->config->item('base_url'); ?>role"><i class="fa   fa-plus-square-o"></i> <span>Rule Management</span></a>
                </li>
                <li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'news_category' || $this->uri->segment(1) == 'news_content') {
                                        echo 'active';
                                    } ?>">
                    <a href="#">
                        <i class="fa fa-newspaper-o"></i> <span>News</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if ($this->uri->segment(1) == 'news_category') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>news_category"><i class="fa fa-circle-o"></i> <span>News Category</span></a>
                        </li>
                        <li <?php if ($this->uri->segment(1) == 'news_content') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>news_content"><i class="fa fa-circle-o"></i> <span>News Content</span></a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'news_category' || $this->uri->segment(1) == 'news_content') {
                                        echo 'active';
                                    } ?>">
                    <a href="#">
                        <i class="fa fa-newspaper-o"></i> <span>Grand Prize</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if ($this->uri->segment(1) == 'event_list') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>event_list"><i class="fa  fa-circle-o"></i> <span>Grand Prize List</span></a>
                        </li>
                        <li <?php if ($this->uri->segment(1) == 'event_data') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>event_data"><i class="fa fa-circle-o"></i> <span>Grand Prize Data</span></a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'report' || $this->uri->segment(1) == 'report') {
                                        echo 'active';
                                    } ?>">
                    <a href="#">
                        <i class="fa fa-files-o"></i> <span>Report</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">

                        <li <?php if ($this->uri->segment(1) == 'report' && $this->uri->segment(2) == 'exchange') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>report/exchange"><i class="fa  fa-circle-o"></i> <span> Exchange</span></a>
                        </li>

                        <li <?php if ($this->uri->segment(1) == 'report' && $this->uri->segment(2) == 'report_rule') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>report/report_rule"><i class="fa  fa-circle-o"></i> <span> Rule Monthly</span></a>
                        </li>
                        <li <?php if ($this->uri->segment(1) == 'report' && $this->uri->segment(2) == 'report_rule_all') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>report/report_rule_all"><i class="fa  fa-circle-o"></i> <span> Rule Daily</span></a>
                        </li>
                    </ul>
                </li>
                <!-- <li <?php //if($this->uri->segment(1) == 'banner'){echo'class="active"';}
                            ?>>
                    <a href="<?php //echo $this->config->item('base_url');
                                ?>banner"><i class="fa   fa-plus-square-o"></i> <span>Banner</span></a>
                    </li> -->
                <li <?php if ($this->uri->segment(1) == 'spesial_day') {
                        echo 'class="active"';
                    } ?>>
                    <a href="<?php echo $this->config->item('base_url'); ?>spesial_day"><i class="fa    fa-heart"></i> <span>Special Day</span></a>
                </li>

                <li class="treeview <?php if ($this->uri->segment(1) == 'merchantgiift' || $this->uri->segment(1) == 'giiftmanagement' || $this->uri->segment(1) == 'reportgiift' || $this->uri->segment(1) == 'email') {
                                        echo 'active';
                                    } ?>">
                    <a href="#">
                        <i class="fa fa-files-o"></i> <span>Giift</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">

                        <li <?php if ($this->uri->segment(1) == 'merchantgiift') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>merchantgiift"><i class="fa    fa-heart"></i> <span>Merchant List</span></a>
                        </li>
                        <li <?php if ($this->uri->segment(1) == 'giiftmanagement') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>giiftmanagement"><i class="fa    fa-heart"></i> <span>Point Setting</span></a>
                        </li>
                        <li <?php if ($this->uri->segment(1) == 'reportgiift') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>reportgiift/redeem"><i class="fa    fa-heart"></i> <span>Redeem Report</span></a>
                        </li>
                        <li <?php if ($this->uri->segment(1) == 'email') {
                                echo 'class="active"';
                            } ?>>
                            <a href="<?php echo $this->config->item('base_url'); ?>email"><i class="fa    fa-heart"></i> <span>Email</span></a>
                        </li>
                    </ul>
                </li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'burndate') {
                                        echo 'active';
                                    } ?>">
                <li <?php if ($this->uri->segment(1) == 'burndate') {
                        echo 'class="active"';
                    } ?>>
                    <a href="<?php echo $this->config->item('base_url'); ?>burndate"><i class="fa  fa-group"></i> <span>Burn Date</span></a>
                </li>
                </li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'reportpoin') {
                                        echo 'active';
                                    } ?>">
                <li <?php if ($this->uri->segment(1) == 'reportpoin') {
                        echo 'class="active"';
                    } ?>>
                    <a href="<?php echo $this->config->item('base_url'); ?>reportpoin"><i class="fa  fa-group"></i> <span>Report Poin</span></a>
                </li>
                </li>
                <li class="treeview <?php if ($this->uri->segment(1) == 'programperiod') {
                                        echo 'active';
                                    } ?>">
                <li <?php if ($this->uri->segment(1) == 'programperiod') {
                        echo 'class="active"';
                    } ?>>
                    <a href="<?php echo $this->config->item('base_url'); ?>programperiod"><i class="fa  fa-group"></i> <span>Program Period</span></a>
                </li>
                </li>
            </ul>

        <?php } else { ?>

        <?php } ?>


    </section>
    <!-- /.sidebar -->
</aside>
