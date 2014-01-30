<script type="text/javascript">
 jQuery(function() {
 	<?php Page::js(0,0); ?>
 });
</script>
<div id="contentHolder">
    <table class="tbl-permissions">
    	<thead>
    		<tr>
    			<th><?php echo __('Page'); ?></th>
    			<th><?php echo __('Status'); ?></th>
    			<th><?php echo __('Author'); ?></th>
    			<th class="tbl-right"><?php echo __('Actions'); ?></th>
    			<?php Observer::notify('page.index.th'); ?>
    		</tr>
    	</thead>
    	<tbody>
    	<?php Page::generatePages(); ?>
    	</tbody>
    </table>
</div>
