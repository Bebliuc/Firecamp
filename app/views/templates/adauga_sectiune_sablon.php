<div id="contentHolder">
<form method="POST" action="<?php echo get_url('templates/salveaza_sectiune'); ?>" name="formular_sablon">
  <fieldset>
	<legend><?php echo __('Snippet details'); ?></legend>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="numeSectiune"><?php echo __('Snippet name'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" name="numeSectiune" size="45" />
            </div>
        </div>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="continutSectiune"><?php echo __('Snippet content'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <textarea name="continutSectiune" id="template" cols="97" rows="20" style="font-size:85%"></textarea>
            </div>
        </div>
    <div class="form-buttons">
            <input type="submit" name="salveaza" value="<?php echo __('Create snippet'); ?>" class="button" />
    </div>
</fieldset>
</form>
</div>
<?php Observer::notify('template.create.snippet'); ?>