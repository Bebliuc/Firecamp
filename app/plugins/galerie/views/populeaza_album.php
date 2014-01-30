<?php
global $__CONN__;
$sql = "SELECT * FROM galerie_album";
$stmt = $__CONN__->prepare($sql);
$stmt->execute();
?>	 
<form method="POST" action="<?php echo get_url('plugin/galerie/upload'); ?>" class="uniForm" enctype="multipart/form-data" >
    <fieldset class="inlineLabels">
        <div class="ctrlHolder">
            <label for="numePoza">Nume imagine</label>
            <input type="text" name="numePoza" class="textInput" />
        </div>
       	 <div class="ctrlHolder">
            <label for="codProdus">Cod produs</label>
            <input type="text" name="codProdus" class="textInput" />
        </div>
         <div class="ctrlHolder">
            <label for="descrierePoza">Descriere poza</label>
            <textarea name="descrierePoza"></textarea>
        </div>
        <div class="ctrlHolder">
            <label for="incarcaPoza">Incarca poza</label>
            <input id="incarcaPoza" class="fileUpload" type="file" size="30" name="poza"/>
            <p class="formHint">Your image will be resized to 75 × 75 pixels.</p>
        </div>
							  
         <div class="ctrlHolder">
         	<label for="idAlbum">Album poza</label>
           	<select name="idAlbum">
            <?php while($album = $stmt->fetchObject()) { ?>
            	<option value="<?php echo $album->id; ?>"><?php echo $album->nume; ?></option>
            <?php } ?>
            </select>
        </div><br />
        <div class="buttonHolder">
            <input type="submit" value="Salveaza" name="salveazaCategorie" class="ui" id="button" />
        </div>
    </fieldset>
</form>