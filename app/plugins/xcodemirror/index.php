<?php
/**
 * Firecamp * CMS
 *
 * @package		Firecamp
 * @author		Bebliuc George
 * @copyright	Copyright (c) 2008 - 2011, Bebliuc.
 * @link		http://bebliuc.ro
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeMirror plugin
 *
 * @package		Firecamp
 * @subpackage	Plugins
 * @author		Bebliuc George
 * @link		http://george.bebliuc.eu
 */

Plugin::setInfos(array(
		'id' => 'xcodemirror',
		'title' => 'CodeMirror',
		'author' => 'Bebliuc George',
		'website' => 'http://george.bebliuc.eu',
		'version' => '1.0',
		'description' => 'Textarea code editor.'));
		
function _init_codeMirror() {
	echo '

	<script src="'.BASE_URL.'app/plugins/xcodemirror/CodeMirror-0.93/js/codemirror.js"></script>
    <script src="'.BASE_URL.'app/plugins/xcodemirror/cscc.js"></script>
    <script src="'.BASE_URL.'app/plugins/xcodemirror/cscc-parse-xml.js"></script>
    <script src="'.BASE_URL.'app/plugins/xcodemirror/cscc-parse-css.js"></script>
    <script src="'.BASE_URL.'plugin/xcodemirror/cscc_sense"></script>
	<link rel="stylesheet" href="'.BASE_URL.'app/plugins/xcodemirror/style.css" type="text/css">
	<script type="text/javascript">
	jQuery(function() {
			cscc.init("template", {
				path: "'.BASE_URL.'app/plugins/xcodemirror/CodeMirror-0.93/js/",
				stylesheet: ["'.BASE_URL.'app/plugins/xcodemirror/CodeMirror-0.93/css/xmlcolors.css", "'.BASE_URL.'app/plugins/xcodemirror/CodeMirror-0.93/css/jscolors.css", "'.BASE_URL.'app/plugins/xcodemirror/CodeMirror-0.93/css/csscolors.css"],
				lineNumbers: true,
				height: "400px"
			});
	});
	</script>
	';
}

Observer::observe('template.create', '_init_codeMirror');
Observer::observe('template.edit', '_init_codeMirror');
Observer::observe('template.edit.snippet', '_init_codeMirror');
Observer::observe('template.create.snippet', '_init_codeMirror');
Observer::observe('template.index', '_init_codeMirror');

Plugin::addController('xcodemirror', 'Codemirror', false, false);