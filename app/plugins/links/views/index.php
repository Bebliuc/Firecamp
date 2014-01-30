<div class="content-box-header">	
		<h3>Links list</h3>
		<div class="clear"></div>		
</div>
<script type="text/javascript">
$(document).ready(function () {
	$('table#links tbody tr').quicksearch({
		position: 'before',
		attached: 'table#links',
		stripeRowClass: ['odd', 'even'],
		labelText: 'Quick search: ',
		loaderImg: '<?php echo BASE_URL.'app/layouts/admin/resources/images/ajax-loader.gif'; ?>',
		delay: 600
	});
});
</script>
<div class="content-box-content">
	<table id="links">
		<thead>
			<tr>
				<th></th>
				<th>Id</th>
				<th>Title</th>
				<th>Category</th>
				<th>Url/Description</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($links as $link): ?>
            <tr>
            	<td></td>
				<td id="left"><small><?php echo $link->id; ?></small></td>
				<td id="left"><small><?php echo $link->title; ?></small></td>
				<td id="left"><small><?php echo $link->category; ?></small></td>
            	<td id="left"><small><b>Url: </b><u><?php echo main::cutText($link->link, '155'); ?></u><br /><b>Description: </b><?php echo main::cutText($link->description, '155'); ?></small></td>
				<td id="left"><a href="<?php echo get_url('plugin/links/edit/'.$link->id); ?>"><img src="<?php echo BASE_URL; ?>app/plugins/products/views/images/icons/edit.png" alt="Editare" /></a>
					<a href="#" class="sterge" title="<?php echo get_url('plugin/links/delete/'.$link->id); ?>"><img src="<?php echo BASE_URL; ?>app/plugins/products/views/images/icons/delete.png" alt="Stergere" /></a></td>
            </tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
