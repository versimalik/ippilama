 <?php 
    //success
    $flashmessage = $this->session->flashdata('message');
    $success = '<div class="alert alert-block alert-success">';
    $success.= '<button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>';
    $success.= '<strong>'.$flashmessage.'</strong>';
    $success.= '</div>'; 
    echo ! empty($flashmessage) ? $success : '';
   
    if(!empty($err)){
        $temp = '';
        foreach($err as $key => $val){
            if(empty($val)) continue;
            $error_msg = '<div class="alert alert-danger">';
            $error_msg.= '<button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>';
            $error_msg.= '<strong>'.$val.'</strong>';
            $error_msg.= '</div>';
            $temp = $temp.$error_msg;
        }
        echo ! empty($temp) ? $temp : '';
    }

?>


<?php $path = isset($post) ? $post : $update ; ?>
<?php echo form_open_multipart('../'.url_admin().$this->module.$path, 'class="form-horizontal" id="popup-validation"'); ?>
    
<div class="col-xs-12 col-sm-8">    
    <?php echo isset($form['name']) ? $form['name'] : ''; ?>
</div>

<?php 
    $this->load->config('ws_menu');
    $menu = $this->config->item('menu');
?>

<?php $menus_temp = isset($permission[0]['ws_menus_temp']) ? unserialize($permission[0]['ws_menus_temp']) : ''; ?>
<?php if(!empty($field_id)){ ?>
<div class="col-xs-12 col-sm-8">
    <div class="form-group">
        <label class="col-sm-3 control-label no-padding-right">Content<br/>Authorizations</label>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <ul class="list-unstyled">
                        <?php foreach($menu as $key => $val){ ?>
                            <li>
                                <?php echo check_box($name = 'ws_menus_temp[]', $value = $key, 'del', $menus_temp); ?> 
                                <?php echo isset($val) ? $val : '' ; ?> 
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<div class="col-xs-12">
        <div class="form-actions">
           <?php echo isset($form['button']) ? $form['button'] : ''; ?>
           <a href="<?php echo base_url().url_admin().$this->module; ?>">    
           <?php echo isset($form['cancel']) ? $form['cancel'] : ''; ?>    
           </a>
    </div>
</div>

<?php
    $id_name = isset($field_id['id']['name']) ? $field_id['id']['name'] :'';
    $id_value = isset($field_id['id']['value']) ? $field_id['id']['value'] :'';
    
    $username_name = isset($field_id['username']['name']) ? $field_id['username']['name'] :'';
    $username_value = isset($field_id['username']['value']) ? $field_id['username']['value'] :'';
?>
<?php echo isset($update) ? '<input type="hidden" name="'.$id_name.'" value="'.$id_value.'" readonly>' : ''; ?>
<?php echo isset($update) ? '<input type="hidden" name="'.$username_name.'" value="'.$username_value.'" readonly>' : ''; ?>


<?php echo form_close(); ?>


<!-- 
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <header>
                <div class="icons"><i class="icon-smile"></i></div>
                <h5><?php echo isset($title) ? $title : ''; ?></h5>
                <div class="toolbar">
                    <ul class="nav">
                        <li></li>
                    </ul>
                </div>

            </header>

        <?php 
            //success
            $flashmessage = $this->session->flashdata('message');
            $success = '<div class="alert alert-success alert-dismissable">';
            $success.= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
            $success.= '<strong>'.$flashmessage.'</strong>';
            $success.= '</div>'; 
            echo ! empty($flashmessage) ? $success : '';
           
            if(!empty($err)){
                $temp = '';
                foreach($err as $key => $val){
                    $error_msg = '<div class="alert alert-danger alert-dismissable">';
                    $error_msg.= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
                    $error_msg.= '<strong>'.$val.'</strong>';
                    $error_msg.= '</div>';
                    $temp = $temp.$error_msg;
                }
                echo ! empty($temp) ? $temp : '';
            }

            // echo'<pre/>'; print_r($err); die(); 
        ?>

            <div id="collapse3" class="accordion-body collapse in body">
                <?php $path = isset($post) ? $post : $update ; ?>
                <?php echo form_open_multipart('../'.url_admin().$this->module.$path, 'class="form-horizontal" id="popup-validation"'); ?>
                    
                <?php echo isset($form['name']) ? $form['name'] : ''; ?>
                
                <?php 
                    $this->load->config('ws_menu');
                    $menu = $this->config->item('menu');
                ?>

                <?php $menus_temp = isset($permission[0]['ws_menus_temp']) ? unserialize($permission[0]['ws_menus_temp']) : ''; ?>
                <?php if(!empty($field_id)){ ?>
                <div class="form-group">
                    <label class="control-label col-lg-2">CONTENT AUTHORIZATIONS</label>
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <ul class="list-unstyled">
                                    <?php foreach($menu as $key => $val){ ?>
                                        <li>
                                            <?php echo check_box($name = 'ws_menus_temp[]', $value = $key, 'del', $menus_temp); ?> 
                                            <?php echo isset($val) ? $val : '' ; ?> 
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php echo isset($form['button']) ? $form['button'] : ''; ?>
                
                <?php
                    $id_name = isset($field_id['id']['name']) ? $field_id['id']['name'] :'';
                    $id_value = isset($field_id['id']['value']) ? $field_id['id']['value'] :'';
                    
                    $username_name = isset($field_id['username']['name']) ? $field_id['username']['name'] :'';
                    $username_value = isset($field_id['username']['value']) ? $field_id['username']['value'] :'';
                ?>
                <?php echo isset($update) ? '<input type="hidden" name="'.$id_name.'" value="'.$id_value.'" readonly>' : ''; ?>
                <?php echo isset($update) ? '<input type="hidden" name="'.$username_name.'" value="'.$username_value.'" readonly>' : ''; ?>
                

                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>
   
    
 -->    
   
    
    
    
    