<div class="content-box-header">	
		<h3>Faq list</h3>
		<div class="clear"></div>		
</div>
<script type="text/javascript">
$(document).ready(function () {
	$('table#faq tbody tr').quicksearch({
		position: 'before',
		attached: 'table#faq',
		stripeRowClass: ['odd', 'even'],
		labelText: 'Quick search: ',
		loaderImg: '<?php echo BASE_URL.'app/layouts/admin/resources/images/ajax-loader.gif'; ?>',
		delay: 600
	});
});
</script>
<div class="content-box-content">
	<table id="faq">
		<thead>
			<tr>
				<th></th>
				<th>Id</th>
				<th>Question</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($faqs as $faq): ?>
            <tr>
            	<td></td>
				<td id="left"><?php echo $faq->id; ?></td>
            	<td id="left"><small><b>Q: </b><u><?php echo main::cutText($faq->question, '155'); ?></u><br /><b>A: </b><?php echo main::cutText($faq->answer, '155'); ?></small></td>
				<td id="left"><a href="<?php echo get_url('plugin/faq/edit/'.$faq->id); ?>"><img src="<?php echo BASE_URL; ?>app/plugins/products/views/images/icons/edit.png" alt="Editare" /></a>
					<a href="#" class="sterge" title="<?php echo get_url('plugin/faq/delete/'.$faq->id); ?>"><img src="<?php echo BASE_URL; ?>app/plugins/products/views/images/icons/delete.png" alt="Stergere" /></a></td>
            </tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
