<form method="post" action="<?php echo get_url('plugin/media/create_album'); ?>" name="album" class="forms">
	<fieldset>
        <legend><?php echo __('Add new album'); ?></legend>
        <div class="form-row ">
    		<div class="form-label">
                    <label for="album[title]"><?php echo __('Album title'); ?></label>
    		</div>
    		
    		<div class="form-field">
                    <input type="text" name="album[title]" size="45" title="<?php echo __('Use only letters and numbers. No special characters allowed.'); ?>" />
                </div>
        </div>
		
		<div class="form-row ">
    		<div class="form-label">
    			<label for="album[type]"><?php echo __('Album type'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <select name="album[type]" title="<?php echo __('Select album type.'); ?>">
					<option value="music"><?php echo __('Music'); ?></option>
					<option value="video"><?php echo __('Video'); ?></option>
					<option value="external"><?php echo __('External'); ?></option>
			  </select>
            </div>
        </div>
		
    </fieldset>
	<div class="form-buttons">
		<input type="submit" value="<?php echo __('Create album'); ?>" name="submit">
	</div>
</form>