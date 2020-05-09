<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Mengerti</title>

        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <?php echo assets_css('../css/bootstrap.min.css'); ?>
        <?php echo assets_css('../font-awesome/4.2.0/css/font-awesome.min.css'); ?>
        <?php echo assets_css('../css/terpaksa.css'); ?>
        <?php echo assets_css('../css/jquery-ui.custom.min.css'); ?>
        <?php echo isset($css_load) ? $css_load : '' ; ?>

        <!-- page specific plugin styles -->

        <!-- text fonts -->
        <?php echo assets_css('../fonts/fonts.googleapis.com.css'); ?>
        
        <!-- ace styles -->
        <?php echo assets_css('../css/ace.min.css', array('class'=>'ace-main-stylesheet', 'id'=>'main-ace-style')); ?>
        
        <!--[if lte IE 9]>
            <?php echo assets_css('../css/ace-part2.min.css', array('class'=>'ace-main-stylesheet')); ?>
        <![endif]-->

        <!--[if lte IE 9]>
            <?php echo assets_css('../css/ace-ie.min.css'); ?>
        <![endif]-->

        <!-- inline styles related to this page -->
        
        <!-- ace settings handler -->
        <?php echo assets_js('../js/ace-extra.min.js'); ?>
        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

        <!--[if lte IE 8]>
        <?php echo assets_js('../js/html5shiv.min.js'); ?>
        <?php echo assets_js('../js/respond.min.js'); ?>
        <![endif]-->

        <script>BASE_URL = "<?php echo base_url(); ?>" </script>
    </head>

    <body class="no-skin">
        <div id="navbar" class="navbar navbar-default">
            <script type="text/javascript">
                try{ace.settings.check('navbar' , 'fixed')}catch(e){}
            </script>

            <div class="navbar-container" id="navbar-container">
                <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                    <span class="sr-only">Toggle sidebar</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>
                </button>

                <div class="navbar-header pull-left">
                    <a href="index.html" class="navbar-brand">
                        <small>
                            <i class="fa fa-leaf"></i>
                            Ace Admin
                        </small>
                    </a>
                </div>

                <div class="navbar-buttons navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">
                        <li class="light-blue">
                            <?php $ses = $this->session->userdata('username'); ?>
                                <?php echo assets_img('../avatars/user.jpg', array('class'=>'nav-user-photo', 'alt'=> isset($ses['ws_user_name']) ? $ses['ws_user_name'] : '')); ?>
                                <span class="user-info userinfo">
                                    <small>Welcome, &nbsp;</small>
                                    <?php echo isset($ses['ws_user_name']) ? $ses['ws_user_name'] : ''; ?>
                                </span>  
                        </li>
                        <li class="purple">
                            <a href="<?php echo base_url().url_admin().'login/process_logout'; ?>">
                                <i class="ace-icon fa fa-power-off icon-animated-vertical"></i>
                            </a>
                        </li>

                    </ul>
                </div>
            </div><!-- /.navbar-container -->
        </div>

        <div class="main-container" id="main-container">
            <script type="text/javascript">
                try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>

            <?php echo isset($block_left) ? $block_left : '' ; ?>

            <div class="main-content">
                <div class="main-content-inner">
                    <!-- Head -->
                    <?php echo isset($block_head) ? $block_head : '' ; ?>

                    <!-- /.page-content -->
                    <?php echo isset($block_content) ? $block_content : '' ; ?>
                    <!-- /.page-content -->
                </div>
            </div><!-- /.main-content -->

            <div class="footer">
                <div class="footer-inner">
                    <div class="footer-content">
                        <span class="bigger-120">
                            <span class="blue bolder">My Toko</span>
                            &copy; <?php echo date('Y'); ?>
                        </span>
                    </div>
                </div>
            </div>

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->
        <?php echo assets_js('../js/jquery.2.1.1.min.js'); ?>
        <!-- <![endif]-->

        <!--[if IE]>
        <script src="assets/js/jquery.1.11.1.min.js"></script>
        <![endif]-->

        <!--[if !IE]> -->
        <script type="text/javascript">
            window.jQuery || document.write("<script src='<?php echo base_url(); ?>assets/wsadmin/js/jquery.min.js'>"+"<"+"/script>");
        </script>
        <!-- <![endif]-->

       <!--[if IE]>
        <script type="text/javascript">
         window.jQuery || document.write("<?php echo assets_js('../js/jquery1x.min.js'); ?>");
        </script>
        <![endif]-->
        <script type="text/javascript">
            if('ontouchstart' in document.documentElement) document.write("<script src='<?php echo base_url(); ?>assets/wsadmin/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>

        <?php echo assets_js('../js/bootstrap.min.js'); ?>
        <!-- page specific plugin scripts -->

        <!--[if lte IE 8]>
        <?php echo assets_js('../js/excanvas.min.js'); ?>
        <![endif]-->
        <?php echo assets_js('../js/jquery-ui.custom.min.js'); ?>
        
        <!-- ace scripts -->
        <?php echo assets_js('../js/ace-elements.min.js'); ?>
        <?php echo assets_js('../js/ace.min.js'); ?>
        <!-- inline scripts related to this page -->

        <?php echo isset($js_load) ? $js_load : '' ;?>

    </body>
<!-- END BODY -->
</html>
