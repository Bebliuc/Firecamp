<html>
<head>
<title><?php echo $GLOBALS['titlu_seo']; ?></title>
<meta name="description" content="<?php echo $GLOBALS['meta_descriere']; ?>" />
<meta name="keywords" content="<?php echo $GLOBALS['meta_keywords']; ?>" />

<link type="text/css" href="<?php echo BASE_URL; ?>app/layouts/css/backend.css" media="screen" rel="stylesheet" />
</head>
<body>
<?php Pagina::meniu(0,0); ?>
<?php echo $content_for_layout; ?>
</body>
</html>