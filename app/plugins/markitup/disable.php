<?php

	global $__CONN__;
	$sql = "
		DELETE FROM setting WHERE name = 'preview_style';
	";
	
	$stmt = $__CONN__->prepare($sql);
	$stmt->execute();
