<?php

class MarkitupController extends PluginController {
	
	function preview() {
		use_helper('Markdown');
		
		$content = $_POST['data'];
		$_content = Markdown($content);
		$url = Setting::get('preview_style');
		$url = str_replace('{base_url}', BASE_URL, $url);
		echo <<<TEMPLATE
			<head>
				<link href="$url" media="screen" rel="stylesheet" type="text/css">
			</head>
			<body>
				$_content
			</body>
		
TEMPLATE;
	}
	
}