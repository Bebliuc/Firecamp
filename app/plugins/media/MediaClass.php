<?php

class Media extends Record {

	const MEDIA_ALBUMS = 'media_albums';
	const MEDIA_RECORDS = 'media_records';
	
        public static function getAlbumTitleFromId( $id = 0 ) {
            $album = self::findOneFrom(self::MEDIA_ALBUMS, 'id = ?', array($id));
            return $album->title;
        }
		
		public static function getRecordTitleFromId( $id = 0 ) {
			$record = self::findOneFrom(self::MEDIA_RECORDS, 'id = ?', array($id));
			return $record->title;
		}
		
        public static function getAlbumTypeFromId( $id = 0 ) {
            $album = self::findOneFrom(self::MEDIA_ALBUMS, 'id = ?', array($id));
            return $album->type;
        }

		public static function iterator( $string ) {
			return str_replace(" ", "_", strtolower($string));
		}

}
