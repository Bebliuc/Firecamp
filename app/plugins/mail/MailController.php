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

class MailController extends PluginController {
	
	function __construct() {
		
		$this->setLayout('admin_v2/index');
		
	}
	
	function index() {
		
		$this->display('mail/views/index');
		
	}
	
}