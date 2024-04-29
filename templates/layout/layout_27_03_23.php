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
    <?php echo $this->Html->script('/plugins/amcharts4/core'); ?>
    <?php echo $this->Html->script('/plugins/amcharts4/charts'); ?>
    <?php echo $this->Html->script('/plugins/amcharts4/animated'); ?>
    <?php echo $this->Html->script('/plugins/amcharts4/worldLow'); ?>
    <?php echo $this->Html->script('/plugins/amcharts4/maps'); ?>
    <?php echo $this->Html->script('/js/pages/chart/amchart/amchart-data'); ?>
    <!-- Excel export -->
    <?php echo $this->Html->script('/js/export-excel'); ?>
	    <?php echo $this->Html->script('/js/jquery.battatech.excelexport.min'); ?>

    <!-- summernote -->
    <?php //echo $this->Html->script('/plugins/summernote/summernote'); ?>
    <!-- <?php echo $this->Html->script('/plugins/summernote/summernote'); ?> -->
    <!-- nProgress Loading -->
    <?php echo $this->Html->script('/plugins/nprogress/nprogress'); ?>
	
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css'>



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
	margin-bottom:15px !important;
	 text-transform: capitalize;
}


.sub-tile {
    font-size: 22px;
    font-weight: 600;
    color: #00355F;
    padding: 0;
	margin-top:10px;
}

.bol{
  font-weight: 600;	
}

.table{
    border-color: #dee2e6 !important;
}


.alignment {
	padding:15px !important;
}

  .lower {	  
	  margin-top:9px;	  
  }


   .blink {
        padding: 12px 55px;
  background-color: #004A7F;
  border: none;
  color: #FFFFFF;
  cursor: pointer;
  display: inline-block;
  font-size: 20px;
  text-align: center;
  text-decoration: none;
  -webkit-animation: glowing 1500ms infinite;
  -moz-animation: glowing 1500ms infinite;
  -o-animation: glowing 1500ms infinite;
  animation: glowing 1500ms infinite;
}
 
