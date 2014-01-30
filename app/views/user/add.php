<form action="<?php echo get_url('user/save'); ?>" class="forms" id="profile_form" method="post">
	  <fieldset>
        <h3><?php echo __('Account Details'); ?></h3>
      <div class="form-row">
        <div class="form-label">
            <label for="nume">
                <?php echo __('Username'); ?></label>
        </div>
        <div class="form-field">
            <input name="nume" type="text" value="" id="username" />
        </div>
      </div>
      <div class="form-row align " id="check-password">
            <div class="form-label">
              <label for="user_password"><?php echo __('Password'); ?></label>
    
            </div>
            <div class="form-field">
              <input id="user_password" name="password" size="20" type="password" />	  
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-label">
              <label for="user_password_confirmation"><?php echo __('Password confirmation'); ?></label>
    
            </div>
            <div class="form-field">
              <input id="user_password_confirmation" name="repassword" size="20" type="password" />
              
            </div>
        </div>
        <span class="color-label" style="position:absolute; top:127px; right:390px;"><b class="label-green"></b></span>
        <div class="form-row">
            <div class="form-label">
                <label for="grup"><?php echo __('Permission group'); ?></label>
            </div>
            <div class="form-field">
                <select name="grup" class="blockLabel" >
                        <?php echo User::GroupToDropdown(); ?>
                </select>
            </div>
        </div>
    </fieldset>
    <div class="form-buttons">
            <input type="submit" name="salveaza" value="<?php echo __('Adauga utilizator'); ?>">
    </div>
</form>
<script type="text/javascript">
jQuery(function($){
	$("input[name='password'], input[name='repassword']").keyup(function() {	
		if($("input[name='password']").val() == $("input[name='repassword']").val())
			$("span.color-label b").removeClass('label-red').addClass('label-green');
		else
			$("span.color-label b").removeClass('label-green').addClass('label-red');
	});
});
</script>