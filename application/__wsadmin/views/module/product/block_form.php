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
    
    <div class="col-xs-12 col-sm-12">
        <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab">
                <li class="active">
                    <a data-toggle="tab" href="#data">
                        <i class="green  glyphicon glyphicon-tint bigger-120"></i>
                        Data
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#image">
                        <i class="green glyphicon glyphicon-picture bigger-120"></i>
                        Image
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#seo">
                        <i class="green fa fa-cloud bigger-120"></i>
                        SEO
                    </a>
                </li>
            </ul>
 
            <div class="tab-content">
                <div id="data" class="tab-pane fade active in ">
                    <?php echo isset($form['title_box']) ? $form['title_box'] : ''; ?>
                    <?php echo isset($form['category']) ? $form['category'] : ''; ?>
                    <?php echo isset($form['desc_box']) ? $form['desc_box'] : ''; ?>
                    <?php echo isset($form['harga']) ? $form['harga'] : ''; ?>
                    <?php echo isset($form['berat']) ? $form['berat'] : ''; ?>
                    <?php echo isset($form['diskon']) ? $form['diskon']: ''; ?>
                    <?php echo isset($form['input_tags']) ? $form['input_tags'] : ''; ?>
                    <?php echo isset($form['option_box']) ? $form['option_box'] : ''; ?>
                    <?php echo isset($form['status']) ? $form['status'] : ''; ?>
                </div>

                <div id="image" class="tab-pane fade">
                    <?php echo isset($form['upload']) ? $form['upload'] : ''; ?>
                </div>   

                <div id="seo" class="tab-pane fade">
                    <?php echo isset($form['metatitle']) ? $form['metatitle'] : ''; ?>
                    <?php echo isset($form['metakey']) ? $form['metakey'] : ''; ?>
                    <?php echo isset($form['metadesc']) ? $form['metadesc'] : ''; ?>
                </div>

            </div>

        </div>
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

