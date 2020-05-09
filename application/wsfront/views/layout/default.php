<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SMP - SMA - SMK IT YP IPPI JAKARTA</title>

  <!-- PLUGINS CSS STYLE -->
  <link rel="icon" type="image/png" href="img/favicon.png">
  <link href="<?php echo base_url('assets/wsfront'); ?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url('assets/wsfront'); ?>/plugins/selectbox/select_option1.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/wsfront'); ?>/plugins/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/wsfront'); ?>/plugins/flexslider/flexslider.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="<?php echo base_url('assets/wsfront'); ?>/plugins/calender/fullcalendar.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/wsfront'); ?>/plugins/animate.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/wsfront'); ?>/plugins/pop-up/magnific-popup.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/wsfront'); ?>/plugins/rs-plugin/css/settings.css" media="screen">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/wsfront'); ?>/plugins/owl-carousel/owl.carousel.css" media="screen">

  <!-- GOOGLE FONT -->
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,600italic,400italic,700' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,700' rel='stylesheet' type='text/css'>

  <!-- CUSTOM CSS -->
  <link rel="stylesheet" href="<?php echo base_url('assets/wsfront'); ?>/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/wsfront'); ?>/css/default.css" id="option_color">
  <link rel="stylesheet" href="<?php echo base_url('assets/wsfront'); ?>/css/customs.css?v=1">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="body-wrapper">

  <div class="main_wrapper">

    <?php $this->load->view('partial/header'); ?>
    
    <!-- content -->
    <?php $this->load->view($content); ?>
    <!-- end content -->

    <!-- footer -->
    <?php $this->load->view('partial/footer'); ?>
    <!-- end footer -->
    



</div>

<!-- JQUERY SCRIPTS -->
<script src="<?php echo base_url('assets/wsfront'); ?>/plugins/jquery/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url('assets/wsfront'); ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('assets/wsfront'); ?>/plugins/flexslider/jquery.flexslider.js"></script>
<script src="<?php echo base_url('assets/wsfront'); ?>/plugins/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script src="<?php echo base_url('assets/wsfront'); ?>/plugins/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="<?php echo base_url('assets/wsfront'); ?>/plugins/selectbox/jquery.selectbox-0.1.3.min.js"></script>
<script src="<?php echo base_url('assets/wsfront'); ?>/plugins/pop-up/jquery.magnific-popup.js"></script>
<script src="<?php echo base_url('assets/wsfront'); ?>/plugins/animation/waypoints.min.js"></script>
<script src="<?php echo base_url('assets/wsfront'); ?>/plugins/count-up/jquery.counterup.js"></script>
<script src="<?php echo base_url('assets/wsfront'); ?>/plugins/animation/wow.min.js"></script>
<script src="<?php echo base_url('assets/wsfront'); ?>/plugins/animation/moment.min.js"></script>
<script src="<?php echo base_url('assets/wsfront'); ?>/plugins/calender/fullcalendar.min.js"></script>
<script src="<?php echo base_url('assets/wsfront'); ?>/plugins/owl-carousel/owl.carousel.js"></script>
<script src="<?php echo base_url('assets/wsfront'); ?>/plugins/timer/jquery.syotimer.js"></script>
<script src="<?php echo base_url('assets/wsfront'); ?>/plugins/smoothscroll/SmoothScroll.js"></script>
<script src="<?php echo base_url('assets/wsfront'); ?>/js/custom.js"></script>

</body>
</html>

