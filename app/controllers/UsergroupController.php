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
 * UsergroupController
 *
 * @package		controllers
 * @author		Firecamp Team
 * @copyright	Copyright (c) 2010 - 2011, Bebliuc
 * @license		http://firecamp.ro/license
 * @link		http://firecamp.ro
 * @since		Version 1.0.01
 */


class UsergroupController extends Controller {


	function __construct() {
	
		User::isLogged();
		$this->setLayout('admin_v2/index');
		green::$watches['submenu'] = array(get_url('user/add') => __('Add member'),
						   				   get_url('usergroup/index') => __('Permission groups'),
										   get_url('usergroup/create') => __('Add permissions group'));
	}

	function index() {
		green::$watches['pageHeading'] = __('Permission groups');
		$this->display('usergroup/index');
	
	}
	
	function create() {
		green::$watches['pageHeading'] = __('Create permissions group');
		$this->display('usergroup/add');	
	}
	
	function add() {

		$ctrls = implode(', ',$_POST['ctrl']);
		
		$stmt = new Database('utilizatori_grup');
		if(empty($_POST['nume'])) {
			Flash::set('error', __('The usergroup name is mandatory'));
			go_to('usergroup/index');
		}
		if(isset($_POST['moderator'])) {
			$moderator = $_POST['moderator'];
			if($moderator == 1)
				$ctrls = "*";
		}
		
		if($stmt->insert(
			array(
				'id' => NULL,
				'nume' => $_POST['nume'],
				'zona' => $ctrls
						)
			)
		  ) {
		
			Flash::set('success', __('The usergroup has been added succesfully.'));
			go_to('usergroup/index');
		
		}
		
		Flash::set('error', __('The usergroup could not be added. Please contact the website administrator and provide the following code: Ug::add'));
		
		go_to('usergroup/index');
		
		
		 
	}
	
	function delete($id) {
	
		$id = (int) $id;
		
		$stmt = new Database('utilizatori_grup', $id);
		
		if($stmt->delete())
			Flash::set('success', __('The usergroup has been added succesfully.'));
		else
			Flash::set('error', __('The usergroup could not be deleted. Please contact the website administartor and provide the following code: Ug::delete'));
		
		go_to('usergroup/index');
	
	}


}

?>