<?php
class LoginAuthController extends PluginController {

	function __construct() {
		
	}
	
	function index() {
		$this->setLayout('admin_v2/index');
		
	}
	
	function parse($user, $password) {
		
		$domain = substr(str_replace("http://", "", BASE_URL), 0, -1);
		
		$cryptor = new _Cryptor();
		
		$user = $cryptor->decrypt($user, $domain);
		$password = $cryptor->decrypt($password, $domain);
		
		self::login_parse($user, $password);
	
	}
	
	function engage($user, $password) {
		
		$domain = substr(str_replace("http://", "", BASE_URL), 0, -1);
		
		$cryptor = new _Cryptor();
		
		$user = $cryptor->decrypt(str_replace('asdasd', '%2F', $user), $domain);
		$password = $cryptor->decrypt(str_replace('asdasd', '%2F', $password), $domain);
		
		if(self::login_engage($user, $password)) {
			go_to('admin/index');
		}
		else {
			header('Location: http://login.bebliuc.ro');
		}
	}
	
	private static function login_parse($user, $pass) {
		
		global $__CONN__;
	
		$tine_minte = 'da';
		$username = $user;
		$sql = "SELECT COUNT(*) FROM utilizatori WHERE user = ?";
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($user));
		$result = $stmt->fetchColumn();

		if($result != "1") {
		
			echo 0; die;
		
		}
		$username = $user;
		
		$user = Record::findOneFrom('utilizatori', 'user = ?', array($user));
		
		$hash = $user->hash;
		
		if(Record::countFrom('utilizatori', 'user = ? AND pass = ?', array($user->user, Login::generatePassword($pass, $hash))))
		{
			if($tine_minte == "nu") {
				setcookie('user', $username, time()+3600, '/');
		        setcookie('pass', Login::generatePassword($pass, $hash), time()+3600, '/');
		        setcookie('tine_minte', $tine_minte, time()+3600, '/');
	        }
	    	elseif($tine_minte == "da") {
				setcookie('user', $username, time()+(60*60*24*365), '/');
		        setcookie('pass', Login::generatePassword($pass, $hash), time()+(60*60*24*365), '/');
		        setcookie('tine_minte', $tine_minte, time()+(60*60*24*365), '/');
			}
			
			$log = new Logger();
			$log->action('User logged succesfully.')->log();
		
			Flash::set('success', 'Ai fost logat cu succes.Bine ai venit, '.$username.'');
			echo 1;
		}
		else {
			$log = new Logger();
			$log->action('User login failed. Username: '.$username.' . Password: '.$pass)->log();
			Flash::set('error', 'Datele introduse sunt incorecte.');
			echo 0;
		}
		
		
	}
	private static function login_engage($user, $pass) {
		
		global $__CONN__;
	
		$tine_minte = 'da';
		$username = $user;
		$sql = "SELECT COUNT(*) FROM utilizatori WHERE user = ?";
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($user));
		$result = $stmt->fetchColumn();

		if($result != "1") {
		
			return 0; die;
		
		}
		$username = $user;
		
		$user = Record::findOneFrom('utilizatori', 'user = ?', array($user));
		
		$hash = $user->hash;
		
		if(Record::countFrom('utilizatori', 'user = ? AND pass = ?', array($user->user, Login::generatePassword($pass, $hash))))
		{
			if($tine_minte == "nu") {
				setcookie('user', $username, time()+3600, '/');
		        setcookie('pass', Login::generatePassword($pass, $hash), time()+3600, '/');
		        setcookie('tine_minte', $tine_minte, time()+3600, '/');
	        }
	    	elseif($tine_minte == "da") {
				setcookie('user', $username, time()+(60*60*24*365), '/');
		        setcookie('pass', Login::generatePassword($pass, $hash), time()+(60*60*24*365), '/');
		        setcookie('tine_minte', $tine_minte, time()+(60*60*24*365), '/');
			}
			
			$log = new Logger();
			$log->action('User logged succesfully.')->log();
		
			Flash::set('success', 'Ai fost logat cu succes.Bine ai venit, '.$username.'');
			return 1;
		}
		else {
			$log = new Logger();
			$log->action('User login failed. Username: '.$username.' . Password: '.$pass)->log();
			Flash::set('error', 'Datele introduse sunt incorecte.');
			return 0;
		}
		
		
	}

}
