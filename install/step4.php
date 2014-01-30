<?php 
include 'config.php';

if(!isset($_POST['user']) AND !isset($_POST['setting'])) die('not allowed');
$errors = 0;
defined('GREEN_ROOT')         or define('GREEN_ROOT', dirname(__FILE__));
defined('CONFIG_PATH')		  or define('CONFIG_PATH', GREEN_ROOT.'/../config');
defined('PUBLIC_PATH')		  or define('PUBLIC_PATH', GREEN_ROOT.'/../public');
$check = false;
	
	if(isset($_POST['setting'])) {
		
		$name = $_POST['setting']['name'];
		$title = $_POST['setting']['title'];
		$keywords = $_POST['setting']['keywords'];
		$description = $_POST['setting']['description'];
		$offline = 0;
		if(isset($_POST['setting']['maintenance'])) $offline = 1;
		
		$sql =  "UPDATE setting SET value = ? WHERE name = 'sitename';";
		
		$stmt = $__CONN__->prepare($sql);
		if($stmt->execute(array($name))) $check = 1; else $check = 0;
		
		
		$sql =  "UPDATE setting SET value = ? WHERE name = 'sitenameseo';";
		
		$stmt = $__CONN__->prepare($sql);
		if($stmt->execute(array($title))) $check = 1; else $check = 0;
		
		$sql =  "UPDATE setting SET value = ? WHERE name = 'keywordsseo';";
		
		$stmt = $__CONN__->prepare($sql);
		if($stmt->execute(array($keywords))) $check = 1; else $check = 0;
		
		$sql =  "UPDATE setting SET value = ? WHERE name = 'descriptionseo';";
		
		$stmt = $__CONN__->prepare($sql);
		if($stmt->execute(array($description))) $check = 1; else $check = 0;
		
		if($offline) {
			$sql = "UPDATE setting SET value =  'a:11:{s:10:\"statistics\";i:1;s:6:\"logger\";i:1;s:11:\"ajax_upload\";i:1;s:7:\"cryptor\";i:1;s:9:\"loginauth\";i:1;s:5:\"tabby\";i:1;s:13:\"error_handler\";i:1;s:5:\"tipsy\";i:1;s:8:\"markitup\";i:1;s:13:\"template_tags\";i:1;s:10:\"contiguous\";i:1;}' WHERE name = 'plugins';";
			$stmt = $__CONN__->prepare($sql);
			if($stmt->execute()) $check = 1; else $check = 0;
		}
		
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
	<li class="selected completed">Step 4: Create your account</li>
	<li class="selected">Step 5: Website settings</li>
	<li class="selected">Step 6: Import and/or finish!</li>
	<li class="selected">----------------</li>
	<li class="selected"><a href="http://aperture.bebliuc.ro/upgrade">Upgrade</a></li>
	<li class="selected"><a href="http://aperture.bebliuc.ro/documentation">Documentation</a></li>
	<li class="selected"><a href="http://aperture.bebliuc.ro/plugin">Plugins</a></li>
</ul>
<form action="<?php echo ($check ? 'step5.php' : 'step4.php'); ?>" method="post">
	<fieldset>
		<legend>Website settings</legend>
		<label>Website Name
			<input name="setting[name]" value="Another Aperture Website" type="text">
		</label>
		<label>Default Meta Title
			<input name="setting[title]" value="My Website" type="text">
		</label>
		<label>Meta keywords
			<input name="setting[keywords]" value="aperture, website, content, management" type="text">
		</label>
		<label>Meta description
			<input name="setting[description]" value="Simplified content management system brought to you by Aperture." type="text">
		</label>
		<label class="option">Maintenance mode
			<input type="checkbox" value="yes" name="setting[maintenance]">
		</label>
		</fieldset>
	</fieldset>
	<?php
	if(isset($_POST['setting'])) if(!$check)
		echo '<div class="error_msg">Please check database connection settings.</div>';
	else
		echo '<div class="success_msg">Your website settings have been saved successfully.</div>';
	?>
	<div class="submit">
		<?php if($check) { ?>
			<input name="submit" value="Finalize setup" type="submit">
		<?php } else { ?>
			<input name="submit" value="Save website settings" type="submit">
		<?php } ?>
	</div>
</form>
</body>
</html>