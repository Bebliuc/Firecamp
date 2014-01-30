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
 * @subpackage catalog
 * 
 * @version 0.1
 * @since 0.1
 */


Plugin::setInfos(array(
		'id' => 'catalog',
		'title' => 'Catalog',
		'author' => 'Bebliuc',
		'website' => 'http://bebliuc.ro',
		'version' => '1.0',
		'description' => 'Catalog plugin for http://cctv.ro'));

Plugin::addController('catalog', 'Catalog');

Observer::observe('page.constructor', 'catalog_page');

function catalog_page( &$page ) {
	if($page->title == 'Support'):
		
		
	endif;
}