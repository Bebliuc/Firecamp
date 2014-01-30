# Host: localhost (MySQL 5.1.44)
# Database: aperture
# Generation Time: 2011-04-22 19:21:51 +0300
# ************************************************************

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table admin_menu
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin_menu`;

CREATE TABLE `admin_menu` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `nume` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `controller` varchar(20) DEFAULT NULL,
  `controller_base` varchar(20) DEFAULT NULL,
  `weight` int(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

LOCK TABLES `admin_menu` WRITE;
/*!40000 ALTER TABLE `admin_menu` DISABLE KEYS */;
INSERT INTO `admin_menu` (`id`,`nume`,`url`,`controller`,`controller_base`,`weight`)
VALUES
	(25,'Pages','pages/index','pages',NULL,2),
	(11,'Add button','nav/adauga_nav','nav','nav',5),
	(34,'Create page','pages/add','pages','pages',15),
	(20,'Create template','templates/adauga_sablon','templates','templates',8),
	(3,'Navigation','nav/index','nav','nav',4),
	(18,'Settings','setting/index','setting',NULL,4),
	(22,'Dashboard','admin/index','admin',NULL,1),
	(23,'Members','user/index','user',NULL,6),
	(24,'Add member','user/add','user','user',10),
	(28,'Permissions groups','usergroup/index','user','user',11),
	(29,'Extensions','setting/plugins','setting','setting',13),
	(31,'General settings','setting/index','setting','setting',12),
	(26,'Members','user/index','user','user',6),
	(46,'Create snippet','templates/adauga_sectiune_sablon','templates','templates',20),
	(21,'Pages','pages/index','pages','pages',8),
	(35,'Templates','templates/index','templates',NULL,17),
	(36,'Templates','templates/index','templates','templates',18),
	(45,'Snippets','templates/sectiuni_sablon','templates','templates',19),
	(48,'Install templates','templates/themes','templates','templates',21);

/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table banner_rotator
# ------------------------------------------------------------

DROP TABLE IF EXISTS `banner_rotator`;

CREATE TABLE `banner_rotator` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `imagine` varchar(255) DEFAULT NULL,
  `descriere` varchar(255) DEFAULT NULL,
  `blend` varchar(20) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

LOCK TABLES `banner_rotator` WRITE;
/*!40000 ALTER TABLE `banner_rotator` DISABLE KEYS */;
INSERT INTO `banner_rotator` (`id`,`imagine`,`descriere`,`blend`,`color`)
VALUES
	(21,'dsc00055.jpg','test','yes','#ff0000');

/*!40000 ALTER TABLE `banner_rotator` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table blog
# ------------------------------------------------------------

DROP TABLE IF EXISTS `blog`;

CREATE TABLE `blog` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `slug` varchar(128) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `summary` text,
  `content` text,
  `tags` varchar(255) DEFAULT NULL,
  `publish_date` varchar(128) DEFAULT NULL,
  `category` varchar(128) DEFAULT NULL,
  `author` varchar(128) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `template` int(12) DEFAULT NULL,
  `comments` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

# Dump of table boxes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `boxes`;

CREATE TABLE `boxes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `page_id` tinytext,
  `type` varchar(255) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;



# Dump of table categorii
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categorii`;

CREATE TABLE `categorii` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `nume_categorie` varchar(255) DEFAULT NULL,
  `tip_categorie` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


# Dump of table comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `author` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `website` varchar(128) DEFAULT NULL,
  `content` text,
  `ip` varchar(128) DEFAULT NULL,
  `date` varchar(128) DEFAULT NULL,
  `page_id` int(12) DEFAULT NULL,
  `status` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;


# Dump of table faq
# ------------------------------------------------------------

DROP TABLE IF EXISTS `faq`;

CREATE TABLE `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text,
  `answer` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

# Dump of table feedback
# ------------------------------------------------------------

DROP TABLE IF EXISTS `feedback`;

