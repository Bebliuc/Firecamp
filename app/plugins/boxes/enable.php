<?php

	global $__CONN__;
	$sql = "
CREATE TABLE IF NOT EXISTS `boxes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `page_id` tinytext,
  `type` varchar(255) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Salvarea datelor din tabel `boxes`
--

INSERT INTO `boxes` (`id`, `title`, `content`, `page_id`, `type`) VALUES
(1, 'Featuredsdadas', '<b>Bold text</b><i>Italic text</i> Bla bladadas', NULL, NULL);
";
	
	$stmt = $__CONN__->prepare($sql);
	$stmt->execute();
