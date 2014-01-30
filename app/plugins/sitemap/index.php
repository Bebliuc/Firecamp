<?php
/**
 * @package Aperture
 * @subpackage plugin
 *
 * @author Bebliuc George <george@bebliuc.ro>
 * @version 0.1
 * @copyright Bebliuc George, 2009
 */

/**
 * Sitemap Plugin
 *
 * @package Aperture
 * @subpackage sitemap
 * @todo Sitemap structure in XML for SEO
 * 
 * @version 0.1
 * @since 0.1
 */


Plugin::setInfos(array(
		'id' => 'sitemap',
		'title' => 'XML Sitemap',
		'author' => 'Bebliuc',
		'website' => 'http://bebliuc.ro',
		'version' => '1.0',
		'description' => 'Sitemap structure in XML for SEO.'));

Behavior::add('sitemap', 'Sitemap XML');

Observer::observe('behavior_sitemap', '_populateSitemapXML');

function _populateSitemapXML( $page ) {

	$page->template = '_blank';
	$sitemap = new SitemapXML();

	foreach(record::findAllFrom('pages', 'behavior != ? ORDER BY id', array('sitemap')) as $page) {
			$date = explode(" ", $page->date);
			$sitemap->_addEntry(array('location' => BASE_URL.page::getPathToPage($page->id), 'lastmod' => $date[0], 'changefreq' => 'Daily', 'priority' => '1.0'));
		}
		$sitemap->build();
		
}

class SitemapXML {
	
	public $_entry = array();
	
	function __construct() {
		$this->_addEntry(array('location' => BASE_URL, 'lastmod' => date('Y-m-d'), 'changefreq' => 'daily', 'priority' => '1.0'));
	}
	
	public function _addEntry( $entry = array() ) {
		$this->_entry = array_merge($this->_entry, array($entry));
	}
	
	public function findAll() {
		return $this->_entry;
	}
	
	public function build() {
		header ("content-type: text/xml");
		echo '<?xml version="1.0" encoding="UTF-8"?>
			  <?xml-stylesheet type="text/xsl" href="'.BASE_URL.'app/plugins/sitemap/sitemap.xsl" ?>
			  <!-- generator="aperture/0.5" -->
			  <!-- sitemap-generator-url="http://www.bebliuc.ro" sitemap-generator-version="1.0" -->
			  <!-- generated-on="'.date("F j, Y g:i a").'" -->
		<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		foreach($this->_entry as $key => $entry)

		echo '
			<url>
				<loc>'.$entry['location'].'</loc>
				<lastmod>'.$entry['lastmod'].'</lastmod>
				<changefreq>'.$entry['changefreq'].'</changefreq>
				<priority>'.$entry['priority'].'</priority>

			</url>';
		echo '
		</urlset> ';
		
	}
	
	
}