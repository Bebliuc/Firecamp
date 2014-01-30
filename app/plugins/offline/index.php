<?php


Plugin::setInfos(array(
    'id' => 'offline',
    'title' => 'Maintenance mode.',
    'author' => 'Bebliuc',
    'website' => 'http://bebliuc.ro',
    'version' => '1.0',
    'description' => 'Simple extendable maintenance mode.'
));

Behavior::add('maintenance', 'Maintenance page');

if (!user::logged()) {

    Observer::observe('system.execute', 'maintenance');

    if (!record::countFrom('setting', 'name = "maintenance"'))
        record::insert('setting', array(
            'name' => 'maintenance',
            'value' => '1'
        ));
   
    function maintenance()
    {
        if (green::segment(1) != "loginauth") {
            $page = record::findOneFrom('pages', 'behavior = ?', array(
                'maintenance'
            ));
            if ($page) {
                if(!class_exists('IndexController'))
                	AutoLoader::addFolder(array(APP_PATH.'/models/', APP_PATH.'/controllers/'));
                	
                	Indexcontroller::page($page->id);
               
            } else
                die("Website under maintenance.");
        }
    }
}