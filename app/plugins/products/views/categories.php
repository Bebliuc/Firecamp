<div class="content-box-header">	
		<h3>Administrare Categorii &amp; Subcategorii existente</h3>
		<div class="clear"></div>		
</div>
<div class="content-box-content" id="hidden">
	<div id="upload_debug"></div>
	<table id="products">
		<thead>
			<tr>
				<th></th>
				<th>Id</th>
				<th>Nume</th>
				<th>Categorie</th>
			</tr>
		</thead>
		<tbody>
		<?php 
        $data = record::findAllFrom('products_categories');
        foreach($data as $key): ?>
            <tr>
            	<td></td>
				<td><?php echo $key->id; ?></td>
            	<td><?php echo $key->name; ?></td>
				<td><?php echo ($key->parent == 0 ? '-' : products::getSubcategoryName($key->parent)); ?></td>
				<td><a href="#" class="sterge" title="<?php echo get_url('plugin/products/delete_category/'.$key->id); ?>"><img src="<?php echo BASE_URL; ?>app/plugins/products/views/images/icons/delete.png" alt="Stergere" /></a></td>
            </tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
</div>
<div class="content-box">
<div class="content-box-header">	
		<h3>Adaugare categorie / subcategorie</h3>
		<div class="clear"></div>		
</div>
<div class="content-box-content">
	<div id="upload_debug"></div>
	<form method="POST" name="category_add" action="<?php echo get_url('plugin/products/category_add'); ?>">
        <fieldset>
           <p>
                <label for="category">Categorie</label>
				<select name="category" id="category" size="1" title="ajax">
					<option value="0">Categorie Principala</option>
					<?php foreach(Products::findCategories() as $category):?>
						<option value="<?php echo $category->id; ?>">
							<?php echo $category->name; ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>

            <p>
                <label for="subcategory">Nume Categorie / Subcategorie</label>
                <input type="text" name="name" class="text-input small-input" />
            </p>
            <p>
                <input type="submit" name="submit" class="button" value="Salveaza" />
            </p>
        </fieldset>
    </form>
</div>
<script type="text/javascript" charset="utf-8">
	// ADD PRODUCT JAVASCRIPT CODE
	$(function() {
        $("#hidden").hide();
		$("#category").change(function() {
			var selected = $("option:selected", this).val();
			var url = "<?php echo get_url('plugin/products/get_subcategories/'); ?>" + selected;
			$.ajax({
			   type: "POST",
			   url: url,
			   success: function(msg){
				 $("#subcategory").html(msg);
			   }
			 });
		});
	});
</script>