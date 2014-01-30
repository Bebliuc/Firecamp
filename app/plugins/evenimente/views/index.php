<div id="contentHolder">
<table  class="tbl-permissions">
		<thead>
			<tr>
				<th id="left">Titlu</th>
				<th id="left">Data inceput</th>
				<th id="left">Data sfarsit</th>
				<th id="left">Categorie</th>
				<th id="left">Actiuni</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($events as $event): ?>
            <tr>
				<td id="left"><?php echo $event->titlu; ?></td>
				<td id="left"><small class="yui"><?php echo $event->data_inceput; ?></small></td>
            	<td id="left"><u><small class="yui"><?php echo $event->data_sfarsit; ?></small></u></td>
				<td id="left"><small class="yui"><?php echo eveniment::getName($event->categorie); ?></small></td>
				<!-- <td id="left"></td>-->
				<td id="left">
					<sup class="role user-type-admin"><a href="<?php echo get_url('plugin/evenimente/delete/'.$event->id); ?>" class="sterge">Sterge</a></sup>
					<sup class="role user-type-owner"><a href="<?php echo get_url('plugin/evenimente/edit/'.$event->id); ?>">Modifica</a></sup>
</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
</table>
</div>
