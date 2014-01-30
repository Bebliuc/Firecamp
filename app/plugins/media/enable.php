<?php

	global $__CONN__;
	$sql = "
	CREATE TABLE `media_albums` (
		`id` INT( 10 ) NULL DEFAULT NULL AUTO_INCREMENT PRIMARY KEY ,
		`title` VARCHAR( 255 ) NULL DEFAULT NULL ,
		`type` VARCHAR( 10 ) NULL DEFAULT NULL
	) ENGINE = MYISAM ;
	
	CREATE TABLE `media_records` (
		`id` INT( 10 ) NULL DEFAULT NULL AUTO_INCREMENT PRIMARY KEY ,
		`title` VARCHAR( 255 ) NULL DEFAULT NULL ,
		`url` VARCHAR( 255 ) NULL DEFAULT NULL ,
		`album` INT( 10 ) NULL DEFAULT NULL
	) ENGINE = MYISAM ;
	";
	$stmt = $__CONN__->prepare($sql);
	$stmt->execute();
