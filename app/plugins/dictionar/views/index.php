<div id="contentHolder">
<h2><?php echo _('Lista cuvinte'); ?></h2>
<table  class="tbl-permissions">
		<thead>
			<tr>
				<th id="left"><?php echo _('Cuvant'); ?></th>
				<th id="left"><?php echo _('Categorie'); ?></th>
				<th id="left"><?php echo _('Action'); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($cuvinte as $cuvant): ?>
            <tr>
				<td id="left"><?php echo $cuvant->cuvant; ?></td>
				<td id="left"><?php echo $cuvant->categorie; ?></td>
				<!-- <td id="left"></td>-->
				<td id="left">
					<sup class="role user-type-owner"><a href="<?php echo get_url('plugin/dictionar/delete/'.$cuvant->id); ?>"><?php echo _('Delete'); ?></a></sup>
</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
</table>
</div>
