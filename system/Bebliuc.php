<?php

class Bebliuc
{
	
	protected $_tableName;
	protected $_id;
	protected $_data = array();
	
	public static $__CONN__;
	
	function __construct($tableName = NULL, $id = NULL) 
	{
		$this->_tableName = $tableName;
		$this->_id = $id;
	}
	
	final public static function tableNameFromClassName($class_name)
    {
        try
        {
            if (class_exists($class_name) && defined($class_name.'::TABLE_NAME'))
                return constant($class_name.'::TABLE_NAME');
        }
        catch (Exception $e)
        {
            return Inflector::underscore($class_name);
        }
    }
	
 	public static function countFrom($table_name, $where=false, $values=array())
    {
		global $__CONN__;
        
		$sql = 'SELECT COUNT(*) AS nb_rows FROM '.$table_name.($where ? ' WHERE '.$where:'');
		      
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute();

        return (int) $stmt->fetchColumn();
    }

	public static function save($data = NULL)
	{
		
		if($data === NULL)
			$data = $this->_data;
		
		global $__CONN__;
		$columns = array();
		foreach($data as $key => $value) {
				
				$columns[$key] = $__CONN__->quote($value);  
		
		}
		$data = implode(' ,',$columns);
		
		$sql = 'INSERT INTO '.self::tableNameFromClassName(get_class($this)).'
				VALUES ('.$data.');';
		
		$stmt= $__CONN__->prepare($sql);
	
		if($stmt->execute())
			return true;
			
		return false;
		
		
	}
	
	public static function update($data = NULL, $id = NULL)
	{
		
		if($data === NULL)
			$data = $this->_data;
	
		if($id === NULL)
			$id = $this->_id;
			
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

	public static function delete($id = NULL)
	{
	
		if($id === NULL)
			$id = $this->_id;
	
		global $__CONN__;
		
		$sql = 'DELETE FROM '.self::tableNameFromClassName(get_class($this)).' WHERE id = '.$this->_id.' LIMIT 1;';
		
		$stmt = $__CONN__->prepare($sql);
		if($stmt->execute())
			return true;
	
		return false;
	}


}