CREATE TABLE `feedback` (
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


# Dump of table galerie_album
# ------------------------------------------------------------

DROP TABLE IF EXISTS `galerie_album`;

CREATE TABLE `galerie_album` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nume` varchar(255) DEFAULT NULL,
  `categorie` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;


# Dump of table galerie_categorii
# ------------------------------------------------------------

DROP TABLE IF EXISTS `galerie_categorii`;

CREATE TABLE `galerie_categorii` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `nume` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;


# Dump of table galerie_poze
# ------------------------------------------------------------

DROP TABLE IF EXISTS `galerie_poze`;

CREATE TABLE `galerie_poze` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `nume` varchar(255) DEFAULT NULL,
  `cod_produs` varchar(255) DEFAULT NULL,
  `descriere` char(255) DEFAULT NULL,
  `fisier` varchar(255) DEFAULT NULL,
  `album` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

LOCK TABLES `galerie_poze` WRITE;

# Dump of table gallery_albums
# ------------------------------------------------------------

DROP TABLE IF EXISTS `gallery_albums`;

CREATE TABLE `gallery_albums` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


# Dump of table gallery_photos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `gallery_photos`;

CREATE TABLE `gallery_photos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `caption` text,
  `filename` varchar(255) DEFAULT NULL,
  `album` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

# Dump of table links
# ------------------------------------------------------------

DROP TABLE IF EXISTS `links`;

CREATE TABLE `links` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

# Dump of table logger
# ------------------------------------------------------------

DROP TABLE IF EXISTS `logger`;

CREATE TABLE `logger` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `action` text,
  `module` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `hide` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

# Dump of table media_albums
# ------------------------------------------------------------

DROP TABLE IF EXISTS `media_albums`;

CREATE TABLE `media_albums` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


# Dump of table media_records
# ------------------------------------------------------------

DROP TABLE IF EXISTS `media_records`;

CREATE TABLE `media_records` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `album` int(10) DEFAULT NULL,
  `external` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

# Dump of table page_links
# ------------------------------------------------------------

DROP TABLE IF EXISTS `page_links`;

CREATE TABLE `page_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) DEFAULT NULL,
  `download` varchar(255) DEFAULT NULL,
  `demo` varchar(255) DEFAULT NULL,
  `buy` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


# Dump of table pages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `tags` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `template` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_time` varchar(30) DEFAULT NULL,
  `modified_time` varchar(30) DEFAULT NULL,
  `publish_time` varchar(30) DEFAULT NULL,
  `login_required` int(11) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `root` int(1) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `behavior` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


# Dump of table plugin_settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `plugin_settings`;

CREATE TABLE `plugin_settings` (
  `plugin_id` varchar(40) NOT NULL,
  `name` varchar(40) NOT NULL,
  `value` varchar(255) NOT NULL,
  UNIQUE KEY `plugin_setting_id` (`plugin_id`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


# Dump of table setting
# ------------------------------------------------------------

DROP TABLE IF EXISTS `setting`;

CREATE TABLE `setting` (
  `name` varchar(40) NOT NULL,
  `value` text NOT NULL,
  UNIQUE KEY `id` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` (`name`,`value`)
VALUES
	('plugins','a:11:{s:10:\"statistics\";i:1;s:6:\"logger\";i:1;s:11:\"ajax_upload\";i:1;s:7:\"cryptor\";i:1;s:9:\"loginauth\";i:1;s:5:\"tabby\";i:1;s:13:\"error_handler\";i:1;s:5:\"tipsy\";i:1;s:8:\"markitup\";i:1;s:13:\"template_tags\";i:1;s:10:\"contiguous\";i:1;}'),
	('sitename','Bebliuc George'),
	('sitenameseo','Bebliuc George on'),
	('keywordsseo','web, design, development, php, css, html, mysql, cplusplus, contact, page'),
	('descriptionseo','Web design and development blog about PHP, Mysql, C++.'),
	('auto_approve_comments','1'),
	('akismet_api','34a2509b6fa3'),
	('theme_base_url','source/'),
	('preview_style','');

/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table statistics
# ------------------------------------------------------------

DROP TABLE IF EXISTS `statistics`;

CREATE TABLE `statistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_type` varchar(255) DEFAULT NULL,
  `occurance_time` varchar(255) DEFAULT NULL,
  `occurance_date` varchar(255) DEFAULT NULL,
  `ipaddress` varchar(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `referer` varchar(255) DEFAULT NULL,
  `browser` varchar(155) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `session_id` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

# Dump of table templates
# ------------------------------------------------------------

DROP TABLE IF EXISTS `templates`;

CREATE TABLE `templates` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `nume` varchar(255) NOT NULL,
  `tip` varchar(255) NOT NULL,
  `continut` text NOT NULL,
  `notes` text,
  `compress` tinyint(1) DEFAULT NULL,
  `tidy` tinyint(1) DEFAULT NULL,
  `tgroup` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

# Dump of table templates_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `templates_groups`;

CREATE TABLE `templates_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;


# Dump of table templates_parts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `templates_parts`;

CREATE TABLE `templates_parts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(125) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

# Dump of table templates_themes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `templates_themes`;

CREATE TABLE `templates_themes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(125) DEFAULT NULL,
  `layouts` text,
  `parts` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;



# Dump of table utilizatori
# ------------------------------------------------------------

DROP TABLE IF EXISTS `utilizatori`;

CREATE TABLE `utilizatori` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `actualizare` varchar(255) DEFAULT NULL,
  `grup` int(10) DEFAULT NULL,
  `hash` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

# Dump of table utilizatori_grup
# ------------------------------------------------------------

DROP TABLE IF EXISTS `utilizatori_grup`;

CREATE TABLE `utilizatori_grup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nume` varchar(255) NOT NULL,
  `zona` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

LOCK TABLES `utilizatori_grup` WRITE;
/*!40000 ALTER TABLE `utilizatori_grup` DISABLE KEYS */;
INSERT INTO `utilizatori_grup` (`id`,`nume`,`zona`)
VALUES
	(1,'Administrator','*');

/*!40000 ALTER TABLE `utilizatori_grup` ENABLE KEYS */;
UNLOCK TABLES;





/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
