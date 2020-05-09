<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>My toko</title>

    <meta name="description" content="User login page" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <?php echo assets_css('../css/bootstrap.min.css'); ?>
    <?php echo assets_css('../font-awesome/4.2.0/css/font-awesome.min.css'); ?>
   
    <!-- text fonts -->
    <?php echo assets_css('../fonts/fonts.googleapis.com.css'); ?>
    
    <!-- ace styles -->
    <?php echo assets_css('../css/ace.min.css'); ?>

    <!--[if lte IE 9]>
      <link rel="stylesheet" href="assets/css/ace-part2.min.css" />
    <![endif]-->
    <?php echo assets_css('../css/ace-rtl.min.css'); ?>

    <!--[if lte IE 9]>
      <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
    <![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="login-layout blur-login">
    
    <?php echo isset($body) ? $body : '' ; ?>

    <!-- basic scripts -->

    <!--[if !IE]> -->
    <?php echo assets_js('../js/jquery.2.1.1.min.js'); ?>
    <!-- <![endif]-->

    <!--[if IE]>
<script src="assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

    <!--[if !IE]> -->
    <script type="text/javascript">
      window.jQuery || document.write("<script src='assets/js/jquery.min.js'>"+"<"+"/script>");
    </script>

    <!-- <![endif]-->

    <!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
    <script type="text/javascript">
      if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
    </script>

    <!-- inline scripts related to this page -->
    <script type="text/javascript">
      jQuery(function($) {
       $(document).on('click', '.toolbar a[data-target]', function(e) {
        e.preventDefault();
        var target = $(this).data('target');
        $('.widget-box.visible').removeClass('visible');//hide others
        $(target).addClass('visible');//show target
       });
      });
      
      
     jQuery(function($) {
        $('.alert').on('click', function(e) {
          $(this).hide(e);
        e.preventDefault();
       });
      });
    </script>
  </body>
</html>

