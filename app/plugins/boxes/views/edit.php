<div id="contentHolder">
<form method="POST" action="<?php echo get_url('plugin/boxes/update/'.$box->id); ?>" name="add_box_form">
  <fieldset>
	<legend><?php echo __('Edit box details'); ?></legend>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="title"><?php echo __('Box name'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" name="title" size="45" value="<?php echo $box->title; ?>" />
            </div>
        </div>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="content"><?php echo __('Box content'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <textarea -amy-enabled="false" name="content" cols="97" rows="20" style="font-size:85%"><?php echo $box->content; ?></textarea>
            </div>
        </div>
    <div class="form-buttons">
            <input type="submit" name="salveaza" value="<?php echo __('Update box'); ?>" class="button" />
    </div>
</fieldset>
</form>
</div>
<?php Observer::notify('box.edit'); ?>
<?php Observer::notify('editors'); ?>