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

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="simple-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <?php foreach($head_title as $key => $val){ ?>
                                        <th><?php echo $val; ?></th>
                                <?php } ?>        
                            </tr>
                        </thead>
                        <tbody id="selectedrow">
                            <?php if(!empty($data)){ ?>
                                <?php echo form_open('../'.url_admin().$this->module.'/delete', 'id="commentForm"'); ?>
                                <?php $j = isset($row) ? $row : 1; ?> 
                                <?php foreach($data as $key => $val){ ?>
                                        <tr class="rows">
                                            <td><?php echo $j; ?></td>
                                            <td><?php echo isset($val[$this->date_create]) ? $val[$this->date_create] : ''; ?></td> 
                                            <td><?php echo isset($val[$this->username]) ? $val[$this->username] : ''; ?></td> 
                                            <td><?php echo isset($val[$this->status]) ? $val[$this->status] : ''; ?></td> 
                                            <td><?php echo isset($val[$this->description]) ? $val[$this->description] : ''; ?></td> 
                                            <td><center><?php echo check_box($username = 'del[]', $value = $val[$this->id].','.$val[$this->username], 'del ace'); ?></center></td>
                                        </tr>
                                    <?php $j++; } ?> 
                                    <tr>
                                        <td colspan="5"></td>
                                        <td><center><button class="btn btn-danger"><i class="icon-remove icon-white"></i> Delete</button></center></td>
                                    </tr>    
                                <?php echo form_close(); ?>   

                            <?php }else{ ?>
                                    <tr><td colspan="6">Data Empty</td></tr>
                            <?php  } ?>            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo isset($pagination) ? $pagination : ''; ?>


