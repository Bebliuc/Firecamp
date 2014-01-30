<?php

class LinksController extends PluginController {

	function __construct() {
		$this->setLayout('admin/index');
	}
	
	function index() {
		$this->display('links/views/index', array('links' => links::findAllFrom(links::TABLE_NAME))); 
	}

}