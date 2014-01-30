<?php

/**
 * @package BebliuCMS
 * @subpackage plugin
 *
 * @author Bebliuc George <george@bebliuc.ro>
 * @version 0.1
 * @copyright Bebliuc George, 2009
 */

/**
 * Ckeditor
 *
 * @package BebliuCMS
 * @subpackage products
 * @todo Advanced WYSIWYG editor
 * 
 * @version 0.1
 * @since 0.1
 */


Plugin::setInfos(array(
		'id' => 'ckeditor',
		'title' => 'CKeditor',
		'author' => 'Bebliuc',
		'website' => 'http://bebliuc.ro',
		'version' => '1.0',
		'description' => 'WYSIWYG editor for textareas.'));

Observer::observe('page.edit.end', 'ckeditor_js');
Observer::observe('page.add.end', 'ckeditor_js');


function ckeditor_js() {
	echo <<<CKEDITOR
	<script type="text/javascript">
		window.onload = function() {
	
			
	CKEDITOR.replace( 'content',
    {
        toolbar :  [
			['NewPage','Preview'],
			['Cut','Copy','Paste','PasteText','PasteFromWord','-','Scayt'],
			['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
			['Image','Table','HorizontalRule','SpecialChar','PageBreak'],
			'/',
			['Styles','Format'],
			['Bold','Italic','Strike'],
			['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
			['Link','Unlink','Anchor'],
			['Maximize','-','About'],
			'/',
			['Source']
		],	
        uiColor : '#EEE',
        language : 'en',
        contentsCss : 'http://cdn.automodifar.ro/themes/automodifar/css/ck_style.css'
    });
	}
	</script>
CKEDITOR;
}

