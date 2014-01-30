<?php

	global $__CONN__;
	$sql = "
CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text,
  `answer` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Salvarea datelor din tabel `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`) VALUES
(1, '406 Not Acceptable - Primesc aceasta eroare pe site', 'Pentru a afla exact de unde provine problema si a primi asistenta in rezolvarea acesteia va rugam contactati departamentul tehnic prin tiket de suport');
";
	
	$stmt = $__CONN__->prepare($sql);
	$stmt->execute();
