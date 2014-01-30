<?php

	global $__CONN__;
	$sql = "

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `comment` text,
  `reservation` int(1) DEFAULT NULL,
  `transfer` int(1) DEFAULT NULL,
  `driver` int(1) DEFAULT NULL,
  `vehicle` int(1) DEFAULT NULL,
  `recommend` int(1) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Salvarea datelor din tabel `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `comment`, `reservation`, `transfer`, `driver`, `vehicle`, `recommend`, `date`, `status`) VALUES
(1, 'Mitchell Gorman Mr', 'Traffic was so bad we had to get out of the car and run and catch the tube to the airport after waiting in the car for 90 minutes. The driver said he would arrange a partial refund. But not anyones fault, just bad traffic.', 5, 5, 5, 5, 1, '02-03-2010 20:19', NULL),
(2, 'Gerard White Mr.', 'Second time to use this service. Minor problem at the airport as the driver was at the arrivals waiting for us but we missed him and headed for the information desk. Driver courteous and car was clean. I would recommend this service.', 4, 4, 4, 4, 1, '03-03-2010 10:58', 1);
";
	
	$stmt = $__CONN__->prepare($sql);
	$stmt->execute();
