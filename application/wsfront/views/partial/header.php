<header class="header-wrapper">
  <div class="topbar clearfix">
    <div class="container">
      <ul class="topbar-left">
        <li class="phoneNo"><i class="fa fa-phone"></i>(021) 48703207</li>
        <li class="email-id hidden-xs hidden-sm"><i class="fa fa-envelope"></i>
          <a href="mailto:info@yourdomain.com">info@yourdomain.com</a>
        </li>
      </ul>
      <ul class="topbar-right">
        <li class="hidden-xs"><a href="#"><i class="fa fa-twitter"></i></a></li>
        <li class="hidden-xs"><a href="#"><i class="fa fa-facebook"></i></a></li>
        <li class="hidden-xs"><a href="#"><i class="fa fa-google-plus"></i></a></li>
        <li class="hidden-xs"><a href="#"><i class="fa fa-youtube-play"></i></a></li>
        
        <!-- <li class="dropdown language">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-globe"></i>EN
            <i class="fa fa-caret-down"></i>
          </a>
          <ul class="dropdown-menu">
            <li class="active">
              <a href="#">English </a>
            </li>
            <li><a href="#">Spanish</a></li>
            <li><a href="#">Russian</a></li>
            <li><a href="#">German</a></li>
          </ul>
        </li> -->
      </ul>
    </div>
  </div>
  <div class="header clearfix">
    <nav class="navbar navbar-main navbar-default">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <div class="header_inner">
              
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header nav-header-logo">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand logo clearfix" href="<?php echo base_url(); ?>"><img class="logo-ups" src="<?php echo base_url('assets/wsfront'); ?>/img/logo-1.png?v=4" alt="" class="img-responsive" /></a>
              </div>
              
              <?php $uri = $this->uri->segment(1); ?>
              <?php $uriSub = $this->uri->segment(2); ?>
              <!-- Collect the nav links, forms, and other content for toggling -->
              <div class="collapse navbar-collapse" id="main-nav">
                <ul class="nav navbar-nav navbar-right">
                  <li class="<?php echo ($uri == 'home') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('home'); ?>" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">Home</a>
                  </li>
                  <li class="dropdown <?php echo ($uri == 'profile') ? 'active' : ''; ?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">PROFIL</a>
                    <ul class="dropdown-menu">
                      <li><a href="#">SEJARAH</a></li>
                      <li><a href="#">VISI &amp; MISI</a></li>
                      <li class="<?php echo ($uriSub == 'struktur-organisasi') ? 'active' : ''; ?>"><a href="<?php echo base_url('profile/struktur-organisasi'); ?>">STRUKTUR ORGANISASI</a></li>
                      <li class="dropdown <?php echo ($uri == 'branch') ? 'active' : ''; ?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">CABANG</a>
                        <ul class="dropdown-menu">
                          <li><a href="<?php echo base_url('branch'); ?>">JAKARTA</a></li>
                          <li><a href="<?php echo base_url('branch'); ?>">BEKASI</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                <li class="dropdown <?php echo ($uri == 'education') ? 'active' : ''; ?>">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">PENDIDIKAN</a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url('education/program'); ?>">AKREDITASI</a></li>
                    <li><a href="<?php echo base_url('education/kurikulum'); ?>">KURIKULUM</a></li>
                    <li><a href="<?php echo base_url('education/prestasi'); ?>">PRESTASI</a></li>
                    <li><a href="<?php echo base_url('education/program'); ?>">PROGRAM</a></li>
                  </ul>
                </li>
                <li class="<?php echo ($uri == 'fasilitas') ? 'active' : ''; ?>">
                  <a href="<?php echo base_url('fasilitas'); ?>" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">FASILITAS</a>
                </li>
                <li class="dropdown <?php echo ($uri == 'news' | $uri == 'event') ? 'active' : ''; ?>">
                  <a href="<?php echo base_url('news'); ?>" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">BERITA</a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url('event'); ?>">EVENT</a></li>
                  </ul>
                </li>
                <li class="<?php echo ($uri == 'gallery') ? 'active' : ''; ?>">
                  <a href="<?php echo base_url('gallery'); ?>" class="dropdown-toggle"  role="button" aria-haspopup="true" aria-expanded="false">GALERI</a>
                </li>
                <li class="<?php echo ($uri == 'contact-us') ? 'active' : ''; ?>">
                  <a href="<?php echo base_url('contact-us'); ?>" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">HUBUNGI KAMI</a>
                </li>
                <!-- <li class="apply_now"><a href="<?php echo base_url('register'); ?>">Pendaftaran</a></li> -->
              </ul>
            </div>
            <!-- navbar-collapse -->
          </div>
        </div>
      </div>
      </div>
      <!-- /.container -->
    </nav>
    <!-- navbar -->
  </div>
</header>

<!--end banner-->