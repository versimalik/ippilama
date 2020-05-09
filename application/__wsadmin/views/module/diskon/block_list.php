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

<?php if(!empty($data)){  ?>
    <table id="simple-table" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                
                <?php foreach($head_title as $key => $val){ ?>
                        <th><?php echo $val; ?></th>
                <?php } ?>        
            </tr>
        </thead>
        
        <tbody>
            <?php echo form_open('../'.url_admin().$this->module.'/delete', 'id="commentForm"'); ?>
            <?php $j = isset($row) ? $row : 1; ?> 
            <?php foreach($data as $key => $val){ ?>
                    <tr class="rows">
                        <td><?php echo $j; ?></td>
                        <td><?php echo isset($val[$this->date_create]) ? date('Y-m-d h:i:s',$val[$this->date_create]) : ''; ?></td> 
                        <td><?php echo isset($val[$this->title_input]) ? $val[$this->title_input] : ''; ?></td> 
                        <td><center><?php echo isset($val[$this->status]) ? $this->__config_beneric['active'][$val[$this->status]] : ''; ?></center></td> 
                        <td><center><a href="<?php echo '../../../'.url_admin().$this->module.'/edit/'.$val[$this->id];?>"><i class="ace-icon fa fa-pencil-square-o"></i></a></center></td> 
                        <td><center><?php echo check_box($title_input = 'del[]', $value = $val[$this->id].','.$val[$this->title_input], 'del ace'); ?></center></td>
                    </tr>
                <?php $j++; } ?> 
                <tr>
                    <td colspan="5"></td>
                    <td>
                        <center>
                            <button type="submit" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i>&nbsp;Delete</button>
                        </center>
                    </td>
                </tr>    
            <?php echo form_close(); ?>     
        </tbody>
    </table>

    <?php echo isset($pagination) ? $pagination : ''; ?>

<?php } ?>


