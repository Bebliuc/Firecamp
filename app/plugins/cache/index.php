<?php

Plugin::setInfos(array(

	'id' => 'cache',

	'title' => 'Simple Cache',

	'description' => 'Simple pages cache system.',

	'version' => '1.0',

	'website' => 'http://bebliuc.ro',

	'author' => 'Bebliuc',

	));



Observer::observe('frontend.page.init', 'startCache');

Observer::observe('frontend.page.end', 'writeCache');	

Observer::observe('page.save.success', 'flushCache');

Observer::observe('page.edit.success', 'flushCache');

Observer::observe('page.delete.success', 'flushCache');



function startCache($id) {

	

		$url = Green::getController().'/'.Green::getAction().'/'.$id;

		$cacheName = str_replace('/','-',$url); // Replasing all slashes from URI with "-"

	

		$cacheFile = PUBLIC_URL.'/cache/'.$cacheName;

		$cacheTime = 4 * 60;

		// Serve the cached file if it is older than $cacheTime

		if (file_exists($cacheFile) && time() - $cacheTime < filemtime($cacheFile)) {

	    	include($cacheFile);

	    	exit;

		}

		// Start the output buffer

		ob_start();

		

	

}



function writeCache($id) {

	

		$url = Green::getController().'/'.Green::getAction().'/'.$id;

		$cacheName = str_replace('/','-',$url); // Replasing all slashes from URI with "-"



		$cacheFile = PUBLIC_URL.'/cache/'.$cacheName;



		$cached = fopen($cacheFile, 'w');

		fwrite($cached, ob_get_contents());

		fclose($cached);

		ob_end_flush(); // Send the output to the browser

}



function flushCache() {

	

	Main::deleteFromFolder(PUBLIC_URL.'/cache/');

	

}