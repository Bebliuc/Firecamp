<script type="text/javascript">
jQuery(function($) {
	$("input[name='moderator']").click(function() {
		$(".tbl-permissions").toggleClass('tbl-disabled');
	});
});
</script>
<form method="post" class="forms" action="<?php echo get_url('usergroup/add'); ?>">
<fieldset>
 <h3><?php echo __('Add new permissions group'); ?></h3>
 <div class="form-row ">
    		<div class="form-label">
    			<label for="albumTitle"><?php echo __('Permissions group name'); ?></label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" size="45" name="nume">
            </div>
  </div><br />
  <div style="height: 50px; background-color:#F8F8FF;">
  	<div style="padding-top:15px; padding-left:15px;">
  		<input type="checkbox" name="moderator" class="textInput" value="1">
        <label for="permissions-admin"><strong><em><?php echo __('Grant administrator rights to this user'); ?></em></strong></label>
  	</div>
  </div>
  <br />
  <table class="tbl-permissions">
  
    <thead>
  		<tr>
  			<th class="tbl-user"><i><?php echo __('Basic'); ?></i></th>
  			<th><?php echo __('Section'); ?></th>
  			<th class="tbl-date"><?php echo __('Enable'); ?></th>
  		</tr>
  	</thead>
	
	
  <tbody>
    
      <tr>
        <td class="tbl-user"></td>
        <td><?php echo __('Pages'); ?></td>
        <td class="tbl-date"><input id="pagina" type="checkbox" value="pages" name="ctrl[]" /></td>
      </tr>
    
      <tr>
        <td class="tbl-user"></td>
        <td><?php echo __('Navigation'); ?></td>
        <td class="tbl-date"><input id="pagina" type="checkbox" value="nav" name="ctrl[]" /></td>
      </tr>
    
      <tr>
        <td class="tbl-user"></td>
        <td><?php echo __('Settings'); ?></td>
        <td class="tbl-date"><input id="pagina" type="checkbox" value="settings" name="ctrl[]" /></td>
      </tr>
    
      <tr>
        <td class="tbl-user"></td>
        <td><?php echo __('Templates'); ?></td>
        <td class="tbl-date"><input id="pagina" type="checkbox" value="templates" name="ctrl[]" /></td>
      </tr>
    
      <tr>
        <td class="tbl-user"></td>
        <td><?php echo __('Members'); ?></td>
        <td class="tbl-date"><input id="pagina" type="checkbox" value="user" name="ctrl[]" /></td>
      </tr>
    
      <tr>
        <td class="tbl-user"></td>
        <td><?php echo __('Permissions'); ?></td>
        <td class="tbl-date"><input id="pagina" type="checkbox" value="usergroup" name="ctrl[]" /></td>
      </tr>
  </tbody>
</table>
<br /><br />
 <table class="tbl-permissions">
  
    <thead>
  		<tr>
  			<th class="tbl-user"><i><?php echo __('Plugins'); ?></i></th>
  			<th><?php echo __('Section'); ?></th>
  			<th class="tbl-date"><?php echo __('Enable'); ?></th>
  		</tr>
  	</thead>
	
	
  <tbody>
  <?php
  $loaded_plugins = Plugin::$plugins;
	foreach($loaded_plugins as $name => $value): ?>
      <tr>
        <td class="tbl-user"></td>
        <td><?php echo ucwords(str_replace("_", " ",$name)); ?></td>
        <td class="tbl-date"><input id="<?php echo $name; ?>" type="checkbox" value="<?php echo str_replace("_", " ", $name); ?>" name="ctrl[]" /></td>
      </tr>
    <?php endforeach; ?>  
  </tbody>
</table>
  </fieldset>  
  <div class="form-buttons">
    <input type="submit" value="<?php echo __('Create group'); ?>" name="submit">
  </div>
</form>

