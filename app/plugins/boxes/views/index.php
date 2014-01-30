<div id="contentHolder">
<table class="tbl-permissions">
<thead>
	<tr>
		<th><?php echo __('Box name'); ?></th>
		<th><?php echo __('Page title'); ?></th>
		<th class="tbl-right"><?php echo __('Actions'); ?></th>
	</tr>
</thead>
<tbody>
<?php foreach($boxes as $box): ?>
<tr>
	<td><?php echo $box->title; ?></td>
	<td><i><?php echo page::getPageTitleById($box->page_id); ?></i></td>
    <td class="tbl-right">
	<sup class="role user-type-owner"><a href="<?php echo get_url('plugin/boxes/edit/'.$box->id); ?>"><?php echo __('Edit'); ?></a></sup>
    <sup class="role user-type-admin"><a href="<?php echo get_url('plugin/boxes/delete/'.$box->id); ?>" class="sterge"><?php echo __('Delete'); ?></a></sup>
	</td>
</tr>
<?php endforeach; ?>
<tbody>
</table>
</div>