@-webkit-keyframes glowing {
  0% { background-color: #B20000; -webkit-box-shadow: 0 0 3px #B20000; }
  50% { background-color: #FF0000; -webkit-box-shadow: 0 0 40px #FF0000; }
  100% { background-color: #B20000; -webkit-box-shadow: 0 0 3px #B20000; }
}

@-moz-keyframes glowing {
  0% { background-color: #B20000; -moz-box-shadow: 0 0 3px #B20000; }
  50% { background-color: #FF0000; -moz-box-shadow: 0 0 40px #FF0000; }
  100% { background-color: #B20000; -moz-box-shadow: 0 0 3px #B20000; }
}

@-o-keyframes glowing {
  0% { background-color: #B20000; box-shadow: 0 0 3px #B20000; }
  50% { background-color: #FF0000; box-shadow: 0 0 40px #FF0000; }
  100% { background-color: #B20000; box-shadow: 0 0 3px #B20000; }
}

@keyframes glowing {
  0% { background-color: #B20000; box-shadow: 0 0 3px #B20000; }
  50% { background-color: #FF0000; box-shadow: 0 0 40px #FF0000; }
  100% { background-color: #B20000; box-shadow: 0 0 3px #B20000; }
}
</style>
<?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	     					
 ?>
<body class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-white">
    <div class="page-wrapper">
        <!-- Mobile Menus start -->
		<div class="mobile-menu">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<div class="container-fluid">
					<a href="index.html" class="navbar-brand">
						<span class="logo-default"><img src="<?php echo $this->Url->build('/img/tnphc_logo.png', ['fullBase' => true]); ?>"alt="Logo"></span> 
					</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>   
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">					     
						 <ul class="navbar-nav me-auto mb-2 mb-lg-0">
						    <li <?php if($this->request->getParam('action') == 'dashboard'){?>class="nav-item active"<?php }?>>
                                <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;Dashboard</span>', array('controller' => 'ProjectWorks', 'action' => 'dashboard'), array('escape' => false, 'class' => 'nav-link')); ?>
                            </li>
							  <?php if($LOGGED_ROLE == 1){   ?>
							 <li
                                <?php $masters = array('Roles','FinancialYears','Divisions');
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
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-calendar"></i>&nbsp;Financial Years</span>', array('controller' => 'FinancialYears', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li> 
									 <li <?php if($this->request->getParam('controller') == 'Divisions'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><ion-icon name="golf-outline"></ion-icon>&nbsp;Divisions</span>', array('controller' => 'Divisions', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li> 
									 <li <?php if($this->request->getParam('controller') == 'Districts'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><ion-icon name="golf-outline"></ion-icon>&nbsp;Districts</span>', array('controller' => 'Districts', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
									 <li <?php if($this->request->getParam('controller') == 'Departments'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><ion-icon name="mail-outline"></ion-icon>&nbsp;Departments</span>', array('controller' => 'Departments', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
									<li <?php if($this->request->getParam('controller') == 'BuildingTypes'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<ion-icon name="business-outline"></ion-icon><span class="title">&nbsp;Building Types</span>', array('controller' => 'BuildingTypes', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
									<li <?php if($this->request->getParam('controller') == 'WorkStages'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;WorkStages</span>', array('controller' => 'WorkStages', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
									<li <?php if($this->request->getParam('controller') == 'Contractors'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Contractors</span>', array('controller' => 'Contractors', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
                                    <li <?php if($this->request->getParam('controller') == 'DepartmentwiseWorkTypes'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Work Type</span>', array('controller' => 'DepartmentwiseWorkTypes', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>	
                                    <li <?php if($this->request->getParam('controller') == 'PoliceDesignations'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Police Designation</span>', array('controller' => 'PoliceDesignations', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
									<li>
									  <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Unit</span>', array('controller' => 'Units', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
									</li>
									<li>
									  <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Tender Status</span>', array('controller' => 'TenderStatuses', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
									</li> 	 									
                                </ul>
                            </li> 
							<!--li
                                <?php $masters = array('Roles','FinancialYears','Divisions');
                                echo (in_array($this->request->getParam('controller'),$masters)) ? 'class="nav-item active"': ' ';?>>
                                <a href="#" class="nav-link nav-toggle">
                                    <ion-icon name="apps-outline"></ion-icon>
                                    <span class="title">&nbsp;Materials Data</span> <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">							   
									<li <?php if($this->request->getParam('controller') == 'BuildingMaterials'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Materials Type</span>', array('controller' => 'BuildingMaterials', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
									<li <?php if($this->request->getParam('controller') == 'BuildingSubmaterials'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Materials Subtype</span>', array('controller' => 'BuildingSubmaterials', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>									
									<li <?php if($this->request->getParam('controller') == 'FinancialyearwiseMaterialCostSubdetails'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Material Details</span>', array('controller' => 'BuildingMaterialDetails', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
									<li <?php if($this->request->getParam('controller') == 'FinancialyearwiseMaterialCostSubdetails'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Financialyearwise Material Cost</span>', array('controller' => 'FinancialyearwiseMaterialCostSubdetails', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
                                </ul>
                            </li--> 
                            <?php  }   ?>										
							 <?php if($LOGGED_ROLE == 1 || $LOGGED_ROLE == 2){   ?>
								<li
									<?php $masters = array('Roles','FinancialYears','Divisions');
									echo (in_array($this->request->getParam('controller'),$masters)) ? 'class="nav-item active"': ' ';?>>
									<a href="#" class="nav-link nav-toggle">
										<ion-icon name="apps-outline"></ion-icon>
										<span class="title">&nbsp;Estimate Master</span> <span class="arrow"></span>
									</a>
									<ul class="sub-menu">
									   
										<!--li <?php if($this->request->getParam('controller') == 'DevelopmentWorks'){?>class="nav-item active"
											<?php }?>>
											<?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Development Works</span>', array('controller' => 'DevelopmentWorks', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
										</li-->									
										<li <?php if($this->request->getParam('controller') == 'BuildingItems'){?>class="nav-item active"
											<?php }?>>
											<?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Building Items</span>', array('controller' => 'BuildingItems', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
										</li>									
									</ul>
								</li> 
							  <?php  } ?>
							   <?php if($LOGGED_ROLE == 9 || $LOGGED_ROLE == 14){   ?>
							   <li <?php if($this->request->getParam('action') == 'OldProjectWorkDetails'){?>class="nav-item active"
                                <?php }?>>
                                <?php echo $this->Html->link('<i class="fa fa-money"></i><span class="title">&nbsp;Work In Progress</span>', array('controller' => 'OldProjectWorkDetails', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                               </li>
							  
							<?php  } ?>  
							  <?php if($LOGGED_ROLE == 6 || $LOGGED_ROLE == 9){   ?>
							  <li
                                <?php $masters = array('Roles','FinancialYears','Divisions');
                                echo (in_array($this->request->getParam('controller'),$masters)) ? 'class="nav-item active"': ' ';?>>
                                <a href="#" class="nav-link nav-toggle">
                                    <ion-icon name="apps-outline"></ion-icon>
                                    <span class="title">&nbsp;New Proposal</span> <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">						   
									<li <?php if($this->request->getParam('controller') == 'BuildingMaterials'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<ion-icon name="business-outline"></ion-icon><span class="title">&nbsp;Construction Work</span>', array('controller' => 'ProjectWorks', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
									<li <?php if($this->request->getParam('controller') == 'BuildingSubmaterials'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Repair Work</span>', array('controller' => 'RepairworkDetails', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>									
                                </ul>
                            </li>
							 <!--li <?php if($this->request->getParam('controller') == 'ProjectWorks'){?>class="nav-item "
                                <?php }?>>
                                <?php echo $this->Html->link('<ion-icon name="business-outline"></ion-icon><span class="title">&nbsp;Proposed Projects</span>', array('controller' => 'ProjectWorks', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                            </li-->
							 <?php  } ?>
							 <?php if($LOGGED_ROLE == 18){   ?>
							  <li >
                                <?php echo $this->Html->link('<i class="fa fa-file-image-o"></i><span class="title">&nbsp;Drawing Upload</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist/16'), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>
							  <?php }else{ ?>
							  <li <?php if($this->request->getParam('action') == 'approvedlist'){?>class="nav-item active"
                                <?php }?>>
                                <?php echo $this->Html->link('<ion-icon name="business-outline"></ion-icon><span class="title">&nbsp;Approved Projects</span>', array('controller' => 'ProjectWorks', 'action' => 'approvedlist'), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>
							  <?php } ?>
							  <?php if($LOGGED_ROLE == 6 || $LOGGED_ROLE == 8 || $LOGGED_ROLE == 1 || $LOGGED_ROLE == 9 || $LOGGED_ROLE == 17){    ?>
							 <li
									<?php $masters = array('Reports');
									echo (in_array($this->request->getParam('controller'),$masters)) ? 'class="nav-item active"': ' ';?>>
									<a href="#" class="nav-link nav-toggle">
										<ion-icon name="apps-outline"></ion-icon>
										<span class="title">&nbsp;Reports</span> <span class="arrow"></span>
									</a>
									<ul class="sub-menu">
									   
										<li <?php if($this->request->getParam('controller') == 'DevelopmentWorks'){?>class="nav-item active"
											<?php }?>>
											<?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Department Wise Report</span>', array('controller' => 'Reports', 'action' => 'departmentreport'), array('escape' => false, 'class' => 'nav-link')); ?>
										</li>									
										<li <?php if($this->request->getParam('controller') == 'Reports'){?>class="nav-item active"
											<?php }?>>
											<?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Division Wise Report</span>', array('controller' => 'Reports', 'action' => 'divisionwise'), array('escape' => false, 'class' => 'nav-link')); ?>
										</li>
										<li <?php if($this->request->getParam('controller') == 'Reports'){?>class="nav-item active"
											<?php }?>>
											<?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Statistic Report</span>', array('controller' => 'Reports', 'action' => 'sanctionedreport'), array('escape' => false, 'class' => 'nav-link')); ?>
										</li>
	                                     <li <?php if($this->request->getParam('controller') == 'Reports'){?>class="nav-item active"
											<?php }?>>
											<?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Progress Report</span>', array('controller' => 'Reports', 'action' => 'progressreport'), array('escape' => false, 'class' => 'nav-link')); ?>
										</li>
										<li <?php if($this->request->getParam('controller') == 'Reports'){?>class="nav-item active"
											<?php }?>>
											<?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Expenditure Report</span>', array('controller' => 'Reports', 'action' => 'expenditurereport'), array('escape' => false, 'class' => 'nav-link')); ?>
										</li>
										<li <?php if($this->request->getParam('controller') == 'Reports'){?>class="nav-item active"
											<?php }?>>
											<?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Contractor Report</span>', array('controller' => 'Reports', 'action' => 'contractorreport'), array('escape' => false, 'class' => 'nav-link')); ?>
										</li>
										<li <?php if ($this->request->getParam('controller') == 'Reports') { ?>class="nav-item active" <?php } ?>>
                                            <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Planning permission Status</span>', array('controller' => 'Reports', 'action' => 'planningandpermissiondetails'), array('escape' => false, 'class' => 'nav-link')); ?>
									     </li>
										 <li <?php if ($this->request->getParam('controller') == 'Reports') { ?>class="nav-item active" <?php } ?>>
                                            <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Tentative Financial Report</span>', array('controller' => 'Reports', 'action' => 'tentativefinancialreport'), array('escape' => false, 'class' => 'nav-link')); ?>
									     </li> 
										 <!--li <?php if ($this->request->getParam('controller') == 'Reports') { ?>class="nav-item active" <?php } ?>>
                                            <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Utilization Certificate Report</span>', array('controller' => 'Reports', 'action' => 'utilisationcertificate'), array('escape' => false, 'class' => 'nav-link')); ?>
									     </li-->  
									</ul>
							</li>  
								<?php  } ?>  
							 <?php if($LOGGED_ROLE == 9){   ?>
							<li <?php if($this->request->getParam('action') == 'administrativesanctionadd'){?>class="nav-item active"
                                <?php }?>>
                                <?php echo $this->Html->link('<i class="fa fa-money"></i><span class="title">&nbsp;Administrative Sanction</span>', array('controller' => 'ProjectWorks', 'action' => 'administrativesanctionadd'), array('escape' => false, 'class' => 'nav-link')); ?>
                            </li>
							<li <?php if($this->request->getParam('action') == 'financialsanctionadd'){?>class="nav-item active"
                                <?php }?>>
                                <?php echo $this->Html->link('<i class="fa fa-money"></i><span class="title">&nbsp;Financial Sanction</span>', array('controller' => 'ProjectWorks', 'action' => 'financialsanctionadd'), array('escape' => false, 'class' => 'nav-link')); ?>
                            </li>
							<?php  } ?>
							 <?php if($LOGGED_ROLE == 8){   ?>
							    <li <?php if($this->request->getParam('controller') == 'ProjectFundDetails'){?>class="nav-item active"
                                <?php }?>>							 
							     <?php //echo $this->Html->link('<i class="fa fa-money"></i><span class="title">&nbsp;Fund Details</span>', array('controller' => 'ProjectFundDetails', 'action' => 'fundrequestlist'), array('escape' => false, 'class' => 'nav-link')); ?>
								</li>
							 <?php  } ?>  
							 
                          <?php if($LOGGED_ROLE == 1){   ?>
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
						  <?php  }  ?>
						    <?php if($LOGGED_ROLE == 14){  ?>
							 <li>
                                  <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;Detailed Estimate Upload</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',0), array('escape' => false, 'class' => 'nav-link')); ?>
                            </li>
							<?php  } ?>
						  
						    <?php if($LOGGED_ROLE == 2 || $LOGGED_ROLE == 14 ||$LOGGED_ROLE == 4 || $LOGGED_ROLE == 5 || $LOGGED_ROLE == 6){  ?>
							 <li >
                                  <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">Abstract / TechnicalSanction</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',1), array('escape' => false, 'class' => 'nav-link')); ?>
                            </li>
							<?php  } ?>							
							<?php if($LOGGED_ROLE == 14 || $LOGGED_ROLE == 4 || $LOGGED_ROLE == 5 || $LOGGED_ROLE == 6){  ?>
							   <li>
                                  <?php //echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;Technical Sanction</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',2), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>							   
							  <?php  } ?>							  
							  <?php if($LOGGED_ROLE == 14 ||$LOGGED_ROLE == 12 || $LOGGED_ROLE == 10){    ?>
							   <li>
                                  <?php echo $this->Html->link('<ion-icon name="archive"></ion-icon><span class="title">&nbsp;Tender Details</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',3), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>	
							   <?php if($LOGGED_ROLE == 12){ ?>
							   <li>
                                  <?php echo $this->Html->link('<ion-icon name="archive"></ion-icon><span class="title">&nbsp;Tender Cancel and Renew</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',15), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>
							  <?php  } ?>
							  <?php  } ?>
							  <?php if($LOGGED_ROLE == 12){ ?>
							   <li <?php if($this->request->getParam('controller') == 'Contractors'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Contractors</span>', array('controller' => 'Contractors', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                               </li>
							  <?php  } ?>
							   <?php if($LOGGED_ROLE == 13){    ?>
							   <li>
                                  <?php echo $this->Html->link('<ion-icon name="archive"></ion-icon><span class="title">&nbsp;Planning Clearance</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',4), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>
							  <li>
                                  <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;Site Hand Over</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',5), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>							   
							  <?php  } ?>						  
							  <?php if($LOGGED_ROLE == 15 || $LOGGED_ROLE == 4 || $LOGGED_ROLE == 5 || $LOGGED_ROLE == 6 || $LOGGED_ROLE == 16 || $LOGGED_ROLE == 8){  ?>
							   <li>
                                  <?php echo $this->Html->link('<i class="fa fa-money"></i><span class="title">&nbsp;Fund Request</span>', array('controller' => 'ProjectWorks', 'action' => 'projectfundrequestlist'), array('escape' => false, 'class' => 'nav-link')); ?>
                               </li>							   
							  <?php  } ?>							  
							  <?php if($LOGGED_ROLE == 9){    ?>
							   <li>
                                  <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;Utilization Certificate</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',8), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>
							  <?php } ?>				  
							   <?php if($LOGGED_ROLE == 13){    ?>
							   <li>
                                  <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;Project Monitoring</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',7), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>							  
							  <li>
                                  <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;Project Handover to User Department</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',9), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>
							  <?php  } ?>
							  <?php if($LOGGED_ROLE == 15 || $LOGGED_ROLE == 5 || $LOGGED_ROLE == 6 || $LOGGED_ROLE == 17){    ?>
							    <li>
								  <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;EOT</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',14), array('escape' => false, 'class' => 'nav-link')); ?>
							   </li>						  
							    <?php  } ?>
							   <?php // if($LOGGED_ROLE == 13 || $LOGGED_ROLE == 4 || $LOGGED_ROLE == 5 || $LOGGED_ROLE == 6 || $LOGGED_ROLE == 8){    ?>
							   <?php if($LOGGED_ROLE == 13 ||  $LOGGED_ROLE == 9){    ?>
							  <li>
                                  <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;Completion Report</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',10), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>
							   <?php  } ?>
							     <?php if($LOGGED_ROLE == 13){    ?>
							  <li>
                                  <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;Tentative Financial Programme</span>', array('controller' => 'TentativeFinancialProgrammeDetails', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>
							   <?php  } ?>
							   <?php if($LOGGED_ROLE == 9){    ?>
							    <li>
								  <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;Add Units (Quarters)</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',11), array('escape' => false, 'class' => 'nav-link')); ?>
							    </li>
								<li>
								  <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;Placed to Board</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',12), array('escape' => false, 'class' => 'nav-link')); ?>
							    </li>
								<li>
								  <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;Development Work</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',13), array('escape' => false, 'class' => 'nav-link')); ?>
							    </li>								
							   <?php  } ?>						   
							  
							   <?php if($LOGGED_ROLE == 8 || $LOGGED_ROLE == 16){    ?>
							   <li>
                                  <?php echo $this->Html->link('<i class="fa fa-money"></i><span class="title">&nbsp;PD Account Balance</span>', array('controller' => 'OpeningBalanceDetails', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>
							   <?php } ?>
							    <?php if($LOGGED_ROLE == 8 || $LOGGED_ROLE == 16){    ?>
							  <li>
                                  <?php echo $this->Html->link('<i class="fa fa-money"></i></ion-icon><span class="title">&nbsp;Fund Request to User Department</span>', array('controller' => 'OpeningBalanceLogs', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>
							   <li>
                                  <?php echo $this->Html->link('<i class="fa fa-money"></i></ion-icon><span class="title">&nbsp; UC Fund Sanctioned</span>', array('controller' => 'UcFundSanctionedDetails', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>
							   
							  <?php  } ?>
							  
						 <li <?php if($this->request->getParam('controller') == 'Users' && $this->request->getParam('action') == 'changepassword'){?>class="nav-item active"
                                <?php }?>>
							<?php echo $this->Html->link('<ion-icon name="sync-outline" size="small"></ion-icon> Change Password', ['controller' => 'Users', 'action' => 'changepassword'], ['escape' => false, 'class' => 'nav-link']);?>
						</li>                                 
						<li>
							<?php echo $this->Html->link('<ion-icon name="log-out-outline" size="small"></ion-icon> Log Out', ['controller' => 'Users', 'action' => 'logout'], ['escape' => false, 'class' => 'nav-link']);?>
						</li>				  
							 
						</ul>						 
					</div>
				</div>
			</nav>
		</div>
		<!-- Mobile Menus End -->
            <?php $user = $this->request->getAttribute('identity'); ?>
        <!-- start page container -->
        <div class="page-container">
            <!-- start sidebar menu -->
            <div class="sidebar-container">
                <div class="sidemenu-container navbar-collapse collapse fixed-menu">
					<div class="logo-bottom">
                            <a href="index.html">
                                <img src="<?php echo $this->Url->build('/img/tnphc_logo.png', ['fullBase' => true]); ?>">
                            </a>
                        </div>
                    <div id="remove-scroll" class="left-sidemenu">									
                        <ul class="sidemenu  page-header-fixed sidemenu-hover-submenu" data-keep-expanded="false"
                            data-auto-scroll="false" data-slide-speed="200" >
                        
                             <li <?php if($this->request->getParam('action') == 'dashboard'){?>class="nav-item active"<?php }?>>
                                <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;Dashboard</span>', array('controller' => 'ProjectWorks', 'action' => 'dashboard'), array('escape' => false, 'class' => 'nav-link')); ?>
                            </li>
							  <?php if($LOGGED_ROLE == 1){   ?>
							 <li
                                <?php $masters = array('Roles','FinancialYears','Divisions');
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
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-calendar"></i>&nbsp;Financial Years</span>', array('controller' => 'FinancialYears', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li> 
									 <li <?php if($this->request->getParam('controller') == 'Divisions'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><ion-icon name="golf-outline"></ion-icon>&nbsp;Divisions</span>', array('controller' => 'Divisions', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li> 
									 <li <?php if($this->request->getParam('controller') == 'Districts'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><ion-icon name="golf-outline"></ion-icon>&nbsp;Districts</span>', array('controller' => 'Districts', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
									 <li <?php if($this->request->getParam('controller') == 'Departments'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><ion-icon name="mail-outline"></ion-icon>&nbsp;Departments</span>', array('controller' => 'Departments', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
									<li <?php if($this->request->getParam('controller') == 'BuildingTypes'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<ion-icon name="business-outline"></ion-icon><span class="title">&nbsp;Building Types</span>', array('controller' => 'BuildingTypes', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
									<li <?php if($this->request->getParam('controller') == 'WorkStages'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;WorkStages</span>', array('controller' => 'WorkStages', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
									<li <?php if($this->request->getParam('controller') == 'Contractors'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Contractors</span>', array('controller' => 'Contractors', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
                                    <li <?php if($this->request->getParam('controller') == 'DepartmentwiseWorkTypes'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Work Type</span>', array('controller' => 'DepartmentwiseWorkTypes', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>	
                                    <li <?php if($this->request->getParam('controller') == 'PoliceDesignations'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Police Designation</span>', array('controller' => 'PoliceDesignations', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
									<li>
									  <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Unit</span>', array('controller' => 'Units', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
									</li>
									<li>
									  <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Tender Status</span>', array('controller' => 'TenderStatuses', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
									</li> 	 									
                                </ul>
                            </li> 
							<!--li
                                <?php $masters = array('Roles','FinancialYears','Divisions');
                                echo (in_array($this->request->getParam('controller'),$masters)) ? 'class="nav-item active"': ' ';?>>
                                <a href="#" class="nav-link nav-toggle">
                                    <ion-icon name="apps-outline"></ion-icon>
                                    <span class="title">&nbsp;Materials Data</span> <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">							   
									<li <?php if($this->request->getParam('controller') == 'BuildingMaterials'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Materials Type</span>', array('controller' => 'BuildingMaterials', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
									<li <?php if($this->request->getParam('controller') == 'BuildingSubmaterials'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Materials Subtype</span>', array('controller' => 'BuildingSubmaterials', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>									
									<li <?php if($this->request->getParam('controller') == 'FinancialyearwiseMaterialCostSubdetails'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Material Details</span>', array('controller' => 'BuildingMaterialDetails', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
									<li <?php if($this->request->getParam('controller') == 'FinancialyearwiseMaterialCostSubdetails'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Financialyearwise Material Cost</span>', array('controller' => 'FinancialyearwiseMaterialCostSubdetails', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
                                </ul>
                            </li--> 
                            <?php  }   ?>										
							 <?php if($LOGGED_ROLE == 1 || $LOGGED_ROLE == 2){   ?>
								<li
									<?php $masters = array('Roles','FinancialYears','Divisions');
									echo (in_array($this->request->getParam('controller'),$masters)) ? 'class="nav-item active"': ' ';?>>
									<a href="#" class="nav-link nav-toggle">
										<ion-icon name="apps-outline"></ion-icon>
										<span class="title">&nbsp;Estimate Master</span> <span class="arrow"></span>
									</a>
									<ul class="sub-menu">
									   
										<!--li <?php if($this->request->getParam('controller') == 'DevelopmentWorks'){?>class="nav-item active"
											<?php }?>>
											<?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Development Works</span>', array('controller' => 'DevelopmentWorks', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
										</li-->									
										<li <?php if($this->request->getParam('controller') == 'BuildingItems'){?>class="nav-item active"
											<?php }?>>
											<?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Building Items</span>', array('controller' => 'BuildingItems', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
										</li>									
									</ul>
								</li> 
							  <?php  } ?>
							   <?php if($LOGGED_ROLE == 9 || $LOGGED_ROLE == 14){   ?>
							   <li <?php if($this->request->getParam('action') == 'OldProjectWorkDetails'){?>class="nav-item active"
                                <?php }?>>
                                <?php echo $this->Html->link('<i class="fa fa-money"></i><span class="title">&nbsp;Work In Progress</span>', array('controller' => 'OldProjectWorkDetails', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                               </li>
							  
							<?php  } ?>  
							  <?php if($LOGGED_ROLE == 6 || $LOGGED_ROLE == 9){   ?>
							  <li
                                <?php $masters = array('Roles','FinancialYears','Divisions');
                                echo (in_array($this->request->getParam('controller'),$masters)) ? 'class="nav-item active"': ' ';?>>
                                <a href="#" class="nav-link nav-toggle">
                                    <ion-icon name="apps-outline"></ion-icon>
                                    <span class="title">&nbsp;New Proposal</span> <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">						   
									<li <?php if($this->request->getParam('controller') == 'BuildingMaterials'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<ion-icon name="business-outline"></ion-icon><span class="title">&nbsp;Construction Work</span>', array('controller' => 'ProjectWorks', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>
									<li <?php if($this->request->getParam('controller') == 'BuildingSubmaterials'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Repair Work</span>', array('controller' => 'RepairworkDetails', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                                    </li>									
                                </ul>
                            </li>
							 <!--li <?php if($this->request->getParam('controller') == 'ProjectWorks'){?>class="nav-item "
                                <?php }?>>
                                <?php echo $this->Html->link('<ion-icon name="business-outline"></ion-icon><span class="title">&nbsp;Proposed Projects</span>', array('controller' => 'ProjectWorks', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                            </li-->
							 <?php  } ?>
							 <?php if($LOGGED_ROLE == 18){   ?>
							  <li >
                                <?php echo $this->Html->link('<i class="fa fa-file-image-o"></i><span class="title">&nbsp;Drawing Upload</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist/16'), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>
							  <?php }else{ ?>
							  <li <?php if($this->request->getParam('action') == 'approvedlist'){?>class="nav-item active"
                                <?php }?>>
                                <?php echo $this->Html->link('<ion-icon name="business-outline"></ion-icon><span class="title">&nbsp;Approved Projects</span>', array('controller' => 'ProjectWorks', 'action' => 'approvedlist'), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>
							  <?php } ?>
							  <?php if($LOGGED_ROLE == 6 || $LOGGED_ROLE == 8 || $LOGGED_ROLE == 1 || $LOGGED_ROLE == 9 || $LOGGED_ROLE == 17){    ?>
							 <li
									<?php $masters = array('Reports');
									echo (in_array($this->request->getParam('controller'),$masters)) ? 'class="nav-item active"': ' ';?>>
									<a href="#" class="nav-link nav-toggle">
										<ion-icon name="apps-outline"></ion-icon>
										<span class="title">&nbsp;Reports</span> <span class="arrow"></span>
									</a>
									<ul class="sub-menu">
									   
										<li <?php if($this->request->getParam('controller') == 'DevelopmentWorks'){?>class="nav-item active"
											<?php }?>>
											<?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Department Wise Report</span>', array('controller' => 'Reports', 'action' => 'departmentreport'), array('escape' => false, 'class' => 'nav-link')); ?>
										</li>									
										<li <?php if($this->request->getParam('controller') == 'Reports'){?>class="nav-item active"
											<?php }?>>
											<?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Division Wise Report</span>', array('controller' => 'Reports', 'action' => 'divisionwise'), array('escape' => false, 'class' => 'nav-link')); ?>
										</li>
										<li <?php if($this->request->getParam('controller') == 'Reports'){?>class="nav-item active"
											<?php }?>>
											<?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Statistic Report</span>', array('controller' => 'Reports', 'action' => 'sanctionedreport'), array('escape' => false, 'class' => 'nav-link')); ?>
										</li>
	                                     <li <?php if($this->request->getParam('controller') == 'Reports'){?>class="nav-item active"
											<?php }?>>
											<?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Progress Report</span>', array('controller' => 'Reports', 'action' => 'progressreport'), array('escape' => false, 'class' => 'nav-link')); ?>
										</li>
										<li <?php if($this->request->getParam('controller') == 'Reports'){?>class="nav-item active"
											<?php }?>>
											<?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Expenditure Report</span>', array('controller' => 'Reports', 'action' => 'expenditurereport'), array('escape' => false, 'class' => 'nav-link')); ?>
										</li>
										<li <?php if($this->request->getParam('controller') == 'Reports'){?>class="nav-item active"
											<?php }?>>
											<?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Contractor Report</span>', array('controller' => 'Reports', 'action' => 'contractorreport'), array('escape' => false, 'class' => 'nav-link')); ?>
										</li>
										<li <?php if ($this->request->getParam('controller') == 'Reports') { ?>class="nav-item active" <?php } ?>>
                                            <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Planning permission Status</span>', array('controller' => 'Reports', 'action' => 'planningandpermissiondetails'), array('escape' => false, 'class' => 'nav-link')); ?>
									     </li>
										 <li <?php if ($this->request->getParam('controller') == 'Reports') { ?>class="nav-item active" <?php } ?>>
                                            <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Tentative Financial Report</span>', array('controller' => 'Reports', 'action' => 'tentativefinancialreport'), array('escape' => false, 'class' => 'nav-link')); ?>
									     </li> 
										 <!--li <?php if ($this->request->getParam('controller') == 'Reports') { ?>class="nav-item active" <?php } ?>>
                                            <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Utilization Certificate Report</span>', array('controller' => 'Reports', 'action' => 'utilisationcertificate'), array('escape' => false, 'class' => 'nav-link')); ?>
									     </li-->  
									</ul>
							</li>  
								<?php  } ?>  
							 <?php if($LOGGED_ROLE == 9){   ?>
							<li <?php if($this->request->getParam('action') == 'administrativesanctionadd'){?>class="nav-item active"
                                <?php }?>>
                                <?php echo $this->Html->link('<i class="fa fa-money"></i><span class="title">&nbsp;Administrative Sanction</span>', array('controller' => 'ProjectWorks', 'action' => 'administrativesanctionadd'), array('escape' => false, 'class' => 'nav-link')); ?>
                            </li>
							<li <?php if($this->request->getParam('action') == 'financialsanctionadd'){?>class="nav-item active"
                                <?php }?>>
                                <?php echo $this->Html->link('<i class="fa fa-money"></i><span class="title">&nbsp;Financial Sanction</span>', array('controller' => 'ProjectWorks', 'action' => 'financialsanctionadd'), array('escape' => false, 'class' => 'nav-link')); ?>
                            </li>
							<?php  } ?>
							 <?php if($LOGGED_ROLE == 8){   ?>
							    <li <?php if($this->request->getParam('controller') == 'ProjectFundDetails'){?>class="nav-item active"
                                <?php }?>>							 
							     <?php //echo $this->Html->link('<i class="fa fa-money"></i><span class="title">&nbsp;Fund Details</span>', array('controller' => 'ProjectFundDetails', 'action' => 'fundrequestlist'), array('escape' => false, 'class' => 'nav-link')); ?>
								</li>
							 <?php  } ?>  
							 
                          <?php if($LOGGED_ROLE == 1){   ?>
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
						  <?php  }  ?>
						    <?php if($LOGGED_ROLE == 14){  ?>
							 <li>
                                  <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;Detailed Estimate Upload</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',0), array('escape' => false, 'class' => 'nav-link')); ?>
                            </li>
							<?php  } ?>
						  
						    <?php if($LOGGED_ROLE == 2 || $LOGGED_ROLE == 14 ||$LOGGED_ROLE == 4 || $LOGGED_ROLE == 5 || $LOGGED_ROLE == 6){  ?>
							 <li >
                                  <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">Abstract / TechnicalSanction</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',1), array('escape' => false, 'class' => 'nav-link')); ?>
                            </li>
							<?php  } ?>							
							<?php if($LOGGED_ROLE == 14 || $LOGGED_ROLE == 4 || $LOGGED_ROLE == 5 || $LOGGED_ROLE == 6){  ?>
							   <li>
                                  <?php //echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;Technical Sanction</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',2), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>							   
							  <?php  } ?>							  
							  <?php if($LOGGED_ROLE == 14 ||$LOGGED_ROLE == 12 || $LOGGED_ROLE == 10){    ?>
							   <li>
                                  <?php echo $this->Html->link('<ion-icon name="archive"></ion-icon><span class="title">&nbsp;Tender Details</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',3), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>	
							   <?php if($LOGGED_ROLE == 12){ ?>
							   <li>
                                  <?php echo $this->Html->link('<ion-icon name="archive"></ion-icon><span class="title">&nbsp;Tender Cancel and Renew</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',15), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>
							  <?php  } ?>
							  <?php  } ?>
							  <?php if($LOGGED_ROLE == 12){ ?>
							   <li <?php if($this->request->getParam('controller') == 'Contractors'){?>class="nav-item active"
                                        <?php }?>>
                                        <?php echo $this->Html->link('<span class="title"><i class="icon-people"></i>&nbsp;Contractors</span>', array('controller' => 'Contractors', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                               </li>
							  <?php  } ?>
							   <?php if($LOGGED_ROLE == 13){    ?>
							   <li>
                                  <?php echo $this->Html->link('<ion-icon name="archive"></ion-icon><span class="title">&nbsp;Planning Clearance</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',4), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>
							  <li>
                                  <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;Site Hand Over</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',5), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>							   
							  <?php  } ?>						  
							  <?php if($LOGGED_ROLE == 15 || $LOGGED_ROLE == 4 || $LOGGED_ROLE == 5 || $LOGGED_ROLE == 6 || $LOGGED_ROLE == 16 || $LOGGED_ROLE == 8){  ?>
							   <li>
                                  <?php echo $this->Html->link('<i class="fa fa-money"></i><span class="title">&nbsp;Fund Request</span>', array('controller' => 'ProjectWorks', 'action' => 'projectfundrequestlist'), array('escape' => false, 'class' => 'nav-link')); ?>
                               </li>							   
							  <?php  } ?>							  
							  <?php if($LOGGED_ROLE == 9){    ?>
							   <li>
                                  <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;Utilization Certificate</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',8), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>
							  <?php } ?>				  
							   <?php if($LOGGED_ROLE == 13){    ?>
							   <li>
                                  <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;Project Monitoring</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',7), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>							  
							  <li>
                                  <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;Project Handover to User Department</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',9), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>
							  <?php  } ?>
							  <?php if($LOGGED_ROLE == 15 || $LOGGED_ROLE == 5 || $LOGGED_ROLE == 6 || $LOGGED_ROLE == 17){    ?>
							    <li>
								  <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;EOT</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',14), array('escape' => false, 'class' => 'nav-link')); ?>
							   </li>						  
							    <?php  } ?>
							   <?php // if($LOGGED_ROLE == 13 || $LOGGED_ROLE == 4 || $LOGGED_ROLE == 5 || $LOGGED_ROLE == 6 || $LOGGED_ROLE == 8){    ?>
							   <?php if($LOGGED_ROLE == 13 ||  $LOGGED_ROLE == 9){    ?>
							  <li>
                                  <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;Completion Report</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',10), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>
							   <?php  } ?>
							     <?php if($LOGGED_ROLE == 13){    ?>
							  <li>
                                  <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;Tentative Financial Programme</span>', array('controller' => 'TentativeFinancialProgrammeDetails', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>
							   <?php  } ?>
							   <?php if($LOGGED_ROLE == 9){    ?>
							    <li>
								  <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;Add Units (Quarters)</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',11), array('escape' => false, 'class' => 'nav-link')); ?>
							    </li>
								<li>
								  <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;Placed to Board</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',12), array('escape' => false, 'class' => 'nav-link')); ?>
							    </li>
								<li>
								  <?php echo $this->Html->link('<ion-icon name="home-outline"></ion-icon><span class="title">&nbsp;Development Work</span>', array('controller' => 'ProjectWorks', 'action' => 'projectlist',13), array('escape' => false, 'class' => 'nav-link')); ?>
							    </li>								
							   <?php  } ?>						   
							  
							   <?php if($LOGGED_ROLE == 8 || $LOGGED_ROLE == 16){    ?>
							   <li>
                                  <?php echo $this->Html->link('<i class="fa fa-money"></i><span class="title">&nbsp;PD Account Balance</span>', array('controller' => 'OpeningBalanceDetails', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>
							   <?php } ?>
							    <?php if($LOGGED_ROLE == 8 || $LOGGED_ROLE == 16){    ?>
							  <li>
                                  <?php echo $this->Html->link('<i class="fa fa-money"></i></ion-icon><span class="title">&nbsp;Fund Request to User Department</span>', array('controller' => 'OpeningBalanceLogs', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>
							   <li>
                                  <?php echo $this->Html->link('<i class="fa fa-money"></i></ion-icon><span class="title">&nbsp; UC Fund Sanctioned</span>', array('controller' => 'UcFundSanctionedDetails', 'action' => 'index'), array('escape' => false, 'class' => 'nav-link')); ?>
                              </li>
							   
							  <?php  } ?>
							  
						 <li <?php if($this->request->getParam('controller') == 'Users' && $this->request->getParam('action') == 'changepassword'){?>class="nav-item active"
                                <?php }?>>
							<?php echo $this->Html->link('<ion-icon name="sync-outline" size="small"></ion-icon> Change Password', ['controller' => 'Users', 'action' => 'changepassword'], ['escape' => false, 'class' => 'nav-link']);?>
						</li>                                 
						<li>
							<?php echo $this->Html->link('<ion-icon name="log-out-outline" size="small"></ion-icon> Log Out', ['controller' => 'Users', 'action' => 'logout'], ['escape' => false, 'class' => 'nav-link']);?>
						</li>
						 <div class="top-menu">
                            <ul class="nav navbar-nav pull-left">
                                <li class="dropdown dropdown-user">
                                    <a class="dropdown-toggle" data-bs-toggle="dropdown" data-hover="dropdown"
                                        data-close-others="true">
                                        <img alt="Dp" class="img-circle width-30" src ="<?php echo $this->Url->build('/img/profile.png', ['fullBase' => true]); ?>" />
                                           &nbsp;&nbsp;
                                        <span class="username username-hide-on-mobile" style="text-transform:capitalize;">
                                            <?php echo $LOGGED_NAME; ?> </span> 
									</a>                                  
                                </li>                                
                            </ul>
                          </div>                   
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
                font-size: 16px;
                margin-right: 1%;
                margin-bottom: 3%;
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
	

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

    <!--script src="<?php echo $this->Url->build('/js/tinymce/tinymce.min.js', ['fullBase' => true]); ?>" referrerpolicy="origin"></script-->
</body>
</html>