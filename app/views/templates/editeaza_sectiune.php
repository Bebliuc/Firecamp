<?php $part = Record::findOneFrom('templates_parts', 'id = '.$id); ?>
<div id="contentHolder">
<form method="POST" action="<?php echo get_url('templates/update_sectiune/'.$id); ?>" name="formular_sablon">
  <fieldset>
	<legend>Snippet details</legend>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="numeSectiune">Snippet name</label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" name="numeSectiune" value="<?php echo $part->name; ?>" size="45" />
            </div>
        </div>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="continutSectiune">Snippet content</label>
    		</div>
    		
    		<div class="form-field">
    		  <textarea name="continutSectiune" id="template" cols="97" rows="30" style="font-size:85%; width:99%"><?php echo html_encode($part->content); ?></textarea>
            </div>
        </div>
    <div class="form-buttons">
            <input type="submit" name="salveaza" value="Save changes" class="button" />
    </div>
</fieldset>
</form>
</div>
<?php Observer::notify('template.edit.snippet', $id); ?>