<?php echo tinymce_new($config_name); ?>

<div class="form-group">
	<label class="col-sm-3 control-label no-padding-right"><?php echo $label; ?></label>
	<div class="col-lg-8">
		<textarea class="validate[required] form-control col-lg-6" id="tinymce_new" name="<?php echo isset($name) ? $name : ''; ?>" rows="15" cols="100">
			<?php echo set_value(isset($name) ? $name : '', isset($set_value) ? $set_value : ''); ?>
		</textarea>
	</div>
</div>
