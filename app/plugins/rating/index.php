<?php
/**
 * @package BebliuCMS
 * @subpackage plugin
 *
 * @author Bebliuc George <george@bebliuc.ro>
 * @version 0.1
 * @copyright Bebliuc George, 2009
 */

/**
 * Products Plugin
 *
 * @package BebliuCMS
 * @subpackage products
 * @todo Add new category feature
 * 
 * @version 0.1
 * @since 0.1
 */


Plugin::setInfos(array(
		'id' => 'rating',
		'title' => 'Rate-me',
		'author' => 'Bebliuc',
		'website' => 'http://bebliuc.ro',
		'version' => '1.0',
		'description' => 'Simple rating plugin for, everything.'));
		
Observer::observe('page_before_execute_layout', 'rating');
Plugin::addController('rating', 'Rating');
function rating(&$layout) {
	$rating  = '<link rel="stylesheet" href="'.BASE_URL.'app/plugins/rating/files/jquery.rating.css" media="screen" type="text/css">'.PHP_EOL
			   .'<script type="text/javascript" src="'.BASE_URL.'plugin/rating/javascript"></script></head>';
	$layout->continut = str_replace('</head>', $rating, $layout->continut);
}