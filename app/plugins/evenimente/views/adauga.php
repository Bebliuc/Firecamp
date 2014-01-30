<div id="contentHolder">
<form method="POST" action="<?php echo get_url('plugin/evenimente/salveaza'); ?>" enctype="multipart/form-data" name="formular_sablon">
	<input type="hidden" value="" name="event[id]" />
  <fieldset>
	<legend><?php echo __('Adauga atelier'); ?></legend>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="event[titlu]"><?php echo __('Titlu atelier'); ?></label>
    		</div>
    		<div class="form-field">
    		  <input type="text" name="event[titlu]" size="45" />
            </div>
        </div>
			<div class="form-row ">
	    		<div class="form-label">
	    			<label for="event[data_inceput]"><?php echo __('Data inceput'); ?></label>
	    		</div>
	    		<div class="form-field">
	    		  <input type="text" name="event[data_inceput]" size="45" />
	            </div>
	        </div>
			<div class="form-row ">
	    		<div class="form-label">
	    			<label for="event[data_sfarsit]"><?php echo __('Data sfarsit'); ?></label>
	    		</div>
	    		<div class="form-field">
	    		  <input type="text" name="event[data_sfarsit]" size="45" />
	            </div>
	        </div>
			<div class="form-row ">
	    		<div class="form-label">
	    			<label for="event[categorie]"><?php echo __('Categorie'); ?></label>
	    		</div>
	    		<div class="form-field">
					<select name="event[categorie]">
                        <?php foreach(record::findAllFrom('e_categorii') as $categorie): ?>
						<option value="<?php echo $categorie->id; ?>"><?php echo $categorie->nume; ?></option>
                        <?php endforeach; ?>
					</select>
	            </div>
	        </div>
			<div class="form-row ">
	    		<div class="form-label">
	    			<label for="event[categorie]"><?php echo __('Detalii'); ?></label>
	    		</div>
	    		<div class="form-field">
					<textarea name="event[detalii]" id="content"></textarea>
	            </div>
	        </div>
            <div class="form-row ">
	    		<div class="form-label">
	    			<label for="event[categorie]" style="background-color: #4F6AA3"><?php echo __('Link Facebook'); ?></label>
	    		</div>
	    		<div class="form-field">
					 <input name="event[poza]" type="text" size="45" />
	            </div>
	        </div>

    <div class="form-buttons">
            <input type="submit" name="salveaza" value="<?php echo __('Adauga atelier'); ?>" class="button" />
    </div>
</fieldset>
</form>
</div>
<script type="text/javascript" src="http://aigrijademine.ro/app/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	window.onload = function() {		
		CKEDITOR.replace( 'content',
	    {
	       	        uiColor : '#EEE',
	        language : 'en',
	    });
	};
	</script>