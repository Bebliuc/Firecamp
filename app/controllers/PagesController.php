<?php

/** 
* Firecamp * 
* @package Firecamp 
* @author Firecamp Team 
* @copyright Copyright (c) 2010 - 2011, Bebliuc 
* @license http://firecamp.ro/license 
* @link http://firecamp.ro 
* @since Version 1.0.01 
*/

/** 
* PagesController * 
* @package controller 
* @author Firecamp Team 
* @copyright Copyright (c) 2010 - 2011, Bebliuc 
* @license http://firecamp.ro/license 
* @link http://firecamp.ro 
* @since Version 1.0.01 
*/

class PagesController extends Controller {

	function __construct()
	{
		User::isLogged();
		$this->setLayout('admin_v2/index');
		green::$watches['submenu'] = array(
			get_url('pages/add') => __('Create page')
		);
	}

	function index()
	{
		green::$watches['pageHeading'] = 'Pages';
		green::$watches['toggleSidebar'] = FALSE;
		$this->display('pages/index');
	}

	function add($parent_id = 0)
	{
		$params = $_GET;

		green::$watches['pageHeading'] = 'Create new page';
		green::$watches['toggleSidebar'] = FALSE;
		$this->display('pages/add_page', array(
			'parent_id' => $parent_id,
			'params' => $params
		));
	}

	function save()
	{
		if (empty($_POST['name']))
		{
			Flash::set('information', 'Campul <b>Titlu pagina</b> este mandator.');
			go_to('pages/add');
		}

		if (empty($_POST['slug']))
		{
			Flash::set('information', 'Campul <b>Slug</b> este mandator.');
			go_to('pages/add');
		}

		$level = ($_POST['parent_id'] == 0 ? 1 : Page::getParentLevel($_POST['parent_id']) + 1);
		$created_time = date("Y-m-d"); // Root page checking : to be rewritten
		
		$_pages = record::findOneFrom(page::TABLE_NAME, 'id != NULL');
		
		if ($_pages)
			if ($_POST['root'] == '1') 
				Page::unsetRootPage();

		$root = ($_POST['root'] == '1' ? 1 : NULL);
		
		Observer::notify('page.before.save');
		
		$data = array(
			'id' => NULL,
			'parent_id' => $_POST['parent_id'],
			'level' => $level,
			'name' => $_POST['name'],
			'slug' => $_POST['slug'],
			'title' => $_POST['title'],
			'content' => $_POST['content'],
			'tags' => $_POST['tags'],
			'meta_keywords' => $_POST['meta_keywords'],
			'meta_description' => $_POST['meta_description'],
			'template' => $_POST['template'],
			'status' => $_POST['status'],
			'created_time' => $created_time,
			'modified_time' => $created_time,
			'publish_time' => $_POST['publish_time'],
			'login_required' => $_POST['login_required'],
			'author' => User::getCurrentUser() ,
			'root' => $_POST['root'],
			'date' => date('Y-m-d H:i:s') ,
			'behavior' => $_POST['behavior']
		);
		if (Page::_save($data))
		{
			Flash::set('success', 'Pagina a fost adaugata cu succes.');
			Observer::notify('page.save.success');
			
			go_to('pages/index');
		}

		Flash::set('error', 'Pagina nu a fost adaugata.');
		Observer::notify('page.save.error');
		
		go_to('pages/add');
	}

	function edit($id)
	{
		green::$watches['toggleSidebar'] = FALSE;
		green::$watches['pageHeading'] = 'Edit page';
		
		$this->display('pages/edit_page', array(
			'id' => $id
		));
	}

	function update($id)
	{
		if ($_POST['root'] == '1') Page::unsetRootPage();
		
		$root = ($_POST['root'] == '1' ? 1 : NULL);
		
		$level = ($_POST['parent_id'] == 0 ? 1 : Page::getParentLevel($_POST['parent_id']) + 1);
		
		$data = array(
			'parent_id' => $_POST['parent_id'],
			'level' => $level,
			'name' => $_POST['name'],
			'slug' => $_POST['slug'],
			'title' => $_POST['title'],
			'content' => $_POST['content'],
			'tags' => $_POST['tags'],
			'meta_keywords' => $_POST['meta_keywords'],
			'meta_description' => $_POST['meta_description'],
			'template' => $_POST['template'],
			'status' => $_POST['status'],
			'modified_time' => date("Y-m-d") ,
			'publish_time' => $_POST['publish_time'],
			'login_required' => $_POST['login_required'],
			'root' => $_POST['root'],
			'date' => date('Y-m-d H:i:s') ,
			'behavior' => $_POST['behavior']
		);
		
		Observer::notify('page.before.edit', $id);
		
		if (Page::_edit($data, $id))
		{
			Flash::set('success', 'Pagina a fost modificata cu succes.');
			Observer::notify('page.edit.success', $id);
			
			go_to('pages/index');
		}
		else
		{
			Flash::set('error', 'Pagina nu a fost modificata.');
			Observer::notify('page.edit.error', $id);
			
			go_to('pages/edit/' . $id);
		}
	}

	function delete($id)
	{
		Observer::notify('page.before.delete', $id);
		if (Page::_delete($id))
		{
			Flash::set('succes', 'Pagina a fost stearsa cu succes.');
			Observer::notify('page.delete.success', $id);
		}
		else
		{
			Flash::set('error', 'Pagina nu a fost stearsa.');
			Observer::notify('page.delete.error', $id);
		}

		go_to('pages/index');
	}

	function ajax_request($id)
	{
		$id = (int)$id;
		$page = record::findOneFrom(page::TABLE_NAME, 'id = ?', array($id));
		
		echo $page->content;
	}

	function post_ajax_request($id)
	{
		$id = (int)$id;

		if (Page::_edit(array('content' => $_POST['content']) , $id)) 
			echo 1;
		else
			echo 0;
	}
}