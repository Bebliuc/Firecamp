<?php
Plugin::setInfos(array(
		'id' => 'evenimente',
		'title' => 'Aigrijademine.ro Evenimente',
		'author' => 'Bebliuc George',
		'website' => 'http://george.bebliuc.eu',
		'version' => '1.0',
		'description' => 'Evenimente CRUD.'));
		
Plugin::addController('evenimente', 'Ateliere');

Green::addRoute(array('ateliere/categorie/:num' => 'plugin/evenimente/view_events/$1'));
Green::addRoute(array('ateliere/categorie/:num/:any' => 'plugin/evenimente/view_event/$1/$2'));

Behavior::add('events', __('Ateliere'));
Behavior::add('event', __('Atelier'));

class Eveniment {
	
	public static function getName($id) {
		
		$cat = record::findOneFrom('e_categorii', 'id = ?', array($id));
		return $cat->nume;
		
	}
    
    public static function path( $image ) {
        
        return PUBLIC_URI.'/atelier/'.$image;
    }
    
}