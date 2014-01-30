<?php
class User extends Record
{
	
	const TABLE_NAME = 'utilizatori';
	
	public static function islogged() 
	{
		
		if(isset($_COOKIE['user']) AND isset($_COOKIE['pass'])) {
			
			global $__CONN__;
			
			$user = $_COOKIE['user'];
			$pass = $_COOKIE['pass'];
			
			$sql = "SELECT * FROM `utilizatori` WHERE user = ? AND pass = ?";
			
			$stmt = $__CONN__->prepare($sql);
			$stmt->execute(array($user, $pass));
			
			if(!$stmt->rowCount()) {
				Flash::set('error', 'Nu esti logat');
				go_to('login/index');
			}
			
			
		
		}
		else {
		
			Flash::set('error', 'Va rugam sa va autentificati.');
			go_to('login/index');
			
		}
		
	}
	
	public static function logged() 
	{
		
		if(isset($_COOKIE['user']) AND isset($_COOKIE['pass'])) {
			
			global $__CONN__;
			
			$user = $_COOKIE['user'];
			$pass = $_COOKIE['pass'];
			
			$sql = "SELECT * FROM `utilizatori` WHERE user = ? AND pass = ?";
			
			$stmt = $__CONN__->prepare($sql);
			$stmt->execute(array($user, $pass));
			
			if(!$stmt->rowCount()) {
				return FALSE;
			}
			
			return TRUE;
		
		}
		else {
		
			return FALSE;
			
		}
		
	}
	
	public static function hasPermissions()
	{
		$controller = Green::getController();
		$action = Green::getAction();
			
		if($controller == "admin" AND $action =="index")
			return true;
		
		global $__CONN__;
		
		$utilizator = $_COOKIE['user'];
		
		$sql = "SELECT zona, nume 
				FROM utilizatori AS u, utilizatori_grup AS p 
				WHERE u.grup = p.id 
				AND u.user = ?";
				
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($utilizator));
		$data = $stmt->fetchObject();
		
		$permisiuni = $data->zona;

		if($permisiuni == "*")
			return true;
		
		
		if($controller == "plugin") {
			
			if(stristr($permisiuni, $action) !== FALSE) {
				return true;
			}
			return false;
		}
		
		if(stristr($permisiuni, $controller)	!== FALSE) {
			return true;
		}
		
		return false;
		
	}
	
	public static function hasPermissionsTo($zona) 
	{
		
		if(isset($_COOKIE['user'])) {
			$user = $_COOKIE['user'];
			global $__CONN__;
			$sql = "SELECT zona
					FROM utilizatori AS u, utilizatori_grup AS p 
					WHERE u.grup = p.id 
					AND u.user = ?";
	
			$stmt = $__CONN__->prepare($sql);
			$stmt->execute(array($user));
			$data = $stmt->fetchObject();
	
			$permisiuni = $data->zona;
	
			if($permisiuni == "*")
				return true;
			if(stristr($permisiuni, $zona))
				return true;
	
			return false;
		}
		return false;
	}
	
	public static function getPermissions( $user = NULL ) {
		$user = $user == NULL ? $_COOKIE['user'] : $user;
		$_user = user::findOneFrom(user::TABLE_NAME, 'user = ?', array($user));
		$_permissions = record::findOneFrom('utilizatori_grup', 'id = ?', array($_user->grup));
		
		return $_permissions->zona;
	}
	
	public static function currentUserIs($user)
	{
		
		$currentUser = $_COOKIE['user'];
		if($user == $currentUser)
			return true;
		
		return false;
		
	}
	
	public static function getGroupByUser($user = NULL)
	{
		if(!$user) $user = $_COOKIE['user'];
		
		global $__CONN__;
		$sql = "SELECT nume
				FROM utilizatori AS u, utilizatori_grup AS g
				WHERE u.grup = g.id
				AND u.user = ?";
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($user));
		
		$data = $stmt->fetchObject();
		
		$group = $data->nume;
		
		return $group;
		
	}
	
	public static function getUserHash() {
		$user = $_COOKIE['user'];
		
		global $__CONN__;
		$user = record::findOneFrom('utilizatori', 'user = ?', array($user));
		return $user->hash;
	}
	
	public static function getUserId( $user = NULL ) {
		$user = $user == NULL ? $_COOKIE['user'] : $user;
		$user = record::findOneFrom('utilizatori', 'user = ?', array($user));
		return $user->id;
	}
	
	public static function getUserName( $id = NULL ) {
		$user = user::findOneFrom(user::TABLE_NAME, 'id = ?', array($id));
		return $user->user;
	}
	
	public static function _fetch( $username = NULL) {
		
		if(!$username) $username = $_COOKIE['user'];
		
		$user = record::findOneFrom('utilizatori', 'user = ?', array($username));
		return $user;
	}
	
	public static function _save($data) {
	
		$date = date("F j, Y, g:i a");
		
		$stmt = new Database('utilizatori');
		if($stmt->insert(array('id' => NULL,
						  'user' => $data[0],
						  'password' => $data[1],
						  'actualizare' => $date,
						  'grup' => $data[2],
						  'hash' => $data[3],
						  'email' => $data[4]))) {
			return true;
		}
		
		return false;
		
	}
	
	public static function _edit($data, $id) {
	
		$date = date("F j, Y, g:i a");
		
		$stmt = new Database('utilizatori', $id);
		if(count($data) == 2) {
			if($stmt->update(array('user' => $data[0],
								   'actualizare' => $date,
								   'grup' => $data[1]))) {
									   
				return true;			      
			}
		}
		else {
		
			if($stmt->update(array('user' => $data[0],
								   'pass' => $data[1],
								   'actualizare' => $date,
								   'grup' => $data[3]))) {
									   
				return true;			      
			}
		
		}
			
		
		return false;
	
	}
	
	public static function _delete($id) {
	
		$user = new Database('utilizatori', $id);
		if($user->delete())
			return true;
	
		return false;
	}
	
	public static function GroupToDropdown($selected = NULL) {
	
		global $__CONN__;
		
		$sql = "SELECT *
				FROM utilizatori_grup
				ORDER BY nume ASC ";
		
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute();
		
		$data = "";
		
		while($grup = $stmt->fetchObject()) {
			
			if($grup->id == $selected)
				$current = "selected=\"\"";
			
			else 
				$current = "";
							
			$data .= "<option value=" . $grup->id . " " . $current . ">" . $grup->nume . "</option>";
			
		}
		
		return $data;
		
	}
	
	public static function getCurrentUser() {
		if(isset($_COOKIE['user']))
			return $_COOKIE['user'];
		else
			return 'Guest';
	}
	
	public static function ip() {
		
		if (!empty($_SERVER['HTTP_CLIENT_IP'])){
			//check ip from share internet
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			//to check ip is pass from proxy
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
}
