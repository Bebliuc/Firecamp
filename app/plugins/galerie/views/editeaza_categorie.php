<div class="content-box-header">
	<h3>
		Editeaza categorie
	</h3>
	<div class="clear"></div>
</div>
<div class="content-box-content">
<form method="POST" action="<?php echo get_url('plugin/galerie/resalveaza_categorie/'.$id); ?>">
    <fieldset>
       <p>
            <label for="numeCategorie">Nume categorie</label>
            <input type="text" name="numeCategorie" class="text-input small-input" value="<?php echo $nume; ?>" />
       </p>
	   <p>
            <input type="submit" value="Salveaza" name="salveazaCategorie" class="button" />
       </p>
    </fieldset>
</form>
</div>