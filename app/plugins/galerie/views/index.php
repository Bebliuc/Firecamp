<div class="content-box-header">
	<h3>
		Lista albume
	</h3>
	<div class="clear"></div>
</div>
<div class="content-box-content">
<table width="100%">
<thead>
	<th>Id</th>
	<th>Nume album</th>
    <th>Categorie</th>
	<th>Editeaza</th>
</thead>
<tbody>
<?php

global $__CONN__;

$sql = "SELECT * FROM galerie_album ORDER BY id ASC";
$stmt = $__CONN__->prepare($sql);
$stmt->execute();

while($album = $stmt->fetchObject()) {
	
	$sql = "SELECT nume FROM galerie_categorii WHERE id = ?";
	$stmt2 = $__CONN__->prepare($sql);
	$stmt2->execute(array($album->categorie));
	$categorie = $stmt2->fetchObject();
	
?>

<tr class="trivial">
	<td class="icon"><span class="grey">(#<?php echo $album->id; ?>)</span></td>
	<td><a href="<?php echo get_url('plugin/galerie/poze_album/'.$album->id); ?>"><?php echo $album->nume; ?></a></td>
	<td><?php echo $categorie->nume; ?></td>
    <td>
		<a href="<?php echo get_url('plugin/galerie/editeaza_album/'.$album->id); ?>"><img src="<?php echo BASE_URL; ?>app/plugins/galerie/views/images/icons/picture_edit.png" /></a>
		<a href="#" class="sterge" title="<?php echo get_url('plugin/galerie/sterge_album/'.$album->id); ?>"><img src="<?php echo BASE_URL; ?>app/plugins/galerie/views/images/icons/picture_delete.png" /></a>
	</td>
</tr>
	
<?php } ?>
</tbody>
</tbody>
</table>
</div>
