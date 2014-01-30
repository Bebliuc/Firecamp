<?php
class Setting extends Model
{
    const TABLE_NAME = 'setting';
    
    public $name;
    public $value;
    
    public static $settings = array();
    public static $is_loaded = false;
    
    public static function init()
    {
        if (! self::$is_loaded)
        {
			global $__CONN__;
            $sql = 'SELECT * FROM setting';
				
				$stmt = $__CONN__->prepare($sql);
				$stmt->execute();
				
				Model::logQuery($sql);
				
				$objects = array();
				while ($object = $stmt->fetchObject())
					$objects[] = $object;
				
				$settings = $objects;
			
			
            foreach($settings as $setting)
                self::$settings[$setting->name] = $setting->value;
            
            self::$is_loaded = true;
        }
    }
    
     /**
     * Set a new setting
     *
     * @param name  string  The setting name
     */
     
    public static function set($name)
    {
    	if(!self::get($name))
  		record::save('setting', array('name' => $name, 'value' => NULL));
    }
    
    /**
    * Delete a setting
    *
    * @param	name	string	The setting name
    */
    
    public static function unlink($name)
    {
    	record::delete('setting', 'name = ?', array($name));
    }
    
    /**
     * Get the value of a setting
     *
     * @param name  string  The setting name
     * @return string the value of the setting name
     */
     
    public static function get($name)
    {
        return isset(self::$settings[$name]) ? self::$settings[$name]: false;
    }
    
    public static function saveFromData($data)
    {
        $tablename = self::tableNameFromClassName('Setting');
        global $__CONN__;
		
        foreach ($data as $name => $value)
        {
            $sql = 'UPDATE '.$tablename.' SET value='.$__CONN__->quote($value)
                 . ' WHERE name='.$__CONN__->quote($name);
            $__CONN__->exec($sql);
			
		}
        
		
    }
    

}