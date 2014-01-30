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
 * Boxes Plugin
 *
 * @package BebliuCMS
 * @subpackage faq
 * @todo Simple faq management
 * 
 * @version 0.1
 * @since 0.1
 */
 
Plugin::setInfos(array(
		'id' => 'faq',
		'title' => 'Simple FAQ',
		'author' => 'Bebliuc',
		'website' => 'http://bebliuc.ro',
		'version' => '1.0',
		'description' => 'Simple FAQ generator.'));

Plugin::addController('faq', 'FAQ');

class Faq extends Record {

	const TABLE_NAME = 'faq';
	
	function __construct() {
	
	}
	
	public static function findAll( $filter = NULL, $params = array() ) {
	
		return self::findAllFrom(self::TABLE_NAME, $filter, $params);
	
	}
	
}