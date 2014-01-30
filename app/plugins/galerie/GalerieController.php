<?php

class GalerieController extends PluginController {

	function __construct() {
	
		Login::isLogged();
		$this->setLayout('admin/index');
	
	}
	
	function index() {
		
		$this->display('galerie/views/index');
		
	}
	
	function categorii() {
		
		$this->display('galerie/views/categorii');
	
	}
	
	function adauga_categorie() {
		
		$this->display('galerie/views/adauga_categorie');
	
	}
	
	function sterge_categorie($id) {
		
		$id = (int) $id;
		
		global $__CONN__;
		
		$sql = "DELETE FROM galerie_categorii WHERE id = ? LIMIT 1";
		$stmt = $__CONN__->prepare($sql);
		if($stmt->execute(array($id))) {
			
			Flash::set('success', 'Categoria a fost stearsa.');
			goto_plugin('galerie/categorii');
			
		}
		else {
		
			Flash::set('error', 'Categoria nu a fost stearsa. O eroare neasteptata a intervenit.');
			goto_plugin('galerie/categorii');
		
		}
		
	}
	
	function salveaza_categorie() {
			
		$nume = $_POST['numeCategorie'];
		
		global $__CONN__;
		
		$sql = "INSERT INTO galerie_categorii VALUES(NULL, ?);";
		$stmt = $__CONN__->prepare($sql);
		if($stmt->execute(array($nume))) {
			
			Flash::set('success', 'Categorie '.$nume.' a fost adaugata cu succes.');
			goto_plugin('galerie/categorii');
			
		}
		else {
		
			Flash::set('error', 'Categoria nu a fost adaugata.');
			goto_plugin('galerie/adauga_categorie');
			
		}
		
	}
	
