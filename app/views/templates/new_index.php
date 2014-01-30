<?php 
	$template = record::findOneFrom('templates', ' id = ?', array(20));
?>
<ul class="vertical-tabs templates-list">  
  <li>
    <h2 class="t_options">
      <b><?php echo __('Templates options'); ?></b>
    </h2>
  </li>
  <li class="vcard" id="t_options">
	<a href="<?php echo get_url('user/edit/'); ?>">Global variables</a>
  </li>
  <li class="vcard" id="t_options">
	<a href="<?php echo get_url('user/edit/'); ?>">Global settings</a>
  </li>
<?php foreach(record::findAllFrom('templates_groups', 'id != 0 ORDER BY name ASC') as $group): ?>
  <li>
    <h2 class="t_<?php echo str_replace(' ', '', $group->name); ?>">
      <b><?php echo $group->name; ?></b>
    </h2>
  </li>
  <?php foreach(record::findAllFrom('templates', 'tgroup = ? ORDER BY nume ASC', array($group->id)) as $template): ?>
 	 <li class="vcard" id="t_<?php echo str_replace(' ', '', $group->name); ?>" rel="<?php echo $template->id; ?>">
		<a href="<?php echo get_url('templates/editeaza/'.$template->id); ?>"><?php echo $template->nume; ?></a>
	  </li>
  <?php endforeach; ?>
