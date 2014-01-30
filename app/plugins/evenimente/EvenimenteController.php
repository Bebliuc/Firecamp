<?php

class EvenimenteController extends PluginController {
	
	function __construct() {
		$this->setLayout('admin_v2/index');
		green::$watches['pageHeading'] = 'Ateliere';
		green::$watches['submenu'] = array(get_url('plugin/evenimente/index') => 'Ateliere',
										   get_url('plugin/evenimente/adauga') => 'Adauga atelier',
										   get_url('plugin/evenimente/categorii') => 'Categorii',
										   get_url('plugin/evenimente/adauga_categorie') => 'Adauga categorie');
	}
	
	function index() {
		$this->display('evenimente/views/index', array('events' => record::findAllFrom('evenimente')));
	}
	
	function adauga() {
        green::$watches['toggleSidebar'] = FALSE;
		$this->display('evenimente/views/adauga');
	}
	
	function salveaza() {
	   
		$event = $_POST['event'];
           
         
		if(empty($event['titlu'])) {
			Flash::set('error', 'Campul Titlu atelier este mandator.');
			redirect(get_url('plugin/evenimente/adauga'));
		}
		if(empty($event['data_inceput'])) {
			Flash::set('error', 'Campul Data inceput este mandator.');
			redirect(get_url('plugin/evenimente/adauga'));
		}
      
 		if(record::save('evenimente', $event))
			Flash::set('success', 'Atelierul a fost aaugat cu succes.');
		else
			Flash::set('error', 'Atelierul nu a fost adaugat.');
		
		redirect(get_url('plugin/evenimente/adauga'));
		
	}
	
	function adauga_categorie() {
		$this->display('evenimente/views/adauga_categorie');
	}
	
	function categorii() {
		
		$this->display('evenimente/views/categorii', array('categorii' => record::findAllFrom('e_categorii')));
		
	}
    
    function view_events( $category = '0' ) {
        
        $events = record::findAllFrom('evenimente', 'categorie = ?', array($category));
        $category = Record::findOneFrom('e_categorii', 'id = ?', array($category));
        $category = $category->nume;
        if(count($events) == 0) $GLOBALS['errmsg'] = '<p>Momentan nu exista ateliere in aceasta categorie.</p>';
	 else $GLOBALS['errmsg'] = NULL;
        $GLOBALS['events'] = $events;
        $GLOBALS['events_category'] = $category;
        
        $page = record::findOneFrom('pages', 'behavior = ? LIMIT 1', array('events'));
$id = $page->id;
	// verify if page exists 
		global $__CONN__;
		$sql = 'SELECT count(*) AS count FROM pages WHERE id = '.$id;
		$nRows = $__CONN__->query($sql)->fetchColumn(); 
		
		if(!$nRows) {
			//log error
			$logger = new Logger(__('404: Page not found at : <b>%url%</b>', array('%url' => green::getCurrentUrl())));
			$logger->log();
			
			$maintenance = new PluginController();
				$maintenance->setLayout('');
				$message = __(' 404: Page not found');
				$details = __(' What you are searching... is not here.');
				$maintenance->display('maintenance/html/index', array('message' => $message, 											      'details' => $details));
		}
		
		// Parse, parse, parse and SHAZAMMMMM
		$page = new Page($id);
		// set Page log		
		Observer::notify('page', $page->page);
		Observer::notify('frontend.page.init', $page->id);

		if($page->page->behavior != 'page')
			Observer::notify('behavior_'.$page->page->behavior, $page->page);
		$page->_executeLayout();
        
//indexcontroller::page($page->id);
        
    }
    
    function view_event( $category, $event ) {
        $event = record::findAllFrom('evenimente', 'categorie = ? AND titlu = ?', array($category, $event));
        $category = Record::findOneFrom('e_categorii', 'id = ?', array($category));
        $category = $category->nume;
        
        $GLOBALS['event'] = $event;
        $GLOBALS['events_category'] = $category;
        
        $page = record::findOneFrom('pages', 'behavior = ? LIMIT 1', array('event'));
        //indexcontroller::page($page->id);
	$id = $page->id;
	// verify if page exists 
		global $__CONN__;
		$sql = 'SELECT count(*) AS count FROM pages WHERE id = '.$id;
		$nRows = $__CONN__->query($sql)->fetchColumn(); 
		
		if(!$nRows) {
			//log error
			$logger = new Logger(__('404: Page not found at : <b>%url%</b>', array('%url' => green::getCurrentUrl())));
			$logger->log();
			
			$maintenance = new PluginController();
				$maintenance->setLayout('');
				$message = __(' 404: Page not found');
				$details = __(' What you are searching... is not here.');
				$maintenance->display('maintenance/html/index', array('message' => $message, 											      'details' => $details));
		}
		
		// Parse, parse, parse and SHAZAMMMMM
		$page = new Page($id);
		// set Page log		
		Observer::notify('page', $page->page);
		Observer::notify('frontend.page.init', $page->id);

		if($page->page->behavior != 'page')
			Observer::notify('behavior_'.$page->page->behavior, $page->page);
		$page->_executeLayout();
    }
    
    function c_salveaza() {
        $categorie = $_POST['cat'];
        if(record::save('e_categorii', $categorie))
            Flash::set('success', 'Categoria a fost adaugata cu succes.');
        else
            Flash::set('error', 'Categoria nu a fost salvata');
        redirect(get_url('plugin/evenimente/index')); 
    }
    
    function c_edit( $id ) {
        $categorie = record::findOneFrom('e_categorii', 'id = ?', array($id));
        $this->display('evenimente/views/c_edit', array('categorie' => $categorie, 'id' => $id));
    }
    
    function c_update() {
        $categorie = $_POST['cat'];
        var_dump($categorie);
        if(record::update('e_categorii', array('nume' => $categorie['nume']), $categorie['id'])) {
            Flash::set('success', 'Categoria a fost modificata cu succes.');
        }
        else
            Flash::set('error', 'Categoria nu a fost modificata.');
            
        redirect(get_url('plugin/evenimente/categorii'));
    }
    
    function c_delete( $id ) {
        if(record::delete('e_categorii', 'id = ?', array($id)))
            Flash::set('success', 'Categoria a fost stearsa cu succes.');
        else
            Flash::set('error', 'Categoria nu a fost stearsa.');
        redirect(get_url('plugin/evenimente/categorii'));
    }
    
    function delete($id) {
        if(record::delete('evenimente', 'id = ?', array($id)))
            Flash::set('success', 'Atelierul a fost sters cu succes.');
        else
            Flash::set('error', 'Atelierul nu a fost sters.');
        redirect(get_url('plugin/evenimente/index'));
    }
    
    function edit($id) {
        green::$watches['toggleSidebar'] = FALSE;
        $event = Record::findOneFrom('evenimente', 'id = ?', array($id));
        $this->display('evenimente/views/edit', array('event' => $event));
    }
    
    function update($id) {
        $event = $_POST['event'];
        
        if(record::update('evenimente', $event, $id))
            Flash::set('success', 'Atelierul a fost modificat cu succes.');
        else
            Flash::set('error', 'Atelierul nu a fost modificat.');
        
        redirect(get_url('plugin/evenimente/index'));
    }
	
}