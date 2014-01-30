<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en"><head>
		
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
		<meta http-equiv="Content-Language" content="en-us">		
		<title>Login</title>
		<link href="<?php echo BASE_URL; ?>app/layouts/login/style.css" media="screen" rel="Stylesheet" type="text/css">
        
        <script src="<?php echo BASE_URL; ?>app/layouts/backend/js/jquery.js" type="text/javascript"></script>
        <script src="<?php echo BASE_URL; ?>app/layouts/login/form.js" type="text/javascript"></script>
        <script type="text/javascript">
		$(document).ready(function(){
			  $("#error").fadeIn(1000);
		  });
    	</script>
</head>
<body>
<div id="wrap" class="clearfix">
<div id="login_form">
	<img src="<?php echo BASE_URL; ?>app/layouts/login/images/login.gif" />
    <?php if(Flash::get('error') != "") { ?>
    <div class="error mb" id="error">
    <?php echo Flash::get('error'); ?>
    </div>
    <?php } ?>
    
    <?php if(Flash::get('success') != "") { ?>
    <div class="error mb" id="error">
    <?php echo Flash::get('success'); ?>
    </div>
    <?php } ?>
	
	<?php echo $content_for_layout; ?>
	</div>
</div>
</body>
</html>