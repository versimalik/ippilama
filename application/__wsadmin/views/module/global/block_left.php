<div id="sidebar" class="sidebar responsive">
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
    </script>

   
    <ul class="nav nav-list">
        <?php 
            $sess = $this->session->userdata('username');
            if(!empty($sess)){
                $this->load->config('ws_menu');
                $menu = $this->config->item('menu');
                $sub_menu = $this->config->item('sub_menu');
                $sub_menu_link = $this->config->item('sub_menu_link');
                $menu_icon = $this->config->item('menu_icon');
                // echo'<pre/>'; print_r($menu_icon); die(); 
               
                if($sess['ws_permission_id'] != 1){
                    unset($menu[1]);
                }
            }       
        ?>

        <?php 
            if(!empty($menu)){ ?>     
            <?php foreach($menu as $key => $val){ 
                
                // echo'<pre/>'; print_r($id_menu); die(); 

                $c = ''; $cl_menu = ''; $cl=''; $arrow=''; $li_class = '';
                if(isset($sub_menu[$key])){

                    if($key == $id_menu) {
                        $li_class = 'active open';
                    }

                    $arrow = '<b class="arrow fa fa-angle-down"></b>';
                    $cl = 'class="dropdown-toggle"';
                    $c = '<span class="badge badge-primary">'.count($sub_menu[$key]).'</span>'; 
                    $cl_menu = 'data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#'.$key.'-nav"';
                    $href = '#';
                }else{
                    
                    if($key == $id_menu) {
                        $li_class = 'active';
                    }

                    $href = base_url().url_admin().strtolower($val);
                }       
                            
            ?>

            <li class="<?php echo $li_class; ?>">
                <a href="<?php echo $href; ?>" <?php echo $cl; ?>>
                    <i class="menu-icon <?php echo $menu_icon[$key]; ?>"></i>
                    <span class="menu-text">
                        <?php echo isset($val) ? $val : '' ; ?> 
                        <?php echo isset($c) ? $c : '' ; ?> 
                    </span>
                    <?php echo isset($arrow) ? $arrow : '' ; ?> 
                </a>
                <?php if(isset($sub_menu[$key])){ ?>
                    <b class="arrow"></b>
                    <ul class="submenu">
                         <?php 
                            foreach($sub_menu[$key] as $k => $v){ 
                                $uri = $this->uri->segment(1);

                                if($uri == $sub_menu_link[$key][$k]) {
                                    $subli_class = 'active';
                                }else{
                                    $subli_class = '';
                                }
                        ?>
                            <li class="<?php echo $subli_class; ?>">
                                <a href="<?php echo base_url().url_admin().strtolower($sub_menu_link[$key][$k]); ?>">
                                 <i class="menu-icon fa fa-caret-right"></i>
                                 <i class="icon-th-list"></i> <?php echo isset($v) ? $v : '' ; ?>  </a>
                                </a>
                                <b class="arrow"></b>
                            </li>
                         <?php } ?>
                    </ul>
                <?php } ?>
            </li>
            <?php } ?>   
        <?php } ?>

    </ul><!-- /.nav-list -->
    
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>

    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
    </script>
</div>
