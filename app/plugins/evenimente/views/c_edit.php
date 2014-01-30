<div id="contentHolder">
<form method="POST" action="<?php echo get_url('plugin/evenimente/c_update'); ?>" name="formular_sablon">
	<input type="hidden" name="cat[id]" value="<?php echo $id; ?>" />
  <fieldset>
	<legend><?php echo __('Modifica categorie'); ?></legend>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="cat[nume]"><?php echo __('Nume categorie'); ?></label>
    		</div>
    		<div class="form-field">
    		  <input type="text" name="cat[nume]" value="<?php echo $categorie->nume; ?>" size="45" />
            </div>
        </div> 
    <div class="form-buttons">
            <input type="submit" name="salveaza" value="<?php echo __('Salveaza modificari'); ?>" class="button" />
    </div>
</fieldset>
</form>
</div>