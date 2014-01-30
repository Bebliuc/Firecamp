<div id="contentHolder">
<table class="tbl-permissions">
<thead>
	<tr>
		<th>Id</th>
		<th>Permissions group name</th>
		<th class="tbl-right">Actions</th>
	</tr>
</thead>
<tbody>
<?php
$groups = Record::findAllFrom('utilizatori_grup', 'id != 0 ORDER BY nume ASC');
foreach($groups as $group):
?>
<tr>
	<td><?php echo $group->id; ?></td>
	<td><?php echo $group->nume; ?></td>
    <td class="tbl-right">
	<sup class="role user-type-admin"><a href="<?php echo get_url('usergroup/delete/'.$group->id); ?>" class="sterge">Delete</a></sup>
	</td>
</tr>

<?php endforeach; ?>
<tbody>
</table>
</div>