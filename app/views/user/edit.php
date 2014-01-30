<?php if(User::hasPermissionsTo('*')) $secure = ''; else $secure = 'disabled="" '; ?>
<?php $current = user::_fetch(user::getUserName($id));  ?>
<ul class="vertical-tabs users-list">
  <li class="vcard anonymous active">
    <a href="<?php echo get_url('user/edit/'.$current->id); ?>">
      <span class="userpic size-large"><img src="<?php echo BASE_URL; ?>app/layouts/admin_v2/images/userpic.gif" alt="<?php echo $current->user; ?>" class="photo" /><b></b></span>
      <span class="username"><span class="fn"><?php echo $current->user; ?></span></span>
    </a>
  </li>
  <li>
    <h2>
    <?php
    	$users = user::findAllFrom('utilizatori');
    	$nr = count($users);
    ?>
      <b><?php echo __('Users({nr})', array('{nr}' => $nr)); ?></b>
    </h2>
  </li>
  <?php

	global $__CONN__;

	$sql = "SELECT * FROM utilizatori ORDER BY grup ASC, user ASC";
	$stmt = $__CONN__->prepare($sql);
	$stmt->execute();

	while($user = $stmt->fetchObject()) {
  ?>
  <li class="vcard">
    <a href="<?php echo get_url('user/edit/'.$user->id); ?>">
      <span class="userpic size-large"><img alt="<?php echo $user->user; ?>" class="photo" height="32" src="<?php echo BASE_URL; ?>app/layouts/admin_v2/images/userpic.gif" width="32" /><b></b></span><span class="username"><span class="fn"><?php echo $user->user; ?></span>
      
      <?php $group = user::getGroupByUser($user->user); ?>
      <?php if($group == "Administrator") { ?>
      <sup class="role user-type-owner">
        Admin
      </sup>
     <?php } elseif ($group == "Moderator") { ?>
      <sup class="role user-type-admin">
        Moderator
      </sup>
     <?php } else { ?>
      <sup class="role user-type-invited">
        <?php echo $group; ?>
      </sup>
     <?php } ?>
      </span><span class="email"><?php echo $user->actualizare; ?></span>
    </a>
  </li>
  <?php } ?>
</ul>
<div class="user-properties">
  <div class="wrapper">
    <h2 class="username">
      <span class="userpic size-large"><img alt="Bebliuc George" class="photo" height="32" src="<?php echo BASE_URL; ?>app/layouts/admin_v2/images/userpic.gif" width="32" /><b></b></span> <?php echo $current->user; ?> 
    </h2>
    <form action="<?php echo get_url('user/save/edit/'.$id); ?>" method="post">
      <div style="margin:0;padding:0;display:inline">
      </div>
      <fieldset>
        <legend>
          <?php echo __('User Profile'); ?>
        </legend>
        <div class="form-row">
          <div class="form-label">
             <?php echo __('User name'); ?> 
          </div>
          <div class="form-field">
            <strong>
              <?php echo $current->user; ?>
            </strong>
          </div>
        </div>
        <div class="form-row ">
          <div class="form-label">
            <label for="profile-fn">
              <?php echo __('Username'); ?>
            </label>
          </div>
          <div class="form-field">
            <input id="profile-fn" name="nume" size="27" type="text" value="<?php echo $current->user; ?>" />
          </div>
        </div>
        <div class="form-row ">
          <div class="form-label">
            <label for="profile-ln">
              <?php echo __('Password'); ?>
            </label>
          </div>
          <div class="form-field">
            <input id="profile-ln" name="password" type="password" value="" />
          </div>
        </div>
        <div class="form-row ">
          <div class="form-label">
            <label for="profile-email">
              <?php echo __('Retype Password'); ?>
            </label>
          </div>
          <div class="form-field">
            <input id="profile-email" name="repassword" type="password" value="" />
          </div>
        </div>
        <div class="form-row ">
          <div class="form-label">
            <label for="profile-email">
              <?php echo __('Usergroup'); ?>
            </label>
          </div>
          <div class="form-field">
		<select name="grup" class="blockLabel" <?php echo $secure; ?>>
			<?php echo User::GroupToDropdown($current->grup); ?>
		</select>
          </div>
        </div>
      </fieldset>
      <fieldset>
      	<legend>
      		<?php echo __('Account security information'); ?>
      	</legend>
      		<p class="comment clear">
      			<strong><?php echo __('Hash'); ?></strong> <?php if(User::hasPermissionsTo('*')) { echo $current->hash; } else echo '<font color="red">unauthorized.</font>'; ?><br />
      			<strong><?php echo __('Last known login'); ?></strong> <?php echo $current->actualizare; ?>
      		
      	
      </fieldset>
      <fieldset>
        <legend>
          <?php echo __('Delete user'); ?>
        </legend>
        <p class="comment clear">
           <?php echo __('Please double-check before you delete your account. This action is not undo-able.'); ?>
        </p>
        <p><?php if(User::hasPermissionsTo('*')) { ?>
          <a href="<?php echo get_url('user/delete/'.$current->id); ?>" class="button">
          <?php } else { ?>
          <a href="#" class="button disabled" onclick="return false">
          <?php } ?>
            <span><?php echo __('Delete this user'); ?></span>
          </a>
        </p>
      </fieldset>
      <div class="form-buttons">
        <input name="salveaza" type="submit" value="<?php echo __('Save changes'); ?>" />
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
jQuery(function($){
	$("input[name='password'], input[name='repassword']").keyup(function() {	
		if($("input[name='password']").val() == $("input[name='repassword']").val())
			$("#validation").css('background', 'green');
		else
			$("#validation").css('background', 'red');
	});
});
</script>