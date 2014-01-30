<?php 


// get domain name

$domain = dirname($_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']);
$domain = str_replace('www.', '', $domain);
$domain = str_replace('http://', '', $domain);
$domain = str_replace('/install', '', $domain);

// get configuration from db

try {
    $_db = new PDO('mysql:dbname=fotomed_domains;host=localhost;port=3306;', 'fotomed_domains', 'b53017500c');
} catch (PDOException $e) {
    print "Firecamp MSM main configuration file is invalid or VPS down.";
    die();
}


$stmt = $_db->prepare("SELECT * FROM domains WHERE domain = ? OR subdomain = ?");
$stmt->execute(array($domain, $domain));

$cfg = $stmt->fetch(PDO::FETCH_OBJ);

if(!$cfg) {
	echo 'Domain is not registered with Firecamp.';
	die;
}


$_db = NULL;

$_public = $cfg->public;

define('DATA', 'mysql:dbname='.$cfg->mysql_database.';host=localhost;port=3306;');
define('USER', $cfg->mysql_username);
define('PASS', $cfg->mysql_password);

ini_set("memory_limit","12M");
ini_set('upload_max_filesize', 5242880);

try {
    $__CONN__ = new PDO(DATA, USER, PASS);
} catch (PDOException $e) {
    print "Firecamp MSM domain configuration file is invalid.";
    die();
}

if ($__CONN__->getAttribute(PDO::ATTR_DRIVER_NAME) == 'mysql')
    $__CONN__->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
$__CONN__->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
$__CONN__->setAttribute(PDO::ATTR_ORACLE_NULLS, true);


try {
	$__CONN__->query("SELECT id FROM pages");
	$is_installed = TRUE;
} catch (PDOException $e) {
	$is_installed = FALSE;
}
