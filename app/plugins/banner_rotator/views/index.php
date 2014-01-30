	<div class="content-box-header">
		<h3>
			Imagini banner
		</h3>
		<div class="clear"></div>
	</div>
	<div class="content-box-content">
<table width="100%">
<thead>
	<th>Id</th>
	<th>Nume imagine</th>
	<th>Descriere</th>
	<th>Blend</th>
    <th>Editeaza</th>
</thead>
<tbody>
<?php

global $__CONN__;

$sql = "SELECT * FROM banner_rotator ORDER BY id ASC";
$stmt = $__CONN__->prepare($sql);
$stmt->execute();

while($item = $stmt->fetchObject()) {
	if($item->blend == "yes")
		$blend = "Activat";
	else
		$blend = "Dezactivat";
?>

<tr id="recordsArray_<?php echo $item->id; ?>">
	<td class="icon"><span class="grey">(#<?php echo $item->id; ?>)</span></td>
	<td><?php echo $item->imagine; ?></td>
	<td><?php echo Main::cutText($item->descriere, 10); ?></td>
	<td><?php echo $blend; ?></td>
    <td>
	<a href="<?php echo get_url('plugin/banner_rotator/_editeaza/'.$item->id); ?>"><img src="<?php echo BASE_URL; ?>app/plugins/banner_rotator/banner_images/icons/image_edit.png" /></a>
	<a class="sterge" title="<?php echo get_url('plugin/banner_rotator/_sterge/'.$item->id); ?>"><img src="<?php echo BASE_URL; ?>app/plugins/banner_rotator/banner_images/icons/image_delete.png" /></a>  </td>
</tr>
	
<?php } ?>
</tbody>
</tbody>
</table>
</div>