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
		'id' => 'products',
		'title' => 'Products',
		'author' => 'Bebliuc',
		'website' => 'http://bebliuc.ro',
		'version' => '1.0',
		'description' => 'Products plugin for http://cctv.ro'));

define('PRODUCTS_PATH', PUBLIC_URL.'/products/');
Plugin::addController('products', 'Products');

Observer::observe('page.constructor', 'products_page');

function products_page( &$page ) {
	if($page->title == 'Products'):
		
		
	endif;
}

//get the page with the name Products
	
	//$products_page = record::findOneFrom(Products::TABLE_NAME, 'title = "Products"');
	
Green::addRoute(array('products/:any/:any' => 'plugin/products/get/$1/$2/$3'));