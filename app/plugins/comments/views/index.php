<table class="commit-commands">
	<thead>
		<tr>
			<th>Name</th>
			<th>Details</th>
			<th>Comment</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
<?php foreach($comments as $comment): ?>
	<tr <?php if($comment->status == '2') echo 'class="tbl-disabled"'; ?>>
		<th><var><?php echo $comment->author; ?></var></th>
		<td><code><strong><?php echo page::getPageTitleById($comment->page_id); ?></strong></code><br /><code><?php echo $comment->email; ?></code></td>
		<td><code><?php echo Main::cutText($comment->content, 200); ?></code></td>
		<td>
			<ul>
				<?php if($comment->status == '1') { ?>
				<li><sup class="role user-type-invited"><a href="<?php echo get_url('plugin/comments/unapprove_comment/'.$comment->id); ?>">Unapprove</a></sup></li>
				<?php } else { ?>
				<li><sup class="role user-type-invited"><a href="<?php echo get_url('plugin/comments/approve_comment/'.$comment->id); ?>">Approve</a></sup></li>	
				<?php } ?>
				<li><sup class="role user-type-admin"><a href="<?php echo get_url('plugin/comments/delete_comment/'.$comment->id); ?>">Delete</a></sup></li>
			</ul>
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
</table>
	<div class="pagination"> 
    	<?php if($page != 0) { ?> <a href="<?php echo $pagination['first_page']; ?>" title="First Page">&laquo; First</a><?php } ?>
		<?php echo $pagination['previous']; ?> 
        	<?php for($i = 0; $i <= $pagination['total_pages'];$i++): ?>
         		<?php $class = ($i == $page ? 'number current' : 'number'); ?>   
				<a href="<?php echo get_url('plugin/comments/index/'.$i); ?>" class="<?php echo $class; ?>" title="1"><?php echo ($i + 1); ?></a> 
            <?php endfor; ?>
		<a href="#" title="Next Page"><?php echo $pagination['next']; ?> </a>
        <a href="<?php echo $pagination['last_page']; ?>" title="Last Page">Last &raquo;</a> 
	</div>