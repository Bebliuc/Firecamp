<?php

/**
 * @package BebliuCMS
 * @subpackage plugin
 *
 * @author Bebliuc George <george@bebliuc.ro>
 * @version 0.1
 * @copyright Bebliuc George, 2009
 */

/**
 * Class BoxesController
 *
 * @package BebliuCMS
 * @subpackage boxes
 * @todo Simple content boxes management
 * 
 * @version 0.1
 * @since 0.1
 */

class BoxesController extends PluginController {
	
	function __construct() {
		$this->setLayout('admin_v2/index');
		green::$watches['submenu'] = array(get_url('plugin/boxes/create') => __('Create box'),
										   get_url('plugin/boxes/index') => __('Boxes'));
	}
	
	function index() {
		green::$watches['pageHeading'] = 'Boxes';	
		$this->display('boxes/views/index', array('boxes' => box::getAll()));
	}
	
	function create() {
		green::$watches['pageHeading'] = 'Create box';
		$this->display('boxes/views/create');	
	}
	
	function save() {
		if(empty($_POST['title'])) {
			Flash::set('error', __('The <b>title</b> field is mandatory.'));
			go_to('plugin/boxes/create');
		}
		$data = array('id' => NULL, 'title' => $_POST['title'], 'content' => $_POST['content'], 'page_id' => NULL, 'type' => NULL);
		if(box::_save($data)) {
			Flash::set('success', __('The box has been created succesfully.'));
			go_to('plugin/boxes/index');
		} else {
			Flash::set('error', __('The box could not be created. Please contact the website administrator and provide the following code: P::box::save'));
			go_to('plugin/boxes/create');
		}
			
	}
	
	function delete( $id ) {
		
		$box = box::findOneFrom(box::TABLE_NAME, 'id = ?', array($id));
    
        
        if(record::delete(box::TABLE_NAME, 'id = ?', array($id)))
            Flash::set('success', __('Box <b><i>%name%</i></b> has been deleted succesfully.', array('%name%' => $box->title)));
        else
            Flash::set('error', __('The box could not be deleted. Please contact the website administrator and provide the following code: P::box::delete'));
        
        go_to('plugin/boxes/index');
	}
	
	function edit( $id ) {
		$box = box::findOneFrom(box::TABLE_NAME, 'id = ?', array($id));
		green::$watches['pageHeading'] = 'Edit box <strong>'.$box->title.'</strong>';
		$this->display('boxes/views/edit',	array('box' => box::findOneFrom(box::TABLE_NAME, 'id = ?', array($id))));
	}
	
	function update( $id ) {
		if(box::_update(array('title' => $_POST['title'], 'content' => $_POST['content']), $id)) {
			Flash::set('success', __('The box has been succesfully updated.'));
			go_to('plugin/boxes/index');	
		}
		else {
			Flash::set('error', _('The box could not be updated. Please contact the website administrator and provide the following code: P::box::update'));
			go_to('plugin/boxes/update/'.$id);
		}
	}
}