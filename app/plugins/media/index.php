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
 * Media Plugin
 *
 * @package BebliuCMS
 * @subpackage media
 *
 * @version 0.1
 * @since 0.1
 */

Plugin::setInfos(array(
	'id' => 'media',
	'title' => 'Media',
	'author' => 'Bebliuc',
	'website' => 'http://bebliuc.ro',
	'version' => '1.0',
	'description' => 'Media plugin with external embeded code support and mp3.'));

Plugin::addController('media', 'Media');

Green::addRoute(array('en/demos/sound/:any' => 'index/page/30'));

define('ALBUMS_PATH', GREEN_ROOT.'/../public/albums/');