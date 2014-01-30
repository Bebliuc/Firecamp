<div id="contentHolder">
<form method="POST" action="<?php echo get_url('plugin/evenimente/c_salveaza'); ?>" name="formular_sablon">
	<input type="hidden" value="" name="cat[id]" />
  <fieldset>
	<legend><?php echo __('Adauga categorie'); ?></legend>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="cat[nume]"><?php echo __('Nume categorie'); ?></label>
    		</div>
    		<div class="form-field">
    		  <input type="text" name="cat[nume]" size="45" />
            </div>
        </div> 
    <div class="form-buttons">
            <input type="submit" name="salveaza" value="<?php echo __('Adauga categorie'); ?>" class="button" />
    </div>
</fieldset>
</form>
</div>