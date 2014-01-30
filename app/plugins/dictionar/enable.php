<?php

	global $__CONN__;
	$sql = "
CREATE TABLE IF NOT EXISTS `dictionar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cuvant` varchar(255) DEFAULT NULL,
  `definitie` varchar(255) DEFAULT NULL,
  `categorie` varchar(255) DEFAULT NULL,
  `altele` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
";
	
	$stmt = $__CONN__->prepare($sql);
	$stmt->execute();
