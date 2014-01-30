<?php

/**

 * Aperture * CMS

 *

 * @package		CodeIgniter

 * @author		Bebliuc George

 * @copyright	Copyright (c) 2008 - 2011, Bebliuc.

 * @link		http://bebliuc.ro

 * @since		Version 1.0

 * @filesource

 */



// ------------------------------------------------------------------------



/**

 * Redirect plugin

 * 

 * @package		Aperture

 * @subpackage	Plugins

 * @author		Bebliuc George

 * @link		http://george.bebliuc.eu

 */



Plugin::setInfos(array(

		'id' => 'redirect',

		'title' => 'Pages redirect',

		'author' => 'Bebliuc George',

		'website' => 'http://george.bebliuc.eu',

		'version' => '1.0',

		'description' => 'Page redirect behavior.'));

		

Behavior::add('redirect', 'Redirect');



Observer::observe('behavior_redirect', 'init_redirect');



function init_redirect($page) {

	header('Location: '.$page->slug);

	die;

}