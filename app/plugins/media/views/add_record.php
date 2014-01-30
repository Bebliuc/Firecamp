<?php if($type == 'music'): ?>
<style type="text/css">
.forms fieldset {
	background: url('<?php echo get_url(''); ?>app/plugins/media/views/icons/music.png') #FAFAFA no-repeat scroll top right;
}
</style>
<form method="post" action="<?php echo get_url('plugin/media/save_record'); ?>" name="record" class="forms">
	<fieldset>
        <legend><?php echo __('Add new record'); ?></legend>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="record[title]"><?php echo __('Record title'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" name="record[title]" size="45" title="<?php echo __('Record title.<u>Mandatory field</u>.'); ?>" />
            </div>
        </div>
				<div class="form-row ">
    		<div class="form-label">
    			<label for="record[url]"><?php echo __('Record url'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" name="record[url]" size="45" title="<?php echo __('External record url.<u>Mandatory field</u>.'); ?>" />
            </div>
			<input type="hidden" name="record[album]" value="<?php echo $id; ?>" />
			<input type="hidden" name="record[external]" value="" />
        </div>
		
    </fieldset>
	<div class="form-buttons">
		<input type="submit" value="<?php echo __('Create record'); ?>" name="submit">
	</div>
</form>
<?php endif; ?>
<?php if($type == 'video'): ?>
<style type="text/css">
.forms fieldset {
	background: url('<?php echo get_url(''); ?>app/plugins/media/views/icons/video.png') #FAFAFA no-repeat scroll top right;
}
</style>
<form method="post" action="<?php echo get_url('plugin/media/save_record'); ?>" name="record" class="forms">
	<fieldset>
        <legend><?php echo __('Add new video'); ?></legend>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="record[title]"><?php echo __('Video title'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" name="record[title]" size="45" title="<?php echo __('Video title.<u>Mandatory field</u>.'); ?>" />
            </div>
        </div>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="record[url]"><?php echo __('Video url'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" name="record[url]" size="45" title="<?php echo __('Youtube url. Example:<br /> <code>http://www.youtube.com/watch?v=9fi8PwlxYTs</code><br /><u>Mandatory field</u>.'); ?>" />
            </div>
        </div>
		<input type="hidden" name="record[album]" value="<?php echo $id; ?>" />
		<input type="hidden" name="record[external]" value="" />
		
    </fieldset>
	<div class="form-buttons">
		<input type="submit" value="<?php echo __('Create video'); ?>" name="submit">
	</div>
</form>
<?php endif; ?>
<?php if($type == 'external'): ?>
<style type="text/css">
.forms fieldset {
	background: url('<?php echo get_url(''); ?>app/plugins/media/views/icons/youtube.png') #FAFAFA no-repeat scroll top right;
}
</style>
<form method="post" action="<?php echo get_url('plugin/media/save_record'); ?>" name="record" class="forms">
	<fieldset>
        <legend><?php echo __('Add new external media'); ?></legend>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="record[title]"><?php echo __('External media title'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" name="record[title]" size="45" title="<?php echo __('Record title.<u>Mandatory field</u>.'); ?>" />
            </div>
        </div>
				<div class="form-row ">
    		<div class="form-label">
    			<label for="record[external]"><?php echo __('External media embed code'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <textarea name="record[external]" title="<?php echo __('External media embedding code.<u>Mandatory field</u>.'); ?>" style="width: auto; height: 300px;" -amy-enabled="true"></textarea>
            </div>
        </div>
		<input type="hidden" name="record[album]" value="<?php echo $id; ?>" />
		<input type="hidden" name="record[url]" value="" />
    </fieldset>
	<div class="form-buttons">
		<input type="submit" value="<?php echo __('Create external media'); ?>" name="submit">
	</div>
</form>
		<link href="<?php echo BASE_URL; ?>app/layouts/admin_v2/css/amy.css" rel="stylesheet" type="text/css">
		<script src="<?php echo BASE_URL; ?>app/layouts/admin_v2/js/amy.js" type="text/javascript"></script>
<?php endif; ?>