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
 * LoginController
 *
 * @package		controllers
 * @author		Firecamp Team
 * @copyright	Copyright (c) 2010 - 2011, Bebliuc
 * @license		http://firecamp.ro/license
 * @link		http://firecamp.ro
 * @since		Version 1.0.01
 */

class LoginController extends Controller {
	
	
	function __construct()
        {
       		$this->setLayout('login/index');
        }
	
	function index() {
		//log error
		
		redirect(BASE_URL);
		
		$logger = new Logger(__('Login form accurance'));
		$logger->log();
		
		if(isset($_COOKIE['user']) AND isset($_COOKIE['pass'])) {
		
			$username = $_COOKIE['user'];
			$pass = $_COOKIE['pass'];
		
			$user = Record::findOneFrom('utilizatori', 'user = "'.$username.'"');
			$hash = $user->hash;
		
			$password = Login::generatePassword($pass, $hash);
			if(Record::countFrom('utilizatori', 'user = "'.$username.'" AND pass = "'.$password.'" AND hash = "'.$hash.'"')) {
					redirect(get_url('admin/index'));
			}
			
		}
		$this->display('login/index');
	

	}
	
	function check() {
	
		Login::login_utilizator();
			
	}
	
	function logout() {
		
		Login::iesire();
		
	}
	
	
}
