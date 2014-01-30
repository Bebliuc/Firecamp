<?php

	global $__CONN__;
	$sql = "
	DROP TABLE IF EXISTS dictionar;
";
	
	$stmt = $__CONN__->prepare($sql);
	$stmt->execute();
