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
 * Cryptor Plugin
 *
 * @package BebliuCMS
 * @subpackage cryptor
 *
 * @version 0.1
 * @since 0.1
 */

Plugin::setInfos(array(
	'id' => 'cryptor',
	'title' => '_Cryptor',
	'author' => 'Bebliuc',
	'website' => 'http://bebliuc.ro',
	'version' => '1.0',
	'description' => 'Simple encryption/decryption class.'));
	
	
class _Cryptor {

	public function encrypt($string, $key) {
	
		$result = '';
		
	  	for($i=0; $i<strlen($string); $i++) {
	    		$char = substr($string, $i, 1);
	    		$keychar = substr($key, ($i % strlen($key))-1, 1);
	    		$char = chr(ord($char)+ord($keychar));
	    		$result.=$char;
	  	}

	 	return base64_encode($result);
	 	
	}

	public function decrypt($string, $key) {
	
	  	$result = '';
	  	
	  	$string = base64_decode($string);

	  	for($i=0; $i<strlen($string); $i++) {
	    		$char = substr($string, $i, 1);
	    		$keychar = substr($key, ($i % strlen($key))-1, 1);
	    		$char = chr(ord($char)-ord($keychar));
	    		$result.=$char;
	  	}

	  	return $result;
	  	
	}

}
