<?php
/**
 * @package BebliuCMS
 * @subpackage plugin
 *
 * @author Bebliuc George <george@bebliuc.ro>
 * @version 0.1
 * @copyright Bebliuc George, 2009
 */

/**
 * LoginAuth Plugin
 *
 * @package BebliuCMS
 * @subpackage cryptor
 *
 * @version 0.1
 * @since 0.1
 */

Plugin::setInfos(array(
	'id' => 'loginauth',
	'title' => '_LoginAuth',
	'author' => 'Bebliuc',
	'website' => 'http://bebliuc.ro',
	'version' => '1.0',
	'description' => 'Cross domain login based on 64bits encryption.'));
	

/***
	_LoginAuth
	
	
		$key = domain key generated with generateHash
		$username = username for $domain/$key
		$password = encrypted password with generatePassword based on $key
		
*/

Plugin::addController('loginauth', 'LoginAuth', false, false);

class _LoginAuth {

	const SALT_LENGTH = 9;
	
	public $domain;
	public $username;
	public $password;
	
	public function prepare( $login = array() ) {
		
		$this->domain = $login['key'];
		$this->username = $login['username'];
		$this->password = $login['password'];
	
	}	
	
	public function action() {
		
		$cryptor = new _Cryptor();
		
		$en_username = $cryptor->encrypt($this->username, $this->domain);
		$en_password = $cryptor->encrypt($this->password, $this->domain);
		return 'http://'.$this->domain.'/plugin/loginAuth/parse/'.urlencode($en_username).'/'.urlencode($en_password);
	}
	
	public function login() {
		
	}
	
	
	
}
	
