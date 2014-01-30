<div id="contentHolder">
<table  class="tbl-permissions">
		<thead>
			<tr>
				<th id="left">Id Categorie</th>
				<th id="left">Nume categorie</th>
				<th id="left">Actiuni</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($categorii as $cat): ?>
            <tr>
				<td id="left"><?php echo $cat->id; ?></td>
				<td id="left"><?php echo $cat->nume; ?></td>
				<td id="left">
					<sup class="role user-type-admin"><a href="<?php echo get_url('plugin/evenimente/c_delete/'.$cat->id); ?>" class="sterge">Sterge</a></sup>
					<sup class="role user-type-owner"><a href="<?php echo get_url('plugin/evenimente/c_edit/'.$cat->id); ?>">Modifica</a></sup>
</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
</table>
</div>
