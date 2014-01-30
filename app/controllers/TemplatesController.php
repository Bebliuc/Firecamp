<?php

/**

 * Firecamp

 *

 * @package		Firecamp

 * @author		Firecamp Team

 * @copyright	Copyright (c) 2010 - 2011, Bebliuc

 * @license		http://firecamp.ro/license

 * @link		http://firecamp.ro

 * @since		Version 1.0.01

 */



/**

 * TemplatesController

 *

 * @package		controllers

 * @author		Firecamp Team

 * @copyright	Copyright (c) 2010 - 2011, Bebliuc

 * @license		http://firecamp.ro/license

 * @link		http://firecamp.ro

 * @since		Version 1.0.01

 */



class TemplatesController extends Controller {

    

	function __construct() {

		

		Login::isLogged();

		$this->setLayout('admin_v2/index');

		green::$watches['submenu'] = array(

			get_url('templates/themes') => __('Themes'),

			get_url('templates/adauga_sablon') => __('Create template'),

			get_url('templates/index') => __('Templates'),

			get_url('templates/adauga_sectiune_sablon') => __('Create snippet'),

			get_url('templates/sectiuni_sablon') => __('Template snippets'),

			get_url('templates/add_group') => __('Create group')

		);

	}

	

	function test() {

		green::$watches['pageHeading'] = 'Templates new layout';

		green::$watches['toggleSidebar'] = FALSE;

		$this->display('templates/index');

	}

	

	function index() {

		green::$watches['toggleSidebar'] = FALSE;

		green::$watches['pageHeading'] = __('Templates');

		$this->display('templates/new_index');	

		

	}

	

	function editeaza($id) {

		green::$watches['pageHeading'] = __('Edit template');

		green::$watches['toggleSidebar'] = FALSE;

		$id = (int) $id;

		$this->display('templates/editeaza', array('id' => $id));

		

	}

	

	function sectiuni_sablon() {

		green::$watches['pageHeading'] = __('Templates snippets');

		$this->display('templates/sectiuni_sablon');

		

	}

	

	function adauga_sectiune_sablon() {

		green::$watches['toggleSidebar'] = FALSE;
		green::$watches['pageHeading'] = __('Add new snippet');
		$this->display('templates/adauga_sectiune_sablon');

		

	}

	

	function salveaza_sectiune() {

		

		if($_POST['numeSectiune'] == "") {

			Flash::set('error', __('Campul <b>Nume sectiune</b> este mandator.'));

			go_to('templates/editeaza_sectiune/'.$id);

		}

		if($_POST['continutSectiune'] == "") {

			Flash::set('error', __('Campul <b>Continut sectiune</b> este mandator.'));

			go_to('templates/editeaza_sectiune/'.$id);

		}

		

		$data = array('id' => NULL, 'name' => $_POST['numeSectiune'], 'continut' => $_POST['continutSectiune']);

		if(Template::_save_part($data)) {

			Flash::set('success', __('Sectiunea a fost adaugata cu succes.'));

			go_to('templates/sectiuni_sablon');

		}

		Flash::set('error', __('Sectiunea nu a fost adaugata.'));

		go_to('templates/adauga_sectiune_sablon');

		

	}

	

	function editeaza_sectiune($id) {

		green::$watches['pageHeading'] = __('Edit snippet');

		green::$watches['toggleSidebar'] = FALSE;

		$id = (int) $id;

		$this->display('templates/editeaza_sectiune', array('id' => $id));

		

	}

	

	function update_sectiune($id) {

		

		$id = (int) $id;

		

			if($_POST['numeSectiune'] == "") {

				Flash::set('error', __('Campul <b>Nume sectiune</b> este mandator.'));

				go_to('templates/editeaza_sectiune/'.$id);

			}

			if($_POST['continutSectiune'] == "") {

				Flash::set('error', __('Campul <b>Continut sectiune</b> este mandator.'));

				go_to('templates/editeaza_sectiune/'.$id);

			}

			

		$data = array('name' => $_POST['numeSectiune'], 'content' => $_POST['continutSectiune']);

		

		if(Template::_update_part($data, $id)) {

			Flash::set('success', __('Sectiunea a fost actualizata cu succes.'));

			go_to('templates/sectiuni_sablon');

		}

		Flash::set('error', __('Sectiunea nu a fost actualizata cu succes.')).

		go_to('templates/editeaza_sectiune/'.$id);

	}

	

