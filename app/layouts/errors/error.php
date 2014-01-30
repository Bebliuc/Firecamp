<!DOCTYPE HTML>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">



	<title>System error</title>
	<meta charset="utf-8">
	<meta name="robots" content="none">

	<link href="<?php echo BASE_URL; ?>app/layouts/errors/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo BASE_URL; ?>app/layouts/errors/js.js"></script>
</head><body class="special-page error-bg red dark">
	
	<section id="error-desc">
		
		<ul class="action-tabs with-children-tip children-tip-left">
			<li><a href="javascript:history.back()" title="Go back"><img src="<?php echo BASE_URL; ?>app/layouts/errors/images/navigation-180.png" height="16" width="16"></a></li>
			<li title="Reload page"><a href="javascript:window.location.reload()" title=""><img src="<?php echo BASE_URL; ?>app/layouts/errors/images/arrow-circle.png" height="16" width="16"></a></li>
		</ul>
		
		<ul class="action-tabs right with-children-tip children-tip-right">
			<li><a href="javascript:void(0)" title="Show/hide&lt;br&gt;error details" onclick="$(document.body).toggleClass('with-log'); return false;">
				<img src="<?php echo BASE_URL; ?>app/layouts/errors/images/application-monitor.png" height="16" width="16">
			</a></li>
		</ul>
		
		<div class="block-border"><div class="block-content">
				
			<h1>Bebliuc*</h1>
			<div class="block-header">System error</div>
			
			<h2>Error description</h2>
			
			<h5>Message</h5>
			<p>An error occurred while processing your request. Please return to 
the previous page and check everything before trying again. If the same 
error occurs again, please contact your system administrator or report 
error (see below).</p>
			
			<p><b>Event type:</b> exception thrown<br>
			<b>Page:</b> <?php echo $action; ?></p>
			
		</div></div>
	</section>
	
	<section id="error-log">
		<div class="block-border"><div class="block-content">
				
			<h1>Error details</h1>
			
			<div class="fieldset grey-bg with-margin">
			<pre style="
 overflow-x: auto; 
 white-space: pre-wrap; 
 white-space: -moz-pre-wrap !important; 
 white-space: -pre-wrap;
 white-space: -o-pre-wrap; 
 /* width: 99%; */
 word-wrap: break-word;
">
			
			
			<?php throw new Exception("Action '{$action}' is not valid!"); ?>
			</pre>
			</div>
		</div></div>
	</section>
<ul id="notifications"></ul><div id="tips"></div></body></html>
