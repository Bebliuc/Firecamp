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
 * NavController
 *
 * @package		controllers
 * @author		Firecamp Team
 * @copyright	Copyright (c) 2010 - 2011, Bebliuc
 * @license		http://firecamp.ro/license
 * @link		http://firecamp.ro
 * @since		Version 1.0.01
 */

class NavController extends Controller {
	
	function __construct() {
		
		Login::isLogged();
		$this->setLayout('admin/index');
		
	}
	
	function index() {
		
		$this->display('nav/index');	
		
	}
	
	function adauga_nav() {
		
		$this->display('nav/adauga_nav');
	
	}
	
	function salveaza_nav() {
		
		//get data from the form for the Nav
		//	numeNav
		//	urlNav
		//	controllerNav
		//	parentControllerNav
		//  orderNav
		
		$nume = addslashes($_POST['numeNav']);
		$url = addslashes($_POST['urlNav']);
		$controller = addslashes($_POST['controllerNav']);
		$parent = $_POST['parentControllerNav'];
		$order = $_POST['orderNav'];
		$order = $order + 1;
		
		if($parent == "0")
			$parent = NULL;
			
		
		if(empty($nume) OR empty($url) OR empty($controller)) {
			
			Flash::set('error', 'Toate campurile sunt obligatorii.');
			redirect(get_url('nav/adauga_nav'));
			
		}
		else
		{
			global $__CONN__;
		
			$sql = "INSERT INTO admin_menu VALUES (NULL, ?, ?, ?, ?, ?);";
		
			$stmt = $__CONN__->prepare($sql);
		
			if($stmt->execute(array($nume, $url, $controller, $parent, $order))) {
				Flash::set('success', 'Butonul a fost adaugat cu succes.');
				redirect(get_url('nav/index'));
			}
			else {
			
				Flash::set('error', 'Butonul nu a fost adaugat deoarece o eroare neasteptata a intervenit.');
				redirect(get_url('nav/adauga_nav'));
								 
			}
		}
		
		
	}
	
	function salveaza_ordine() {
		
		$updateRecordsArray 	= $_POST['recordsArray'];
		$listingCounter = 1;
		global $__CONN__;
		foreach ($updateRecordsArray as $recordIDValue) {
	
			$sql = "UPDATE admin_menu SET weight = " . $listingCounter . " WHERE id = " . $recordIDValue;
			$stmt = $__CONN__->prepare($sql);
			$stmt->execute();
			
			$listingCounter = $listingCounter + 1;
		}
	
		echo '<pre>';
		print_r($updateRecordsArray);
		echo '</pre>';

	}
	
	function sterge_nav($id) {
		
		$id = (int)$id;
		
		global $__CONN__;
		$sql = "DELETE FROM admin_menu WHERE id = ?";
		$stmt = $__CONN__->prepare($sql);
		if($stmt->execute(array($id))) {
			
			Flash::set('success', 'Butonul a fost sters cu succes.');
			redirect(get_url('nav/index'));
			
		}
		else {
			
			Flash::set('success', 'Butonul nu a fost sters. O eroare neasteptata a intervenit.');
			redirect(get_url('nav/index'));
			
		}
	
	
	}
		
}