	function delete_sectiune($id) {

		

		$id = (int) $id;

		

		if(Template::_delete_part($id)) {

			Flash::set('success', __('Sectiunea a fost stearsa cu succes.'));

		}

		else {

			Flash::set('error', __('Sectinuea nu a fost stearsa.'));

		}

		go_to('templates/sectiuni_sablon');

		

	}

	

	function themes() {

		

		$this->display('templates/list', array('themes', Template::getThemes()));

		

	}

	

	function install($theme_id) {

		

		Template::getThemes();

		$theme_dir = Template::$themes[$theme_id]['path'];

		$parts = array_slice(scandir($theme_dir.'/parts'), 2);

		$layouts = array_slice(scandir($theme_dir.'/layouts'), 2);

		//$snippets = array_diff(scandir($theme_dir.'/parts'), array('.', '..'));

		

		$_parts = array();

		$_layouts = array();

		

		foreach($parts as $part):

			$_parts[] = Template::makeName($part);

			$content = file_get_contents($theme_dir.'/parts/'.$part);

			if(!Template::isUnique(Template::makeName($part))) {

				Flash::set('error', 'Sectiunea de sablon '.Template::makeName($part).' este deja existenta in baza de date.');

				go_to('templates/themes');

			}

			$data = array('id' => NULL, 'name' => Template::makeName($part), 'content' => $content);

			Record::save('templates_parts', $data);

		endforeach;

		

		foreach($layouts as $layout):

			$_layouts[] = Template::makeName($layout);

			$content = file_get_contents($theme_dir.'/layouts/'.$layout);

			if(!Template::isUnique(Template::makeName($layout))) {

				Flash::set('error', 'Sablonul '.Template::makeName($layout).' este deja existent in baza de date.');

				go_to('templates/themes');

			}

			$data = array('id' => NULL, 'nume' => Template::makeName($layout), 'tip' => 'text/html', 'continut' => $content);

			Record::save('templates', $data);

		endforeach;

		

		$datas['layouts'] = serialize($_layouts);

		$datas['parts'] = serialize($_parts);

		

		$data = array('id' => NULL, 'name' => Template::$themes[$theme_id]['id'], 'layouts' => $datas['layouts'], 'parts' => $datas['parts']);

		if(Record::save('templates_themes', $data))

			Flash::set('success', 'Sablonul a fost instalat cu succes.');

		else

			Flash::set('error', 'Sablonul nu a fost instalat.');

		go_to('templates/themes');

		

	}

	

	function uninstall($theme_id) {

		

		Template::getThemes();

		

		$theme = Record::findOneFrom('templates_themes', 'name = ?', array($theme_id));

		

		$parts = unserialize($theme->parts);

		$layouts = unserialize($theme->layouts);

		

		foreach($parts as $part):

			if(!Record::delete('templates_parts', 'name = ?', array($part))) {

				Flash::set('error', 'Sectiunea de sablon <i>'.$part.'</i> nu a fost stearsa.');

				go_to('templates/themes');

			}

		endforeach;

		

		foreach($layouts as $layout):

			if(!Record::delete('templates', 'nume = ?', array($layout))) {

				FLash::set('error', 'Sablonul <i>'.$layout.'</i> nu a fost sters.');

				go_to('templates/themes');

			}

		endforeach;

	

		if(!Record::delete('templates_themes', 'name = ?', array($theme_id))) {

			Flash::set('error', 'Sablonul nu a fost dezinstalat.');

		}

		Flash::set('success', 'Sablonul a fost dezinstalat cu succes.');

		go_to('templates/themes');

		

	}

	

	function salveaza_editare($id) {



		$id = (int) $id;

		

		$nume = $_POST['numeSablon'];

		$tip = $_POST['tipSablon'];

		$continut = $_POST['continutSablon'];

		

		if(empty($nume))

			Flash::set('error', __('Campul <i>Nume</i> este obligatoriu.'));

		if(empty($tip))

			Flash::set('error', __('Campul <i>Tip</i> este obligatoriu.'));

		if(empty($continut))

			Flash::set('error', __('Campul <i>Continut</i> este obligatoriu.'));

		if(empty($nume) OR empty($tip) OR empty($continut))

			go_to('templates/editeaza/'.$id);

		

		$sql = "UPDATE templates SET nume = ? ,tip = ? , continut = ? WHERE id = ? ;";

		

		global $__CONN__;

		

		$stmt = $__CONN__->prepare($sql);

		if(!$stmt->execute(array($nume, $tip, $continut, $id))) {

		

			Flash::set('error', __('Sablonul nu a fost modificat. O eroare neasteptata a intervenit.'));

			Observer::notify('edit.template.fail', $id);

			go_to('templates/editeaza/'.$id);

			

		}

		

		Flash::set('success', __('Sablonul a fost modificat cu succes.'));

		Observer::notify('edit.template.success', $id);

		if(isset($_POST['continua']))

			go_to('templates/editeaza/'.$id);

		

		go_to('templates/index');

			

		

	}

	

