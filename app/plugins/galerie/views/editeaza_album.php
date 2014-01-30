<?php
$sql = "SELECT * FROM galerie_categorii";

global $__CONN__;
$stmt = $__CONN__->prepare($sql);
$stmt->execute();
$nr = $stmt->rowCount();
if($nr == 0) {
	Flash::set('error', 'Va rugam sa adaugati o categorie inainte de a adauga un album.');
	goto_plugin('galerie/adauga_categorie');	
}
?>
<div class="content-box-header">
	<h3>
		Editeaza album
	</h3>
	<div class="clear"></div>
</div>
<div class="content-box-content">
<form method="POST" action="<?php echo get_url('plugin/galerie/resalveaza_album/'.$id); ?>" >
    <fieldset>
       <p>
            <label for="numeAlbum">Nume album</label>
            <input type="text" name="numeAlbum" class="text-input small-input" value="<?php echo $nume; ?>" />
       </p>
		<p>
            <label for="idCategorie">Categorie album</label>
            <select name="idCategorie">
          	<?php while($categorie = $stmt->fetchObject()) { 
			if($categorie->id == $idCategorie)
				$current = ' selected="selected"';
			else
				$current = NULL;	
			
			?>
            	<option value="<?php echo $categorie->id; ?>" <?php echo $current; ?>><?php echo $categorie->nume; ?></option>
            <?php } ?>
            
            </select>
        </p>
        
    	<p>
	
            <input type="submit" value="Salveaza" name="salveazaAlbum" class="button" />
        </p>
    </fieldset>
</form>
</div>