<?php endforeach; ?>
</ul>
<div class="user-properties">
  <div class="wrapper" id="w_templates">
		<h2 class="username"><?php echo __('Templates'); ?></h2>
		<div id="contentHolder">
		<table class="tbl-permissions">
		<thead>
			<tr>
				<th><?php echo __('Nume sablon'); ?></th>
				<th><?php echo __('Tip sablon'); ?></th>
				<th class="tbl-right"><?php echo __('Editeaza'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$templates = Record::findAllFrom('templates', 'id != 0 ORDER BY id ASC');
		foreach($templates as $template):
		?>
		<tr>
			<td><?php echo $template->nume; ?></td>
			<td><i><?php echo $template->tip; ?></i></td>
		    <td class="tbl-right">
			<sup class="role user-type-owner"><a href="<?php echo get_url('templates/editeaza/'.$template->id); ?>"><?php echo __('Edit'); ?></a></sup>
		    <sup class="role user-type-admin"><a href="<?php echo get_url('templates/sterge/'.$template->id); ?>" class="sterge"><?php echo __('Delete'); ?></a></sup>
			</td>
		</tr>

		<?php endforeach; ?>
		<tbody>
		</table>
		</div>
  </div>
  <div class="wrapper" id="w_edit" style="position:relative; display:none;">
    <h2 class="username" id="templates_h"><?php echo __('Templates'); ?></h2>
	<div id="msg_log">
		<p>Not saved...</p>
	</div>
  	<form method="POST" action="<?php echo get_url('templates/salveaza_editare/'.$template->id); ?>" name="formular_sablon">
		<fieldset>
			<legend><?php echo __('Template details'); ?></legend>
			<div class="form-row ">
	    		<div class="form-label">
	    			<label for="numeSablon"><?php echo __('Template name'); ?></label>
	    		</div>

	    		<div class="form-field">
	    		  <input type="text" name="numeSablon" value="<?php echo $template->nume; ?>" title="<?php echo __('Template name. No special characters allowed.'); ?>" size="45" />
	            </div>
	        </div>
			<div class="form-row ">
	    		<div class="form-label">
	    			<label for="continutSablon"><?php echo __('Template content'); ?></label>
	    		</div>
	    		<div class="form-field" id="exposable">
	    		  <div id="makeEditor"></div>
	
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
					    		  <input type="text" value="<?php echo $template->tip; ?>" name="tipSablon" title="<?php echo __('Template MIME-Type. Default: <i>text/html</i>.'); ?>" size="45" />
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
	            <input type="submit" value="Save changes and continue" name="continua" class="button" />
	    </div>
	</form>
  </div>
</div>
<script type="text/javascript">
var editor = "";

	jQuery(function($) {
		$('ul.vertical-tabs li.vcard').css('display', 'none').attr('title', 'collapsed');
		$('ul.vertical-tabs li h2').click(function(e) {
			var expand_id = $(this).attr('class');
			
			if($('ul.vertical-tabs li#' + expand_id).attr('title') == 'collapsed') {
				$('ul.vertical-tabs li#' + expand_id).css('display', 'block').attr('title', 'expanded');
				$(this).children('b').css('background-image', 'url(<?php echo BASE_URL; ?>app/layouts/admin_v2/images/template_edit_minus_blue.png)');
			}
			else {
				$('ul.vertical-tabs li#' + expand_id).css('display', 'none').attr('title', 'collapsed');
				$(this).children('b').css('background-image', 'url(<?php echo BASE_URL; ?>app/layouts/admin_v2/images/template_edit_plus_blue.png)');
			}
			e.preventDefault();
		});

		$('ul.vertical-tabs li.vcard').click(function(e) {
			var $this = $(this);
			var id = $this.attr('rel');
				var tid = "template" + id;
				$("#makeEditor").html('<textarea name="continutSablon" id="' + tid + '" style="width:98%; height:300px;"></textarea>');
			$('form[name=formular_sablon]').attr('rel', id);
			$('form[name=formular_sablon]').attr('action', '<?php echo get_url("templates/salveaza_editare/"); ?>' + id);

			$.getJSON('<?php echo get_url("templates/ajax_fetch/"); ?>' + id, function(data) {
				$('h2#templates_h').html('<?php echo __("Edit template: "); ?> <strong>' + data.name +'</strong');
				$('input[name=tipSablon]').val(data.type);
				$('input[name=numeSablon]').val(data.name);
				$('textarea#notes').val(data.notes);
				$('textarea[name=continutSablon]').val(data.content);
				
				if(data.compress == 1) {
					$('input[name=compress]').attr('checked', 'checked');
					$('input[name=compress]').parent().children('label').removeClass('iToff').addClass('iTon').css('backgroundPosition', '0% -19px');
					
				} else {
					$('input[name=compress]').attr('checked', false);
					$('input[name=compress]').parent().children('label').removeClass('iTon').addClass('iToff').css('backgroundPosition', '100% -19px');
				}
				
				if(data.tidy == 1) {
					$('input[name=tidy]').attr('checked', 'checked');
					$('input[name=tidy]').parent().children('label').removeClass('iToff').addClass('iTon').css('backgroundPosition', '0% -19px');
				} else {
						$('input[name=tidy]').attr('checked', false);
						$('input[name=tidy]').parent().children('label').removeClass('iTon').addClass('iToff').css('backgroundPosition', '100% -19px');
				}

				editor = cscc.init(tid, {
					path: "<?php echo BASE_URL; ?>app/plugins/xcodemirror/CodeMirror-0.93/js/",
					stylesheet: ["<?php echo BASE_URL; ?>app/plugins/xcodemirror/CodeMirror-0.93/css/xmlcolors.css", "<?php echo BASE_URL; ?>app/plugins/xcodemirror/CodeMirror-0.93/css/jscolors.css", "<?php echo BASE_URL; ?>app/plugins/xcodemirror/CodeMirror-0.93/css/csscolors.css"],
					lineNumbers: true,
					height: "400px"
				});
			});
			$('#w_templates').hide();
			$('#w_edit').hide();
			$('#w_edit').fadeIn();
			$("#msg_log p").html('Not saved...').animate({ color : '#900' });
			e.preventDefault();
		});
		
		$('form[name=formular_sablon] input[type=submit]').click(function(e) {
			var $form = $('form[name=formular_sablon]');
			var id = $('form[name=formular_sablon]').attr('rel');
			var title = $form.find('input[name=numeSablon]').val();
			var content = $form.find('textarea[name=continutSablon]').val();
			var type = $form.find('input[name=tipSablon]').val();
			if($form.find('input[name=compress]').is(':checked'))
				var compress = 1;
			else
				var compress = 0;
				
			if($form.find('input[name=tidy]').is(':checked'))
				var tidy = 1;
			else
				var tidy = 0;
				
			var notes = $form.find('textarea#notes').val();
			
			$.ajax({
			   type: "POST",
			   url: "<?php echo get_url('templates/get_data/'); ?>" + id,
			   data: "title=" + title + "&content=" + editor.editor.getCode() + "&type=" + type + "&compress=" + 
				      compress + "&tidy=" + tidy + "&notes=" + notes,
			   success: function(msg){
					
					var currentTime = new Date()
					var hours = currentTime.getHours()
					var minutes = currentTime.getMinutes()
					
				    $.scrollTo('#title', 700, {onAfter:function(){
						if(msg == "1")
							$("#msg_log p").html('Saved <br /><span>' + hours + ':' + minutes + '</span>').animate({ color : 'green' });
				 		else
							$("#msg_log p").html('Still not <br /><span>saved</span>');
					}});
			   }
			 });
			e.preventDefault();
		});
		
	});
</script>

<?php Observer::notify('template.index'); ?>