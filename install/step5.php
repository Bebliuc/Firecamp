<?php
include 'config.php';
if(!isset($_POST['setting'])) die('not allowed');
defined('BASE_URL')           or define('BASE_URL', 'http://'.dirname($_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']) .'/?'); 
defined('LOGIN_URL')		  or define('LOGIN_URL', 'http://login.bebliuc.ro/');
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
	<li class="selected completed">Step 1: Requirements</li>
	<li class="selected completed">Step 2: Database settings</li>
	<li class="selected completed">Step 3: Configuration file</li>
	<li class="selected completed">Step 4: Create your account</li>
	<li class="selected completed">Step 5: Website settings</li>
	<li class="selected">Step 6: Finish!</li>
	<li class="selected">----------------</li>
	<li class="selected"><a href="http://aperture.bebliuc.ro/upgrade">Upgrade</a></li>
	<li class="selected"><a href="http://aperture.bebliuc.ro/documentation">Documentation</a></li>
	<li class="selected"><a href="http://aperture.bebliuc.ro/plugin">Plugins</a></li>
</ul>
<form>
	<fieldset>
		<legend>Your website is now up and running.</legend>
		<h2 style="text-decoration:underline; font-size:16px">Website links</h2>
		<p><a href="<?php echo LOGIN_URL; ?>/admin">Administration panel</a></p>
		<p><a href="<?php echo str_replace('install/', '', BASE_URL); ?>">Website frontend</a></p>
		<h2 style="text-decoration:underline; font-size:16px">Aperture</h2>
		<p><a href="http://aperture.bebliuc.ro/plugins">Plugins</a></p>
		<p><a href="http://aperture.bebliuc.ro/documentation">Documentation</a></p>
		<p><a href="http://aperture.bebliuc.ro/upgrade">Upgrade</a></p>
		</fieldset>
	</fieldset>
</form>
</body>
</html>