<div id="contentHolder">
<table class="tbl-permissions">
<thead>
	<tr>
		<th><?php echo __('Snippet'); ?></th>
		<th  class="tbl-right"><?php echo __('Actions'); ?></th>
	</tr>
</thead>
<tbody>
<?php
$templates_parts = Record::findAllFrom('templates_parts', 'id != 0 ORDER BY id ASC');
foreach($templates_parts as $template_part):
?>
<tr>
	<td><?php echo $template_part->name; ?></td>
    <td class="tbl-right">
	<sup class="role user-type-owner"><a href="<?php echo get_url('templates/editeaza_sectiune/'.$template_part->id); ?>"><?php echo __('Edit'); ?></a></sup>
    <sup class="role user-type-admin"><a href="<?php echo get_url('templates/delete_sectiune/'.$template_part->id); ?>"><?php echo __('Delete'); ?></a></sup>
	</td>
</tr>

<?php endforeach; ?>
<tbody>
</table>
</div>