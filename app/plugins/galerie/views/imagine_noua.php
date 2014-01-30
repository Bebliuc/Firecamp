<?php
global $__CONN__;
$sql = "SELECT * FROM galerie_album";
$stmt = $__CONN__->prepare($sql);
$stmt->execute();
?>	
<div class="content-box-header">
	<h3>
		Pasul 1 : Completeaza date poza
	</h3>
	<div class="clear"></div>
</div>
<div class="content-box-content"> 
<form method="POST" action="<?php echo get_url('plugin/galerie/imagine_noua/upload'); ?>" enctype="multipart/form-data" >
    <fieldset>
      	<p>
            <label for="numePoza">Nume imagine</label>
            <input type="text" name="numePoza" class="text-input small-input" />
        </p>
		<p>
            <label for="incarcaPoza">Incarca poza</label>
            <input id="incarcaPoza" class="fileUpload text-input small-input" type="file" size="30" name="poza"/>
        </p>
		<p>
            <label for="codProdus">Cod produs</label>
            <input type="text" name="codProdus" class="text-input small-input" />
        </p>
		<p>
            <label for="descrierePoza">Descriere poza</label>
            <textarea name="descrierePoza"></textarea>
        </p>
		<p>
         	<label for="idAlbum">Album poza</label>
           	<select name="idAlbum">
            <?php while($album = $stmt->fetchObject()) { ?>
            	<option value="<?php echo $album->id; ?>"><?php echo $album->nume; ?></option>
            <?php } ?>
            </select>
        </p>
		<p>
            <input type="submit" value="Continua" name="salveazaCategorie" class="button" />
    	</p>
    </fieldset>
</form>
</div>