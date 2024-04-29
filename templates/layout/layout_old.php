<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Responsive Admin Template" />
    <meta name="author" content="SmartUniversity" />
    <title>TNPHC </title>
    <!-- favicon -->
    <!--link rel="shortcut icon" href="<?php //echo $this->Url->build('/', true) ?>tnphc_logo.png" type="image/x-icon"-->
    <link rel="shortcut icon" href="<?php echo $this->Url->build('/tnphc_logo.png', ['fullBase' => true]); ?>" type="image/x-icon">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet" type="text/css" />
    <!--preloader -->
    <?php //echo $this->Html->css('/css/pages/spinners/css/spinner/inner-circles'); ?>
    <!-- icons -->
    <?php echo $this->Html->css('/fonts/font-awesome/css/font-awesome.min'); ?>
    <?php echo $this->Html->css('/fonts/simple-line-icons/simple-line-icons.min'); ?>
    <?php //echo $this->Html->css('/fonts/material-design-icons/material-icon'); ?>
    <?php echo $this->Html->css('https://fonts.googleapis.com/icon?family=Material+Icons'); ?>
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js"></script>
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->

    <!--bootstrap -->
    <?php echo $this->Html->css('/plugins/bootstrap/css/bootstrap.min'); ?>
    <?php echo $this->Html->css('/plugins/bootstrap-datepicker/datepicker'); ?>
    <?php echo $this->Html->css('/plugins/bootstrap-datepicker/datepicker3'); ?>
    <?php echo $this->Html->css('/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker'); ?>
    <?php echo $this->Html->css('/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min'); ?>
    <?php //echo $this->Html->css('/plugins/summernote/summernote'); ?>
    <!-- <?php echo $this->Html->css('/plugins/summernote/summernote'); ?> -->
    <?php echo $this->Html->css('/plugins/flatpicker/css/flatpicker.min'); ?>
    <?php echo $this->Html->css('/plugins/flatpicker/plugins/monthSelect/style'); ?>
    <!-- data tables -->
    <?php echo $this->Html->css('/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min'); ?>
    <?php echo $this->Html->css('/plugins/datatables/export/buttons.dataTables.min'); ?>
    <!-- Material Design Lite CSS -->
    <?php echo $this->Html->css('/plugins/material/material.min'); ?>
    <?php echo $this->Html->css('/css/material_style'); ?>
    <!-- steps -->
    <?php echo $this->Html->css('/plugins/steps/steps'); ?>
    <!-- inbox style -->
    <?php // echo $this->Html->css('/css/pages/inbox.min'); ?>
    <!-- Theme Styles -->
    <link href="<?php echo $this->Url->build('/css/theme/light/theme_style.css', ['fullBase' => true]); ?>" rel="stylesheet"
        id="rt_style_components" type="text/css" />
    <!-- <link href="<?php //echo $this->Url->build('/', true) ?>css/theme/hover/theme_style.css" rel="stylesheet"
        id="rt_style_components" type="text/css" /> -->
    <?php //echo $this->Html->css('/css/theme/hover/style'); ?>
    <?php //echo $this->Html->css('/css/theme/hover/theme-color'); ?>
    <?php echo $this->Html->css('/css/plugins.min'); ?>
    <?php echo $this->Html->css('/css/theme/light/style'); ?>
    <?php echo $this->Html->css('/css/responsive'); ?>
    <?php echo $this->Html->css('/css/pages/formlayout'); ?>
    <?php echo $this->Html->css('/css/theme/light/theme-color'); ?>
    <?php echo $this->Html->css('/plugins/sweet-alert/sweetalert2.min'); ?>
    <!--tagsinput-->
    <?php //echo $this->Html->css('/plugins/jquery-tags-input/jquery-tags-input'); ?>
    <!--tooltipster-->
    <?php echo $this->Html->css('/plugins/tooltipster/dist/css/tooltipster.bundle'); ?>
    <?php echo $this->Html->css('/plugins/tooltipster/dist/css/plugins/tooltipster/sideTip/themes/tooltipster-sideTip-shadow.min'); ?>
    <!-- Jquery Toast css -->
    <?php echo $this->Html->css('/plugins/toastr/toastr'); ?>
    <!--select2-->
    <?php echo $this->Html->css('/plugins/select2/css/select2'); ?>
    <?php echo $this->Html->css('/plugins/select2/css/select2-bootstrap.min'); ?>
    <!-- passtrengthmeter -->
    <?php echo $this->Html->css('/plugins/passtrength/css/passtrength'); ?>
    <!-- nProgress Loading -->
    <?php echo $this->Html->css('/plugins/nprogress/nprogress'); ?>

    <!-- start js include path -->
    <?php echo $this->Html->script('/plugins/jquery/jquery.min'); ?>
    <?php echo $this->Html->script('/plugins/popper/popper'); ?>
    <?php echo $this->Html->script('/plugins/jquery-blockui/jquery.blockui.min'); ?>
    <?php echo $this->Html->script('/plugins/jquery-slimscroll/jquery.slimscroll'); ?>
    <?php echo $this->Html->script('/plugins/jquery-validation/js/jquery.validate.min'); ?>
    <?php echo $this->Html->script('/plugins/jquery-validation/js/additional-methods.min'); ?>
    <!-- bootstrap -->
    <?php echo $this->Html->script('/plugins/bootstrap/js/bootstrap.min'); ?>
    <?php echo $this->Html->script('/plugins/bootstrap-switch/js/bootstrap-switch.min'); ?>
    <?php echo $this->Html->script('/plugins/bootstrap-inputmask/bootstrap-inputmask.min'); ?>
    <?php echo $this->Html->script('/plugins/bootstrap-datepicker/bootstrap-datepicker'); ?>
    <?php //echo $this->Html->script('/plugins/bootstrap-datepicker/datepicker-init'); ?>
    <?php echo $this->Html->script('/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker'); ?>
    <?php echo $this->Html->script('/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min'); ?>
    <?php echo $this->Html->script('/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker-init'); ?>
    <!-- data tables -->
    <?php echo $this->Html->script('/plugins/datatables/jquery.dataTables.min'); ?>
    <?php echo $this->Html->script('/plugins/datatables/plugins/bootstrap/dataTables.bootstrap4.min'); ?>
    <?php echo $this->Html->script('/plugins/datatables/export/dataTables.buttons.min'); ?>
    <?php echo $this->Html->script('/plugins/datatables/export/buttons.flash.min'); ?>
    <?php echo $this->Html->script('/plugins/datatables/export/jszip.min'); ?>
    <?php // echo $this->Html->script('/plugins/datatables/export/pdfmake.min'); ?>
    <?php echo $this->Html->script('/plugins/datatables/export/vfs_fonts'); ?>
    <?php echo $this->Html->script('/plugins/datatables/export/buttons.html5.min'); ?>
    <?php echo $this->Html->script('/plugins/datatables/export/buttons.print.min'); ?>
    <?php echo $this->Html->script('/js/pages/table/table_data'); ?>

    <!-- steps -->
    <?php echo $this->Html->script('/plugins/steps/jquery.steps'); ?>
    <?php //echo $this->Html->script('/js/pages/steps/steps-data'); ?>
    <!-- passtrengthmeter -->
    <?php echo $this->Html->script('/plugins/passtrength/js/jquery.passtrength.min'); ?>

    <?php echo $this->Html->script('/plugins/sparkline/jquery.sparkline'); ?>
    <?php echo $this->Html->script('/js/pages/sparkline/sparkline-data'); ?>
    <?php echo $this->Html->script('/plugins/flatpicker/js/flatpicker.min'); ?>
    <?php echo $this->Html->script('/plugins/flatpicker/plugins/monthSelect/index'); ?>
    <!-- Common js-->
    <?php echo $this->Html->script('/js/app'); ?>
    <?php echo $this->Html->script('/js/pages/validation/form-validation'); ?>
    <?php echo $this->Html->script('/js/layout'); ?>
    <?php echo $this->Html->script('/js/theme-color'); ?>
    <!-- material -->
    <?php echo $this->Html->script('/plugins/material/material.min'); ?>
    <?php echo $this->Html->script('/plugins/sweet-alert/sweetalert2.all.min'); ?>
    <?php echo $this->Html->script('/plugins/sweet-alert/sweetalert2.min'); ?>
    <?php echo $this->Html->script('/js/pages/sweet-alert/sweet-alert-data'); ?>
    <?php echo $this->Html->script('/js/pages/date-time/date-time.init'); ?>

    <!-- dropzone -->
    <?php echo $this->Html->script('/plugins/dropzone/dropzone'); ?>
    <?php echo $this->Html->script('/plugins/dropzone/dropzone-call'); ?>
    <!--tagsinput-->
    <?php echo $this->Html->script('/plugins/jquery-tags-input/jquery-tags-input'); ?>
    <?php echo $this->Html->script('/plugins/jquery-tags-input/jquery-tags-input-init'); ?>
    <!-- notifications -->
    <?php echo $this->Html->script('/plugins/toastr/toastr'); ?>
    <!-- <script src="<?php //echo $this->Url->build('/', true) ?>plugins/toastr/toastr.js.map"></script> -->
    <!-- counterup -->
    <?php echo $this->Html->script('/plugins/counterup/jquery.waypoints.min'); ?>
    <?php echo $this->Html->script('/plugins/counterup/jquery.counterup.min'); ?>
    <!-- chart js -->
    <!-- <?php echo $this->Html->script('/plugins/chart-js/Chart.min'); ?>
    <?php echo $this->Html->script('/plugins/chart-js/utils'); ?>
    <?php echo $this->Html->script('/js/pages/chart/chartjs/home-data2'); ?>
    <?php echo $this->Html->script('/plugins/sparkline/jquery.sparkline'); ?>
    <?php echo $this->Html->script('/js/pages/sparkline/sparkline-data'); ?> -->
    <!--apex chart-->
    <!-- <?php echo $this->Html->script('/plugins/apexcharts/apexcharts.min'); ?> -->
    <!-- Page Specific JS File -->
    <!-- <?php echo $this->Html->script('/js/pages/chart/apex/apexcharts.data'); ?> -->
    <!--amchart chart-->
    <?php // echo $this->Html->script('/plugins/amcharts4/core'); ?>
    <?php // echo $this->Html->script('/plugins/amcharts4/charts'); ?>
    <?php //echo $this->Html->script('/plugins/amcharts4/animated'); ?>
    <?php //echo $this->Html->script('/plugins/amcharts4/worldLow'); ?>
    <?php //echo $this->Html->script('/plugins/amcharts4/maps'); ?>
    <?php //echo $this->Html->script('/js/pages/chart/amchart/amchart-data'); ?>
    <!-- Excel export -->
    <?php echo $this->Html->script('/js/export-excel'); ?>
    <!-- summernote -->
    <?php //echo $this->Html->script('/plugins/summernote/summernote'); ?>
    <!-- <?php echo $this->Html->script('/plugins/summernote/summernote'); ?> -->
    <!-- nProgress Loading -->
    <?php echo $this->Html->script('/plugins/nprogress/nprogress'); ?>


    <?php //echo $this->Html->css('/plugins/smooth-scrollbar/locomotive-scroll.min'); ?>
    <?php //echo $this->Html->script('/plugins/smooth-scrollbar/locomotive-scroll.min'); ?>


    <!-- end js include path -->
