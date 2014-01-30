<?php

class FaqController extends PluginController {

	function __construct() {
		$this->setLayout('admin/index');
	}
	
	function index() {
		$this->display('faq/views/index', array('faqs' => faq::findAllFrom(faq::TABLE_NAME)));
	}
	
	function create() {
		$this->display('faq/views/create');
	}
	
	function edit( $id = NULL ) {
		$this->display('faq/views/edit', array('faq' => faq::findOneFrom(faq::TABLE_NAME, 'id = ?', array($id))));
	}
	
	function update( $id = NULL ) {
		if(faq::update(faq::TABLE_NAME, array('question' => $_POST['question'], 'answer' => $_POST['answer']), $id)) {
			Flash::set('success', 'The FAQ has been edited succesfully.');
			go_to('plugin/faq/index');
		}
		else {
			Flash::set('error', 'The FAQ could not be edited. Please contact the website administrator and provide the following code: P::faq::edit');
			go_to('plugin/faq/update/'.$id);
		}
	}
	
	function delete( $id = NULL ) {
		if(faq::delete(faq::TABLE_NAME, 'id = ?', array($id)))
			Flash::set('success', 'The FAQ has been deleted succesfully.');
		else
			Flash::set('error', 'The FAQ could not be deleted. Please contact the website administrator and provide the following code: P::faq::delete');
		
		go_to('plugin/faq/index');
	}
	
}