<?php foreach($popularPages as $page): ?>
	<p><strong><?php echo page::getPageTitleById($page->page_id); ?></strong> : <?php echo $page->visits; ?></p>
<?php endforeach; ?>