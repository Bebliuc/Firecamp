<?php
global $__CONN__;
$sql = "SELECT * FROM galerie_album";
$stmt = $__CONN__->prepare($sql);
$stmt->execute();
?>
<div class="content-box-header">
	<h3>
		Editeaza poza : <?php echo $nume; ?>
	</h3>
	<div class="clear"></div>
</div>
<div class="content-box-content">
<form method="POST" action="<?php echo get_url('plugin/galerie/actualizeaza_imagine/'.$id); ?>" enctype="multipart/form-data" >
    <fieldset>
    	<p>
            <label for="numePoza">Nume imagine</label>
            <input type="text" name="numePoza" class="text-input small-input" value="<?php echo $nume; ?>" />
        </p>
		<p>
            <label for="codProdus">Cod produs</label>
            <input type="text" name="codProdus" class="text-input small-input" value="<?php echo $cod_produs; ?>" />
       	</p>
		<p>
            <label for="descrierePoza">Descriere poza</label>
            <textarea name="descrierePoza"><?php echo $descriere; ?></textarea>
       	</p>
		<p>
         	<label for="idAlbum">Album poza</label>
           	<select name="idAlbum">
            <?php while($album = $stmt->fetchObject()) { 
			if($albumid == $album->id) 
				$status = 'selected="selected" ';
			else
				$status = '';
			
			?>
                <option <?php echo $status; ?>value="<?php echo $album->id; ?>"><?php echo $album->nume; ?></option>
            <?php } ?>
            </select>
            <input type="hidden" value="<?php echo $albumid; ?>" name="albumVechi" />
            <input type="hidden" value="<?php echo strtolower(str_replace(" ", "_", $nume)); ?>" name="numeVechi" />
        </p>
        <p>
            <input type="submit" value="Salveaza" name="salveazaPoza" class="button" />
			<input type="submit" value="Salveaza si continua editarea" name="salveazaPozaSiContinua" class="button" />
       </p>
    </fieldset>
</form>
</div>