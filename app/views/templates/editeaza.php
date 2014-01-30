<?php $template = Record::findOneFrom('templates', 'id = '.$id); ?>
<div id="contentHolder">
<form method="POST" action="<?php echo get_url('templates/salveaza_editare/'.$id); ?>" name="formular_sablon">
	<fieldset>
		<legend><?php echo __('Template details'); ?></legend>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="numeSablon"><?php echo __('Template name'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" name="numeSablon" value="<?php echo $template->nume; ?>" size="45" />
            </div>
        </div>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="continutSablon"><?php echo __('Template content'); ?></label>
    		</div>
    		<div class="form-field" id="exposable">
    		  <textarea name="continutSablon" style="height:400px;" id="template" style="width:auto; height:300px;"><?php echo html_encode($template->continut); ?></textarea>
            </div>
            <p class="action" style="float:right">
			  <a href="#" class="button" id="toggle_exposee"><span><b class="icon arrow"></b><?php echo __('Edit in fullscreen'); ?></span></a>
			</p>
        </div>
	</fieldset>
	<fieldset>
		<legend><?php echo __('Template options'); ?></legend>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="tipSablon"><?php echo __('Template type'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" value="<?php echo $template->tip; ?>" name="tipSablon" size="45" />
            </div>
         </div>
	</fieldset>
    <div class="form-buttons">
            <input type="submit" name="salveaza" value="Save changes" class="button" />
            <input type="submit" value="Save changes and continue" name="continua" class="button" />
    </div>


</form>
<div id="exposee" style="display:block; visibility:hidden;">
    <div class="holder">
        <div class="exposee_content" style="width:1100px; height:500px;">
        <h2><?php echo __('Template edit'); ?><p class="action" style="float:right">
              <a href="#" class="button" id="update"><span><b class="icon arrow"></b><?php echo __('Update'); ?></span></a>
        </p></h2>
        <textarea id="fullscreen_edit" style="width:1000px;" name="test"></textarea>
        <h2><code><?php echo __('Available snippets :'); ?> <?php foreach(record::findAllFrom('templates_parts') as $snippet) { echo $snippet->name.', '; } ?></code></h2>
        </div>
    </div>
</div>	
</div>
<script type="text/javascript">
jQuery(function($) {
	$("#exposee .holder .exposee_content textarea").val($("#template").val());
	$("#toggle_exposee").click(function() {	
		$("#exposee").css('visibility', '');
	});
	$("#update").click(function() {
		var update = $("#fullscreen_edit").val();
		$("#fullscreen_editor").val(update);
		alert(update);
	//	$("#exposee").css('visibility', 'hidden');	
	});
});
</script>
<?php Observer::notify('template.edit', $id); ?>