	function editeaza_categorie($id) {
		
		global $__CONN__;
		$id = (int) $id;
		$sql = "SELECT * FROM galerie_categorii WHERE id = ?";
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($id));
		$categorie = $stmt->fetchObject();
		$this->display('galerie/views/editeaza_categorie', array(
						'nume' => $categorie->nume,
						'id' => $id));
		
	}
	
	function resalveaza_categorie($id) {
		
		$nume = $_POST['numeCategorie'];
		$id = (int) $id;
		global $__CONN__;
		
		$sql = "UPDATE galerie_categorii SET nume = ? WHERE id = ?;";
		$stmt = $__CONN__->prepare($sql);
		if($stmt->execute(array($nume, $id))) {
			
			Flash::set('success', 'Categoria '.$nume.' a fost modificata cu succes.');
			goto_plugin('galerie/categorii');
			
		}
		else {
		
			Flash::set('error', 'Categoria nu a fost modificata.');
			goto_plugin('galerie/editeaza_categorie/'.$id);
			
		}
		
	}
	
	function adauga_album() {
		
		$this->display('galerie/views/adauga_album');
	
	}
	
	function salveaza_album() {
		
		$nume = $_POST['numeAlbum'];
		$id = (int) $_POST['idCategorie'];
		$dirAlbum = strtolower(str_replace(" ", "_", $nume));
		
		if(empty($nume) OR empty($id)) {
			
			Flash::set('error', 'Toate campurile sunt obligatorii.');
			goto_plugin('galerie/adauga_album');
			
		}
		
		
		
		if(!file_exists(UPLOAD.'/thumb/'.$dirAlbum)) {
			
			mkdir(UPLOAD.'/thumb/'.$dirAlbum);
			Flash::set('success', 'Folderul thumb/'.$dirAlbum.' a fost creat cu succes');
			
		}
		
		if(!file_exists(UPLOAD.'/original/'.$dirAlbum)) {
			
			mkdir(UPLOAD.'/original/'.$dirAlbum);
			Flash::set('success', 'Folderul original/'.$dirAlbum.' a fost creat cu succes');
			
		}
		
		if(!file_exists(UPLOAD.'/caption/'.$dirAlbum)) {
			
			mkdir(UPLOAD.'/caption/'.$dirAlbum);
			Flash::set('success', 'Folderul caption/'.$dirAlbum.' a fost creat cu succes');
			
		}
		
		global $__CONN__;
		$sql = "INSERT INTO galerie_album VALUES(NULL, ?, ?);";
		
		$stmt = $__CONN__->prepare($sql);
		if($stmt->execute(array($nume, $id))) {
			
			Flash::set('success', 'Albumul <b>'.$nume.'</b> a fost adaugat cu succes.');
			goto_plugin('galerie/index');
			
		}
		else {
			
			Flash::set('error', 'Albumul nu a fost adaugat. O eroare neasteptata a intervenit.');
			goto_plugin('galerie/adauga_album');
		
		}
		
	}
	
	function editeaza_album($id) {
		
		$id = (int) $id;
		
		global $__CONN__;
		$sql = "SELECT * FROM galerie_album WHERE id = ?";
		
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($id));
		if($stmt->rowCount() == 0) {
			
			Flash::set('error', 'Album inexistent.');
			goto_plugin('galerie/index');
		
		}
		
		$album = $stmt->fetchObject();
		
		
		$this->display('galerie/views/editeaza_album', array(
					   'nume' => $album->nume,
					   'idCategorie' => $album->categorie,
					   'id' => $album->id));
	
	}
	
	function resalveaza_album($id) {
		
		$nume = $_POST['numeAlbum'];
		$id = (int) $id;
		$categorie = $_POST['idCategorie'];
		
		if(empty($nume) OR empty($categorie) OR empty($id)) {
			
			Flash::set('error', 'Toate campurile sunt obligatorii.');
			goto_plugin('galerie/editeaza_album/'.$id);
			
		}
		
		global $__CONN__;
		$sql = "UPDATE galerie_album SET nume = ? , categorie = ? WHERE id = ? ;";
		
		$stmt = $__CONN__->prepare($sql);
		if($stmt->execute(array($nume, $categorie, $id))) {
			
			Flash::set('success', 'Albumul a fost modificat cu succes.');
			goto_plugin('galerie/index');
			
		}
		else {
			
			Flash::set('error', 'Albumul nu a fost modificat. O eroare neasteptata a intervenit.');
			goto_plugin('galerie/editeaza_album/'.$id);
			
		}
		
		
	}
	
	function sterge_album($id) {
		
		$id = (int) $id;
		
		global $__CONN__;
		
		$sql = "SELECT nume FROM galerie_album WHERE id = ?";
		
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($id));
		
		$album = $stmt->fetchObject();
		
		$dirAlbum = strtolower(str_replace(" ", "_", $album->nume));
		
	
		
		if(file_exists(UPLOAD.'/original/'.$dirAlbum)) {
			
				Main::deleteFolder(UPLOAD.'/original/'.$dirAlbum);
				
		}
		
		if(file_exists(UPLOAD.'/thumb/'.$dirAlbum)) {
			
				Main::deleteFolder(UPLOAD.'/thumb/'.$dirAlbum);
			
		}
		
		if(file_exists(UPLOAD.'/caption/'.$dirAlbum)) {

				Main::deleteFolder(UPLOAD.'/caption/'.$dirAlbum);

		}
		
		
		$sql = "DELETE FROM galerie_album WHERE id = ?";
		
		$stmt = $__CONN__->prepare($sql);
		
		
		if($stmt->execute(array($id))) {
				
			Flash::set('success', 'Albumul a fost sters cu succes.');
			
		}
		else {
			
			Flash::set('error', 'Albumul nu a fost sters. O eroare neasteptata a intervenit.');
		}
		goto_plugin('galerie/index');
			
			
	}
	
	function populeaza_album() {
		
		$this->display('galerie/views/populeaza_album');	
		
	}
	
	function crop($numePoza) {
		
		$this->display('galerie/views/crop', array('numePoza' => $numePoza));
		
	}
	function imagine_noua($action = "") {
	
		
		
		if($action == "upload") {
			
			if(empty($_POST['numePoza']) OR empty($_POST['descrierePoza']) OR empty($_POST['codProdus'])) {
				
				Flash::set('error', 'Toate campurile sunt obligatorii');
				goto_plugin('galerie/imagine_noua');
				
			}
			/*
			if(!is_numeric($_POST['codProdus'])) {
				
				Flash::set('error', 'Valoarea campului <i>Cod produs</i> trebuie sa fie numerica.');
				goto_plugin('galerie/imagine_noua');
				
			}
			*/
			
			$numePoza = $_POST['numePoza'];
			$poza = $_FILES['poza']['name'];
			
			$_SESSION['numePoza'] = $numePoza;
			$_SESSION['descrierePoza'] = $_POST['descrierePoza'];
			$_SESSION['codProdus'] = $_POST['codProdus'];
			$_SESSION['albumPoza'] = (int) $_POST['idAlbum'];
			
			$renumePoza = strtolower(str_replace(" ", "_", $numePoza)).'.jpg';
			if(file_exists(UPLOAD.'/tmp/'.$renumePoza)) {
						Flash::set('error', 'Aceasta imagine este deja existenta in baza de date');
						goto_plugin('galerie/imagine_noua/upload');
				}
				else
				{
					 	$file = UPLOAD.'/tmp/'.$renumePoza;
						$orig_w = 700;
						
						$imageFile = $_FILES['poza']['tmp_name'];
					
						
						list($width, $height) = getimagesize($imageFile);
						
						$src = imagecreatefromjpeg($imageFile);
						$orig_h = ($height/$width)* $orig_w;
						
						$tmp = imagecreatetruecolor($orig_w, $orig_h);
						imagecopyresampled($tmp, $src, 0,0,0,0,$orig_w,$orig_h,$width,$height);
						imagejpeg($tmp, $file,100);
						
						imagedestroy($tmp);
						imagedestroy($src);
					  Flash::set('information', 'Selectati o portiune din imagine si apasati butonul Decupare.');
					  goto_plugin('galerie/crop/'.$renumePoza);
					
				}
				
		
		}
		$this->display('galerie/views/imagine_noua');
		
		
	}

	
	function upload() {
		
		$numePoza = $_POST['numePoza'];
		$codProdus = $_POST['codProdus'];
		$descrierePoza = $_POST['descrierePoza'];
		$poza = $_FILES['poza']['name'];
		$idAlbum = $_POST['idAlbum'];
		
		global $__CONN__;
		
		$sql = "SELECT * FROM galerie_album WHERE id = ?";
		
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($idAlbum));
		$album = $stmt->fetchObject();
		
		$numeAlbum = strtolower(str_replace(" ", "_", $album->nume));
		
		
		$renumePoza = strtolower(str_replace(" ", "_", $numePoza)).'.jpg';
			
	}
	
	
	function poze_album($id) {
		
		$this->display('galerie/views/poze_album', array('id' => $id));
		
	}
	
	function sterge_poza($id) {
		
		global $__CONN__;
		
		$sql = "SELECT fisier, album FROM galerie_poze WHERE id = ? ;";
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($id));
		
		$poza = $stmt->fetchObject();
		
		$fisier = $poza->fisier;
		
		$sql = "SELECT id, nume FROM galerie_album WHERE id = ? ;";
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($poza->album));
		
		$album = $stmt->fetchObject();
		
		$numeAlbum = strtolower(str_replace(" ", "_", $album->nume));
		$idAlbum = $album->id;
		unlink(UPLOAD.'/thumb/'.$numeAlbum.'/'.$fisier);
		unlink(UPLOAD.'/caption/'.$numeAlbum.'/'.$fisier);
		$sql = "DELETE FROM galerie_poze WHERE id = ?";
		
		$stmt = $__CONN__->prepare($sql);
		if(!$stmt->execute(array($id))) {
			Flash::set('error', 'Poza nu a fost stearsa. O eroare neasteptata a intervenit.');
			goto_plugin('galerie/poze_album/'.$idAlbum);
		}
		
		Flash::set('success', 'Poza a fost stearsa cu succes.');
		goto_plugin('galerie/poze_album/'.$idAlbum);
			
		
		
	}
	
	function editeaza_imagine($id) {
		
		$id = (int) $id;
		
		global $__CONN__;
		
		$sql = "SELECT * FROM galerie_poze WHERE id = ? ;";
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($id));
		$poza = $stmt->fetchObject();
		
		$this->display('galerie/views/editeaza_imagine', array(
					   'id' => $id,
					   'nume' => $poza->nume,
					   'cod_produs' => $poza->cod_produs,
					   'descriere' => $poza->descriere,
					   'albumid' => $poza->album));
	
	}
	
	function actualizeaza_imagine($id) {
		
		$id = (int) $id;
		$nume = $_POST['numePoza'];
		$numeVechi = $_POST['numeVechi'];
		$descriere = $_POST['descrierePoza'];
		$cod_produs = $_POST['codProdus'];
		$albumNou = $_POST['idAlbum'];
		$albumVechi = $_POST['albumVechi'];
		$numePoza = strtolower(str_replace(" ", "_", $nume));
		
		
		global $__CONN__;
		
		$sql = "SELECT nume FROM galerie_album WHERE id = ?";
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($albumNou));
		$album = $stmt->fetchObject();
	
		$numeAlbumNou = strtolower(str_replace(" ", "_", $album->nume));
		
		$sql = "SELECT nume FROM galerie_album WHERE id = ?";
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($albumVechi));
		$album = $stmt->fetchObject();
		
		$numeAlbumVechi = strtolower(str_replace(" ", "_", $album->nume));
		
		$adresaAlbumNouThumb = UPLOAD.'/thumb/'.$numeAlbumNou.'/'.$numePoza.'.jpg';
		$adresaAlbumNouCaption = UPLOAD.'/caption/'.$numeAlbumNou.'/'.$numePoza.'.jpg';
		
		$adresaAlbumVechiThumb = UPLOAD.'/thumb/'.$numeAlbumVechi.'/'.$numeVechi.'.jpg';
		$adresaAlbumVechiCaption = UPLOAD.'/caption/'.$numeAlbumVechi.'/'.$numeVechi.'.jpg';
		
		
		if($numeVechi != $numePoza OR $numeAlbumVechi != $numeAlbumNou) {
			if(!copy($adresaAlbumVechiThumb, $adresaAlbumNouThumb)) {
				Flash::set('error', 'Thumbnail-ul nu a fost copiat.');
				goto_plugin('galerie/editeaza_imagine/'.$id);
			}
			unlink($adresaAlbumVechiThumb);
			
			if(!copy($adresaAlbumVechiCaption, $adresaAlbumNouCaption)) {
				Flash::set('error', 'Caption-ul nu a fost copiat.');
				goto_plugin('galerie/editeaza_imagine/'.$id);
			}
			
			unlink($adresaAlbumVechiCaption);
		}
		
		$sql = "UPDATE galerie_poze SET nume = ? , cod_produs = ? , descriere = ? , fisier = ? , album = ? WHERE id = ? ;";
		$stmt = $__CONN__->prepare($sql);
			
				
			if($stmt->execute(array($nume, $cod_produs, $descriere, $numePoza.'.jpg', $albumNou, $id))) {
				
				Flash::set('success', 'Imaginea a fost actualizata cu succes.');
				if(!isset($_POST['salveazaPozaSiContinua']))
					goto_plugin('galerie/poze_album/'.$albumNou);
				else
					goto_plugin('galerie/editeaza_imagine/'.$id);
			}
			
			
	}

	
}