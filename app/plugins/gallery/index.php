<?php


/**


 * Firecamp


 *


 * @package		Firecamp


 * @author		Firecamp Team


 * @copyright	Copyright (c) 2010 - 2011, Bebliuc


 * @license		http://firecamp.ro/license


 * @link		http://firecamp.ro


 * @since		Version 1.0.01


 */





/**


 * Gallery plugin


 *


 * @package		plugins


 * @author		Firecamp Team


 * @copyright	Copyright (c) 2010 - 2011, Bebliuc


 * @license		http://firecamp.ro/license


 * @link		http://firecamp.ro


 * @since		Version 1.0.01


 */





Plugin::setInfos(array(


	'id' => 'gallery',


	'title' => 'Gallery',


	'author' => 'Bebliuc',


	'website' => 'http://bebliuc.ro',


	'version' => '1.0',


	'description' => 'Basic gallery plugin.'));





Plugin::addController('gallery', 'Gallery');





define('_UPLOAD', PUBLIC_URL.'/gallery/');








/*





	Define gallery page





*/





Behavior::add('gallery', __('Gallery'));


if(record::countFrom('pages', 'behavior = ?', array('gallery'))) {


	$sql = "SELECT id FROM pages WHERE behavior = 'gallery'";


	global $__CONN__;


	$stmt = $__CONN__->prepare($sql);


	$stmt->execute();


	$galleries = $stmt->fetchAll(PDO::FETCH_CLASS);


	


	foreach($galleries as $gallery) {


		$url = green::$routes[page::getPathToPage($gallery->id)];


		unset(green::$routes[page::getPathToPage($gallery->id)]);


		Green::addRoute(page::getPathToPage($gallery->id).':any', $url);


	}


}


/*





	Gallery template tags


	


*/





if(class_exists('TemplateTags')) {


	


	templateTags::add('gallery:start:all', '


		<?php


			$sql = \'SELECT name AS album, title, caption, filename FROM gallery_albums AS a, gallery_photos AS p WHERE a.id = p.album\';


	    	global $__CONN__;


	    	$stmt = $__CONN__->prepare($sql);


	    	$stmt->execute();


	    	$photos = $stmt->fetchAll(PDO::FETCH_CLASS);


			foreach($photos as $photo):


		?>');


		


	


	$albums = record::findAllFrom('gallery_albums');


	foreach($albums as $album) {


		templateTags::add('gallery:start:'.strtolower($album->name), '


			<?php


				$sql = \'SELECT name AS album, title, caption, filename FROM gallery_albums AS a, gallery_photos AS p WHERE a.id = p.album AND a.name = ? \';


		    	global $__CONN__;


		    	$stmt = $__CONN__->prepare($sql);


		    	$stmt->execute(array('.$album->name.'));


		    	$photos = $stmt->fetchAll(PDO::FETCH_CLASS);


				foreach($photos as $photo):


			?>');


	}


	templateTags::add('photo:title', '<?php echo $photo->title; ?>');


	templateTags::add('photo:thumbnail', '<?php echo gallery::thumbnail($photo->filename, $photo->album); ?>');


	templateTags::add('photo:image', '<?php echo gallery::photo($photo->filename, $photo->album); ?>');


	templateTags::add('photo:album', '<?php echo $photo->album; ?>');


	templateTags::add('photo:caption', '<?php echo $photo->caption; ?>');


	templateTags::add('gallery:end', '<?php endforeach; ?>');


	


	templateTags::add('gallery:albums', '


		<?php


	  		$albums = record::findAllFrom(\'gallery_albums\');


	  		foreach($albums as $album): ?>');


	templateTags::add('album:id', '<?php echo $album->id; ?>');


	templateTags::add('album:name', '<?php echo $album->name; ?>');


	templateTags::add('album:link', '


		<?php


			if(record::countFrom(\'pages\', \'behavior = ?\', array(\'gallery\'))) {


				$sql = "SELECT id FROM pages WHERE behavior = \'gallery\'";


				global $__CONN__;


				$stmt = $__CONN__->prepare($sql);


				$stmt->execute();


				$gallery = $stmt->fetchObject();


				


				$link = BASE_URL.page::getPathToPage($gallery->id);


				$album_name = str_replace(\' \', \'_\', strtolower($album->name));


				echo $link."/".$album_name;


			}


		?>


	');


	


	templateTags::add('gallery:start:albumFromURL', '


		<?php


		$_params = explode(\'/\', $_SERVER["REQUEST_URI"]);


		$album = $_params[count($_params)-1];


		


			$sql = \'SELECT name AS album, title, caption, filename FROM gallery_albums AS a, gallery_photos AS p WHERE a.id = p.album AND a.name = ? \';


	    	global $__CONN__;


	    	$stmt = $__CONN__->prepare($sql);


	    	$stmt->execute(array($album));


	    	$photos = $stmt->fetchAll(PDO::FETCH_CLASS);


			foreach($photos as $photo):


			?>


	');


	


	templateTags::add('gallery:start:albumFromLoop', '


		<?php


		


			$sql = \'SELECT name AS album, title, caption, filename FROM gallery_albums AS a, gallery_photos AS p WHERE a.id = p.album AND a.name = ? \';


	    	global $__CONN__;


	    	$stmt = $__CONN__->prepare($sql);


	    	$stmt->execute(array($album->name));


	    	$photos = $stmt->fetchAll(PDO::FETCH_CLASS);


			foreach($photos as $photo):


			?>


	');


	


	


	


}








/*


	Check if gallery folder exists


*/


		


if(!file_exists(_UPLOAD)) {			


	mkdir(_UPLOAD);


}





/*


	Check if thumbnails folder exists


*/





if(!file_exists(_UPLOAD.'thumbnails')) {			


	mkdir(_UPLOAD.'thumbnails');


}


