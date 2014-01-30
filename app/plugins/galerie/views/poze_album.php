
<?php

global $__CONN__;

$sql = "SELECT nume FROM galerie_album WHERE id = ? ;";
$stmt = $__CONN__->prepare($sql);
$stmt->execute(array($id));
$album = $stmt->fetchObject();
$numeAlbum = $album->nume;

$sql = "SELECT id, nume, cod_produs, album FROM galerie_poze WHERE album = ? ;";

$stmt = $__CONN__->prepare($sql);
$stmt->execute(array($id));

?>
<?php echo $action; ?>
<div class="content-box-header">
	<h3>
		Poze album <b><?php echo $numeAlbum; ?>
	</h3>
	<div class="clear"></div>
</div>
<div class="content-box-content">
<table width="100%">
<thead>
	<th>Id</th>
	<th>Nume poza</th>
	<th>Cod produs</th>
	<th>Album</th>
    <th>Editeaza</th>
</thead>
<tbody>
<?php
while($poza = $stmt->fetchObject()) {

$sql = "SELECT nume FROM galerie_album WHERE id = ? ;";

$stmt2 = $__CONN__->prepare($sql);
$stmt2->execute(array($poza->album));
$album = $stmt2->fetchObject();
	
?>

<tr class="trivial" id="recordsArray_<?php echo $poza->id; ?>">
	<td class="icon"><span class="grey">(#<?php echo $poza->id; ?>)</span></td>
	<td><?php echo $poza->nume; ?></td>
	<td><?php echo $poza->cod_produs; ?></td>
	<td><?php echo $album->nume; ?></td>
    <td>
    	<a href="<?php echo get_url('plugin/galerie/editeaza_imagine/'.$poza->id); ?>"><img src="<?php echo BASE_URL; ?>app/plugins/galerie/views/images/icons/picture_edit.png" /></a>
		<a href="#" class="sterge" title="<?php echo get_url('plugin/galerie/sterge_poza/'.$poza->id); ?>"><img src="<?php echo BASE_URL; ?>app/plugins/galerie/views/images/icons/picture_delete.png" /></a>
	</td>
</tr>
	
<?php } ?>
</tbody>
</tbody>
</table>
</div>