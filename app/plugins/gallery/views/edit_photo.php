<form method="post" action="<?php echo get_url('plugin/gallery/update_photo').'/'.$photo->id;; ?>" name="photo">
	<fieldset>
        <legend>Edit <?php echo $photo->title; ?></legend>
		<div class="form-row">
    		<div class="form-label">
    			<label for="photo[title]">Photo title</label>
    		</div>

    		<div class="form-field">
    		  <input type="text" name="photo[title]" value="<?php echo $photo->title; ?>" title="<?php echo __('Use only letters, numbers and spaces. No special characters allowed. <u>Mandatory field</u>'); ?>" size="45" />
            </div>
        </div>
		<div class="form-row">
    		<div class="form-label">
    			<label for="photo[caption]">Photo caption</label>
    		</div>

    		<div class="form-field">
                    <textarea name="photo[caption]" title="<?php echo __('Short photo description. <u>Mandatory field</u>.'); ?>" style="width:98%; height:300px;" /><?php echo $photo->caption; ?></textarea>
            </div>
        </div>
    </fieldset>
	<div class="form-buttons">
		<input type="submit" value="Update photo" name="submit">
	</div>
</form>