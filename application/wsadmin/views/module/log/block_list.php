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
                        <td><?php echo isset($val[$this->date_create]) ? TanggalIndo($val[$this->date_create]) : ''; ?></td> 
                        <td><?php echo isset($val[$this->username]) ? $val[$this->username] : ''; ?></td> 
                        <td><?php echo isset($val[$this->status]) ? $val[$this->status] : ''; ?></td> 
                        <td><?php echo isset($val[$this->description]) ? $val[$this->description] : ''; ?></td> 
                        <td><center><?php echo check_box($username = 'del[]', $value = $val[$this->id].','.$val[$this->username], 'del ace'); ?></center></td>
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

