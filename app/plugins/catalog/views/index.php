<div class="content-box-header">	
		<h3>Catalog</h3>
		<ul class="content-box-tabs">
            <li>
				<a href="#catalog" class="default-tab">Catalog</a>
			</li>
            <li>
				<a href="#software">Software</a>
			</li>
			<li>
				<a href="#adauga_software">Adauga software</a>
			</li>
            <li>
				<a href="#adauga_catalog">Adauga catalog</a>
			</li>
		</ul>
		<div class="clear"></div>		
</div>
<div class="content-box-content">
    <div class="tab-content default-tab" id="catalog">
        <table id="catalog">
		<thead>
			<tr>
				<th></th>
				<th>Id</th>
				<th>Nume</th>
				<th>Link</th>
				<th>Categorie</th>
                <th>Editare</th>
			</tr>
		</thead>
		<tbody>
        <?php foreach($catalogs as $catalog): ?>
            <tr>
                <td></td>
                <td><?php echo $catalog->id; ?></td>
                <td><?php echo $catalog->name; ?></td>
                <td><?php echo $catalog->link; ?></td>
                <td><?php echo products::getCategoryName($catalog->category); ?></td>
                <td><a href="#" class="sterge" title="<?php echo get_url('plugin/catalog/delete/'.$catalog->id); ?>"><img src="<?php echo BASE_URL; ?>app/plugins/products/views/images/icons/delete.png" alt="Stergere" /></a></td>
            </tr>
        <?php endforeach; ?>
		</tbody>
	   </table>
        <script type="text/javascript">
        $(document).ready(function () {
        	$('table#catalog tbody tr').quicksearch({
          		position: 'before',
          		attached: 'table#catalog',
          		stripeRowClass: ['odd', 'even'],
          		labelText: 'Cautare rapida: ',
        		loaderImg: '<?php echo BASE_URL.'app/layouts/admin/resources/images/ajax-loader.gif'; ?>',
        		delay: 600
        	});	
        });
        </script>
    </div>
    <div class="tab-content" id="software">
        <table id="software">
		<thead>
			<tr>
				<th></th>
				<th>Id</th>
				<th>Nume</th>
				<th>Link</th>
                <th>Editare</th>
			</tr>
		</thead>
		<tbody>
        <?php foreach($softwares as $software): ?>
            <tr>
                <td></td>
                <td><?php echo $software->id; ?></td>
                <td><?php echo $software->name; ?></td>
                <td><?php echo $software->link; ?></td>
                <td><a href="#" class="sterge" title="<?php echo get_url('plugin/catalog/delete/'.$software->id); ?>"><img src="<?php echo BASE_URL; ?>app/plugins/products/views/images/icons/delete.png" alt="Stergere" /></a></td>
            </tr>
        <?php endforeach; ?>
		</tbody>
	   </table>
        <script type="text/javascript">
        $(document).ready(function () {
        	$('table#software tbody tr').quicksearch({
          		position: 'before',
          		attached: 'table#software',
          		stripeRowClass: ['odd', 'even'],
          		labelText: 'Cautare rapida: ',
        		loaderImg: '<?php echo BASE_URL.'app/layouts/admin/resources/images/ajax-loader.gif'; ?>',
        		delay: 600
        	});	
        });
        </script>
    </div>
    <div class="tab-content" id="adauga_software">
         	<form method="POST" action="<?php echo get_url('plugin/catalog/save_software'); ?>" id="add_catalog_form" name="add_catalog_form" name="post">
            <fieldset>
                <p>
                    <label for="name">Nume</label>
                    <input type="text" name="name" class="text-input medium-input" />   
                </p>
                <p>
                    <label for="name">Link</label>
                    <input type="text" name="link" class="text-input medium-input" />   
                </p>
                <p>
                    <input type="submit" value="Salveaza" class="button" style="margin-left: 10px;" />
                </p>
            </fieldset>
            </form>
    </div>
    <div class="tab-content" id="adauga_catalog">
        	<form method="POST" action="<?php echo get_url('plugin/catalog/save'); ?>" id="add_catalog_form" name="add_catalog_form" name="post">
            <fieldset>
                <p>
                    <label for="name">Nume</label>
                    <input type="text" name="name" class="text-input medium-input" />   
                </p>
                <p>
                    <label for="name">Categorie catalog</label>
                    <select name="category" id="category" size="1" title="ajax">
					<option value="0">Categorie catalog</option>
    					<?php foreach(Products::findCategories() as $category):?>
    						<option value="<?php echo $category->id; ?>">
    							<?php echo $category->name; ?>
    						</option>
    					<?php endforeach; ?>
				    </select>   
                </p>
                <p>
                    <label for="name">Link</label>
                    <input type="text" name="link" class="text-input medium-input" />   
                </p>
                <p>
                    <input type="submit" value="Salveaza" class="button" style="margin-left: 10px;" />
                </p>
            </fieldset>
            </form>
    </div>
</div>