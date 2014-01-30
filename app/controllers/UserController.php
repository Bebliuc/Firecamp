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
 * UserController
 *
 * @package		controllers
 * @author		Firecamp Team
 * @copyright	Copyright (c) 2010 - 2011, Bebliuc
 * @license		http://firecamp.ro/license
 * @link		http://firecamp.ro
 * @since		Version 1.0.01
 */

class UserController extends Controller
{

	function __construct() {
	
		User::isLogged();
		$this->setLayout('admin_v2/index');
		green::$watches['submenu'] = array(get_url('user/add') => __('Add member'),
						   				   get_url('usergroup/index') => __('Permission groups'),
										   get_url('usergroup/create') => __('Add permissions group'));
		
	}
	
	function index() {
		green::$watches['toggleSidebar'] = FALSE;;
		green::$watches['pageHeading'] = __('Members');
		$this->display('user/index');
		
	}
	
	function add() {
	
		$this->display('user/add');
	
	}
	
	function edit($id) {
		green::$watches['toggleSidebar'] = FALSE;
		$_user = user::findOneFrom(user::TABLE_NAME, 'id = ?', array($id));
		if($_COOKIE['user'] != $_user->user && user::getPermissions($_COOKIE['user']) != '*') { 
				Flash::set('error', __('You are not allowed to change other users data.'));
				$log = new Logger();
				$log->action('User '.$_COOKIE['user'].' tried to modify '.$_username.' permissions')->log();
				go_to('user/index');
		}
		
		$this->display('user/edit', array('id' => $id));
	
	}
	
	function save($action, $id = "") {
		
		$nume = $_POST['nume'];
		$password = $_POST['password'];
		$repassword = $_POST['repassword'];
		$grup = $_POST['grup'];
		
		
		if(empty($nume)) {
		
			Flash::set('error', 'Campul nume este obligatoriu.');
			if($action != 'edit')
				go_to('user/add');
			else
				go_to('user/edit/'.$id);
		}
		
		if($password != $repassword) {
			Flash::set('error', 'Parola introdusa nu este corecta. Va rugam sa o reintroduceti.');
			if($action != 'edit')
				go_to('user/add');
			go_to('user/edit/'.$id);
			
		}
		$hash = Login::generateHash();
		$password = Login::generatePassword($password, $hash);
		if($_POST['password'] == "")
			$data = array($nume, $grup);
		else
			$data = array($nume, $password, $grup, $hash, '');
		
		if($action != 'edit') {
		
			if(User::_save($data)) {
				Flash::set('success', 'Utilizatorul a fost adaugat cu succes.');
				go_to('user/index');
			}
			Flash::set('error', 'Utilizatorul nu a fost adaugat. O eroare neasteptata a intervenit.');
			go_to('user/add');
			
		}
		else {
				
			$_user = user::findOneFrom(user::TABLE_NAME, 'id = ?', array($id));
			
			$_username = $_user->user;
			
			if($_COOKIE['user'] != $_username || user::getPermissions() != '*') {
					Flash::set('error', __('You are not allowed to change other users data.'));
					$log = new Logger();
					$log->action('User '.$_COOKIE['user'].' tried to modify '.$_username.' permissions')->log();
					go_to('admin/index');
			}	
			if(User::_edit($data, $id)) {
				Flash::set('success', 'Datele utilizatorului au fost modificate cu succes.');
				//check if the old username is now changing his name and reset the cookie to keep him logged
				if($_COOKIE['user'] == $_username)
					setcookie('user', $nume, time()+3600, '/');
				go_to('user/index');
			}
			Flash::set('error', 'Datele nu au fost modificate. O  eroare neasteptata a intervenit.');
			go_to('user/edit/'.$id);
		
		}
	}
	
	function delete($id) {
	
		$id = (int) $id;
		
		if(!User::_delete($id)) 
		
			Flash::set('error', 'Utilizatorul nu a fost sters. O eroare neasteptata a intervenit.');
		
		else
		
			Flash::set('success', 'Utilizatorul a fost sters cu succes.');
		
		go_to('user/index');
	}
	
}
