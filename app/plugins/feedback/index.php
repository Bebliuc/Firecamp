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
 * Feedback Plugin
 *
 * @package BebliuCMS
 * @subpackage feedback
 * @todo Simple feedback management
 * 
 * @version 0.1
 * @since 0.1
 */
 
Plugin::setInfos(array(
		'id' => 'feedback',
		'title' => 'Feedback',
		'author' => 'Bebliuc',
		'website' => 'http://bebliuc.ro',
		'version' => '1.0',
		'description' => 'Simple feedback management.'));

Plugin::addController('feedback', 'Feedback');

class Feedback extends Record {

	const TABLE_NAME = 'feedback';
	
	function __construct() {
	
	}
	
	public static function getAll( $filter = NULL, $params = array() ) {
	
		return self::findAllFrom(self::TABLE_NAME, $filter, $params);
	
	}
	
}