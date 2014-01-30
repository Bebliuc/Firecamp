<?php

if ( ! defined('FIRECAMP')) exit('No direct script access allowed');

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
 * 
 *
 * @package		Dictionar Plugin
 * @author		Firecamp Team
 * @copyright	Copyright (c) 2010 - 2011, Bebliuc
 * @license		http://firecamp.ro/license
 * @link		http://firecamp.ro
 * @since		Version 1.0.01
 */
 

class DictionarController extends PluginController {

	function __construct() {
		green::$watches['submenu'] = array(get_url('plugin/dictionar/create') => _('Adauga cuvant'),
										   get_url('plugin/dictionar/') => _('Lista cuvinte'));
		green::$watches['pageHeading'] = 'Dictionar';
		$this->setLayout('admin_v2/index');
		
	}
	
	function index() {
		
		$this->display('dictionar/views/index', array('cuvinte' => record::findAllFrom('dictionar', 'id != 0 ORDER BY cuvant ASC')));
	
	}

	function create() {
		
		$this->display('dictionar/views/create');
		
	}
	
	function delete( $id ) {
		if(is_null($id)) redirect(get_url('plugin/dictionar/'));
		
		if(record::delete('dictionar', 'id = ?', array($id)))
			Flash::set('success', _('Cuvantul a fost sters cu succes.'));
		else
			Flash::set('error', _('Cuvantul nu a fost sters.'));
			
		redirect(get_url('plugin/dictionar'));
	}
	
	function save() {
		if(isset($_POST['cuvant'])) {
			$cuvant = $_POST['cuvant'];
			if(record::save('dictionar', array('id' => NULL, 'cuvant' => $cuvant['cuvant'], 'definitie' => $cuvant['definitie'], 'categorie' => $cuvant['categorie'], 'altele' => NULL)))
				Flash::set('succes', _('Cuvantul a fost adaugat cu succes.'));
			else
				Flash::set('error', _('Cuvantul nu a fost adaugat.'));
			
			redirect(get_url('plugin/dictionar'));	
		}
	}

}

