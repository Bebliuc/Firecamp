<?php

	global $__CONN__;
	$sql = "
CREATE TABLE IF NOT EXISTS `links` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Salvarea datelor din tabel `links`
--

INSERT INTO `links` (`id`, `category`, `title`, `link`, `description`) VALUES
(1, 'Hotels / Accomodation', 'Bali hotel, Bali villa, Tour, Vacation Guide', 'http://www.balistay.com/', ' Bali hotel, Bali villa and vacation guide - Balistay.com provide best bali hotel and villa with discounted rates. '),
(2, 'Hotels / Accomodation', 'Special Rate Los Angeles Lodging from all top chains: Howard Johnson, Ramada Inn, Hilton', 'http://los-angeles-hotels.travelwand.com/', ' Easy & secure online booking engine for hotels in Los Angeles. Our special rates are up to 70% off both budget and luxury accommodation.  Plus an ever growing Los Angeles travel guide with great vacation ideas including popular attractions, tours, museums and entertainment information');
";
	
	$stmt = $__CONN__->prepare($sql);
	$stmt->execute();
