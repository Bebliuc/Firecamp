<?php

	global $__CONN__;
	$sql = "
	CREATE TABLE `comments` (
	  `id` int(12) NOT NULL AUTO_INCREMENT,
	  `author` varchar(128) DEFAULT NULL,
	  `email` varchar(128) DEFAULT NULL,
	  `website` varchar(128) DEFAULT NULL,
	  `content` text,
	  `ip` varchar(128) DEFAULT NULL,
	  `date` varchar(128) DEFAULT NULL,
	  `page_id` int(12) DEFAULT NULL,
	  `status` int(3) DEFAULT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
	
		INSERT INTO `setting` (`name`,`value`)
		VALUES
			('akismet_api', '34a2509b6fa3');
	";
	
	$stmt = $__CONN__->prepare($sql);
	$stmt->execute();
