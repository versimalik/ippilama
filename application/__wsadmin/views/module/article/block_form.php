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
                    if(empty($val)) continue;
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
                    
                <?php echo isset($form['title_box']) ? $form['title_box'] : ''; ?>
                
                

                <?php echo isset($form['summary_box']) ? $form['summary_box'] : ''; ?>
                <?php echo isset($form['desc_box']) ? $form['desc_box'] : ''; ?>
                <?php echo isset($form['upload']) ? $form['upload'] : ''; ?>
                <?php echo isset($form['tags_box']) ? $form['tags_box'] : ''; ?>
                <?php echo isset($form['option_box']) ? $form['option_box'] : ''; ?>
                <?php echo isset($form['status']) ? $form['status'] : ''; ?>
                <?php echo isset($form['button']) ? $form['button'] : ''; ?>
                
                <?php
                    $id_name = isset($field_id['id']['name']) ? $field_id['id']['name'] :'';
                    $id_value = isset($field_id['id']['value']) ? $field_id['id']['value'] :'';
                    
                ?>
                <?php echo isset($update) ? '<input type="hidden" name="'.$id_name.'" value="'.$id_value.'" readonly>' : ''; ?>
               

                <?php echo form_close(); ?>

            </div>
        </div>
    </div>
</div>
   
    
    
   
    
    
    
    