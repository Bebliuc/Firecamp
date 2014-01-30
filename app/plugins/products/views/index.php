<div class="content-box-header">	
		<h3>Lista produse</h3>
		<div class="clear"></div>		
</div>
<script type="text/javascript">
$(document).ready(function () {
	$('table#products tbody tr').quicksearch({
		position: 'before',
		attached: 'table#products',
		stripeRowClass: ['odd', 'even'],
		labelText: 'Cautare rapida: ',
		loaderImg: '<?php echo BASE_URL.'app/layouts/admin/resources/images/ajax-loader.gif'; ?>',
		delay: 600
	});
});
</script>
<div class="content-box-content">
	<table id="products">
		<thead>
			<tr>
				<th></th>
				<th>Id</th>
				<th>Titlu</th>
				<th>Categorie</th>
				<th>Rating</th>
				<th>Editare</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($products as $product): ?>
            <tr>
            	<td></td>
				<td><?php echo $product->id; ?></td>
            	<td><?php echo $product->title; ?></td>
				<td><?php echo $product->name; ?></td>
				<td><?php echo rating::getfromid('product'.$product->id); ?> / 5</td>
				<td><a href="<?php echo get_url('plugin/products/edit/'.$product->id); ?>"><img src="<?php echo BASE_URL; ?>app/plugins/products/views/images/icons/edit.png" alt="Editare" /></a>
					<a href="#" class="sterge" title="<?php echo get_url('plugin/products/delete/'.$product->id); ?>"><img src="<?php echo BASE_URL; ?>app/plugins/products/views/images/icons/delete.png" alt="Stergere" /></a></td>
            </tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<div class="pagination"> 
    	<?php if($page != 0) { ?> <a href="<?php echo $pagination['first_page']; ?>" title="First Page">&laquo; Prima pagina</a><?php } ?>
		<?php echo $pagination['previous']; ?> 
        	<?php for($i = 0; $i <= $pagination['total_pages'];$i++): ?>
         		<?php $class = ($i == $page ? 'number current' : 'number'); ?>   
				<a href="<?php echo get_url('plugin/products/index/'.$i); ?>" class="<?php echo $class; ?>" title="1"><?php echo ($i + 1); ?></a> 
            <?php endfor; ?>
		<a href="#" title="Next Page"><?php echo $pagination['next']; ?> </a>
        <a href="<?php echo $pagination['last_page']; ?>" title="Last Page">Ultima pagina &raquo;</a> 
	</div>
</div>
