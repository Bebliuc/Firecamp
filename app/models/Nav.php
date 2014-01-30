<?php

class Nav extends Model {
	
	function __construct() {
		
		Login::isLogged();
		
	}
	
	
	public static function hasChild($buton) {
		
		global $__CONN__;

		$sql = 'SELECT COUNT(*) FROM admin_menu WHERE controller_base = ? ;';
	    $stmt = $__CONN__->prepare($sql);

		$stmt->execute(array($buton));

	    return (int) $stmt->fetchColumn();
		
	}
	
	
	public static function generateNav($ctrl, $plugins, $action) {
		
		global $__CONN__;
		
		$sql = "SELECT * FROM admin_menu WHERE controller_base IS NULL ORDER BY weight ASC";
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute();
		
		while($buton = $stmt->fetchObject()) {
			
			if(User::hasPermissionsTo($buton->controller)) {
			
				if($ctrl == $buton->controller) 
					$current = ' class="active"'; 
				else
					$current = NULL;
		
				
                    echo '<li'.$current.'><a href="'.get_url($buton->url).'"><span>'.__($buton->nume).'</span></a></li>';
					
			}

		}
		foreach ($plugins as $plugin_name => $plugin)
		{
		
			if(User::hasPermissionsTo($plugin_name)) {
			
				if($ctrl=='plugin' && $action == $plugin_name)
					$current = ' class="active"';
				else 
					$current = '';
                if ($plugin->show_tab)
                    echo '<li'.$current.'><a href="'.get_url('plugin/'.$plugin_name.'/index').'"><span>'.__($plugin->label).'</span></a></li>';
		
        	}
			
		}
	}
	
    public static function generateThemeDropDown( $options = array() ) {
        
        if($options['controller'] != 'plugin') {
            
            if(self::hasChild($options['controller']) > 0) {
    					self::generateSubNav($options['controller'], $options['plugins']);
            }
        }
        else {
        	$plugin_name = green::segment(1);
            $model_file = APP_PATH.'/plugins/'.$plugin_name.'/views/nav.php';
	
            if (file_exists($model_file)) {
            			echo '<li class="single">';
                        if(Green::segment(2) == 'index')
                             echo '<a href="'.get_url('plugin/'.$plugin_name.'/index').'" title="'.Plugin::$controllers[$plugin_name]->label.'"><span class="color-label"><b class="label-red"></b></span>'.Plugin::$controllers[$plugin_name]->label.'</a>';
            			else
            			     echo '<a href="'.get_url('plugin/'.$plugin_name.'/index').'">'.Plugin::$controllers[$plugin_name]->label.'</a>';
            			
                        include $model_file;
                        echo '</li>';
    		}
        }
    }
    
    
	public static function generateSubNav($ctrl, $plugins) {
		
		global $__CONN__;
		
		$sql = "SELECT * FROM admin_menu WHERE controller_base = ? ORDER BY weight ASC";
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($ctrl));
		echo '<li class="single">';
		while($buton = $stmt->fetchObject()) {
			$url = Green::getController().'/'.Green::getAction();
			
			if($url == $buton->url)
				$current = ' class="current"';
			else
				$current = '';
				
			
			echo '<a href="'.get_url($buton->url).'"'.$current.'><span class="color-label"><b class="label-red"></b></span> '.__($buton->nume).'</a>';
			

		}
        echo '</li>';
	
		
	}
	

	
	public static function generateDropDown() {
		
		global $__CONN__;
		
		$sql = "SELECT * FROM admin_menu WHERE controller_base IS NULL ORDER BY weight ASC";
		
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute();
		
		while($buton = $stmt->fetchObject()) {
			
			echo '<option value="'.$buton->controller.'">'.$buton->nume.'</option';
			
		}
		
	}	
	

}