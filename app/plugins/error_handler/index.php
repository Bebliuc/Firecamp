<?php
/**
 * Firecamp
 *
 * @package		Firecamp
 * @author		Firecamp Team
 * @copyright	Copyright (c) 2010 - 2011, Bebliuc
 * @license		http://firecamp.ro/license
 * @link		http://firecamp.ro
 * @since		Version 1.0.01
 */

/**
 * Error handler plugin
 *
 * @package		plugins
 * @author		Firecamp Team
 * @copyright	Copyright (c) 2010 - 2011, Bebliuc
 * @license		http://firecamp.ro/license
 * @link		http://firecamp.ro
 * @since		Version 1.0.01
 */

Plugin::setInfos(array(
		'id' => 'error_handler',
		'title' => 'Error Handler',
		'author' => 'Bebliuc',
		'website' => 'http://bebliuc.ro',
		'version' => '1.0',
		'description' => 'E_WARNING ^ E_NOTICE ^ E_STRICT error handling.'));

/* ERROR HANDLING */

function debug2($var, $end = FALSE, $i = 1)
{
	echo '<pre style="overflow:scroll; width:96%;color: #699; background-color: #ffc; font-family: monospace; line-height: 12px; padding: 20px; margin: 0 auto; position: fixed; bottom: 0; right: 0; z-index: 1; text-shadow: 0px 0px 0px #000000;">'; var_dump($var); echo '</pre>'; 
	if($end) die;
}
function show_errors($layout) {

	$debug_js = BASE_URL.'app/plugins/error_handler/handler.js';
	$debug_css = BASE_URL.'app/plugins/error_handler/handler.css';
	$errors = '';
	$notices = 0;
	$warnings = 0;
	$debugs = 0;
	foreach(tes::get() as $key => $val) {
		if($val['type'] == 2) $class = 'warning';
		if($val['type'] == 8) $class = 'notice';
		if($val['type'] == 16) $class = 'debug';
		
 		if($val['type'] != 16)
			$errors .= '<li class="'.$class.'">'.$val['str'].' on line '.$val['line'].' located in '.$val['file'].' .</li>'.PHP_EOL;
		else
			$errors .= '<li class="'.$class.'">'.$val['str'].'</li>';
			
		if($val['type'] == 2) $warnings++;
		if($val['type'] == 8) $notices++;
		if($val['type'] == 16) $debugs++;
		
	}
	$jquery = BASE_URL.'app/plugins/jquery/jquery.js';
	$scroll = BASE_URL.'app/plugins/error_handler/handler.js';
	$debug_bar = '<script type="text/javascript">
		if (typeof jQuery == \'undefined\') document.write("<scr" + "ipt type=\"text/javascript\" src=\"'.$jquery.'\"></scr" + "ipt>");
	</script>';
	$debug_bar .= <<<DEBUG_BAR
<div id="debug_bar">
<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
<div class="viewport">
	<div class="overview">
		<ul>
			$errors
		</ul>
	</div>
</div>
<a href="#" id="toggleDebug">$debugs $notices $warnings</a>
</div>
<link href="$debug_css" media="all" type="text/css" rel="stylesheet">
<script type="text/javascript" src="$scroll"></script>
<script type="text/javascript">
jQuery(function($) {
	jQuery("#debug_bar").tinyscrollbar();
						$("a#toggleDebug").toggle(
							function() {
								$("#debug_bar").animate({ marginBottom : '0px' });
								$(this).css("backgroundPosition", "0px -24px"); 
							},
							function() {
								$("#debug_bar").animate({ marginBottom : '-200px' });
								$(this).css("backgroundPosition", "0px 0px");
							});
});
</script>
DEBUG_BAR;
	$layout->continut = str_replace('</body>', $debug_bar.'</body>', $layout->continut);
}
if(user::hasPermissions()) {
	Observer::observe('page_before_execute_layout', 'show_errors');
	Observer::observe('admin.theme', 'admin_errors');
}
function admin_errors() {
	$debug_js = BASE_URL.'app/plugins/error_handler/handler.js';
	$debug_css = BASE_URL.'app/plugins/error_handler/handler.css';
	$errors = '';
	$notices = 0;
	$warnings = 0;
	$debugs = 0;
	foreach(tes::get() as $key => $val) {
		if($val['type'] == 2) $class = 'warning';
		if($val['type'] == 8) $class = 'notice';
		if($val['type'] == 16) $class = 'debug';
		
 		if($val['type'] != 16)
			$errors .= '<li class="'.$class.'">'.$val['str'].' on line '.$val['line'].' located in '.$val['file'].' .</li>'.PHP_EOL;
		else
			$errors .= '<li class="'.$class.'">'.$val['str'].'</li>';
			
		if($val['type'] == 2) $warnings++;
		if($val['type'] == 8) $notices++;
		if($val['type'] == 16) $debugs++;
		
	}
		$scroll = BASE_URL.'app/plugins/error_handler/handler.js';
		$debug_js = BASE_URL.'app/plugins/error_handler/handler.js';
		$debug_css = BASE_URL.'app/plugins/error_handler/handler.css';
		$debug_bar .= <<<DEBUG_BAR
	<div id="debug_bar">
	<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
	<div class="viewport">
		<div class="overview">
			<ul>
				$errors
			</ul>
		</div>
	</div>
	<a href="#" id="toggleDebug">$debugs $notices $warnings</a>
	</div>
	<link href="$debug_css" media="all" type="text/css" rel="stylesheet">
	<script type="text/javascript" src="$scroll"></script>
	<script type="text/javascript">
	jQuery(function($) {
		jQuery("#debug_bar").tinyscrollbar();
							$("a#toggleDebug").toggle(
								function() {
									$("#debug_bar").animate({ marginBottom : '0px' });
									$(this).css("backgroundPosition", "0px -24px"); 
								},
								function() {
									$("#debug_bar").animate({ marginBottom : '-200px' });
									$(this).css("backgroundPosition", "0px 0px");
								});
	});
	</script>
DEBUG_BAR;

	echo $debug_bar;
}