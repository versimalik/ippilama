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
        <?php echo isset($form['select_box_search']) ? $form['select_box_search'] : ''; ?>
        <?php echo isset($form['name']) ? $form['name'] : ''; ?>
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



<!-- <form class="form-horizontal" role="form">
    <div class="col-xs-12 col-sm-8">
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Parent </label>
            <div class="col-sm-4">  
                <select class="chosen-select form-control" id="form-field-select-3" data-placeholder="Choose a State...">
                    <option value="">  </option>
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                </select>
            </div>
        </div>
        
        <div class="space-4"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Category </label>

            <div class="col-sm-9">
                <input type="text" id="form-field-1" placeholder="Category" class="col-xs-10 col-sm-5" />
            </div>
        </div>

        <div class="space-4"></div>

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Status </label>
            <div class="col-sm-4">  
                <select id="form-field-select-3" name="">
                    <option value="0">No Active</option>
                    <option value="1">Active</option>
                </select>
            </div>
        </div>
        <div class="space-4"></div>
    </div>

    <div class="col-xs-12">
        <div class="clearfix form-actions">
            <div class="col-md-offset-2 col-md-9">
                <button class="btn btn-info" type="button">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Submit
                </button>

                &nbsp; &nbsp; &nbsp;
                <button class="btn" type="reset">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    Reset
                </button>
            </div>
        </div>
    </div>
</form>     -->