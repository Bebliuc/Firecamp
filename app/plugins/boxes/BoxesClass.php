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
 * Class Box
 *
 * @package BebliuCMS
 * @subpackage boxes
 * @todo Simple content boxes management
 * 
 * @version 0.1
 * @since 0.1
 */
 
class Box extends Record {
	
	const TABLE_NAME = 'boxes';
	
	private $box;	
	var $id;
	var $title;
	var $content;
	
	function __construct($id = NULL) {
		$this->box = Record::findOneFrom(self::TABLE_NAME, 'id = ?', array($id)); 
		$this->id = $this->box->id;
		$this->title = $this->box->title;
		$this->content = $this->box->content;
		Observer::notify('box.construct', $this->box);
	}
	
	public function id() { return $this->box->id; }
	public function title() { return $this->box->title; }
	public function content() { return $this->box->content; }
	public function page_id() { return $this->box->page_id; }
	public function type() { return $this->box->type; }
	
	public static function getAll( $filter = NULL, $values = array() )  {
		return $boxes = record::findAllFrom(self::TABLE_NAME, $filter, $values);
	}	
	
	public static function _save($data = NULL) {
		
		if(self::save(self::TABLE_NAME, $data)) 
			return true;
			
		return false;
		
	}
	
	public static function _update($data, $id) {
		if(self::update(self::TABLE_NAME, $data, $id))
			return true;
		else
			return false;
	}
}

class Boxes extends Box {

}