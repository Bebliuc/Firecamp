<?php

class XcodemirrorController extends PluginController {
	
	function cscc_sense() {

	
		header("Content-type: text/javascript");
		$keys = NULL;
		foreach(templateTags::$_tags as $key => $value) {
			$keys .= '"fc:'.$key.'" : 1,
	  ';
		}
		$javascript = file_get_contents(APP_PATH.'/plugins/xcodemirror/cscc-sense.js');
		$javascript = str_replace('//fc_tags', $keys, $javascript);
		
		echo $javascript;
	}
	
}