	function adauga_sablon() {

		green::$watches['pageHeading'] = __('Add new template');

		green::$watches['toggleSidebar'] = FALSE;

		$this->display('templates/adauga_sablon');	

	}

	

	function salveaza() {



		$nume = $_POST['numeSablon'];

		$tip = $_POST['tipSablon'];

		$continut = $_POST['continutSablon'];

		$notes = $_POST['notes'];

		$group = $_POST['tgroup'];

		$compress = 0;

		

		$tidy = 0;

		

		

		if(empty($nume))

			Flash::set('error', __('Campul <i>Nume</i> este obligatoriu.'));

		if(empty($tip))

			Flash::set('error', __('Campul <i>Tip</i> este obligatoriu.'));

		if(empty($continut))

			Flash::set('error', __('Campul <i>Continut</i> este obligatoriu.'));

		if(empty($nume) OR empty($tip) OR empty($continut))

			go_to('templates/adauga_sablon');

		

		$sql = "INSERT INTO templates VALUES(NULL, ?, ?, ?, ?, ?, ?, ?); ";

		

		global $__CONN__;

		

		$stmt = $__CONN__->prepare($sql);

		if(!$stmt->execute(array($nume, $tip, $continut, $notes, $compress, $tidy, $group))) { 

			Flash::set('error', __('Sablonul nu a fost adaugat.'));

			Observer::notify('save.template.fail'); }

		else {

			Flash::set('success', __('Sablonul a fost adaugat cu succes.'));

			Observer::notify('save.template.success');

		}

		go_to('templates/index');

		

	}

	

	function sterge($id) {

		

		$id = (int) $id;

		

		$sql = "DELETE FROM templates WHERE id = ? ;";

		

		global $__CONN__;

		

		$stmt = $__CONN__->prepare($sql);

		if(!$stmt->execute(array($id))) {

			Flash::set('error', __('Sablonul nu a fost sters.'));

			Observer::notify('delete.template.fail', $id);

		}

		else {

			Flash::set('success', __('Sablonul a fost sters cu succes.'));

			Observer::notify('delete.template.success', $id);

		}

		go_to('templates/index');	

	}

	

	// TEMPLATE GROUPS //

	// added on 21.01.2011 for the new v1.2 //

	

	function add_group() {

		green::$watches['pageHeading'] = 'Create template group';

		green::$watches['toggleSidebar'] = TRUE;

		

		$this->display('templates/add_group');

	}

	

	function create_group() {

		if(empty($_POST['group']['name'])) {

			Flash::set('error', __('The <i>Group name</i> field is mandatory.'));		

			go_to('templates/add_group');

		}

		else {

			$group = $_POST['group'];

			if(record::save('templates_groups', array('id' => NULL, 'name' => $group['name'])))

				Flash::set('success', __('A new template group has been created with the name %name% .', array('%name%' => $group['name'])));

			else

				Flash::set('error', __('The group could not be created. Please contact the website administrator and provide the following code : Templates::ag'));

			

			go_to('templates/index');

		}

	}

	

	function ajax_fetch( $id ) {

		$template = record::findOneFrom('templates', 'id = ?', array($id));

		echo json_encode(array('name' => $template->nume, 'content' => $template->continut, 'type' => $template->tip, 'notes' => $template->notes, 'compress' => $template->compress, 'tidy' => $template->tidy));

	}

	

	function get_data( $id ) {

		$t = $_POST;



		$data = array(

			'id' => $id,

			'nume' => $t['title'],

			'tip' => $t['type'],

			'continut' => $t['content'],

			'notes' => $t['notes'],

			'compress' => $t['compress'],

			'tidy' => $t['tidy']

		);

		

		if(record::update('templates', $data, $id)) echo 1;

		else echo 0;

	}

}