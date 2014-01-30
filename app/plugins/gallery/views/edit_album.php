<form method="post" action="<?php echo get_url('plugin/gallery/update_album/'.$album->id); ?>" name="album">
	<fieldset>
        <legend>Update <i><?php echo $album->name; ?></i> album</legend>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="albumTitle">Album title</label>
    		</div>

    		<div class="form-field">
    		  <input type="text" name="albumTitle" value="<?php echo $album->name; ?>" title="<?php echo __('Use only letters, numbers and spaces. No special characters allowed.'); ?>" size="45" />
            </div>
        </div>

    </fieldset>
	<div class="form-buttons">
		<input type="submit" value="Update album" name="submit">
	</div>
</form>