<?php

class CommentsController extends PluginController {
	
	function __construct() {
		
		$this->setLayout('admin_v2/index');
		
	}
	
	function index($page = 0) {
		$from = ($page == 0 ? 0 : $page * 5);
		$to = $from + 5;
		$total = Record::countFrom('comments');
		$total_pages = (ceil($total / 5) - 1);
		$pagination = array();

		$pagination['next'] = ($total > $to ? '<a href="'.get_url('plugin/comments/index/'.($page + 1)).'">Next page &raquo;</a>' : NULL);	
		$pagination['previous'] = ($page > 0 ? '<a href="'.get_url('plugin/comments/index/'.($page - 1)).'">&laquo; Previews page</a>' : NULL);	
		$pagination['first_page'] = get_url('plugin/comments/index/0');
		$pagination['last_page'] = get_url('plugin/comments/index/'.$total_pages);
		$pagination['total_pages'] = $total_pages;
		
		$this->display('comments/views/index', array('comments' => Record::findAllFrom('comments', "status != 5 LIMIT $from, $to"),
													'pagination' => $pagination,
													'page' => $page));
	}
	
	function delete_comment( $id ) {
		
		if(record::delete('comments', 'id = ?', array($id)))
			flash::set('success', __('Comment has been deleted successfully.'));
		else
			flash::set('error', __('Comment could not be deleted. Please contact the website administrator and provide the following code: P ::comment:d'));
			
		go_to('plugin/comments/index');
		
	}
	
	function unapprove_comment( $id ) {
		
		if(record::update('comments', array('status' => '2'), $id))
			flash::set('success', __('Comment has been moved to spam.'));
		else
			flash::set('error', __('Comment could not be moved to spam. Please contact the website administrator and provide the following code: P::comment::uc'));
		
		go_to('plugin/comments/index');
		
	}
	
	function approve_comment( $id ) {
		
		if(record::update('comments', array('status' => '1'), $id))
			flash::set('success', __('Comment has been moved to active.'));
		else
			flash::set('error', __('Comment could not be moved to active. Please contact the website administrator and provide the following code: P::comment::uc'));
		
		go_to('plugin/comments/index');
		
	}
	
	
	
	
}