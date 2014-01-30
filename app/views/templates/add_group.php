<div id="contentHolder">
<form method="POST" action="<?php echo get_url('templates/create_group'); ?>" name="formular_sablon">
  <fieldset>
	<legend><?php echo __('Template group'); ?></legend>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="numeSectiune"><?php echo __('Group name'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" name="group[name]" size="45" />
            </div>
        </div>
    <div class="form-buttons">
            <input type="submit" name="salveaza" value="<?php echo __('Create group'); ?>" class="button" />
    </div>
</fieldset>
</form>
</div>

<?php Observer::observe('template.create.group'); ?>