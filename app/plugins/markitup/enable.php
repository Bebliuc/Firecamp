<?php

	global $__CONN__;
	$sql = "
		INSERT INTO `setting` (`name`,`value`)
		VALUES
			('preview_style', 'http://path.to.style');
	";
	
	$stmt = $__CONN__->prepare($sql);
	$stmt->execute();
