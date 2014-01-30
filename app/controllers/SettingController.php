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
 * SettingController
 *
 * @package		controllers
 * @author		Firecamp Team
 * @copyright	Copyright (c) 2010 - 2011, Bebliuc
 * @license		http://firecamp.ro/license
 * @link		http://firecamp.ro
 * @since		Version 1.0.01
 */

class SettingController extends Controller
{

    function __construct() {
		
		Login::isLogged();
		$this->setLayout('admin_v2/index');
		green::$watches['submenu'] = array(get_url('setting/plugins') => __('Extensions'),
										   get_url('setting/index') => __('General settings'));
	}
	
	
	function index() {
        green::$watches['pageHeading'] = __('General settings');
		$this->display('setting/index');
	
	}
	
	function save() {
	
		$post = $_POST;
		unset($post['submit']);
	
		Setting::saveFromData($post);
		
		Flash::set('success', __('Setarile au fost salvate cu succes.'));
		
		go_to('setting/index');
	}
	
	public function plugins() {
		green::$watches['pageHeading'] = __('Extensions');
        green::$watches['sidebar'] = '<div id="asidebar">bla bla</div>';
        green::$watches['toggleSidebar'] = FALSE;
		$this->display('setting/plugins');
		
	}
	
    public function activate_plugin($plugin)
    {
		
        Plugin::activate($plugin);	
        Observer::notify('plugin_after_enable', $plugin);
    	Flash::set('information', __('Pluginul a fost activat'));
		go_to('setting/plugins');
		
	}
    
    public function deactivate_plugin($plugin)
    {
    
        Plugin::deactivate($plugin);
        Observer::notify('plugin_after_disable', $plugin);
		Flash::set('information', __('Pluginul a fost dezactivat'));
		go_to('setting/plugins');
		
    }

} // end SettingController class