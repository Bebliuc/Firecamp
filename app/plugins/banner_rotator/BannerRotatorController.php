<?php

class BannerRotatorController extends PluginController {
	
	function __construct() {
	
		Login::isLogged();
		$this->setLayout('admin/index');
	}
	
	private function allowedExtensions($allowedExtensions, $fileName) {
		
		$fileName = explode(".", $fileName);
		return in_array(end($fileName), $allowedExtensions);
		
	}
	
	public function index() {
		
		$this->display('banner_rotator/views/index');
	
	}
	
	public function adauga_imagine() {
	
		$this->display('banner_rotator/views/adauga_imagine');
		
	}
	
	public function _salveaza() {
		
		$descriere = $_POST['descriereImagine'];
		$textBlend = $_POST['textBlend'];
		$imagine = strtolower(str_replace(" ", "_", $_FILES['fileUpload']['name']));
		$destination = PUBLIC_URL.'/banner_rotator/';
		$color = $_POST['textColor'];
		
		if(empty($descriere)) {
				  Flash::set('error', 'Campul descriere este obligatoriu.'); 
				  go_to('plugin/banner_rotator/adauga_imagine'); }
				  
		if(empty($imagine)) {
				  Flash::set('error', 'Va rugam sa alegeti o imagine.'); 
				  go_to('plugin/banner_rotator/adauga_imagine'); }
		if(!self::allowedExtensions(array('jpg', 'jpeg', 'gif', 'png', 'swf'), $imagine)) {
				  Flash::set('error', 'Va rugam sa alegeti o imagine cu o extensie permisa.');
				  go_to('plugin/banner_rotator/adauga_imagine'); }
		
		if(!file_exists($destination)) 
					mkdir($destination, 0777) ;
					
		if(file_exists($destination . $imagine)) {
					Flash::set('error', 'Imaginea incarcata este deja existenta pe server.');
					go_to('plugin/banner_rotator/adauga_imagine'); }
		
		global $__CONN__;
		
		$sql = "INSERT INTO banner_rotator VALUES(NULL, ?, ?, ?, ?);";
		
		$stmt = $__CONN__->prepare($sql);
		if(!$stmt->execute(array($imagine, $descriere, $textBlend, $color))) {
			
			Flash::set('error', 'Imaginea nu a fost adaugata cu succes. O eroare neasteptata a intervenit.');
			go_to('plugin/banner_rotator/adauga_imagine');
			
		}
	
		if(!move_uploaded_file($_FILES['fileUpload']['tmp_name'], $destination . $imagine)) {
			
			Flash::set('error', 'O eroare a intervenit: '.$_FILES['fileUpload']['error']);
			go_to('plugin/banner_rotator/adauga_imagine');
			
		}
		Flash::set('success', 'Imaginea a fost adaugata cu succes.');
		go_to('plugin/banner_rotator/index');
	}
	
	public function _sterge($id) {
		
		$id = (int) $id;
		
		global $__CONN__;
		
		$sql = "SELECT COUNT(*) FROM banner_rotator WHERE id = ? ";
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($id));
		
		if($stmt->fetchColumn() < 0) {
		
			Flash::set('error', 'Aceasta imagine nu exista in baza de date <b>banner_rotator</b>.');
			go_to('plugin/banner_rotator/index');
			
		}
		
		$sql = "SELECT * FROM banner_rotator WHERE id = ?";
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($id));
		
		$imagine = $stmt->fetchObject();
		$imagine = $imagine->imagine;
		
		$sql = "DELETE FROM banner_rotator WHERE id = ?";
		$stmt = $__CONN__->prepare($sql);
		
		if(!$stmt->execute(array($id))) {
			
			Flash::set('error', 'Imaginea nu a fost stearsa deoarece a intervenit o eroare neasteptata.');
			go_to('plugin/banner_rotator/index');
			
		}
		
		if(!unlink(PUBLIC_URL.'/banner_rotator/'.$imagine)) {
		
			Flash::set('error', 'Imaginea nu a fost stearsa de pe server deoarece nu a fost gasita.');
			go_to('plugin/banner_rotator/index');
		
		}
		
		Flash::set('success', 'Imaginea a fost stearsa cu succes.');
		go_to('plugin/banner_rotator/index');
		
	}
	
	public function _editeaza($id) {
	
		$id = (int) $id;
		
		global $__CONN__;
		
		$sql = "SELECT * FROM banner_rotator WHERE id = ? ;";
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($id));
		$item = $stmt->fetchObject();
		
		$this->display('banner_rotator/views/editeaza',array(
						'imagine' => $item->imagine,
						'descriere' => $item->descriere,
						'blend' => $item->blend,
						'id' => $id,
						'color' => $item->color));
		
	}
	
	public function __salveaza($id) {
		
		$id = (int) $id;
		$descriere = $_POST['descriereImagine'];
		$blend = $_POST['textBlend'];
		$color = $_POST['textColor'];
		$color = "#".$color;
		
		global $__CONN__;
		
		$sql = "UPDATE banner_rotator SET descriere = ?, blend = ?, color = ? WHERE id = ?";
		$stmt = $__CONN__->prepare($sql);
		
		if(!$stmt->execute(array($descriere, $blend, $color, $id))) {
			Flash::set('error', 'Imaginea <b>nu</b> a fost editata cu succes.');
			go_to('plugin/banner_rotator/index');
		}
		
		Flash::set('success', 'Imaginea a fost editata cu succes.');
		go_to('plugin/banner_rotator/index');
		
	}



}