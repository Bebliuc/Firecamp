<?php
include 'config.php';

if('http://'.$domain.'/install/' != $_SERVER['HTTP_REFERER']) die('not allowed');
			
			$_sql = file_get_contents('templates/database.tpl');
			
			$stmt = $__CONN__->prepare($_sql);
			if($stmt->execute()) {
				header('Location: step3.php');
			}
echo 'Database connection error. Please contact Firecamp staff.';
		
?>