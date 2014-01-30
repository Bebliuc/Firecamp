<?php

/**
 * Aperture * CMS
 *
 * @package		Aperture
 * @author		Bebliuc George
 * @copyright	Copyright (c) 2008 - 2011, Bebliuc.
 * @link		http://bebliuc.ro
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Mail plugin
 *
 * @package		Aperture
 * @subpackage	Plugins
 * @author		Bebliuc George
 * @link		http://george.bebliuc.eu
 */

// ------------------------------------------------------------------------

Plugin::setInfos(array(
		'id' => 'mail',
		'title' => 'Mailing system',
		'author' => 'Bebliuc George',
		'website' => 'http://george.bebliuc.eu',
		'version' => '1.0',
		'description' => 'Complex mailing system.'));
		
Plugin::addController('mail', 'Mail Manager');