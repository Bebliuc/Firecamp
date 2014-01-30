<?php

error_reporting(E_ALL);
	function debug($var = array()) {
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}
	
	function get_url_contents($url){
		$crl = curl_init();
		$timeout = 5;
		curl_setopt ($crl, CURLOPT_URL,$url);
		curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
		$ret = curl_exec($crl);
		curl_close($crl);
		
		return $ret;
	}
	
	$error = '';		
	$disabled = false;
	include 'classes/_cryptor.php';
	include 'classes/_loginAuth.php';

	
	if(isset($_POST['login']['submit']) AND $error == '') {
		
		$referer =  substr($_SERVER['HTTP_REFERER'], 0, -1);
		$url = 'http://'.dirname($_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']); 
	
		if($_POST['login']['username'] == '')
			$error = 'Username field is empty';
		elseif($_POST['login']['password'] == '')
			$error = 'Password field is empty';
		elseif($_POST['login']['key'] == '')
			$error = 'Domain field is empty';
		
		elseif($referer != $url)
			$error = 'No cross-domain forgery please...';
			
		if($error == '') {
		
			$auth = new _LoginAuth();
			$auth->prepare($_POST['login']);
			
			$_response = get_url_contents($auth->action());
			
			
			
			if(!$_response)
				$error = "Unrecognized credentials.";	
			else
				$auth->login();
			
		}
	
	}	
	
?>
<!DOCTYPE html>
<html>
<head>
<title>Firecamp login</title>
<link rel="stylesheet" href="font/font.css" type="text/css" media="screen" charset="utf-8"/>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" charset="utf-8"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript">
	$(function() {
		$("input#login").click(function(e) {
			if($('.input-site-url').val() == '') { $('.input-site-url').addClass('error'); e.preventDefault(); }
			else $('.input-site-url').removeClass('error'); errors = 0;
			
			if($('.input-email').val() == '') { $('.input-email').addClass('error'); e.preventDefault(); }
			else $('.input-email').removeClass('error');
			
			if($('.input-password').val() == '') { $('.input-password').addClass('error'); e.preventDefault(); }
			else $('.input-password').removeClass('error');
		});
	});
</script>
</head>
<body>
<div class="stage-message">
	<img src="images/firecamp.png" class="firecamp_logo" />
	<div class="title">
		Manage your website
	</div>
	<div class="message">
		Log into using your existing Firecamp account - domain name.
	</div>
	<div class="error-wrapper">
		<div class="error">
			<?php echo $error != '' ? $error : ''; ?>
		</div>
	</div>
	<form method="POST" action="#">
	<div class="signup-fields clear">
		<div class="field-block">
			<div class="field-title">
				SITE DOMAIN NAME
			</div>
			<div class="field-input">
				<input class="input-site-url" autocomplete="off" placeholder="your-domain.com" name="login[key]" style="width: 280px;" type="text">
				<div class="input-site-url-overlay field-title-overlay">
				</div>
			</div>
		</div>
		<div class="field-block">
			<div class="field-title">
				USERNAME
			</div>
			<div class="field-input">
				<input class="input-email" spellcheck="false" autocomplete="off" name="login[username]" placeholder="username" style="width: 220px;" type="text">
			</div>
		</div>
		<div class="field-block">
			<div class="field-title">
				PASSWORD
			</div>
			<div class="field-input">
				<input class="input-password" style="width: 160px;" name="login[password]" placeholder="password" type="password">
			</div>
		</div>
	</div>
	<div class="controls clear">
		<div class="control">
			<input id="login" name="login[submit]" value="Authentificate" type="submit">
		</div>
	</div>
	</form>
</div>
</body>
</html>