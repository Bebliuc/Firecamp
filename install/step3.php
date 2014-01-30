<?php

$errors = 0;
defined('GREEN_ROOT')         or define('GREEN_ROOT', dirname(__FILE__));
defined('CONFIG_PATH')		  or define('CONFIG_PATH', GREEN_ROOT.'/../config');
defined('PUBLIC_PATH')		  or define('PUBLIC_PATH', GREEN_ROOT.'/../public');
include 'config.php';

if('http://'.$domain.'/install/' != $_SERVER['HTTP_REFERER'] AND !isset($_POST['user'])) die('not allowed');
$check = false;

if(isset($_POST['user'])) {
	
	$username = $_POST['user']['username'];
	$password = $_POST['user']['password'];
	$email = $_POST['user']['email'];
	
	function generateHash($salt = NULL) {
		
		if($salt === NULL)
		        $salt = substr(md5(uniqid(rand(), true)), 0, 9);
		else
		        $salt = substr($salt, 0, 9);
			
		return $salt;
	}
	
	function generatePassword($password, $salt = NULL) {
		
		return generateHash($salt).sha1(generateHash($salt).$password);
		
	}
	if(!empty($_POST['user']['username']) && !empty($_POST['user']['password']) && !empty($_POST['user']['email'])) {
		$hash = generateHash();
		$password = generatePassword($password, $hash);
	
		$sql = "INSERT INTO utilizatori (`id`, `user`, `pass`, `actualizare`, `grup`, `hash`, `email`) VALUES (NULL, ?, ?, NULL, '1', ?, ?);";
		$stmt = $__CONN__->prepare($sql);
		if($stmt->execute(array($username, $password, $hash, $email))) $check = true;
	}
	else $check = false;
	
}
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
	<li class="selected">Step 4: Create your account</li>
	<li class="selected">Step 5: Website settings</li>
	<li class="selected">Step 6: Import and/or finish!</li>
	<li class="selected">----------------</li>
	<li class="selected"><a href="http://aperture.bebliuc.ro/upgrade">Upgrade</a></li>
	<li class="selected"><a href="http://aperture.bebliuc.ro/documentation">Documentation</a></li>
	<li class="selected"><a href="http://aperture.bebliuc.ro/plugin">Plugins</a></li>
</ul>
<form action="<?php echo ($check ? 'step4.php' : 'step3.php'); ?>" method="post">
	<fieldset>
		<legend>Create your account</legend>
		<label>Username
			<input name="user[username]" value="" type="text">
		</label>
		<label>Password 
			<input name="user[password]" value="" type="password">
		</label>
		<label>Email
			<input name="user[email]" value="" type="text">
		</label>
		<fieldset>
			<legend>Keep your credentials at a safe place. This account will <br />be used as the main administrator of the website.</legend>
		</fieldset>
	</fieldset>
	<?php
	if(isset($_POST['user'])) if(!$check)
		echo '<div class="error_msg">User could not be created. Please check database connection.</div>';
	else
		echo '<div class="success_msg">User has been created succesfully.</div>';
	?>
	<div class="submit">
		<?php if($check) { ?>
			<input name="submit" value="Proceed to step 5" type="submit">
		<?php } else { ?>
			<input name="submit" value="Create account" type="submit">
		<?php } ?>
	</div>
</form>
</body>
</html>