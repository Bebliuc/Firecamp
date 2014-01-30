<?php

class CatalogController extends PluginController {
    
    const TABLE_NAME = 'catalog';
	public $catalog;
	
	function __construct( )
	{
		# code...
	}
    
    function index() {
        $this->setLayout('admin/index');
        $this->display('catalog/views/index',array(
            'catalogs' => catalog::findAll(array('where' => 'category != 0')),
            'softwares' => catalog::findAll(array('where' => 'category = 0'))
        ));
        
    }
    
    function save() {
        $data = $_POST;
        $error = '';
        if(empty($data['name'])) $error .= 'Campul <b>Nume</b> este mandator<br />';
        if(empty($data['link'])) $error .= 'Campul <b>Link</b> este mandator<br />';
        if($data['category'] == 0) $error .= 'Campul <b>Categorie</b> este mandator<br />';
        if(record::insert('catalog', array('id' => NULL, 'name' => $data['name'], 'link' => $data['link'], 'category' => $data['category'])))
            Flash::set('success', 'Catalogul a fost adaugat cu succes.');
        else 
            Flash::set('error', 'Catalogul nu a fost adaugat. O eroare neasteptata a intervenit. P::catalog::save');
        
        go_to('plugin/catalog/index');    
    }
    function save_software() {
        $data = $_POST;
        $error = '';
        if(empty($data['name'])) $error .= 'Campul <b>Nume</b> este mandator<br />';
        if(empty($data['link'])) $error .= 'Campul <b>Link</b> este mandator<br />';
        if(record::insert('catalog', array('id' => NULL, 'name' => $data['name'], 'link' => $data['link'], 'category' => NULL)))
            Flash::set('success', 'Catalogul a fost adaugat cu succes.');
        else 
            Flash::set('error', 'Catalogul nu a fost adaugat. O eroare neasteptata a intervenit. P::catalog::save');
        
        go_to('plugin/catalog/index');    
    }
    
    function delete( $id ) {
    
        if(record::delete('catalog', 'id = ?', array( $id ))) 
            Flash::set('success', 'Catalogul a fost sters cu succes.');
        else
            Flash::set('error', 'Catalogul nu a fost sters. O eroare neasteptata a intervenit. P::catalog::delete');
           
        go_to('plugin/catalog/index');    
       
    }
    
}