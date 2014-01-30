<div class="content-box-header">	
		<h3>Navigatie</h3>
		<div class="clear"></div>		
</div>
<div class="content-box-content">
<h3 class="section">Butoane de navigare principale</h3>
<table id="butoane">
<thead>
	<tr>
		<th>Id</th>
		<th>Nume buton</th>
		<th>Adresa buton</th>
		<th>Controller</th>
		<th>Editeaza</th>
	</tr>
</thead>
<tbody>
<?php

global $__CONN__;

$sql = "SELECT * FROM admin_menu WHERE controller_base IS NULL ORDER BY weight ASC";
$stmt = $__CONN__->prepare($sql);
$stmt->execute();

while($buton = $stmt->fetchObject()) {
?>

<tr class="trivial" id="recordsArray_<?php echo $buton->id; ?>">
	<td class="icon"><span class="grey">(#<?php echo $buton->weight; ?>)</span></td>
	<td><?php echo $buton->nume; ?></td>
	<td><?php echo $buton->url; ?></td>
	<td><?php echo $buton->controller; ?></td>
    <td class="actions"><a title="<?php echo get_url('nav/sterge_nav/'.$buton->id); ?>" class="sterge"><img src="<?php echo BASE_URL; ?>app/layouts/admin/resources/images/icons/button_delete.png" alt="Delete" /></a></td>
</tr>
	
<?php } ?>
</tbody>
</table>

<h3 class="section">Butoane de navigare secundare</h3>
<table>
	<thead>
		<tr>
			<th>Id</th>
			<th>Nume buton</th>
			<th>Adresa buton</th>
			<th>Controller</th>
			<th>Editeaza</th>
		</tr>
	</thead>
<tbody>
<?php

global $__CONN__;

$sql = "SELECT * FROM admin_menu WHERE controller_base IS NOT NULL ORDER BY weight ASC";
$stmt = $__CONN__->prepare($sql);
$stmt->execute();

while($buton = $stmt->fetchObject()) {
?>

<tr class="trivial" id="recordsArray_<?php echo $buton->id; ?>">
	<td class="icon"><span class="grey">(#<?php echo $buton->weight; ?>)</span></td>
	<td><?php echo $buton->nume; ?></td>
	<td><?php echo $buton->url; ?></td>
	<td><?php echo $buton->controller; ?></td>
    <td class="actions"><a title="<?php echo get_url('nav/sterge_nav/'.$buton->id); ?>" class="sterge"><img src="<?php echo BASE_URL; ?>app/layouts/admin/resources/images/icons/button_delete.png" alt="Delete" /></a></td>
</tr>
	
<?php } ?>
</tbody>
</table>
   <script type="text/javascript">
		$(document).ready(function(){ 
			$("#error").hide();
			$(function() {
				$("#butoane tbody").sortable({ opacity: 0.6, cursor: 'move', update: function() {
					var order = $(this).sortable("serialize");
					$.post("<?php echo get_url('nav/salveaza_ordine'); ?>", order, function(theResponse){
						$("#error").hide().fadeIn(600);									
						$("#error").html(theResponse);
					});
				}
				});
			});
		
		});
	</script> 
</div>