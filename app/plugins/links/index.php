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
 * Links Plugin
 *
 * @package BebliuCMS
 * @subpackage links
 * @todo Simple links management
 * 
 * @version 0.1
 * @since 0.1
 */
 
 Plugin::setInfos(array(
		'id' => 'links',
		'title' => 'Links',
		'author' => 'Bebliuc',
		'website' => 'http://bebliuc.ro',
		'version' => '1.0',
		'description' => 'Links management.'));

Plugin::addController('links', 'Links');

class Links extends Record {

	const TABLE_NAME = 'links';

}