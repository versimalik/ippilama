<div class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <h1>
                <small>
                    <i class="ace-icon glyphicon glyphicon-tags"></i>&nbsp;
                </small>
                <?php echo (isset($title) ? $title : '' ); ?>
                <?php if(!isset($iconadd)) { ?>
                <span class="icon-add">
                    <a href="<?php echo base_url().url_admin().$this->module.'/add'; ?>">
                        <?php echo assets_img('../img/icon-add.png', array('width' =>'32px', 'height' => '32px;')); ?>
                    </a>
                </span> 
                <?php } ?>    
            
                <?php echo isset($block_search) ? $block_search: '' ; ?> 

            </h1>
            <div class="hr hr10 hr-dotted"></div>
               
            <?php echo isset($block_form) ? $block_form: '' ; ?>    

            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.page content -->
