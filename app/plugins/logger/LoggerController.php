<?php

class LoggerController extends PluginController {

	function __construct() {
		$this->setLayout('admin_v2/index');
	}
	
	function index() {
		green::$watches['toggleSidebar'] = FALSE;
		green::$watches['pageHeading'] = 'Logger';
		$this->display('logger/views/index', array('logs' => logger::findAllFrom(logger::TABLE_NAME, 'hide != 1 ORDER BY id DESC LIMIT 100')));
	}
	
	function delete($id = NULL) {
		if(logger::delete(logger::TABLE_NAME, 'id = ?', array($id)))
			flash::set('success', 'The log has been deleted succesfully.');
		else
			flash::set('error', 'The log could not be deleted. Please contact the web administrator and provide the following code: P::logger::d');
			
		go_to('plugin/logger/index');
	}	
	
	function hide($id = NULL) {
		if(logger::update(logger::TABLE_NAME, array('hide' => 1), $id))
			flash::set('success', 'The log has been hidden succesfully.');
		else
			flash::set('error', 'The log could not be deleted. Please contact the website adminstrator and provide the following code: P::logger::e');
		
		go_to('plugin/logger/index');
	}
	

}
