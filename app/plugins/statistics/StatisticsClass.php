<?php

class Statistics extends Model {
	
	const TABLE_NAME 	= 'statistics';
	
	public $event_type		= null;
	public $occurance_time	= null;
	public $occurance_date  = null;
	public $ipaddress		= null;
	public $username		= null;
	public $referer			= null;
	public $browser			= null;
	public $page_id			= null;
	public $session_id		= null;
	protected $event 		= array();
	

	function __construct($event = false) {
		
		if(!$this->event_type) $this->event_type = "unknown_event";
		if(!$this->occurance_time) $this->event_type = date('H:i:s');
		if(!$this->occurance_date) $this->occurance_date = date('Y-m-d');
		if(!$this->ipaddress) $this->event_type = "0.0.0.0";
		if(!$this->referer) $this->referer = "http://unknown.com";
		if(!$this->username) $this->username = "Guest";
		if(!$this->page_id) $this->page_id = "0";
		if(!$this->session_id) $this->session_id = "unknown";
		if(!$this->browser) $this->browser = "unknown";
	}
	
	function setEvent($event_type, $page_id) {
		$this->event_type = $event_type;
		$this->occurance_time = date('H:i:s');
		$this->occurance_date = date('Y-m-d');
		$this->ipaddress = self::getIp();
		$this->username = self::getUsername();
		$this->page_id = $page_id;
		$this->session_id = session_id();
		$this->referer  = self::getReferer();
		$this->browser = self::getBrowser();
		$this->event = array(NULL, $this->event_type, $this->occurance_time, $this->occurance_date, $this->ipaddress, $this->username, $this->referer, $this->browser, $this->page_id, $this->session_id);
		
	}
	
	function saveEvent() {
		
		$event = Record::save(self::TABLE_NAME, $this->event);
		
	}
	
	function getIp() {
		
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
	
	function getUsername() {
		
		if(isset($_COOKIE['user']))
			return $_COOKIE['user'];
		
		return 'Guest';
		
	}
	
	function getReferer() {
		
		if(!isset($_SERVER['HTTP_REFERER']))
			return "direct";
		
		return $_SERVER['HTTP_REFERER'];	
	}
	
	function getBrowser() {
		$user_agent = $_SERVER["HTTP_USER_AGENT"];
		$browser = explode(" ", $user_agent);
		$browser = array_reverse($browser);
		return $browser[0];
	}
}

?>