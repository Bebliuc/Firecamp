<?php 
include 'config.php';
if($is_installed) header('Location: http://login.bebliuc.ro');
$error = 0;
defined('GREEN_ROOT')         or define('GREEN_ROOT', dirname(__FILE__));
defined('CONFIG_PATH')		  or define('CONFIG_PATH', GREEN_ROOT.'/../config');
defined('PUBLIC_PATH')		  or define('PUBLIC_PATH', GREEN_ROOT.'/../public');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Install Aperture</title>
<link href="favicon.ico" rel="shortcut icon">
<link href='http://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<h1>Install Aperture <em>Version 1.0beta</em></h1>
<ul>
	<li class="selected">Step 1: Requirements</li>
	<li class="selected">Step 2: Database settings</li>
	<li class="selected">Step 3: Configuration file</li>
	<li class="selected">Step 4: Create your account</li>
	<li class="selected">Step 5: Website settings</li>
	<li class="selected">Step 6: Import and/or finish!</li>
	<li class="selected">----------------</li>
	<li class="selected"><a href="http://aperture.bebliuc.ro/upgrade">Upgrade</a></li>
	<li class="selected"><a href="http://aperture.bebliuc.ro/documentation">Documentation</a></li>
	<li class="selected"><a href="http://aperture.bebliuc.ro/plugin">Plugins</a></li>
</ul>
<?php
if ( !$is_installed  ) {
?>
<form action="step2.php" method="post">
	<fieldset>
		<legend>Server requirements</lenged>
			<div class="requirements">
				<?php $check = (PHP_VERSION >= '5.1.2'); ?>
				<p>
					Php version: <em class="<?php echo ($check ? 'success' : 'error'); ?>"><?php echo PHP_VERSION; ?></em>
				</p>
				<?php
					$check = false;
					$check = class_exists('PDO',false);
					if(!$check) $error = 1;
				?>
				<p>
					PDO Support: <em class="<?php echo ($check ? 'success' : 'error'); ?>"><?php echo ($check ? 'Available' : 'Unavailable'); ?></em>
				</p>
				<?php
					$drivers = PDO::getAvailableDrivers();
					$mcheck = in_array('mysql', $drivers);
					if(!$mcheck) $error = 1;
				?>
				<p>
					PDO MySQL Driver: <em class="<?php echo ($mcheck ? 'success' : 'error'); ?>"><?php echo ($mcheck ? 'Available' : 'Unavailable'); ?></em>
				</p>
				<p>
				<?php
					$check = is_writable(PUBLIC_PATH);
					if(!$check) $error = 1;
				?>
					Public folder is writable: <em class="<?php echo ($check ? 'success' : 'error'); ?>"><?php echo ($check ? 'Writable' : 'Not writable'); ?></em>
				</p>
				<p>
				<?php
			   		$check = false;
			   		if (function_exists('apache_get_modules')) {
					  $modules = apache_get_modules();
					  $check = in_array('mod_rewrite', $modules);
					} else {
					  $check =  getenv('HTTP_MOD_REWRITE')=='On' ? true : false ;
					}
				?>
					Mod_rewrite: <em class="<?php echo ($check ? 'success' : 'warning'); ?>"><?php echo ($check ? 'Available' : 'Unavailable'); ?></em>
				</p>
			</div>
	</fieldset>
	<?php
	if($error)
		echo '<div class="error_msg">It seems your server is not matching the requirements of this install.</div>';
	else
		echo '<div class="success_msg">You may now begin and install Aperture on your server.</div>';
	?>
	<div class="submit">
		<input name="submit" value="Install Aperture" type="submit" />
	</div>
</form>
<?php } ?>
</body>
</html>