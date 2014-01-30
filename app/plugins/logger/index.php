<?php

Plugin::setInfos(array(
		'id' => 'logger',
		'title' => 'Logger',
		'author' => 'Bebliuc',
		'website' => 'http://bebliuc.ro',
		'version' => '1.0',
		'description' => '...'));

Plugin::addController('logger', 'Logger');
		
class Logger extends Record {
	
	const TABLE_NAME = 'logger';
	
	public $data = array();
	public $action = NULL;
	
	function __construct( $action = NULL ) {
		if($action)
			$this->action($action);
	
	}
	
	public function log() {
		
		$this->data['id'] = NULL;
		$this->data['user'] = (!isset($_COOKIE['user']) ? 'Guest' : $_COOKIE['user']);
		$this->data['action'] = $this->action;
		$this->data['module'] = green::getController() . ' \ ' . green::getAction();
		$this->data['time'] = date('l jS \of F Y h:i:s A');
		$this->data['ip'] = self::getIp();
		$this->data['hide'] = 0;
		
		global $__CONN__;
		
		//save the info in teh database
		
		if(record::save(self::TABLE_NAME, $this->data)) {
			//do smth
		}
		else
			echo 'Logger crashed. Please check the database connection.';	
		
	}
	
	public function action($action) {
		$this->action = $action;
		return $this;
	}

        private static function getIp() {

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
