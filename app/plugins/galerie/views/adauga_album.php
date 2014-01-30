<?php
$sql = "SELECT * FROM galerie_categorii";

global $__CONN__;
$stmt = $__CONN__->prepare($sql);
$stmt->execute();
$nr = $stmt->rowCount();
if($nr == 0) {
	Flash::set('error', 'Va rugam sa adaugati o categorie inainte de a adauga un album.');
	redirect(get_url('galerie/adauga_categorie'));	
}
?>
<div class="content-box-header">
	<h3>
		Adauga album
	</h3>
	<div class="clear"></div>
</div>
<div class="content-box-content">
<form method="POST" action="<?php echo get_url('plugin/galerie/salveaza_album'); ?>">
    <fieldset>
    	<p>
            <label for="numeAlbum">Nume album</label>
            <input type="text" name="numeAlbum" class="text-input small-input" />
       	</p>
		<p>
            <label for="idCategorie">Categorie album</label>
            <select name="idCategorie">
          	<?php while($categorie = $stmt->fetchObject()) { ?>
            	<option value="<?php echo $categorie->id; ?>"><?php echo $categorie->nume; ?></option>
            <?php } ?>
            </select>
        </p>
        <p>
            <input type="submit" value="Salveaza" name="salveazaAlbum" class="button" />
        </p>
    </fieldset>
</form
</div>