<h2><b><?php echo __('Media albums'); ?></b></h2>
<div id="contentHolder">
<table class="tbl-permissions">
	<thead>
		<th><?php echo __('Album title'); ?></th>
		<th><?php echo __('Album type'); ?></th>
		<th class="tbl-right"><?php echo __('Actions'); ?></th>
	</thead>
	<tbody>
		<?php foreach($albums as $album): ?>
		<tr>
			<td><?php echo $album->title; ?></td>
                            <?php if($album->type == 'music') { ?>
                                <td><sup class="role user-type-invited"><?php echo ucwords($album->type); ?></sup></td>
                            <?php } else { ?>
                                <td><sup class="role user-type-admin"><?php echo ucwords($album->type); ?></sup></td
                            ><?php } ?>
			<td class="tbl-right"><sup class="role user-type-owner"><a href="<?php echo get_url('plugin/media/add_record').'/'.$album->id.'/'.$album->type; ?>"><?php echo __('Add'); ?> <?php echo ucwords($album->type); ?></a></sup><sup class="role user-type-invited"><a href="<?php echo get_url('plugin/media/view_records').'/'.$album->id; ?>"><?php echo ('Records'); ?></a></sup><sup class="role user-type-yellow"><a href="<?php echo get_url('plugin/media/edit_album').'/'.$album->id; ?>"><?php echo __('Edit'); ?></a></sup><sup class="role user-type-admin"><a href="<?php echo get_url('plugin/media/delete_album').'/'.$album->id; ?>"><?php echo __('Delete'); ?></a></sup></td>
		</tr>
		<?php endforeach; ?>
		<?php if(count($albums) == 0):  ?>
			<tr><td><?php echo __('There are no albums yet. Please add one using the <i>Add new album</i> button from the submenu.'); ?></td><td></td><td></td></tr>
		<?php endif; ?>
	</tbody>
</table>
</div>

<h2><b><?php echo __('Last 25 records added'); ?></b></h2>
<div id="contentHolder">
<table class="tbl-permissions">
	<thead>
		<th><?php echo __('Record title'); ?></th>
		<th><?php echo __('Album'); ?></th>
		<th class="tbl-right"><?php echo __('Actions'); ?></th>
	</thead>
	<tbody>
		<?php foreach($records as $record): ?>
		<tr>
			<td><?php echo $record->title; ?></td>
                          <?php if(media::getAlbumTypeFromId($record->album) == 'music') { ?>
                                <td><sup class="role user-type-invited"><?php echo media::getAlbumTitleFromId($record->album); ?></sup></td>
                            <?php } else { ?>
                                <td><sup class="role user-type-admin"><?php echo media::getAlbumTitleFromId($record->album); ?></sup></td
                            ><?php } ?>
          
                                <td class="tbl-right"><sup class="role user-type-yellow"><a href="<?php echo get_url('plugin/media/edit_record').'/'.$record->id.'/'.media::getAlbumTypeFromId($record->album); ?>"><?php echo __('Edit'); ?></a></sup><sup class="role user-type-admin"><a href="<?php echo get_url('plugin/media/delete_record').'/'.$record->id; ?>"><?php echo __('Delete'); ?></a></sup></td>
		</tr>
		<?php endforeach; ?>
		<?php if(count($records) == 0):  ?>
			<tr><td><?php echo __('There are no records yet. Please add one using the <i>Add record</i> button from the menu.'); ?></td><td></td><td></td></tr>
		<?php endif; ?>
	</tbody>
</table>
</div>