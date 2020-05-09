
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="<?php echo '../../../'.url_admin().$this->module.'/add'; ?>">
                    <i class="icon-plus"></i> Add Article    
                </a>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
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
                                        <tr>
                                            <td><?php echo $j; ?></td>
                                            <td><?php echo isset($val[$this->date_create]) ? date('Y-m-d h:i:s',$val[$this->date_create]) : ''; ?></td> 
                                            <td><?php echo isset($val[$this->title_input]) ? $val[$this->title_input] : ''; ?></td> 
                                            <td><center><?php echo isset($val[$this->status]) ? $this->__config['statuses'][$val[$this->status]] : ''; ?></center></td> 
                                            <td><center><a href="<?php echo '../../../'.url_admin().$this->module.'/edit/'.$val[$this->id];?>"><i class="icon-edit"></i></a></center></td> 
                                            <td><center><?php echo check_box($title_input = 'del[]', $value = $val[$this->id].','.$val[$this->title_input], 'del'); ?></center></td>
                                        </tr>
                                    <?php $j++; } ?> 
                                    <tr>
                                        <td colspan="5"></td>
                                        <td><center><button class="btn btn-danger"><i class="icon-remove icon-white"></i> Delete</button></center></td>
                                    </tr>    
                                <?php echo form_close(); ?>   

                            <?php }else{ ?>
                                    <tr><td colspan="5">Data Empty</td></tr>
                            <?php  } ?>            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo isset($pagination) ? $pagination : ''; ?>


