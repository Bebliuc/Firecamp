<form method="post" action="<?php echo get_url('plugin/media/update_album/'.$album->id); ?>" name="album" class="forms">
	<fieldset>
        <legend><?php echo __('Edit <b>%title%</b>', array('%title%' => $album->title)); ?></legend>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="album[title]"><?php echo __('Album title'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" name="album[title]" value="<?php echo $album->title; ?>" title="<?php echo __('Use only letters and numbers. No special characters allowed.'); ?>" size="45" />
            </div>
        </div>
		
		<div class="form-row ">
    		<div class="form-label">
    			<label for="album[type]"><?php echo __('Album type'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <select name="album[type]" title="<?php echo __('Select album type.'); ?>">
					<option value="music"<?php if($album->type == 'music') echo ' selected=""'; ?>><?php echo __('Music'); ?></option>
					<option value="video"<?php if($album->type == 'video') echo ' selected=""'; ?>><?php echo __('Video'); ?></option>
                    <option value="video"<?php if($album->type == 'external') echo ' selected=""'; ?>><?php echo __('External'); ?></option>
			  </select>
            </div>
        </div>
		
    </fieldset>
	<div class="form-buttons">
		<input type="submit" value="<?php echo __('Update album'); ?>" name="submit">
	</div>
</form>