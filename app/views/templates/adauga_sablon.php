<div id="contentHolder">
<form method="POST" action="<?php echo get_url('templates/salveaza'); ?>" name="formular_sablon">
	<fieldset>
		<legend><?php echo __('Template details'); ?></legend>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="numeSablon"><?php echo __('Template name'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" name="numeSablon" size="45" />
            </div>
        </div>
		<div class="form-row ">
    		<div class="form-label">
    			<label for="continutSablon"><?php echo __('Template content'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <textarea name="continutSablon" id="template" style="width:auto; height:400px;"></textarea>
            </div>
        </div>
	</fieldset>
	<div id="dropables">
		<div id="dropable">
			<h2><a href="#"><?php echo __('Preferences'); ?></a></h2>
			<div class="content">
				<div class="form-row ">
		    		<div class="form-label">
		    			<label for="tipSablon"><?php echo __('Template type'); ?></label>
		    		</div>

		    		<div class="form-field">
		    		  <input type="text" name="tipSablon" title="<?php echo __('Template MIME-Type. Default: <i>text/html</i>.'); ?>" size="45" />
		            </div>
		         </div>
					<div class="form-row ">
			    		<div class="form-label">
			    			<label for="tgroup"><?php echo __('Template group'); ?></label>
			    		</div>

			    		<div class="form-field">
							<select name="tgroup" title="<?php echo __('Select template group.'); ?>">
								<?php foreach(record::findAllFrom('templates_groups', 'id != 0 ORDER BY name ASC') as $group): ?>
									<option value="<?php echo $group->id; ?>"><?php echo $group->name; ?></option>
								<?php endforeach; ?>
							</select>
			            </div>
			         </div>
						<div class="form-row">
							<div class="form-label">
								<label for="compress"><?php echo __('Compress'); ?></label>
							</div>
							<div class="form-field">
								<input type="checkbox" name="compress" title="<?php echo __('Only for CSS/Javascript.'); ?>" />
							</div>
						</div>
						<div class="form-row">
							<div class="form-label">
								<label for="tidy">Tidy cleanup</label>
							</div>
							<div class="form-field">
								<input type="checkbox" id="example" name="tidy" title="<?php echo __('Only for (x)HTML.'); ?>" />
							</div>
						</div>
			</div>
		</div>
		<div id="dropable">
			<h2><a href="#"><?php echo __('Template notes'); ?></a></h2>
			<div class="content">
				<p><?php echo __('Store notes, informations and TODO\'s in this form field.'); ?></p>
				<textarea title="<?php echo __('Usage of PHP is forbidden and it will not be executed.'); ?>" name="notes" id="notes" style="height:200px;"></textarea>
			</div>
		</div>
		</div>
    <div class="form-buttons">
        <input type="submit" value="<?php echo __('Create template'); ?>" name="submit" />
        <span class="button-alt"><?php echo __('or '); ?><a href="<?php echo get_url('templates/index'); ?>"><?php echo __('Cancel and go to templates'); ?></a></span>
    </div>
</form>
</div>
<?php Observer::notify('template.create'); ?>