<?php

class Gallery extends Record {
	
	const ALBUM_TABLE_NAME = 'gallery_albums';
	const TABLE_NAME = 'gallery_photos';

	public static function photosNumber( $album ) {
		
		global $__CONN__;
		
		$sql = "SELECT count(*) AS count FROM ".self::TABLE_NAME." WHERE album = ?";
		
		$stmt = $__CONN__->prepare($sql);
		$stmt->execute(array($album));

		return $stmt->fetchObject()->count;
		
	}
	
	public static function getAlbumName( $id ) {
		$album = self::findOneFrom(self::ALBUM_TABLE_NAME, 'id = ?', array($id));
		return $album->name;
	}
	
	public static function photo( $filename, $album ) {
		$album_name = str_replace(' ', '_', strtolower($album));
		return PUBLIC_URI.'/gallery/'.$album_name.'/'.$filename;
	}
	
	public static function thumbnail( $filename, $album ) {
		$album_name = str_replace(' ', '_', strtolower($album));		
		return PUBLIC_URI.'/gallery/thumbnails/'.$album_name.'/'.$filename;
	}

}