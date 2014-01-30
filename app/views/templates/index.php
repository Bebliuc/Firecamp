<div id="contentHolder">
<table class="tbl-permissions">
<thead>
	<tr>
		<th><?php echo __('Nume sablon'); ?></th>
		<th><?php echo __('Tip sablon'); ?></th>
		<th class="tbl-right"><?php echo __('Editeaza'); ?></th>
	</tr>
</thead>
<tbody>
<?php
$templates = Record::findAllFrom('templates', 'id != 0 ORDER BY id ASC');
foreach($templates as $template):
?>
<tr>
	<td><?php echo $template->nume; ?></td>
	<td><i><?php echo $template->tip; ?></i></td>
    <td class="tbl-right">
	<sup class="role user-type-owner"><a href="<?php echo get_url('templates/editeaza/'.$template->id); ?>"><?php echo __('Edit'); ?></a></sup>
    <sup class="role user-type-admin"><a href="<?php echo get_url('templates/sterge/'.$template->id); ?>" class="sterge"><?php echo __('Delete'); ?></a></sup>
	</td>
</tr>

<?php endforeach; ?>
<tbody>
</table>
</div>
<?php page::getParentTitle(); ?>