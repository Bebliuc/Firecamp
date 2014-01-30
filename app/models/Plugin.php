<?php


class Plugin


{


	static $plugins = array();


	static $plugins_infos = array();


    static $updatefile_cache = array();





	static $controllers = array();


    static $javascripts = array();


	


	static function init()


	{


		


		self::$plugins = unserialize(Setting::get('plugins'));


		


		foreach (self::$plugins as $plugin_id => $tmp)


		{	


			$model = APP_PATH.'/plugins/'.$plugin_id.'/'.ucwords($plugin_id).'Class.php';


			if (file_exists($model)) {


				include $model;


				try {


					$method = new ReflectionMethod( ucwords($plugin_id).'::init' );


					call_user_func(array(ucwords($plugin_id), 'init'));


				}


				catch ( ReflectionException $e ) {


					


				}


			}


				


			$file = APP_PATH.'/plugins/'.$plugin_id.'/index.php';


			if (file_exists($file))


				include $file;


									 


		}


		


	}



	static function setInfos($infos)


	{


		self::$plugins_infos[$infos['id']] = (object) $infos;


	}



	static function activate($plugin_id)


	{


		self::$plugins[$plugin_id] = 1;


		self::save();





		$file = APP_PATH.'/plugins/'.$plugin_id.'/enable.php';


		if (file_exists($file))


			include $file;


        


        $class_name = Inflector::camelize($plugin_id).'Controller';        


		


        


		//AutoLoader::addFile($class_name, self::$controllers[$plugin_id]->file);


	}


	
	static function deactivate($plugin_id)


	{


		if (isset(self::$plugins[$plugin_id]))


		{


			unset(self::$plugins[$plugin_id]);


			self::save();





			$file = APP_PATH.'/plugins/'.$plugin_id.'/disable.php';


			if (file_exists($file))


				include $file;


		}


	}



	static function save()


	{


		Setting::saveFromData(array('plugins' => serialize(self::$plugins)));


	}








	static function findAll()


	{


		$dir = APP_PATH.'/plugins/';

		if ($handle = opendir($dir))


		{


			while (false !== ($plugin_id = readdir($handle)))


			{


				if ( ! isset(self::$plugins[$plugin_id]) && is_dir($dir.$plugin_id) && strpos($plugin_id, '.') !== 0)


				{	


					


					$file = APP_PATH.'/plugins/'.$plugin_id.'/index.php';


					if (file_exists($file))


						include $file;


					


				}


			}

			closedir($handle);


		}





		ksort(self::$plugins_infos);

        global $domain;

        foreach(self::$plugins_infos as $key => $val)
            if(isset($val->domains))
                if(strpos($val->domains, $domain) !== false || $val->domains == '*')
                    continue;
                else
                    unset(self::$plugins_infos[$key]);

		return self::$plugins_infos;


	}





	static function addController($plugin_id, $label, $permissions=false, $show_tab=true)


	{


		$class_name = Inflector::camelize($plugin_id).'Controller';





		self::$controllers[$plugin_id] = (object) array(


			'label' => ucfirst($label),


			'class_name' => $class_name,


			'file'	=> APP_PATH.'/plugins/'.$plugin_id.'/'.$class_name.'.php',


			'permissions' => $permissions,


            		'show_tab' => $show_tab


		);


        


        AutoLoader::addFile($class_name, self::$controllers[$plugin_id]->file);


	}

	


	static function addClass($plugin_id, $file)


	{


		AutoLoader::addFile($plugin_id, APP_PATH.'/plugins/'.$plugin_id.'/'.$file.'.php');


	}


    


    static function isEnabled($plugin_id)


    {


        if (array_key_exists($plugin_id, Plugin::$plugins) && Plugin::$plugins[$plugin_id] == 1)


            return true;


        else


            return 0;


    }








    static function setAllSettings($array=null, $plugin_id=null)


    {


        if ($array == null || $plugin_id == null) return false;





        global $__CONN__;


        $tablename = 'plugin_settings';


        $plugin_id = $__CONN__->quote($plugin_id);





        $existingSettings = array();





        $sql = "SELECT name FROM $tablename WHERE plugin_id=$plugin_id";


        $stmt = $__CONN__->prepare($sql);


        $stmt->execute();





        while ($settingname = $stmt->fetchColumn())


            $existingSettings[$settingname] = $settingname;





        $ret = false;





        foreach ($array as $name => $value)


        {


            if (array_key_exists($name, $existingSettings))


            {


                $name = $__CONN__->quote($name);


                $value = $__CONN__->quote($value);


                $sql = "UPDATE $tablename SET value=$value WHERE name=$name AND plugin_id=$plugin_id";


            }


            else


            {


                $name = $__CONN__->quote($name);


                $value = $__CONN__->quote($value);


                $sql = "INSERT INTO $tablename (value, name, plugin_id) VALUES ($value, $name, $plugin_id)";


            }





            $stmt = $__CONN__->prepare($sql);


            $ret = $stmt->execute();


        }





        return $ret;


    }





    static function setSetting($name=null, $value=null, $plugin_id=null)


    {


        if ($name == null || $value == null || $plugin_id == null) return false;





        global $__CONN__;


        $tablename = 'plugin_settings';


        $plugin_id = $__CONN__->quote($plugin_id);





        $existingSettings = array();





        $sql = "SELECT name FROM $tablename WHERE plugin_id=$plugin_id";


        $stmt = $__CONN__->prepare($sql);


        $stmt->execute(array($plugin_id));





        while ($settingname = $stmt->fetchColumn())


            $existingSettings[$settingname] = $settingname;





        if (in_array($name, $existingSettings))


        {


            $name = $__CONN__->quote($name);


            $value = $__CONN__->quote($value);


            $sql = "UPDATE $tablename SET value=$value WHERE name=$name AND plugin_id=$plugin_id";


        }


        else


        {


            $name = $__CONN__->quote($name);


            $value = $__CONN__->quote($value);


            $sql = "INSERT INTO $tablename (value, name, plugin_id) VALUES ($value, $name, $plugin_id)";


        }





        $stmt = $__CONN__->prepare($sql);


        $stmt->execute();


    }





 


    static function getAllSettings($plugin_id=null)


    {


        if ($plugin_id == null) return false;





        global $__CONN__;


        $tablename = 'plugin_settings';


        $plugin_id = $__CONN__->quote($plugin_id);





        $settings = array();





        $sql = "SELECT name,value FROM $tablename WHERE plugin_id=$plugin_id";


        $stmt = $__CONN__->prepare($sql);


        $stmt->execute();





        while ($obj = $stmt->fetchObject()) {


            $settings[$obj->name] = $obj->value;


        }





        return $settings;


    }





    static function getSetting($name=null, $plugin_id=null)


    {


        if ($name == null || $plugin_id == null) return false;





        global $__CONN__;


        $tablename = 'plugin_settings';


        $plugin_id = $__CONN__->quote($plugin_id);


        $name = $__CONN__->quote($name);





        $existingSettings = array();





        $sql = "SELECT value FROM $tablename WHERE plugin_id=$plugin_id AND name=$name LIMIT 1";


        $stmt = $__CONN__->prepare($sql);


        $stmt->execute();





        if ($value = $stmt->fetchColumn()) return $value;


        else return false;





    }





}


