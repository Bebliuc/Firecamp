<?php 

define('DATA', 'mysql:dbname={database};host={localhost};port={port};');
define('USER', '{username}');
define('PASS', '{password}');

ini_set("memory_limit","12M");
ini_set('upload_max_filesize', 5242880);

$__CONN__ = new PDO(DATA, USER, PASS);
if ($__CONN__->getAttribute(PDO::ATTR_DRIVER_NAME) == 'mysql')
    $__CONN__->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
$__CONN__->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
$__CONN__->setAttribute(PDO::ATTR_ORACLE_NULLS, true);