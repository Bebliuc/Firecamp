<?php

class PaginaController extends Controller 
{
	
	function __construct() {
		
			$this->setLayout('backend/backend');
		
	}
	
	function root() {
	
		$this->display('plugins/index');
	
	}
	
	function index() {
		
		$this->display('pagina/index');
		
	}
	function adauga_pagina()
	{	
			 
		$this->display('pagina/adauga_pagina');
		
	}
	
	function detalii($id) {
	
		$sql = "SELECT * FROM galerie_poze WHERE id = ?";
		global $__CONN__;
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($id));
		$poza = $stmt->fetchObject();
		$text = "Detalii ".$poza->cod_produs;
		echo '
		<div style="background-color: #FFF; height: 350px; width: 550px; padding: 15px; color: white; font-size: 10px">
			'.Image::textalb($text).'
			<div id="note"></div> 
			<div id="stylized" class="myform">
			<form id="form1" name="form1" method="post" action="http://aralia.ro/pagina/trimite">
   				<label>Solicitant
        		<span class="small">Numele si prenumele dumneavoastra.</span>
    			</label>
    			<input type="text" name="solicitant" id="textfield" />
    			<label>Telefon
    			<span class="small">Numarul dumneavoastra de telefon.</span>
    			</label>
    			<input type="text" name="telefon" id="textfield" />
    			<label>Email
        		<span class="small">Adresa email valida.</span>
    			</label>
    			<input type="text" name="email" id="textfield" />
    			<label>Mesaj
        		<span class="small">Detalii legate de solicitarea dumneavoastra.</span>
    			</label>
   				<textarea name="mesaj"></textarea>
   				<input type="hidden" value="'.$poza->cod_produs.'" name="poza" />
    			<div style="clear:both;"> <div>
    			<button type="submit">Trimite</button>
    			<button onclick="Boxy.get(this).hide(); return false"  style="margin-left: 5px;">Anuleaza</button>
    			<div class="spacer"></div>
  			</form>
			</div>
		</div>
				';
	
	}

	function contact_trimite() {
	
		if(empty($_POST['nume']) OR empty($_POST['telefon']) OR empty($_POST['email']) OR empty($_POST['mesaj'])) {
		
			header('Location: http://aralia.ro/contact');
			
		}
		
		$param = array('from' => 'formular@aralia.ro',
				   'to' => 'best_doc_4_u@yahoo.com',
				   'subject' => 'Aralia.ro Formular de contact',
				   'nume' => $_POST['nume'],
				   'telefon' => $_POST['telefon'],
				   'email' => $_POST['email'],
				   'mesaj' => $_POST['mesaj']);

		
	
		$sendmail = new Email();
		$sendmail->set('html', true);
		$sendmail->getParams($param);
		$sendmail->parseBody();
		$sendmail->setHeaders();
		$sendmail->send();
		header('Location: http://aralia.ro/contact');
	
	
	}
	function formular_trimite($id) {
	
		$sql = "SELECT * FROM galerie_poze WHERE id = ?";
		global $__CONN__;
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($id));
		$poza = $stmt->fetchObject();
		$text = "Detalii ".$poza->cod_produs;
		echo '
		<div style="background-color: #FFF; height: 450px; width: 550px; padding: 15px; color: white; font-size: 10px">
			'.Image::textalb($text).'
			<div id="note"></div> 
			<div id="stylized" class="myform">
			<form id="form1" name="form1" method="post" action="http://aralia.ro/pagina/trimite2">
   				<label>Solicitant
        		<span class="small">Numele si prenumele dumneavoastra.</span>
    			</label>
    			<input type="text" name="solicitant" id="textfield" />
    			<label>Telefon
    			<span class="small">Numarul dumneavoastra de telefon.</span>
    			</label>
    			<input type="text" name="telefon" id="textfield" />
    			<label>Email
        		<span class="small">Adresa email valida.</span>
    			</label>
    			<input type="text" name="email" id="textfield" />
    			<label>Adresa
        		<span class="small">Adresa de livrare a produsului.</span>
    			</label>
    			<input type="text" name="adresa" id="textfield" />
    			<label>Mesaj
        		<span class="small">Detalii legate de solicitarea dumneavoastra.</span>
    			</label>
   				<textarea name="mesaj"></textarea>
   				<label><a href="http://aralia.ro/termeni_si_conditii" target="_BLANK">Termeni si conditii</a>
        		<span class="small">Sunt de accord.</span>
    			</label>
				<input type="checkbox" value="da" name="termeni" id="textfield" />
    			<input type="hidden" value="'.$poza->cod_produs.'" name="poza" />
    			<div style="clear:both;"> <div>
    			<button type="submit">Trimite</button>
    			<button onclick="Boxy.get(this).hide(); return false"  style="margin-left: 5px;">Anuleaza</button>
    			<div class="spacer"></div>
  			</form>
			</div>
		</div>
				';
	
	}
	
	function trimite() {
	
		if(empty($_POST['solicitant']) OR empty($_POST['telefon']) OR empty($_POST['email']) OR empty($_POST['mesaj'])) {
		
			header('Location: http://aralia.ro/trimite_flori');
			
		}
		
		$param = array('from' => 'formular@aralia.ro',
				   'to' => 'best_doc_4_u@yahoo.com',
				   'subject' => 'Aralia.ro Solicitare detalii',
				   'solicitant' => $_POST['solicitant'],
				   'telefon' => $_POST['telefon'],
				   'email' => $_POST['email'],
				   'cod produs ' => $_POST['poza'],
				   'mesaj' => $_POST['mesaj']);

		
	
		$sendmail = new Email();
		$sendmail->set('html', true);
		$sendmail->getParams($param);
		$sendmail->parseBody();
		$sendmail->setHeaders();
		$sendmail->send();
		header('Location: http://aralia.ro/trimite_flori');
	}
	
	function trimite2() {
	
		if(empty($_POST['solicitant']) OR empty($_POST['telefon']) OR empty($_POST['email']) OR empty($_POST['mesaj']) OR $_POST['termeni'] != "da") {
		
			header('Location: http://aralia.ro/trimite_flori');
			
		}
		
		$param = array('from' => 'formular@aralia.ro',
				   'to' => 'best_doc_4_u@yahoo.com',
				   'subject' => 'Aralia.ro Comanda noua',
				   'solicitant' => $_POST['solicitant'],
				   'telefon' => $_POST['telefon'],
				   'email' => $_POST['email'],
				   'adresa' => $_POST['adresa'],
				   'cod produs ' => $_POST['poza'],
				   'mesaj' => $_POST['mesaj']);

		
	
		$sendmail = new Email();
		$sendmail->set('html', true);
		$sendmail->getParams($param);
		$sendmail->parseBody();
		$sendmail->setHeaders();
		$sendmail->send();
		header('Location: http://aralia.ro/trimite_flori');
	}
	
	function salveaza_pagina($id = NULL) {
		
		global $__CONN__;
		
		$pagina = $_POST['pagina'];
		
		$titlu = htmlentities($pagina['titlu'], ENT_QUOTES);
		$url = htmlentities(strtolower(str_replace(" ", "_", $pagina['url'])), ENT_QUOTES);
		$continut = htmlentities($pagina['continut'], ENT_QUOTES);
		$titlu_seo = htmlentities($pagina['titlu_seo'], ENT_QUOTES);
		$meta_descriere = htmlentities($pagina['meta_descriere'], ENT_QUOTES);
		$meta_keywords = htmlentities($pagina['meta_keywords'], ENT_QUOTES);
		$template = $pagina['template'];
		$galerie = $pagina['galerie'];
		
		if(empty($id)) 
		{
			$parent = (int) htmlentities($pagina['parent'], ENT_QUOTES);
		
			$sql = "SELECT nume_pagina FROM pagini WHERE id = ? LIMIT 1";
			$stmt = $__CONN__->prepare($sql);
			$stmt->execute(array($parent));
			$query = $stmt->fetchObject();
			$parent_name = $query->nume_pagina;
		
			$data_initiala = date("F j, Y, g:i a");
		}
		$data_modificare = date("F j, Y, g:i a");
		if(empty($id))
		{
			$sql = "INSERT INTO pagini VALUES (NULL, '{$titlu}', '{$url}', '{$continut}', '{$titlu_seo}', '{$meta_descriere}', '{$meta_keywords}', '{$parent}', '{$parent_name}', '{$data_initiala}', '{$data_modificare}', '{$template}', '{$galerie}'); ";
		}
		else
		{
			$sql = "UPDATE pagini SET nume_pagina = '{$titlu}', url_pagina = '{$url}', continut_pagina = '{$continut}', titlu_seo = '{$titlu_seo}', descriere_meta = '{$meta_descriere}', keyword_meta = '{$meta_keywords}', data_modificare = '{$data_modificare}', template = '{$template}', galerie_id = '{$galerie}' WHERE id = {$id} ; ";
		}
		if(empty($titlu) OR empty($url) OR empty($continut) OR empty($meta_descriere) OR empty($meta_keywords)) 
		{
			Flash::set('error', 'Toate campurile sunt obligatorii. Va rugam verificati datele introduse');
			if(!empty($id)) {
				redirect(get_url('pagina/editeaza_pagina/'.$id));
			}
			redirect(get_url('pagina/adauga_pagina'));
		}
		else 
		{
			
			$stmt = $__CONN__->prepare($sql);
			
			if($stmt->execute()) 
			{
				if(empty($id))
				{
					Flash::set('success', 'Pagina a fost adaugata cu succes.');
					Observer::notify('add.page.success', $id);
				}
				else
				{
					Flash::set('success', 'Pagina a fost modificata cu succes.');
					Observer::notify('edit.page.success', $id);
				}
				if(!isset($_POST['continua']))
					redirect(get_url('admin/index'));
				
				redirect(get_url('pagina/editeaza_pagina/'.$id));
				
			}
			else 
			{
				if(empty($id))
				{
					Flash::set('error', 'Pagina nu a fost adaugata. Va rugam sa verificati datele introduse.');
					Observer::notify('add.page.fail', $id);
					redirect(get_url('admin/adauga_pagina'));
				}
				else {
					Flash::set('error', 'Pagina nu a fost editata. Va rugam sa verificati datele introduse.');
					Observer::notify('edit.page.fail', $id);
					redirect(get_url('admin/editeaza_pagina/'.$id));
				}
			}
		} 
		
	}
	
	function editeaza_pagina($id)
	{
		global $__CONN__;
		
		$sql = "SELECT * FROM pagini WHERE id = ? LIMIT 1";
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($id));
		$date = $stmt->fetchObject();
		
		$nume_pagina = $date->nume_pagina;
		$url_pagina = $date->url_pagina;
		$continut_pagina = $date->continut_pagina;
		$titlu_seo = $date->titlu_seo;
		$descriere_meta = $date->descriere_meta;
		$keyword_meta = $date->keyword_meta;
		$parent_id = $date->parent_id;
		$parent_name = $date->parent_name;
		$template = $date->template;
		$galerie = $date->galerie_id;
		
		$this->display('pagina/editeaza_pagina', array(
												'id' => $id,
												'nume_pagina' => $nume_pagina,
												'url_pagina' => $url_pagina,
												'continut_pagina' => $continut_pagina,
												'titlu_seo' => $titlu_seo,
												'descriere_meta' => $descriere_meta,
												'keyword_meta' => $keyword_meta,
												'parent_id' => $parent_id,
												'parent_name' => $parent_name,
												'template_id' => $template,
												'galerie_id' => $galerie)
					   );
												
		
	}
	
	function sterge_pagina($id)
	{
		global $__CONN__;
		$sql = "SELECT nume_pagina FROM pagini WHERE id = ? LIMIT 1";
		$stm = $__CONN__->prepare($sql);
		$stm->execute(array($id));
		$pagina = $stm->fetchObject();
		$nume_pagina = $pagina->nume_pagina;
		
		$sql = "DELETE FROM pagini WHERE id = ? ORDER BY id LIMIT 1";
		$stmt = $__CONN__->prepare($sql);
		if($stmt->execute(array($id))) 
		{
			Flash::set('success', 'Pagina <b>'.$nume_pagina.'</b> a fost stearsa cu succes.');
			redirect(get_url('pagina/index'));
			Observer::notify('delete.page.success', $id);
		}
		else
		{
			Flash::set('error', 'Pagina <b>'.$nume_pagina.'</b> nu a fost gasita.');
			redirect(get_url('pagina/index'));
			Observer::notify('delete.page.fail', $id);
		}
	}
}