<?php

	global $__CONN__;
	
	
	
	$sql = "CREATE TABLE IF NOT EXISTS galerie_album (
				  id int(20) NOT NULL AUTO_INCREMENT,
				  nume varchar(255) DEFAULT NULL,
				  categorie int(20) DEFAULT NULL,
				  PRIMARY KEY (id)
				) ENGINE=MyISAM AUTO_INCREMENT=19 ;
				
			CREATE TABLE IF NOT EXISTS `galerie_categorii` (
				  `id` int(50) NOT NULL AUTO_INCREMENT,
				  `nume` varchar(255) DEFAULT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;
			CREATE TABLE IF NOT EXISTS `galerie_poze` (
				  `id` int(20) NOT NULL AUTO_INCREMENT,
				  `nume` varchar(255) DEFAULT NULL,
				  `cod_produs` varchar(255) DEFAULT NULL,
				  `descriere` char(255) DEFAULT NULL,
				  `fisier` varchar(255) DEFAULT NULL,
				  `album` int(20) DEFAULT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;";
				
	$stmt = $__CONN__->prepare($sql);
	
	if(!$stmt->execute()) {
		
		Flash::set('error', 'Pluginul <b>Galerie</b> nu a fost activat cu succes.');
		
	}
