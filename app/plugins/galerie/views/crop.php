<?php
	global $__CONN__;
	$sql = "SELECT nume FROM galerie_album WHERE id = ? ";
	$stmt = $__CONN__->prepare($sql);
	$stmt->execute(array($_SESSION['albumPoza']));
	$album = $stmt->fetchObject();
	
	$numeAlbum = $album->nume;
	
	$src = UPLOAD.'/tmp/'.$numePoza;
	$poza = BASE_URL.'galerie/tmp/'.$numePoza;
	
	$numeAlbumOrg = $numeAlbum;
	
	$numeAlbum = strtolower(str_replace(" ", "_", $numeAlbum));
	
	$pozaAlbumThumb = UPLOAD.'/thumb/'.$numeAlbum.'/'.$numePoza;
	$pozaAlbumCaption = UPLOAD.'/caption/'.$numeAlbum.'/'.$numePoza;
	
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		
		
		if(file_exists($pozaAlbumThumb) OR file_exists($pozaAlbumCaption)) {
			
			Flash::set('error', 'Imaginea incarcata este deja existenta in baza de date.');	
			goto_plugin('galerie/imagine_noua');
		}
		
		$src = imagecreatefromjpeg($src);
	
		$tmp = imagecreatetruecolor(426, 426);
		imagecopyresampled($tmp, $src, 0,0,$_POST['x'],$_POST['y'],426,426,$_POST['w'],$_POST['h']);
		imagejpeg($tmp, $pozaAlbumCaption,100);
		
		$tmp = imagecreatetruecolor(75, 75);
		imagecopyresampled($tmp, $src, 0,0,$_POST['x'],$_POST['y'],75,75,$_POST['w'],$_POST['h']);
		imagejpeg($tmp, $pozaAlbumThumb,100);
		
		imagedestroy($tmp);
		imagedestroy($src);
		
		$sql = "INSERT INTO galerie_poze VALUES (NULL, ?, ?, ?, ?, ?);";
		
		$stmt = $__CONN__->prepare($sql);
		if($stmt->execute(array($_SESSION['numePoza'], $_SESSION['codProdus'], $_SESSION['descrierePoza'], $numePoza, $_SESSION['albumPoza']))) {
		
			Flash::set('success', 'Imaginea a fost adaugata in albumul '.$numeAlbumOrg.' cu succes.');
			Observer::notify('salveaza.imagine.plugin.galerie');
		}
		else {
			Flash::set('error', 'Imaginea nu a fost adaugata. O eroare neasteptata a intervenit.');	
		}
								
		goto_plugin('galerie/index');
	}
	
?>
<script language="Javascript">
	jQuery(function(){
		jQuery('#cropbox').Jcrop({
			setSelect: [ 20, 130, 480, 230 ],
			bgColor: 'green',
			bgOpacity: .6,
			sideHandles: false,
			onSelect: updateCoords,
			aspectRatio: 1 / 1

		});
	});
	function updateCoords(c){
		jQuery('#x').val(c.x);
		jQuery('#y').val(c.y);
		jQuery('#w').val(c.w);
		jQuery('#h').val(c.h);
	};
	function checkCoords(){
		if (parseInt(jQuery('#w').val()) && parseInt(jQuery('#h').val())) return true;
		alert('Selectati o regiune apoi apasati butonul Decupare.');
		return false;
	};
</script>
<div class="content-box-header">
	<h3>
		Pasul 2 : Decupare imagine
	</h3>
	<div class="clear"></div>
</div>
<div class="content-box-content">
<img src="<?php echo $poza; ?>" id="cropbox" />
<form action="<?php echo get_url('plugin/galerie/crop/'.$numePoza); ?>" method="post" onsubmit="return checkCoords();">
	<input type="hidden" id="x" name="x" />
	<input type="hidden" id="y" name="y" />
	<input type="hidden" id="w" name="w" />
	<input type="hidden" id="h" name="h" />
    <br />
	<input type="submit" value="Decupare" class="button" />
</form>

</div>