<?php

class Record
{
	
	protected $_tableName;
	protected $_id;
	protected $_data = array();
	public static $counts = 0;
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
	
 	public static function countFrom($table_name, $where = false, $values=array())
    {
		global $__CONN__;
        
		$sql = 'SELECT COUNT(*) AS nb_rows FROM '.$table_name.($where ? ' WHERE '.$where:'');
		      
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute($values);
		self::$counts++;
        	return (int) $stmt->fetchColumn();
    }

	public static function countFromDistinct($table_name, $column = NULL, $where = false, $values=array())
    {
		global $__CONN__;
        $column = ($column == NULL ? '*' : $column);
		$sql = 'SELECT COUNT(DISTINCT('.$column.')) AS nb_rows FROM '.$table_name.($where ? ' WHERE '.$where:'');
		track(interpolateQuery($sql,$values));
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute();
		self::$counts++;
		
        return (int) $stmt->fetchColumn();
    }

	public static function findAllFrom($table_name, $where = false, $values = array()) {
		
		global $__CONN__;
		
		$sql = 'SELECT * FROM '.$table_name.($where ? ' WHERE '.$where:'');
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute($values);
		track(interpolateQuery($sql,$values));
		$objects = array();
        while ($object = $stmt->fetchObject())
            $objects[] = $object;
        self::$counts++;
		
        return $objects;
		
	}
	
	public static function findDistinctFrom($table_name, $column = NULL, $where = false, $values = array()) {
		
		global $__CONN__;
		$column = ($column == NULL ? '*' : $column);
		$sql = 'SELECT DISTINCT('.$column.') FROM '.$table_name.($where ? ' WHERE '.$where:'');
	
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute($values);
		track(interpolateQuery($sql,$values));
		$objects = array();
        while ($object = $stmt->fetchObject())
            $objects[] = $object;
        self::$counts++;
		
        return $objects;
		
	}
	
	public static function findOneFrom($table_name, $where, $values = array())
    {
		global $__CONN__;
        $sql = 'SELECT * FROM '.$table_name.' WHERE '.$where;

        $stmt = $__CONN__->prepare($sql);
        $stmt->execute($values);
		track(interpolateQuery($sql,$values));
        return $stmt->fetchObject();

    }
 	
	public static function save($table_name, $data = NULL)
	{
		
		global $__CONN__;
		$columns = array();
		foreach($data as $key => $value) {
				
				$columns[$key] = $__CONN__->quote($value);  
		
		}
		$data = implode(' ,',$columns);
		
		$sql = 'INSERT INTO '.$table_name.'
				VALUES ('.$data.');';
	
		$stmt= $__CONN__->prepare($sql);
		self::$counts++;
		track($sql);
		if($stmt->execute())
			return true;
			
		return false;
		
		
	}
	
	public static function insert($table_name, $data = NULL)
	{

		global $__CONN__;
		$datas = $data;
		$columns = array();
		foreach($data as $key => $value) {

				$columns[$key] = $__CONN__->quote($value);  
		}

		$data = implode(' ,', $columns);
		$rows = implode(' ,', array_keys($datas));

		$sql = 'INSERT INTO '.$table_name.' ('.$rows.')
				VALUES ('.$data.');';

		$stmt= $__CONN__->prepare($sql);
		self::$counts++;
		track($sql);
		if($stmt->execute())
			return true;

		return false;


	}
	
	public static function update($table_name, $data, $id)
	{
			
        global $__CONN__;
		
      	$names = '';
      	$values = '';
      	$updates = '';
      	foreach($data as $name => $value)
      	{
      
			$value = ( $value == '' ? 'NULL' : $__CONN__->quote($value));    		
      		$updates .= $name.' = '.$value. ', ';
      	
      	}
		

      	$updates = substr($updates,0,-2);
      	$sql = 'UPDATE '.$table_name.'
      			SET '.$updates.'
      			WHERE id = '.$id.'
      			LIMIT 1;';
		track($sql);
		$stmt = $__CONN__->prepare($sql);
		self::$counts++;
		
      	if($stmt->execute())
      		return true;
      		
      	return false;	
	}

	public static function delete($table_name, $where, $values = array())
	{
	
		global $__CONN__;
		
		$sql = 'DELETE FROM '.$table_name.($where ? ' WHERE '.$where:'');
		track(interpolateQuery($sql,$values));
		$stmt = $__CONN__->prepare($sql);
		self::$counts++;
		if($stmt->execute($values))
			return true;
	
		return false;
	}
	
	

}
