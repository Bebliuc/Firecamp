<?php

/**
 * Firecamp
 *
 * @package		Firecamp
 * @author		Firecamp Team
 * @copyright	Copyright (c) 2010 - 2011, Bebliuc
 * @license		http://firecamp.ro/license
 * @link		http://firecamp.ro
 * @since		Version 1.0.01
 */

/**
 * AdminController
 *
 * @package		controllers
 * @author		Firecamp Team
 * @copyright	Copyright (c) 2010 - 2011, Bebliuc
 * @license		http://firecamp.ro/license
 * @link		http://firecamp.ro
 * @since		Version 1.0.01
 */

class AdminController extends Controller 
{
	function __construct() {
		Login::islogged();
		$this->setLayout('admin_v2/index');
	}
	
	function index()
	{	
        green::$watches['toggleSidebar'] = FALSE;
        green::$watches['pageHeading'] = __('Dashboard - Statistics');
		$this->display('admin/index');
	}
}