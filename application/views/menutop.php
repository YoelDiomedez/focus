<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-sidebar-fixed" onload="sinVueltaAtras();" onpageshow="if (event.persisted) sinVueltaAtras();" onunload="">
    
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">

        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner">

            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="<?= site_url('logistics/main/index/'.$this->session->userdata('0')->locationID); ?>">
                    <img src="<?= site_url('resources/img/focus.png'); ?>" alt="logo" class="logo-default" />
                </a>
                <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                </div>
            </div>
            <!-- END LOGO -->

            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"></a>
            <!-- END RESPONSIVE MENU TOGGLER -->

            <!-- BEGIN PAGE TOP -->
            <div class="page-top">
                
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">

                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                         <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img 
                                    alt="profile picture" 
                                    class="img-circle" 
                                    src="<?= site_url('assets/layouts/layout2/img/avatar.png'); ?>"/>
                                <span class="username username-hide-on-mobile">
                                    <?= $this->session->userdata('0')->type; ?>
                                </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <a href="<?= site_url('signin/welcome'); ?>">
                                        <i class="icon-refresh"></i>OFICINAS 
                                    </a>
                                </li>
                                <li class="divider"> </li>
                                <li>
                                    <a href="<?= site_url('signin/logout'); ?>">
                                        <i class="icon-logout"></i>SALIR
                                    </a>
                                </li>
                            </ul>
                        </li>
                         <!-- END USER LOGIN DROPDOWN -->
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END PAGE TOP -->
        </div>
        <!-- END HEADER INNER -->
    </div>
    <!-- END HEADER -->

<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->