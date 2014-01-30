<?php

	global $__CONN__;
	$sql = "
	DROP TABLE comments;
	DELETE FROM setting WHERE name = 'akismet_api';
	";
	
	$stmt = $__CONN__->prepare($sql);
	$stmt->execute();
