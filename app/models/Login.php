<?php
class Login extends Record {
	
	const SALT_LENGTH = 9;

	public static function login_utilizator() {
		
		global $__CONN__;
		
		$user = $_POST['nume'];
		$pass = $_POST['parola'];
		
		//$pass = md5($pass);
		
		if(isset($_POST['tine_minte'])) {
			$tine_minte = $_POST['tine_minte'];
		}
		else {
			$tine_minte = "nu";
		}
		
		$sql = "SELECT COUNT(*) FROM utilizatori WHERE user = ?";
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($user));
		$result = $stmt->fetchColumn();

		if($result != "1") {
		
			Flash::set('error', 'Utilizatorul introdus nu exista.');
			go_to('login/index');
		
		}
		$username = $user;
		$user = Record::findOneFrom('utilizatori', 'user = "'.$user.'"');
		$hash = $user->hash;
		
		if(Record::countFrom('utilizatori', 'user = "'.$username.'" AND pass = "'.Login::generatePassword($pass, $hash).'"'))
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
		
			Flash::set('success', 'Ai fost logat cu succes.Bine ai venit, '.$_POST['nume'].'');
			redirect(get_url('admin/index'));
		}
		else {
			$log = new Logger();
			$log->action('User login failed. Username: '.$username.' . Password: '.$_POST['parola'])->log();
			Flash::set('error', 'Datele introduse sunt incorecte.');
			redirect(get_url('login/index'));
		}
		
		
	}
	
	public static function login_parse($user, $pass) {
		
		global $__CONN__;
	
		
		//$pass = md5($pass);
		
		if(isset($_POST['tine_minte'])) {
			$tine_minte = $_POST['tine_minte'];
		}
		else {
			$tine_minte = "nu";
		}
		
		$sql = "SELECT COUNT(*) FROM utilizatori WHERE user = ?";
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($user));
		$result = $stmt->fetchColumn();

		if($result != "1") {
		
			Flash::set('error', 'Utilizatorul introdus nu exista.');
			go_to('login/index');
		
		}
		$username = $user;
		$user = Record::findOneFrom('utilizatori', 'user = "'.$user.'"');
		$hash = $user->hash;
		
		if(Record::countFrom('utilizatori', 'user = "'.$username.'" AND pass = "'.Login::generatePassword($pass, $hash).'"'))
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
		
			Flash::set('success', 'Ai fost logat cu succes.Bine ai venit, '.$_POST['nume'].'');
			redirect(get_url('admin/index'));
		}
		else {
			$log = new Logger();
			$log->action('User login failed. Username: '.$username.' . Password: '.$_POST['parola'])->log();
			Flash::set('error', 'Datele introduse sunt incorecte.');
			redirect(get_url('login/index'));
		}
		
		
	}
	
	public static function isLogged() {
	
		User::isLogged();
		
	}
		
	public static function iesire() {
		
		if(isset($_COOKIE['user'])) {
			$log = new Logger();
			$log->action('User logged out succesfully.')->log();
			
			if($_COOKIE['tine_minte'] == "nu") {
				
				setcookie('user', '', time()-3600, '/');
		        setcookie('pass', '', time()-3600, '/');
		        setcookie('tine_minte', '', time()-3600, '/');
		        Flash::set('success', 'Ai parasit interfata administrativa cu succes.');
		        redirect(get_url('login/index'));
								
			} 
			elseif($_COOKIE['tine_minte'] == "da") {
				
				setcookie('user', '', time()-(60*60*24*365), '/');
		        setcookie('pass', '', time()-(60*60*24*365), '/');
		        setcookie('tine_minte', '', time()-(60*60*24*365), '/');
		        Flash::set('success', 'Ai parasit interfata administrativa cu succes.');
		        redirect(get_url('login/index'));
		        
			}
			
		
		}
		else {
			
			Flash::set('error', 'Nu ai permisiunile necesare pentru efectua aceasta operatie.');
			redirect(get_url('login/index'));
		
		}
	
	
	}
	
	public static function generateHash($salt = NULL) {
		
		if($salt === NULL)
		        $salt = substr(md5(uniqid(rand(), true)), 0, self::SALT_LENGTH);
		else
		        $salt = substr($salt, 0, self::SALT_LENGTH);
			
		return $salt;
	}
	
	public static function generatePassword($password, $salt = NULL) {
		
		return self::generateHash($salt).sha1(self::generateHash($salt).$password);
		
	}
	
}
