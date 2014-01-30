<?php

class MediaController extends PluginController {

    function __construct() {

        $this->setLayout('admin_v2/index');
		green::$watches['submenu'] = array(get_url('plugin/media/add_album') => __('Add album'));
    }

    function index() {
    	green::$watches['pageHeading'] = __('Media Plugin');
        $this->display('media/views/index', array('albums' => media::findAllFrom(media::MEDIA_ALBUMS), 
						  'records' => media::findAllFrom(media::MEDIA_RECORDS, 'id != 0 ORDER BY id DESC LIMIT 25')));
    }

    function add_album() {
    	    green::$watches['pageHeading'] = __('Media Plugin - Add new album');
            $this->display('media/views/add_album');
    }

    function create_album() {
	    	green::$watches['pageHeading'] = __('Media Plugin - Create album');
            if(isset($_POST['submit'])) {

                    $album = $_POST['album'];

                    if(empty($album['title'])) {
                            Flash::set('error', __('The <b>Album title</b> is mandatory'));
                            go_to('plugin/media/add_album');
                    }

                    // save it!!!!

                    if(media::save(media::MEDIA_ALBUMS, array('id' => NULL, 'title' => $album['title'], 'type' => $album['type'])))
                            Flash::set('success', __('Album <b>%album%</b> has been created succesfully.', array('%album' => $album['title'])));
                    else
                            Flash::set('error', __('The album could not be created. Please contact the website administrator and provide the following code: P::media::Ca'));

                    go_to('plugin/media/index');

            }

            else
                    die('die bozgor');
    }

    function edit_album( $id ) {
    		green::$watches['pageHeading'] = __('Media Plugin - Edit album');
            $this->display('media/views/edit_album', array('album' => media::findOneFrom(media::MEDIA_ALBUMS, 'id = ?', array($id))));
    }

    function update_album( $id = 0 ) {

            if(isset($_POST['submit'])) {

                    $album = $_POST['album'];

                    if(empty($album['title'])) {
                            Flash::set('error', __('The <b>Album title</b> is mandatory'));
                            go_to('plugin/media/edit_album/'.$id);
                    }

                    if(media::update(media::MEDIA_ALBUMS, array('title' => $album['title'], 'type' => $album['type']), $id)) {
                            Flash::set('success', __('Album <b>%album%</b> has been updated succesfully.',
																			array('%album%' => $album['title'])));
                            go_to('plugin/media/index');
                    }
                    else {
                            Flash::set('error', __('The album could not be edited. Please contact the website administrator and provide the following code: P::media::Ea'));
                            go_to('plugin/media/edit_album/'.$id);
                    }
            }

            else
                    die('die bozgor');
    }

    function delete_album( $id = 0 ) {

            if($id != 0) {
                    $album = media::findOneFrom(media::MEDIA_ALBUMS, 'id = ?', array($id));

                    if(media::delete(media::MEDIA_ALBUMS, 'id = ?', array($id)))
                            Flash::set('success', __('Album <b>%album%</b> has been deleted succesfuly.',
																array('%album%' => $album->title)));
                    else
                            Flash::set('error', __('The album could not be deleted succesfully. Please provide the following code to the website administrator: P::media::Da'));

                    go_to('plugin/media/index');
            }
            else
                    die('die bozgor');
    }

    function add_record( $id = 0, $type = 'music') {
    	    green::$watches['pageHeading'] = __('Media Plugin - Add %type% Records', array('%type%' => ucwords($type)));
            $this->display('media/views/add_record', array('type' => $type, 'id' => $id));
    }

    function view_records( $album ) {
        $album_name = media::getAlbumTitleFromId( $album );
        green::$watches['pageHeading'] = __('Media Plugin - %name% records', array('%name%' => $album_name));
        $this->display('media/views/view_records', array('album_name' => $album_name, 'records' => media::findAllFrom(media::MEDIA_RECORDS, 'album = ? ORDER BY id DESC', array($album))));
        

    }

    function save_record() {

            if(isset($_POST['submit'])) {

                    if(empty($_POST['record']['title'])) {
                            Flash::set('error' ,__(' The <b>title</b> field is mandatory.'));
                            go_to('plugin/media/index');
                    }

                    $record['id'] = NULL;
                    $record['title'] = $_POST['record']['title'];
                    $record['url'] = $_POST['record']['url'];
                    $record['album'] = $_POST['record']['album'];
                    $record['external'] = html_encode($_POST['record']['external']);


                    if(media::save(media::MEDIA_RECORDS, $record))
                            Flash::set('success', __('The record <b>%title%</b> has been added succesfully.',
																	array('%title%' => $record['title'])));
                    else
                            Flash::set('error', __('The record could not be added. Please contact the website administrator and provide the folllowing code: P::media::Rc'));

                    go_to('plugin/media/index');
            }

    }

    function delete_record( $id = 0 ) {
        $title = media::getRecordTitleFromId($id);
        if(media::delete(media::MEDIA_RECORDS, 'id = ?', array($id)))
            Flash::set('success', __('Record <b>%title%</b> has been deleted successfully.',
														array('%title%' => $title)));
        else
            Flash::set('error', __('The record could not be deleted. Please contact the website administrator providing the following code: P::media::Dr'));
        go_to('plugin/media/index');
    }

	function edit_record( $id = 0, $type = 'music') {
		$this->display('media/views/edit_record', array('id' => $id, 'type' => $type, 'record' => media::findOneFrom(media::MEDIA_RECORDS, 'id = ?', array($id))));	
	}

	function update_record( $id = 0 ) {
		if(isset($_POST['submit'])) {
			if(media::update(media::MEDIA_RECORDS, $_POST['record'], $id))
				Flash::set('success', __('Record %title% has been edited succesfully.', array('%title%' => $_POST['record']['title'])));
			else
				Flash::set('error', __('The record could not be edited sucesfully. Please contact the website administrator providing the following code: P::media::Ur'));
				
			go_to('plugin/media/index');
		}
	}
}