<?php
/**
 * @package Firecamp
 * @subpackage plugin
 *
 * @author Bebliuc George <george@bebliuc.ro>
 * @version 0.1
 * @copyright Bebliuc George, 2009
 */

/**
 * Template Tags Plugin
 *
 * @package Firecamp
 * @subpackage template_tags
 * @todo Enables templates tags for Templating System.
 * 
 * @version 0.1
 * @since 0.1
 */

Plugin::setInfos(array(
		'id' => 'template_tags',
		'title' => 'Template Tags',
		'author' => 'Bebliuc',
		'website' => 'http://bebliuc.ro',
		'version' => '1.0',
		'description' => 'Enables template tags like {tag_name:tag_atribute:atribute_value}.'));


Observer::observe('page_before_execute_layout', 'parse');
Observer::observe('snippet.before.eval', 'parse_snippet');
Observer::observe('page', 'parse_page');

// snippets

foreach(record::findAllFrom('templates_parts') as $snippet) {
	templateTags::add('snippet:'.$snippet->name, '<?php template::part("'.$snippet->name.'"); ?>');
}

// Basic stuff
templateTags::add('theme_url', PUBLIC_URI.'/themes/'.setting::get('theme_base_url'));
templateTags::add('setting:sitename', setting::get('sitename'));
templateTags::add('js:jquery', BASE_URL.'app/plugins/jquery/jquery.js');

// Page tags

templateTags::add('page:title', '<?php echo $page->name; ?>');
templateTags::add('page:url', '<?php echo BASE_URL.page::getPathToPage($page->id); ?>');
templateTags::add('page:seo:title', '<?php echo $page->title; ?>');
templateTags::add('page:content', '<?php echo $page->content; ?>');
templateTags::add('page:tags', '<?php echo $page->tags; ?>');
templateTags::add('page:seo:keywords', '<?php echo $page->meta_keywords; ?>');
templateTags::add('page:seo:description', '<?php echo $page->meta_description; ?>');
templateTags::add('page:date', '<?php echo $page->date; ?>');

function parse_page( $page ) {
	
	$page->content = templateTags::parse($page->content);

}
function parse_snippet( $snippet ) {
	$snippet->content = templateTags::parse($snippet->content);
}

function parse($layout) {
	
	$layout->continut = templateTags::parse($layout->continut);
}