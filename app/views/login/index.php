</form>
	<form action="<?php echo get_url('login/check'); ?>" method="post" id="login_form">
	<label for="nume">Email</label>
	<input name="nume" id="nume" size="30" value="" type="text">
	<label for="parola">Password</label>
	<input name="parola" id="parola" size="30" type="password">
	<label for="remember">Remember me for 2 weeks</label>
	<input type="checkbox" name="tine_minte" value="da" checked="" />
	
	<hr>
	<input name="Submit" value="Login" type="submit">
</form>