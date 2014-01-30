<?php

class Database
{
	
	protected $_tableName;
	protected $_id;
	
	function __construct($tableName, $id = "") 
	{
		$this->_tableName = $tableName;
		$this->_id = $id;
	}
	
	function getter() {
	
		echo $this->_tableName;
		echo $this->_id;
		
	}
	
	public function insert($data)
	{
	
		global $__CONN__;
		
		$names = '';
		$values = '';
		
		foreach($data as $name => $value)
		{
			
			$value = $__CONN__->quote($value);
			
			$name = $__CONN__->quote($name);
		
			$names .= $name.', ';
			$values .= $value.', ';
		}

		$names = substr($names, 0, -2);
		$values = substr($values, 0, -2);
		
		$sql = 'INSERT INTO '.$this->_tableName.' 
				VALUES ('.$values.');';
		$stmt = $__CONN__->prepare($sql);
		if($stmt->execute())
			return true;
			
		return false;
		
	} 
	
	public function saveData($data)
	{
		
		
		global $__CONN__;
		$columns = array();
		foreach($data as $key => $value) {
				
				$columns[$key] = $__CONN__->quote($value);  
		
		}
		$data = implode(' ,',$columns);
		
		$sql = 'INSERT INTO '.$this->_tableName.'
				VALUES ('.$data.');';
		
		$stmt= $__CONN__->prepare($sql);
	
		if($stmt->execute())
			return true;
			
		return false;
		
	}
	
	public function update($data)
	{
	
        global $__CONN__;
		
      	$names = '';
      	$values = '';
      	$updates = '';
      	foreach($data as $name => $value)
      	{
      	
      		$value = $__CONN__->quote($value);
      		$name = $name;
      		
      		$updates .= $name.' = '.$value. ', ';
      	
      	}
      	$updates = substr($updates,0,-2);
      	$sql = 'UPDATE '.$this->_tableName.'
      			SET '.$updates.'
      			WHERE id = '.$this->_id.'
      			LIMIT 1;';
      	
      	$stmt = $__CONN__->prepare($sql);
      	if($stmt->execute())
      		return true;
      		
      	return false;	
	}

	public function delete()
	{
	
		global $__CONN__;
		
		$sql = 'DELETE FROM '.$this->_tableName.' WHERE id = '.$this->_id.' LIMIT 1;';
		
		$stmt = $__CONN__->prepare($sql);
		if($stmt->execute())
			return true;
	
		return false;
	}



}