<?php
Plugin::setInfos(array(
		'id' => 'galerie',
		'title' => 'Advanced Gallery',
		'description' => 'Advanced gallery with CRUD functions for categories, albums and images. + thumbnails.',
		'author' => 'Bebliuc',
		'website' => 'http://bebliuc.ro',
		'version' => '1.0'
));

Plugin::addController('galerie', 'Galerie');



Observer::observe('adauga.pagina.tab', 'tabGalerie');
Observer::observe('adauga.pagina.fieldset', 'divGalerie');
Observer::observe('backend.javascript', 'jsGalerie');

function tabGalerie($id = "")
{
	 echo '<span id="button" class="galerie ui" />Galerie</span>';
}

function divGalerie($id = "", $galerie = "")
{
	echo '<div id="galerie" style="height: 38px; display: none;">'.categorii($galerie).'</div>';
}

function jsGalerie($id = "")
{
	echo "$('.galerie').click(function () {
		$('#galerie').slideToggle('medium');
    });";
}
function categorii($current = "")

{
	global $__CONN__;
	
	$sql = "SELECT * FROM galerie_categorii ORDER BY nume ASC";
	$stmt = $__CONN__->prepare($sql);
	$stmt->execute();
	
	$categorii = "
	<div class=\"ctrlHolder\">
	<label for=\"galerie\">Categorii galerie</label>";
	
	$categorii .= "<select name=\"pagina[galerie]\"><option value=\"0\"></a>";
	
	$current = (int) $current;
	
	while($categorie = $stmt->fetchObject()) {
		
		if($current == $categorie->id)
			$selected = "selected=\"\"" ;
		else
			$selected = "";
			
		$categorii .= "<option value=\"".$categorie->id."\" ".$selected.">".$categorie->nume."</option> \n";
		
	}
	
	$categorii .= "</select></div>";
	
	return $categorii;
}

function frJsGalerie($numar) {
	
	$js = "<script type=\"text/javascript\">
var onMouseOutOpacity = 0.67;
			$('#thumbs-adv".$numar." ul.thumbs li').css('opacity', onMouseOutOpacity)
				.hover(
					function () {
						$(this).not('.selected').fadeTo('fast', 1.0);
					}, 
					function () {
						$(this).not('.selected').fadeTo('fast', onMouseOutOpacity);
					}
				);
			$(document).ready(function() {
				// Initialize Advanced Galleriffic Gallery
				var galleryAdv = $('#gallery-adv".$numar."').galleriffic('#thumbs-adv".$numar."', {
					delay:                  2000,
					numThumbs:              12,
					preloadAhead:           10,
					enableTopPager:         false,
					enableBottomPager:      true,
					imageContainerSel:      '#slideshow-adv".$numar."',
					controlsContainerSel:   '#controls-adv".$numar."',
					captionContainerSel:    '#caption-adv".$numar."',
					loadingContainerSel:    '#loading-adv".$numar."',
					renderSSControls:       true,
					renderNavControls:      true,
					playLinkText:           'Play Slideshow',
					pauseLinkText:          'Pause Slideshow',
					prevLinkText:           '< Previous Photo',
					nextLinkText:           'Next Photo >',
					nextPageLinkText:       '>>',
					prevPageLinkText:       '>>',
					enableHistory:          false,
					autoStart:              false,
					onChange:               function(prevIndex, nextIndex) {
						$('#thumbs-adv".$numar." ul.thumbs').children()
							.eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
							.eq(nextIndex).fadeTo('fast', 1.0);
					},
					onTransitionOut:        function(callback) {
						$('#slideshow-adv".$numar.", #caption-adv').fadeOut('fast', callback);
					},
					onTransitionIn:         function() {
						$('#slideshow-adv".$numar.", #caption-adv').fadeIn('fast');
					},
					onPageTransitionOut:    function(callback) {
						$('#thumbs-adv".$numar." ul.thumbs').fadeOut('fast', callback);
					},
					onPageTransitionIn:     function() {
						$('#thumbs-adv".$numar." ul.thumbs').fadeIn('fast');
					}
				});
				
			});


</script>";

	echo $js;
	
	
}


Observer::observe('salveaza.imagine.plugin.galerie', 'flushTemporary');

function flushTemporary() {

	Main::deleteFromfolder(UPLOAD.'/tmp/');
	
}
