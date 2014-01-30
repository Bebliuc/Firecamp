<?php

class GalleryController extends PluginController {
	
	function __construct() {
		$this->setLayout('admin_v2/index');
		green::$watches['submenu'] = array(get_url('plugin/gallery/add_album') => __('Add new album'));
		green::$watches['pageHeading'] = 'Gallery';
	}
	
	function index() {
		/*
			Layout options
		*/
		green::$watches['pageHeading'] = 'Gallery';
		green::$watches['toggleSidebar'] = TRUE;
		
		$this->display('gallery/views/index', array('albums' => gallery::findAllFrom(gallery::ALBUM_TABLE_NAME), 
													'photos' => gallery::findAllFrom(gallery::TABLE_NAME, 'id != 0 LIMIT 10')));
	}
	
	function add_album() {
		/*
			Layout options
		*/
		green::$watches['pageHeading'] = 'Add new album';
		green::$watches['toggleSidebar'] = TRUE;
	
		$this->display('gallery/views/add_album');
	}
	
	function create_album() {
		/*
			Get albumTitle from $_POST
		*/
		$albumTitle = $_POST['albumTitle'];
		
		if(empty($albumTitle)) {
			Flash::set('error', 'Field <b>Album title</b> is mandatory.');
			go_to('plugin/gallery/add_album');
		}
		
		/*
			Create folder
		*/
		
		$dirAlbum = strtolower(str_replace(" ", "_", $albumTitle));
		
		
		if(!file_exists(_UPLOAD.'/thumbnails/'.$dirAlbum)) {
			
			mkdir(_UPLOAD.'/thumbnails/'.$dirAlbum);
			
		}
		
		if(!file_exists(_UPLOAD.'/'.$dirAlbum)) {
			
			mkdir(_UPLOAD.'/'.$dirAlbum);
			
		}
		
		
		/*
			Save album
		*/
		
		if(gallery::save(gallery::ALBUM_TABLE_NAME, array('id' => NULL, 'title' => $albumTitle)))
			Flash::set('success', 'Album <b>'.$albumTitle.'</b> has been created.');
		else
			Flash::set('error', 'Album could not be created. Please contact the website administrator and provide the following code: P::gallery:create_album');
		
		go_to('plugin/gallery/index');
		
	}
	
	function delete_album( $id ) {
		/*
			Delete query
		*/
		
		$albumTitle = gallery::getAlbumName($id);
		$dirAlbum = strtolower(str_replace(" ", "_", $albumTitle));
		
		$_albumTitle = gallery::getAlbumName($id);
		
		if(gallery::delete(gallery::ALBUM_TABLE_NAME, 'id = ?', array($id))) 
			Flash::set('success', 'Album <b>'.$_albumTitle.'</b> has been deleted.');
		else
			Flash::Set('error', 'Album could not be deleted. Please contact the website administrator and provide the following code: P::gallery:delete_album');
		
		gallery::delete(gallery::TABLE_NAME, 'album = ?', array($id));
		

		
		if(file_exists(_UPLOAD.'/'.$dirAlbum))
			main::deleteFolder(_UPLOAD.'/'.$dirAlbum);
		
		if(file_exists(_UPLOAD.'/thumbnails/'.$dirAlbum))
			main::deleteFolder(_UPLOAD.'/thumbnails/'.$dirAlbum);

		
		go_to('plugin/gallery/index');
	}

	function add_photo( $album_id ) {
		/*
			Add new photo
				-id
				-title
				-caption
				-filename / thumbnail
				-album <-> $album_id
		*/
		$this->display('gallery/views/add_photo', array('album_id' => $album_id));
	}
	
	function upload_photo( $album = '', $qqData = '') {
		
		$albumTitle = $album;
		$dirAlbum = strtolower(str_replace(" ", "_", $albumTitle));
		// list of valid extensions, ex. array("jpeg", "xml", "bmp")
		$allowedExtensions = array("jpeg", "jpg", "bmp", "png", "gif");
		// max file size in bytes
		$sizeLimit = 6 * 1024 * 1024;
		
		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
		$result = $uploader->handleUpload(_UPLOAD.$dirAlbum.'/');
		// to pass data through iframe you will need to encode all html tags
		echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		
	}
	