</head>
<!-- END HEAD -->

<style>
.success{
	color:green !important;
	font-weight: bold !important;
}
.error{
	font-weight: bold !important;
}


.form-group{
	margin-bottom:30px !important;
}
</style>

<body
    class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-white">


    <div class="page-wrapper">

        <!-- start header -->
        <div class="page-header navbar navbar-fixed-top">
            <div class="page-header-inner ">
                <!-- logo start -->
                <div class="page-logo">
                    <a href="index.html">
                        <span class="logo-default"><img src="http://localhost/tnphc_staging/webroot/img/tnphc_logo.png"
                                alt="Logo" style="margin-left: -1%; width: 60%;"></span> </a>
                    <!-- <span class="logo-icon"><img src="<?php // echo $this->Url->build('/', true) ?>hero-logo.png"
                            alt="Logo" style="height: 45px; width: 96px;"></span> </a></span> -->
                    </a>
                </div>
                <!-- logo end -->
                <ul class="nav navbar-nav navbar-left in">
                    <li><a href="#" class="menu-toggler sidebar-toggler" style="color: #000">
                            <i class="icon-menu"></i>
                        </a>
                    </li>
                </ul>
                <!-- start mobile menu -->
                <a class="menu-toggler responsive-toggler" data-bs-toggle="collapse" data-bs-target=".navbar-collapse">
                    <span></span>
                </a>
                <!-- end mobile menu -->
                <!-- start header menu -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <li><a class="fullscreen-btn">
                                <ion-icon name="scan-outline" size="small"></ion-icon>
                            </a></li>
                        <!-- start manage user dropdown -->
                        <li class="dropdown dropdown-user">
                            <a class="dropdown-toggle" data-bs-toggle="dropdown" data-hover="dropdown"
                                data-close-others="true">
                                <img alt="Dp" class="img-circle" src ="<?php echo $this->Url->build('/img/profile.png', ['fullBase' => true]); ?>" />
                                   
                                <span class="username username-hide-on-mobile" style="text-transform:capitalize;">
                                    <?php echo $LOGGED_NAME; ?> </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                                <li>
                                    <?php //echo $this->Html->link('<ion-icon name="person-outline" size="small"></ion-icon> Profile', ['controller' => 'AdminUsers', 'action' => 'profile', base64_encode($LOGGED_USER)], ['escape' => false]);?>
                                </li>
                                <li>
                                    <?php echo $this->Html->link('<ion-icon name="sync-outline" size="small"></ion-icon> Change Password', ['controller' => 'Users', 'action' => 'changepassword'], ['escape' => false]);?>
                                </li>                               
                                <li>
                                    <?php echo $this->Html->link('<ion-icon name="log-out-outline" size="small"></ion-icon> Log Out', ['controller' => 'Users', 'action' => 'logout'], ['escape' => false]);?>
                                </li>
                            </ul>
                        </li>
                        <!-- end manage user dropdown -->
                        <!-- <li class="dropdown dropdown-quick-sidebar-toggler">
                            <a id="headerSettingButton" class="mdl-button mdl-js-button mdl-button--icon pull-right"
                                data-upgraded=",MaterialButton">
                                <i class="material-icons">more_vert</i>
                            </a>
                        </li> -->
                    </ul>
                </div>
            </div>
        </div>
        <!-- end header -->
            <?php $user = $this->request->getAttribute('identity'); ?>
        <!-- start page container -->
        <div class="page-container">
            <!-- start sidebar menu -->
            <div class="sidebar-container">
                <div class="sidemenu-container navbar-collapse collapse fixed-menu">
                    <div id="remove-scroll" class="left-sidemenu">
                        <ul class="sidemenu  page-header-fixed sidemenu-hover-submenu" data-keep-expanded="false"
                            data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px;height: 630px;">
                            <li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                            </li>
                            <!--li class="sidebar-user-panel">
                                <div class="user-panel">
                                    <div class="pull-left image">
                                        <img src="<?php //echo $this->Url->build('/', true) ?>img/profile.png"
                                            class="img-circle user-img-circle" alt="User Image" style="height: 65px;" />
                                    </div>
                                    <div class="pull-left info">
                                        <p style="text-transform:capitalize;"> <?php echo 'Vignesh'; ?></p>
                                        <small class="pull-left text-muted"
                                            style="margin-bottom: 0% !important;">Admin</small><br>
                                        <hr style="margin-bottom: 0px;margin-top: 0px;">
                                        <small><i class="fa fa-circle user-online"></i><span class="txtOnline">
                                                Online</span></small>
                                    </div>
                                </div>
                            </li-->
                            <!--li <?php if($this->request->getParam('action') == 'dashboard'){?>class="nav-item active"
                                <?php }?>>
                                <?php echo $this->Html->link('<ion-icon name="grid-outline"></ion-icon><span class="title">&nbsp;Dashboard</span>', array('controller' => 'Reports', 'action' => 'dashboard'), array('escape' => false, 'class' => 'nav-link')); ?>
                            </li>
                            <li
                                <?php $reports = array('statistical_report','inc_exp_typ_chart','client_wise_chart','company_wise_chart','financial_abstract_report','company_performance_report','income_expense_type_report');
                                echo (in_array($this->request->getParam('action'),$reports)) ? 'class="nav-item active"': ' ';?>>
                                <a href="#" class="nav-link nav-toggle">
                                    <ion-icon name="reader-outline"></ion-icon>
                                    <span class="title">&nbsp;Reports</span> <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li <?php if($this->request->getParam('controller') == 'Reports' && $this->request->getParam('action') == 'statistical_report'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<ion-icon name="git-commit-outline"></ion-icon><span class="title">&nbsp;Statistical Report</span><span class="arrow "></span>', array('controller' => 'Reports', 'action' => 'statistical_report'), array('escape' => false, 'class' => 'nav-link nav-toggle')); ?>
                                        <ul class="sub-menu">
                                            <li <?php if($this->request->getParam('controller') == 'Reports' && $this->request->getParam('action') == 'inc_exp_typ_chart'){?>class="nav-item active"
                                                <?php }?>>
                                                <?php echo $this->Html->link('<span class="title"><i class="fa fa-line-chart"></i>&nbsp;Income Expense Type Wise Chart</span>', array('controller' => 'Reports', 'action' => 'inc_exp_typ_chart'), array('escape' => false, 'class' => 'nav-link')); ?>
                                            </li>
                                            <li <?php if($this->request->getParam('controller') == 'Reports' && $this->request->getParam('action') == 'client_wise_chart'){?>class="nav-item active"
                                                <?php }?>>
                                                <?php echo $this->Html->link('<span class="title"><i class="fa fa-bar-chart-o"></i>&nbsp;Income Expense Client Wise Chart</span>', array('controller' => 'Reports', 'action' => 'client_wise_chart'), array('escape' => false, 'class' => 'nav-link')); ?>
                                            </li>
                                            <li <?php if($this->request->getParam('controller') == 'Reports' && $this->request->getParam('action') == 'company_wise_chart'){?>class="nav-item active"
                                                <?php }?>>
                                                <?php echo $this->Html->link('<span class="title"><i class="fa fa-bar-chart-o"></i>&nbsp;Income Expense Company Wise Chart</span>', array('controller' => 'Reports', 'action' => 'company_wise_chart'), array('escape' => false, 'class' => 'nav-link')); ?>
                                            </li>
                                        </ul>
                                    </li>
                                    <li <?php if($this->request->getParam('controller') == 'Reports' && $this->request->getParam('action') == 'financial_abstract_report'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<ion-icon name="git-commit-outline"></ion-icon><span class="title">&nbsp;Financial Abstract</span>', array('controller' => 'Reports', 'action' => 'financial_abstract_report'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
                                    <li <?php if($this->request->getParam('controller') == 'Reports' && $this->request->getParam('action') == 'company_performance_report'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<ion-icon name="git-commit-outline"></ion-icon><span class="title">&nbsp;Company Performance Report</span>', array('controller' => 'Reports', 'action' => 'company_performance_report'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
                                    <li <?php if($this->request->getParam('controller') == 'Reports' && $this->request->getParam('action') == 'income_expense_type_report'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<ion-icon name="git-commit-outline"></ion-icon><span class="title">&nbsp;Income/Expenses Type Report</span>', array('controller' => 'Reports', 'action' => 'income_expense_type_report'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <ion-icon name="git-commit-outline"></ion-icon>
                                            <span class="title">
                                                &nbsp;Detail Report
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li <?php if($this->request->getParam('controller') == 'CompanyDetails' && $this->request->getParam('action') == 'index'){?>class="nav-item active"
                                <?php }?>>
                                <?php echo $this->Html->link('<ion-icon name="business-outline"></ion-icon><span class="title">&nbsp;Companies</span>', array('controller' => 'CompanyDetails', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                            </li>
                            <li
                                <?php $employees = array('EmployeeDetails','EmployeeDocuments');
                                echo (in_array($this->request->getParam('controller'),$employees)) ? 'class="nav-item active"': ' ';?>>
                                <a href="#" class="nav-link nav-toggle">
                                    <ion-icon name="people-outline"></ion-icon>
                                    <span class="title">&nbsp;Employees</span> <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li <?php if($this->request->getParam('controller') == 'EmployeeDetails' && $this->request->getParam('action') == 'index'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Employees List</span>', array('controller' => 'EmployeeDetails', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
                                    <li <?php if($this->request->getParam('controller') == 'EmployeeDocuments'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><ion-icon name="document-text-outline"></ion-icon>&nbsp;Documents</span>', array('controller' => 'EmployeeDocuments', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
                                </ul>
                            </li>
                            <li
                                <?php $hrmis = array('EmployeeWorkingDays','EmployeeLeaveApplications','Recruitments','Candidates','Holidays');
                                echo (in_array($this->request->getParam('controller'),$hrmis)) ? 'class="nav-item active"': ' ';?>>
                                <a href="#" class="nav-link nav-toggle">
                                    <i class="icon-support"></i>
                                    <span class="title">&nbsp;HRMIS</span> <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li <?php if($this->request->getParam('controller') == 'EmployeeWorkingDays'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-calendar"></i>&nbsp;Working Days</span>', array('controller' => 'EmployeeWorkingDays', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <span class="title">
                                                <ion-icon name="card-outline"></ion-icon>&nbsp;Monthly Salary
                                            </span>
                                        </a>
                                    </li>
                                    <li <?php if($this->request->getParam('controller') == 'EmployeeLeaveApplications'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<ion-icon name="file-tray-full-outline"></ion-icon><span class="title">&nbsp;Leave Applications</span>', array('controller' => 'EmployeeLeaveApplications', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <span class="title">
                                                <ion-icon name="cash-outline"></ion-icon>&nbsp;Employee Salary
                                            </span>
                                        </a>
                                    </li>
                                    <li <?php if($this->request->getParam('controller') == 'Recruitments'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<ion-icon name="golf-outline"></ion-icon><span class="title">&nbsp;Recruitments</span>', array('controller' => 'Recruitments', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
                                    <li <?php if($this->request->getParam('controller') == 'Candidates'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<ion-icon name="people-outline"></ion-icon><span class="title">&nbsp;Candidates</span>', array('controller' => 'Candidates', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
                                    <li <?php if($this->request->getParam('controller') == 'Holidays'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-calendar "></i>&nbsp;Holidays</span>', array('controller' => 'Holidays', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
                                </ul>
                            </li-->
							 <li <?php if($this->request->getParam('controller') == 'ProjectWorks'){?>class="nav-item active"
                                <?php }?>>
                                <?php echo $this->Html->link('<ion-icon name="business-outline"></ion-icon><span class="title">&nbsp;Project Works</span>', array('controller' => 'ProjectWorks', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                            </li>
                            <li
                                <?php $users = array('Users');
                                echo (in_array($this->request->getParam('controller'),$users)) ? 'class="nav-item active"': ' ';?>>
                                <a href="#" class="nav-link nav-toggle">
                                    <ion-icon name="person-outline"></ion-icon>
                                    <span class="title">&nbsp;Users</span> <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li <?php if($this->request->getParam('controller') == 'Users'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Users List</span>', array('controller' => 'Users', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>                                    
                                </ul>
                            </li>
							
							 <li
                                <?php $masters = array('Masters');
                                echo (in_array($this->request->getParam('controller'),$masters)) ? 'class="nav-item active"': ' ';?>>
                                <a href="#" class="nav-link nav-toggle">
                                    <ion-icon name="apps-outline"></ion-icon>
                                    <span class="title">&nbsp;Masters</span> <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
								    <li <?php if($this->request->getParam('controller') == 'Roles'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Roles</span>', array('controller' => 'Roles', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li> 
                                    <li <?php if($this->request->getParam('controller') == 'FinancialYears'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-calendar"></i>&nbsp;Financial Year</span>', array('controller' => 'FinancialYears', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li> 
									 <li <?php if($this->request->getParam('controller') == 'Districts'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><ion-icon name="golf-outline"></ion-icon>&nbsp;District</span>', array('controller' => 'Districts', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li> 
									 <li <?php if($this->request->getParam('controller') == 'Departments'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><ion-icon name="mail-outline"></ion-icon>&nbsp;Department</span>', array('controller' => 'Departments', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
									<li <?php if($this->request->getParam('controller') == 'BuildingTypes'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<ion-icon name="business-outline"></ion-icon><span class="title">&nbsp;Building Types</span>', array('controller' => 'BuildingTypes', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
									<!--li <?php if($this->request->getParam('controller') == 'Masters'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Divisions</span>', array('controller' => 'Users', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li-->
                                </ul>
                            </li>
                            <!--li
                                <?php $projects = array('ProjectDetails','ProjectDocuments','ProjectHostingDetails','ProjectPaymentGateways','SecurityAuditDetails');
                                echo (in_array($this->request->getParam('controller'),$projects)) ? 'class="nav-item active"': ' ';?>>
                                <a href="#" class="nav-link nav-toggle">
                                    <i class="icon-layers"></i>
                                    <span class="title">&nbsp;Projects</span> <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li <?php if($this->request->getParam('controller') == 'ProjectDetails'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<ion-icon name="file-tray-full-outline"></ion-icon><span class="title">&nbsp;Projects List</span>', array('controller' => 'ProjectDetails', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
                                    <li <?php if($this->request->getParam('controller') == 'ProjectDocuments'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<ion-icon name="folder-outline"></ion-icon><span class="title">&nbsp;Project Documents</span>', array('controller' => 'ProjectDocuments', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
                                    <li <?php if($this->request->getParam('controller') == 'ProjectHostingDetails'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<ion-icon name="cloud-upload-outline"></ion-icon><span class="title">&nbsp;Project Hostings</span>', array('controller' => 'ProjectHostingDetails', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
                                    <li <?php if($this->request->getParam('controller') == 'ProjectPaymentGateways'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<ion-icon name="push-outline"></ion-icon><span class="title">&nbsp;Payment Gateways</span>', array('controller' => 'ProjectPaymentGateways', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
                                    <li <?php if($this->request->getParam('controller') == 'SecurityAuditDetails'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<ion-icon name="git-compare-outline"></ion-icon><span class="title">&nbsp;Security Audits</span>', array('controller' => 'SecurityAuditDetails', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
                                    <li <?php if($this->request->getParam('controller') == 'reports' && $this->request->getParam('action') == 'smstemplates'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<ion-icon name="mail-outline"></ion-icon><span class="title">&nbsp;SMS Templates</span>', array('controller' => 'Reports', 'action' => 'smstemplates'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
                                </ul>
                            </li>
                            <li <?php if($this->request->getParam('controller') == 'Supports'){?>class="nav-item active"
                                <?php }?>>
                                <?php echo $this->Html->link('<ion-icon name="repeat-outline"></ion-icon><span class="title">&nbsp;Support Requests</span>', array('controller' => 'Supports', 'action' => 'index'), array('escape' => false, 'class' => '')); ?>
                            </li>
                            <li
                                <?php $expense = array('Expenses');
                                echo (in_array($this->request->getParam('controller'),$expense)) ? 'class="nav-item active"': ' ';?>>
                                <a href="#" class="nav-link nav-toggle">
                                    <ion-icon name="document-text-outline"></ion-icon>
                                    <span class="title">&nbsp;Expenses</span> <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li <?php if($this->request->getParam('controller') == 'Expenses' && $this->request->getParam('action') == 'add'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<ion-icon name="document-text-outline"></ion-icon><span class="title">&nbsp;Expenses</span>', array('controller' => 'Expenses', 'action' => 'add'), array('escape' => false, 'class' => '')); ?>
                                    </li>
                                    <li <?php if($this->request->getParam('controller') == 'ExpenseTypes' && $this->request->getParam('action') == 'index'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<ion-icon name="document-text-outline"></ion-icon><span class="title">&nbsp;Expense Category</span>', array('controller' => 'ExpenseTypes', 'action' => 'index'), array('escape' => false, 'class' => '')); ?>
                                    </li>
                                    <li <?php if($this->request->getParam('controller') == 'Expenses' && $this->request->getParam('action') == 'index'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<ion-icon name="document-text-outline"></ion-icon><span class="title">&nbsp;Expenses Report</span>', array('controller' => 'Expenses', 'action' => 'index'), array('escape' => false, 'class' => '')); ?>
                                    </li>
                                </ul>
                            </li>
                            <li <?php if($this->request->getParam('controller') == 'MonthlyIncomeExpenses'){?>class="nav-item active"
                                <?php }?>>
                                <?php echo $this->Html->link('<ion-icon name="swap-vertical-outline"></ion-icon><span class="title">&nbsp;Monthly Income Expenses</span>', array('controller' => 'MonthlyIncomeExpenses', 'action' => 'index'), array('escape' => false, 'class' => '')); ?>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <ion-icon name="book-outline"></ion-icon>
                                    <span class="title">
                                        &nbsp;Accounts
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <ion-icon name="server-outline"></ion-icon>
                                    <span class="title">
                                        &nbsp;Maintenance
                                    </span>
                                </a>
                            </li-->
                            <!--li <?php if($this->request->getParam('controller') == 'DailyTaskDetails'){?>class="nav-item active"
                                <?php }?>>
                                <?php echo $this->Html->link('<ion-icon name="code-slash-outline"></ion-icon><span class="title">&nbsp;Daily Tasks</span>', array('controller' => 'DailyTaskDetails', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                            </li-->
                            <!--li <?php if($this->request->getParam('controller') == 'AdminUsers'){?>class="nav-item active"
                                <?php }?>>
                                <?php echo $this->Html->link('<ion-icon name="apps-outline"></ion-icon><span class="title">&nbsp;Masters</span>', array('controller' => 'AdminUsers', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                            </li-->

                        </ul>
                    </div>
                </div>
            </div>
            <!-- end sidebar menu -->
            <style>
            /* body {
                width: 100%;
                height: 100vh;
                overflow: auto;
            } */

            ion-icon {
                font-size: 18px;
                margin-right: 1%;
                margin-bottom: 1%;
            }

            .marquee {
                font-size: 1rem;
                font-variant: small-caps;
                line-height: 1.3em;
                color: #000;
                background-color: #fff;
                margin-bottom: 1rem;
                border-radius: 10px !important;
                animation: marquee 8s linear infinite;
            }

            .marquee:hover span {
                animation-play-state: paused
            }

            .flex-container {
                padding: 0;
                margin: 0;
                list-style: none;
                display: flex;
                justify-content: space-around;
            }

            .flex-item {
                max-width: 100%;
                margin: 0 2.5rem 0;
                line-height: 35px;
                color: black;
                animation: marquee 15s linear infinite;
            }

            .center {
                justify-content: center;
            }

            /* #myDiv {
                    display: none;
                    text-align: center;
                } */
            /* #scroll {
                overflow: auto;
            } */
            </style>
            <!-- start page content -->
            <div class="page-container">
                <div class="page-content-wrapper">
                    <div class="page-content">
                        <div class="page-bar">
                            <?php echo $this->Flash->render() ?>
                            <?php echo $this->fetch('content'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page container -->

        <!-- start footer -->
        <div class="page-footer">
            <div class="page-footer-inner"> Copyright &copy; 2022. All Rights Reserved By
                <a href="www.mslabs.in" target="_blank" class="makerCss">TNPHC</a>
            </div>
            <div class="scroll-to-top">
                <span class="svg-icon svg-icon-primary svg-icon-2x">
                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Arrow-up.svg--><svg
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <rect fill="#000000" opacity="0.3" x="11" y="5" width="2" height="14" rx="1" />
                            <path
                                d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
                                fill="#000000" fill-rule="nonzero" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
            </div>
        </div>
        <!-- end footer -->
    </div>
    <!-- </div> -->


    <script type="text/javascript">
    // Top Progress bar 
    // NProgress.configure({
    //  speed: 1000,
    //     showSpinner: false
    // });

    NProgress.start();
    setTimeout(function() {
        NProgress.done();
    }, 1000);

    // end of Top Progress bar

    // (function() {
    //     var scroll = new LocomotiveScroll({
    //         el: document.querySelector('[data-scroll-container]'),
    //         smooth: true,
    //         direction: 'vertical',
    //         draggingClass: 'has-scroll-dragging',
    //         smoothClass: 'has-scroll-smooth'
    //     });
    // })();

    // Smooth - Scrollbar
    // var Scrollbar = window.Scrollbar;

    // var options = {
    //     'damping': 0.05
    // }

    // Scrollbar.init(document.querySelector('body'), options);
    // Scrollbar.initAll();
    // end of Smooth - Scrollbar

    // $(":input").bind("keyup change", function(e) {
    //     var pattern = new RegExp('<script>', 'gi');
    //     var endtag = new RegExp('<\/script>');

    //     this.value = this.value.replace(pattern, '').replace(/  +/g, ' ');
    //     this.value = this.value.replace(endtag, '').replace(/  +/g, ' ');

    // });

    function titleCase(string) {
        var sentence = string.toLowerCase().split(" ");
        for (var i = 0; i < sentence.length; i++) {
            sentence[i] = sentence[i][0].toUpperCase() + sentence[i].slice(1);
        }

        return sentence.join(" ");
    }


    jQuery('.titleCase').keyup(function() {
        this.value = titleCase(this.value);
    });


    jQuery('body').on('keyup', '.num', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '').replace(/  +/g, ' ');
    });

    jQuery('body').on('keyup', '.amount', function(e) {
        this.value = this.value.replace(/[^0-9\.]/g, '').replace(/  +/g, ' ');
    });

    jQuery('body').on('keyup', '.alphanumeric', function(e) {
        this.value = this.value.replace(/[^0-9a-zA-Z ]/g, '').replace(/  +/g, ' ');
    });

    jQuery('body').on('keyup', '.specialfield', function(e) {
        this.value = this.value.replace(/[^a-zA-Z0-9\.\&\-\_\/\s]/g, '').replace(/  +/g, ' ');
    });

    jQuery('body').on('keyup', '.trimspace', function(e) {
        var value = this.value.trim();
    });

    $(document).on("input", ".name", function() {
        this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
    });

    jQuery('body').on('focusout', '.email', function(e) {
        var trimmedValue = $('.email').val();
        $('.email').val('').val(trimmedValue);
    });

    $('.datetimepicker').flatpickr({
        maxDate: "today",
        enableTime: true,
        time_24hr: false,
        dateFormat: "d-m-Y H:i K"
    });
    $('.datepicker').flatpickr({
        maxDate: "today",
        dateFormat: "d-m-Y",
        allowInput: false
    });
    $(document).ready(function() {
        $('.tooltipster').tooltipster({
            contentAsHTML: true,
            animation: 'grow',
            delay: 200,
            theme: 'tooltipster-shadow',
            touchDevices: false,
            trigger: 'hover'
        });
    });
    </script>


    <!--tooltipster-->
    <?php echo $this->Html->script('/plugins/tooltipster/dist/js/tooltipster.bundle'); ?>

    <!-- Meterial Loading -->
    <?php //echo $this->Html->script('/js/pages/material-loading/material-loading'); ?>

    <!-- Marquee -->
    <?php //echo $this->Html->script('/js/pages/marquee/jquery.marquee'); ?>
    <?php //echo $this->Html->script('/js/pages/marquee/jquery.pause'); ?>

    <!--select2-->
    <?php echo $this->Html->script('/js/pages/material-select/getmdl-select'); ?>
    <?php echo $this->Html->script('/plugins/select2/js/select2'); ?>
    <?php echo $this->Html->script('/js/pages/select2/select2-init'); ?>

    <!-- <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script> -->

    <script src="<?php echo $this->Url->build('/js/tinymce/tinymce.min.js', ['fullBase' => true]); ?>" referrerpolicy="origin"></script>
</body>
</html>