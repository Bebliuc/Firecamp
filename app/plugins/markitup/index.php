<?php
/**
 * @package Moustache
 * @subpackage plugin
 *
 * @author Bebliuc George <george@bebliuc.ro>
 * @version 0.1
 * @copyright Bebliuc George, 2009
 */

/**
 * Maintenance Plugin
 *
 * @package Moustache
 * @subpackage maintenance
 * @todo MarkItUp! Editor with buttons control API for other plugins.
 * 
 * @version 0.1
 * @since 0.1
 */

Plugin::setInfos(array(
		'id' => 'markitup',
		'title' => 'MarkItUp!',
		'author' => 'Bebliuc',
		'website' => 'http://bebliuc.ro',
		'version' => '1.0',
		'description' => 'MarkItUp! Editor with buttons control API for other plugins.'));

Observer::observe('page.edit.end', 'markitup_js');
Observer::observe('page.add.end', 'markitup_js');
Plugin::addController('markitup', 'Markitup', TRUE, FALSE);

Observer::observe('setting.page.index', 'markitup_settings');
Observer::observe('page', 'markdown_parse');

class Markitup {
	
	public static $buttons = array();
	public static $styles = array();
	
	public static function addButton( $syntax ) {
		array_push(self::$buttons, $syntax);
	}
	
	public static function addStyle( $title, $url ) {
		array_push(self::$styles, '
		.markItUp .'.$title.' a {
		    background-image: url("'.$url.'");
		}
		');
	}
	
}
function markdown_parse($page) {
	use_helper('Markdown');
	$page->content = Markdown($page->content);
}

function markitup_settings() {
	$url = Setting::get('preview_style');
	echo <<<COMMENT
	<fieldset>
        <legend>markItUp!</legend>
         <div class="form-row ">
        	<div class="form-label">
    			<label for="ckeditor_style">Preview style URL</label>
    		</div>
    		
    		<div class="form-field">
    		  <input type="text" title="Use {base_url} for the website URI." name="preview_style" size="45" value="$url">
            </div>
         </div>
    </fieldset>
	
COMMENT;
}


function markitup_js() {
	$preview_url = get_url('plugin/markitup/preview');
	$styles = '';
	$buttons = '';
	foreach(markitup::$buttons as $button)
		$buttons .= $button.',';
	foreach(markitup::$styles as $style)
		$styles .= $style.'\n';
		
	echo <<<JS
		
		<script type="text/javascript">
		<!--
		jQuery(document).ready(function($)	{
			mySettings = {
				previewParserPath:	'$preview_url',
				previewInWindow: 'width=800, height=600, resizable=yes, scrollbars=yes',
				onShiftEnter:		{keepDefault:false, openWith:'\\n\\n'},
				markupSet: [
					{name:'First Level Heading', key:'1', placeHolder:'Your title here...', closeWith:function(markItUp) { return miu.markdownTitle(markItUp, '=') } },
					{name:'Second Level Heading', key:'2', placeHolder:'Your title here...', closeWith:function(markItUp) { return miu.markdownTitle(markItUp, '-') } },
					{name:'Heading 3', key:'3', openWith:'### ', placeHolder:'Your title here...' },
					{name:'Heading 4', key:'4', openWith:'#### ', placeHolder:'Your title here...' },
					{name:'Heading 5', key:'5', openWith:'##### ', placeHolder:'Your title here...' },
					{name:'Heading 6', key:'6', openWith:'###### ', placeHolder:'Your title here...' },
					{separator:'---------------' },		
					{name:'Bold', key:'B', openWith:'**', closeWith:'**'},
					{name:'Italic', key:'I', openWith:'_', closeWith:'_'},
					{separator:'---------------' },
					{name:'Bulleted List', openWith:'- ' },
					{name:'Numeric List', openWith:function(markItUp) {
						return markItUp.line+'. ';
					}},
					{separator:'---------------' },
					{name:'Picture', key:'P', replaceWith:'![[![Alternative text]!]]([![Url:!:http://]!] "[![Title]!]")'},
					{name:'Link', key:'L', openWith:'[', closeWith:']([![Url:!:http://]!] "[![Title]!]")', placeHolder:'Your text to link here...' },
					{separator:'---------------'},	
					{name:'Quotes', openWith:'> '},
					{name:'Code Block / Code', openWith:'(!(\t|!|`)!)', closeWith:'(!(`)!)'},
					{separator:'---------------'},
					{name:'Preview', call:'preview', className:"preview"},
					{separator:'---------------'},
					$buttons
					{separator:'---------------'}
				]
			}

			// mIu nameSpace to avoid conflict.
			miu = {
				markdownTitle: function(markItUp, char) {
					heading = '';
					n = $.trim(markItUp.selection||markItUp.placeHolder).length;
					for(i = 0; i < n; i++) {
						heading += char;
					}
					return '\\n'+heading;
				}
			}
			$('textarea').markItUp(mySettings);
			$('#fullscreen_edit').markItUp(mySettings);
		});
		-->
		</script>
		<style type="text/css">
			$styles;
		</style>
JS;
}