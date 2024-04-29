<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta name="description" content="Responsive Admin Template" />
    <meta name="author" content="RedstarHospital" />
    <link rel="shortcut icon" href="<?php echo $this->Url->build('/tnphc_logo.png', ['fullBase' => true]); ?>" type="image/x-icon">
    <title>Login | TNPHC</title>
    <!-- google font -->
    <link href="http://fonts.googleapis.com/css?family=Poppins:400,300,600,700&subset=all" rel="stylesheet"
        type="text/css" />
    <!-- icons -->
    <?php echo $this->Html->script('https://kit.fontawesome.com/64d58efce2.js'); ?>
    <!-- style -->
    <?php echo $this->Html->css('/css/emp_login/style'); ?>
    <?php echo $this->Html->css('/css/util'); ?>
    <!--bootstrap -->
    <?php echo $this->Html->css('/plugins/bootstrap/css/bootstrap.min'); ?>

    <!-- start js include path -->
    <?php echo $this->Html->script('/plugins/jquery/jquery.min'); ?>
    <?php echo $this->Html->script('/plugins/popper/popper'); ?>
    <?php echo $this->Html->script('/plugins/jquery-blockui/jquery.blockui.min'); ?>
    <?php echo $this->Html->script('/plugins/jquery-slimscroll/jquery.slimscroll'); ?>

    <?php echo $this->Html->script('/plugins/jquery-validation/js/jquery.validate.min'); ?>
    <?php echo $this->Html->script('/plugins/jquery-validation/js/additional-methods.min'); ?>
    <?php echo $this->Html->script('/js/pages/validation/form-validation'); ?>
    <!-- bootstrap -->
    <?php echo $this->Html->script('/plugins/bootstrap/js/bootstrap.min'); ?>
    <?php echo $this->Html->script('/plugins/bootstrap-switch/js/bootstrap-switch.min'); ?>
    <!-- Common js-->
    <?php echo $this->Html->script('/js/app'); ?>
    <?php echo $this->Html->script('/js/layout'); ?>
    <?php echo $this->Html->script('/js/theme-color');?>
    <!-- end js include path -->
</head>
<body>
<style>
    .toolbar {
    background: white !important;
	}	
  .error {
        color: #ed5249 !important;
    }

    .success {
        color: #198754 !important;
    }
</style>

     
      <?= $this->fetch('content') ?>
    <script type="text/javascript">
    $(document).on("input", ".name", function() {
        this.value = this.value.replace(/[^a-zA-Z\s]/g, '');
    });
    $(document).on("input", ".num", function() {
        this.value = this.value.replace(/[^0-9\.]/g, '');
    });
    $(document).on("input", ".alphanumeric", function() {
        this.value = this.value.replace(/[^a-zA-Z0-9\s]/g, '');
    });
    </script>
</body>

</html>