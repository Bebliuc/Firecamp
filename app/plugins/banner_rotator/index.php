<?php
Plugin::setInfos(array(
		'id' => 'banner_rotator',
		'title' => 'Banner rotator',
		'author' => 'Bebliuc',
		'website' => 'http://bebliuc.ro',
		'version' => '1.0',
		'description' => 'XML & Flash banner rotator'));

Plugin::addController('banner_rotator', 'Rotator');

function banner_rotator($div, $width, $height, $menu) {
	
	$continut = '<script type="text/javascript"><!--
			var so = new SWFObject("'.BASE_URL.'app/plugins/banner_rotator/banner.swf", "mymovie", "'.$width.'", "'.$height.'", "8");
			so.addParam("menu", "'.$menu.'");
			so.addVariable("xmlPath", "'.BASE_URL.'banner_rotator");
			so.write("'.$div.'");
// --></script>';	
	
	return $continut;
	
}
