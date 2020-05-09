<div class="breadcrumbs" id="breadcrumbs">
    <script type="text/javascript">
        try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
    </script>

    <ul class="breadcrumb">
        <li class="active">
            <?php
                $menu = $this->config->item('menu_icon');
                echo '<i class="ace-icon '.$menu[$id_menu].'"></i>';
            ?>
                        
            <?php
                  $temp=''; $i=''; $tanda='';
                  foreach($this->breadcumb as $key => $val){
                     if($i != '' || count($this->breadcumb) == 1 ) {
                          $ahref = '<li><a href="'.base_url().url_admin().$this->module.'">'.$val.'</a></li>';
                     }else{
                          $ahref = '<li>'.$val.'</li>';
                     }

                     $temp = $temp.$ahref;
                     $i++;
                  }
                  echo $temp;
            ?> 
            
        </li>      
    </ul><!-- /.breadcrumb -->

    <?php echo $this->load->view('module/global/search', array(), true); ?>
    <!-- /.nav-search -->
</div>