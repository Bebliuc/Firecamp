<form method="post" action="<?php echo get_url('plugin/gallery/create_album'); ?>" name="album">
	<fieldset>
        <legend>Add new album</legend>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="albumTitle">Album title</label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" name="albumTitle" size="45" title="<?php echo __('Use only letters, numbers and spaces. No special characters allowed.'); ?>" />
            </div>
        </div>
		
    </fieldset>
	<div class="form-buttons">
		<input type="submit" value="Create album" name="submit">
	</div>
</form>