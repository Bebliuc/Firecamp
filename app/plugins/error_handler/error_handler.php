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
 * Error_handler tes() function
 *
 * @package		error_handler
 * @author		Firecamp Team
 * @copyright	Copyright (c) 2010 - 2011, Bebliuc
 * @license		http://firecamp.ro/license
 * @link		http://firecamp.ro
 * @since		Version 1.0.01
 */


class tes {
	private static $er = array();
	public static function echol($error = array()) {
		self::$er = array_merge(self::$er, array($error));
	}
	public static function get() {
		return self::$er;
	}
}

function track( $var ) {
	
	ob_start();
		var_dump($var);
		$a = ob_get_contents();
	ob_end_clean();
	$b = '<pre>';
	$b .= htmlspecialchars($a, ENT_QUOTES);
	$b .= '</pre>';
	
	$_pushable = array('type' => 16, 'str' => $b, 'file' => '', 'line' => '');
	tes::echol($_pushable);
}

set_error_handler("error_handler");

function error_handler($errno, $errstr, $errfile, $errline) {
	
	$error_name = array(
		'1' => 'E_ERROR',
		'2' => 'E_WARNING',
		'4' => 'E_PARSE',
		'8' => 'E_NOTICE');
	$_pushable = array('type' => $errno, 'str' => $errstr, 'file' => $errfile, 'line' => $errline);
	tes::echol($_pushable);
	return true;
}

function interpolateQuery($query, $params) {
    $keys = array();

    foreach ($params as $key => $value) {
        if (is_string($key)) {
            $keys[] = '/:'.$key.'/';
        } else {
            $keys[] = '/[?]/';
        }
    }

    $query = preg_replace($keys, $params, $query, 1, $count);

    return $query;
}

