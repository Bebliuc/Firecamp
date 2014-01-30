<?php
/***
	_LoginAuth
	
	
		$key = domain key generated with generateHash
		$username = username for $domain/$key
		$password = encrypted password with generatePassword based on $key
		
*/

class _LoginAuth {

	const SALT_LENGTH = 9;
	
	public $domain;
	public $username;
	public $password;
	
	public $_domain;
	
	public function prepare( $login = array() ) {
		
		$this->domain = $login['key'];
		$this->username = $login['username'];
		$this->password = $login['password'];
	
	}	
	
	public function action() {
		
		$cryptor = new _Cryptor();
		
		$en_username = $cryptor->encrypt($this->username, $this->domain);
		$en_password = $cryptor->encrypt($this->password, $this->domain);
		
		$this->_domain = 'http://'.$this->domain.'/plugin/loginauth/parse/'.str_replace('%2F', 'asdasd', urlencode($en_username)).'/'.str_replace('%2F', 'asdasd', urlencode($en_password));
		return $this->_domain;
	}
	
	public function login() {
		
		header('Location: '.str_replace('parse', 'engage', $this->_domain));
		exit;
	}
	
	
	
}