	function create_photo( $album_id) {
		
		$photo = $_POST['photo'];
		
		$albumTitle = gallery::getAlbumName($album_id);
		
		$dirAlbum = strtolower(str_replace(" ", "_", $albumTitle));
		
		Image::resize(_UPLOAD.$dirAlbum.'/'.$photo['filename'], _UPLOAD.'thumbnails/'.$dirAlbum.'/'.$photo['filename'], '200');
		
		if(empty($photo['title'])) {
			Flash::set('error', 'The <b>Photo title</b> field is mandatory.');
			go_to('plugin/gallery/add_photo');
		}

		if(empty($photo['filename'])) {
			Flash::set('error', 'Uploading a photo is mandatory.');
			go_to('plugin/gallery/add_photo');
		}
		$details = array('id' => NULL, 'title' => $photo['title'], 'caption' => $photo['caption'], 'filename' => $photo['filename'], 'album' => $album_id);

		if(gallery::save(gallery::TABLE_NAME, $details)) {
			Flash::set('success', 'The photo has been added succesfully.');
			go_to('plugin/gallery/index');
		}
		else {
			Flash::set('error', 'The photo could not be added. Please report this to the website administrator.');
			go_to('plugin/gallery/add_photo');
		}
		
	}

        function edit_photo( $id ) {
            /*
             *  Description : Edit photo by $id param
             *  @TODO: Edit filename
             */
            $this->display('gallery/views/edit_photo', array('photo' => record::findOneFrom(gallery::TABLE_NAME, 'id = ?', array($id))));

        }

        function update_photo( $id ) {
            /*
             *  Description: Update photo after edit_photo( $id ) form submittance
             */

            $photo = $_POST['photo'];
            if(empty($photo['title'])) { Flash::set('error', 'The <b>Photo title</b> field is mandatory.'); go_to('plugin/gallery/edit_photo/'.$id); }
            if(empty($photo['caption'])) { Flash::set('error', 'The <b>Photo caption</b> field is mandatory.'); go_to('plugin/gallery/edit_photo/'.$id); }

            if(gallery::update(gallery::TABLE_NAME, array('title' => $photo['title'], 'caption' => $photo['caption']), $id)) {
                Flash::set('success', 'Photo <b>'.$photo['title'].'</b>has been updated succesfully.');
                go_to('plugin/gallery/edit_photo/'.$id);
            }
            else {
                Flash::set('error', 'The photo could not be updated. Please report this to the website administrator.');
                go_to('plugin/gallery/index');
            }
        }

        function edit_album( $id ) {
            /*
             *  Description: Edits an album
             */
              $this->display('gallery/views/edit_album', array('album' => gallery::findOneFrom(gallery::ALBUM_TABLE_NAME, 'id = ?', array($id))));

        }
        
        function update_album( $id ) {
            /*
             *  Description: Updates an album after edit_album( $id ) form submittance
             */
            $title = strtolower(str_replace(" ", "_", gallery::getAlbumName($id)));
              if(empty($_POST['albumTitle'])) {
                 Flash::set('error', 'The <b>Album title</b> field is mandatory.');
                 go_to('plugin/gallery/edit_album/'.$id);
             }
             if(!gallery::update(gallery::ALBUM_TABLE_NAME, array('name' => $_POST['albumTitle']), $id)) {
                Flash::set('error', 'The album could not be updated. Please report this to the website administrator.');
                go_to('plugin/gallery/index');
             }
             else {
                 $new_title = strtolower(str_replace(" ", "_", $_POST['albumTitle']));
                 rename(_UPLOAD.$title, _UPLOAD.$new_title);
                 
                 Flash::set('success', 'Album <b>'.$_POST['albumTitle'].'</b> has been updated succesfully.');
                 go_to('plugin/gallery/index');
             }
        }
        
        function delete_photo( $id ) {
        	/*
        	*	Description: Delete photo with $id id
        	*/
        	
        	/* get filename */
        	$_photo = gallery::findOneFrom(gallery::TABLE_NAME, 'id = ?', array($id));
        	$_filename = $_photo->filename;
        	
        	/* get album name */
        	$_album = gallery::findOneFrom(gallery::ALBUM_TABLE_NAME, 'id = ?', array($_photo->album));
        	$_albumname = $_album->name;
        	
        	$_albumpath = strtolower(str_replace(" ", "_", $_albumname));
        	$_filepath = strtolower(str_replace(" ", "_", $_filename));
        	
        	if(file_exists(_UPLOAD.$_albumpath.'/'.$_filepath))
        		unlink(_UPLOAD.$_albumpath.'/'.$_filepath);
        	
        	if(file_exists(_UPLOAD.'thumbnails/'.$_albumpath.'/'.$_filepath))
        		unlink(_UPLOAD.'thumbnails/'.$_albumpath.'/'.$_filepath);
        	
        	if(gallery::delete(gallery::TABLE_NAME, 'id = ?', array($id)))
        		Flash::set('success', __('Photo %name% has been deleted succesfully.', array('%name%' => $_filename)));
        	else
        		Flash::set('error', __('Photo %name% could not be deleted. Please contact the website administrator and provide the following code: P::gallery::dp', array('%name%' => $_filename)));
        		
        	go_to('plugin/gallery/index');
        	
        
        }

}