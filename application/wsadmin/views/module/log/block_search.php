<div class="pull-right col-xs-4">
	   <form action="<?php echo base_url(url_admin().$this->module.'/search'); ?>" method="get" class="form-search">
		<div style="margin-right: 30px">
	        <div class="input-daterange input-group">
	            <input type="text" value="<?php echo (isset($_GET['s'])) ? $_GET['s'] : date('Y-m-d'); ?>" placeholder="yyyy-mm-dd" class="input-sm form-control" name="s" />
	            <span class="input-group-addon">TO</span>
	            <input type="text" value="<?php echo (isset($_GET['s'])) ? $_GET['e'] : date('Y-m-d'); ?>" placeholder="yyyy-mm-dd" class="input-sm form-control" name="e" />
	        </div>
		</div>
		<div class="pull-right" style="margin-top: -41px; margin-right:4px;">
			<button type="submit" class="btn-primary btn-xs"><i class="ace-icon fa fa-search"></i></button>
		</div>
	</form>   
<div>
