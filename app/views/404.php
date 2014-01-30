<?php
error_reporting(0);

	$ip = getenv ("REMOTE_ADDR");				// IP Address
	$server_name = getenv ("SERVER_NAME");		// Server Name
	$request_uri = getenv ("REQUEST_URI");		// Requested URI
	$http_ref = getenv ("HTTP_REFERER");		// HTTP Referer
	$http_agent = getenv ("HTTP_USER_AGENT");	// User Agent
	$error_date = date("D M j Y g:i:s a T");	// Error Date
	$text = "
	<b>IP : </b> ".$ip."<br />
	<b>Server Name : </b> ".$server_name."<br />
	<b>Request URI : </b> ".$request_uri."<br />
	<b>Referrer : </b> ".$http_ref."<br />
	<b>Http agent: </b> ".$http_agent."<br />
	<b>Error date: </b> ".$error_date;
	$param = array('from' => 'Aralia.ro 404 Error',
				   'to' => 'debug@bebliuc.ro',
				   'cc' => 'bdesign2007@yahoo.com',
				   'bcc' => 'bebliuc@yahoo.com',
				   'text' => $text);

	use_helper('email');
	
	$sendmail = new sendMail();
	$sendmail->set(html, true);
	$sendmail->getParams($param);
	$sendmail->parseBody();
	$sendmail->setHeaders();
	$sendmail->send();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
<title>404 Not Found - Pagina ceruta nu exista..</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<link type="text/css" href="<?php echo BASE_URL; ?>app/layouts/404/styles.css" media="screen" rel="stylesheet" />
</head>

<body>
	<div id="wrapper">
		<img src="<?php echo BASE_URL; ?>app/layouts/404/oops.jpg" alt="404 Error Oops!" title="404 Error Oops!" />
		<h1 class="loud">Pagina ceruta nu exista.</h1>
		<p class="loud">Administratorul site-ul a fost anuntat de aceasta eroare. In cazul unei eroari in sistem, aceasta va fi remediata cat de curand posibil.</p>
		<p class="small">Cateva sfaturi pentru a gasii ceea ce cautati.</p>
		<ol>
			<li><span>Verificati adresa introdusa, in cazul unor greseli gramaticale.</span></li>
			<li><span>Intoarcetiva la pagina principala a siteului.</span></li>
			<li><span>Verificati o <a href="#">harta</a> a site-ului.</span></li>
		</ol>
        <?php
		global $__CONN__;
		$sql = "SELECT nume_pagina, url_pagina FROM pagini WHERE parent_id = 0";
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute();
		?>
		<ul>
			<?php 
			while($pagina = $stmt->fetchObject()) { ?>
            <li><a href="<?php echo BASE_URL.$pagina->url_pagina; ?>"><?php echo $pagina->nume_pagina; ?></a></li>
			<?php } ?>
			<li class="last"><a href="http://bebliuc.ro/">Bebliuc</a></li>
		</ul>
	</div>
</body>
</html>
