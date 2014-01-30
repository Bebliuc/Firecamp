<div id="contentHolder">
<h2><?php echo _('Adauga cuvant'); ?></h2>
<form method="POST" action="<?php echo get_url('plugin/dictionar/save'); ?>">
	<fieldset>
		<legend><?php echo _('Adauga cuvant nou'); ?></legend>
			<div class="form-row">
				<div class="form-label">
    				<label for="cuvant[cuvant]"><?php echo __('Cuvant'); ?></label>
    			</div>
    			
    			<div class="form-field">
    			  <input type="text" value="" name="cuvant[cuvant]" />
            	</div>
        	</div>
        	<div class="form-row">
				<div class="form-label">
    				<label for="cuvant[definitie]"><?php echo __('Definitie'); ?></label>
    			</div>
    			<div class="form-field">
    			 	<textarea name="cuvant[definitie]"></textarea>
            	</div>
        	</div>
        	<div class="form-row">
				<div class="form-label">
    				<label for="cuvant[categorie]"><?php echo __('Categorie'); ?></label>
    			</div>
    			<div class="form-field">
    			 	<input type="text" value="" name="cuvant[categorie]" />
            	</div>
        	</div>
	</fieldset>
	<div class="form-buttons">
		<input type="submit" value="<?php echo __('Adauga'); ?>" name="submit">
	</div>
</form>
</div>