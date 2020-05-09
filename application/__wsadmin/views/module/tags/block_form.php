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
<?php echo form_open_multipart('../'.url_admin().$this->module.$path, 'class="form-horizontal" id="formID"'); ?>
            
    <div class="col-xs-12 col-sm-8">

        <?php echo isset($form['title_box']) ? $form['title_box'] : ''; ?>
        <?php echo isset($form['option_box']) ? $form['option_box'] : ''; ?>    
                                        
    </div>

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

