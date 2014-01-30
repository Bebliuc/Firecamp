<div class="content-box-header">
	<h3>
		Lista categorii
	</h3>
	<div class="clear"></div>
</div>
<div class="content-box-content">
<table width="100%">
<thead>
		<th>Id</th>
		<th>Nume categorie</th>
		<th>Editeaza</th>
</thead>
<tbody>
<?php

global $__CONN__;

$sql = "SELECT * FROM galerie_categorii ORDER BY id ASC";
$stmt = $__CONN__->prepare($sql);
$stmt->execute();

while($categorie = $stmt->fetchObject()) {
?>

<tr class="trivial">
	<td class="icon"><span class="grey">(#<?php echo $categorie->id; ?>)</span></td>
	<td><?php echo $categorie->nume; ?></td>
    <td>
		<a href="<?php echo get_url('plugin/galerie/editeaza_categorie/'.$categorie->id); ?>"><img src="<?php echo BASE_URL; ?>app/plugins/galerie/views/images/icons/category_edit.png" /></a>
    	<a href="#" class="sterge" title="<?php echo get_url('plugin/galerie/sterge_categorie/'.$categorie->id); ?>"><img src="<?php echo BASE_URL; ?>app/plugins/galerie/views/images/icons/category_delete.png" /></a>
    </td>
</tr>
	
<?php } ?>
</tbody>
</tbody>
</table>
</div>