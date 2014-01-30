<?php
class Main 
{
	
	/*
		Function: deleteFolder($path);
		Description: Deletes the folder from $path, recurive
	*/
	
	public static function deleteFolder($path) {
		
		if(file_exists($path)) {
			
			$album = dir($path); 
			
			while($dir = $album->read()) { 
			
				if ($dir!= "." && $dir!= "..") { 
						unlink($path.'/'.$dir); 
					} 
				} 
			
			$album->close(); 
			
			rmdir($path);
					
		}
		
	}
	
	/*
		Function deleteFromFolder($path)
		Description: Deletes content of the folder from $path
	*/
	
	public static function deleteFromFolder($path) {
		
		if(file_exists($path)) {
			
			$album = dir($path); 
			
			while($dir = $album->read()) { 
			
				if ($dir!= "." && $dir!= "..") {
						unlink($path.'/'.$dir); 
					} 
				} 
			
			$album->close(); 
					
		}
		
	}
	
	/*
		Function: cutText($string, $limit)
		Description: Limits $string to $limit characters
	*/
	
	public static function cutText($string, $limit) {
		if (strlen($string) < $limit)
			return $string;
		
		$reg ="/^(.{1," . $limit . "}[^\s]*).*$/s";
		return preg_replace($reg, '\\1', $string);
	}

	/*
		Function: array2object($array)
		Description: Converts $array to an object and returns it
	*/
	
	public static function array2object($array) {
 
		if (is_array($array)) {
			$obj = new StdClass();
	 
			foreach ($array as $key => $val){
				$obj->$key = $val;
			}
		}
    	else { $obj = $array; }
		
 		return $obj;
	}
	
	/*
		Function: object2array($object)
		Description: Converts $object to an array and returns it
	*/

	public static function object2array($object) {
		
		if (is_object($object)) {
			foreach ($object as $key => $value) {
				$array[$key] = $value;
			}
		}
		else {
			$array = $object;
		}
		
    	return $array;
	}
	
	/*
		Function: in_array($str, $a);
		Description: Custom in_array adaptation for array_real_unique($a);
	*/
	
	public static function in_iarray($str, $a){
		foreach($a as $v){
			
			if(strcasecmp($str, $v)==0){return true;}
			
		}
		
		return false;
	}
	
	/*
		Function: array_real_unique($a);
		Description: Custom array_unique adaptation, for case ignore
	*/

	public static function array_iunique($a){
		$n = array();
		foreach($a as $k=>$v){
		
			if(!self::in_iarray($v, $n)){$n[$k]=$v;}
		
		}
		
		return $n;
	}
	
	public static function dateToString($date, $rules, $add = 0) {
		
		$date = str_split(str_replace($rules, '', $date), 4);
		return ($date[0] + $add).$date[1].$date[2].$date[3];
		
	}
	
	/**
	 * Get file extensions , easy and nice
	 *
	 * @param string $filename 
	 * @return void
	 * @author Bebliuc George
	 */
	
	public static function file_extension($filename)
	{
	    $path_info = pathinfo($filename);
	    return $path_info['extension'];
	}
	
	public static function sanitize($var, $type)
	{       
			switch ( $type ) {

							case 'int': // integer

							$var = (int) $var;

							break;



							case 'str': // trim string

							$var = trim ( $var );

							break;



							case 'nohtml': // trim string, no HTML allowed

							$var = htmlentities ( trim ( $var ), ENT_QUOTES );

							break;

							

							case 'plain': // trim string, no HTML allowed, plain text

							$var =  htmlentities ( trim ( $var ) , ENT_NOQUOTES )  ;

							break;



							case 'upper_word': // trim string, upper case words

							$var = ucwords ( strtolower ( trim ( $var ) ) );

							break;



							case 'ucfirst': // trim string, upper case first word

							$var = ucfirst ( strtolower ( trim ( $var ) ) );

							break;



							case 'lower': // trim string, lower case words

							$var = strtolower ( trim ( $var ) );

							break;



							case 'urle': // trim string, url encoded

							$var = urlencode ( trim ( $var ) );

							break;



							case 'trim_urle': // trim string, url decoded

							$var = urldecode ( trim ( $var ) );

							break;

							

							case 'telephone': // True/False for a telephone number

							$size = strlen ($var) ;

							for ($x=0;$x<$size;$x++)

							{

									if ( ! ( ( ctype_digit($var[$x] ) || ($var[$x]=='+') || ($var[$x]=='*') || ($var[$x]=='p')) ) )

									{

											return false;

									}

							}

							return true;

							break;

							

							case 'pin': // True/False for a PIN

							if ( (strlen($var) != 13) || (ctype_digit($var)!=true) )

							{

									return false;

							}

							return true;

							break;

							

							case 'id_card': // True/False for an ID CARD

							if ( (ctype_alpha( substr( $var , 0 , 2) ) != true ) || (ctype_digit( substr( $var , 2 , 6) ) != true ) || ( strlen($var) != 8))

							{

									return false;

							}

							return true;

							break;

							

							case 'sql': // True/False if the given string is SQL injection safe

							//  insert code here, I usually use ADODB -> qstr() but depending on your needs you can use mysql_real_escape();

							return mysql_real_escape_string($var);

							break;

					}       

			return $var;


	}
	
	function gravatar( $email = 'george@bebliuc.eu' ) {
		$email = strtolower( $email );
		return md5($email);
	}
}