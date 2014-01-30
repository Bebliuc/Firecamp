<div id="contentHolder">
<form method="POST" action="<?php echo get_url('plugin/boxes/save'); ?>" name="add_box_form">
  <fieldset>
	<legend><?php echo __('Box details'); ?></legend>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="title"><?php echo __('Box name'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" name="title" size="45" title="Box name with underscore instead of space"/>
            </div>
        </div>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="content"><?php echo __('Box content'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <textarea -amy-enabled="false" name="content" cols="97" title="test" rows="20" style="font-size:85%"></textarea>
            </div>
        </div>
    <div class="form-buttons">
            <input type="submit" name="salveaza" value="<?php echo __('Create box'); ?>" class="button" />
    </div>
</fieldset>
</form>
</div>
<?php Observer::notify('box.create'); ?>
<?php Observer::notify('editors'); ?>
