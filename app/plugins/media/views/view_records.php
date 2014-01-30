<h2><?php echo $album_name; ?> records</h2>
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

                                <td class="tbl-right"><sup class="role user-type-yellow"><a href="<?php echo get_url('plugin/media/edit_record').'/'.$record->id.'/'.media::getAlbumTypeFromId($record->album); ?>">Edit</a></sup><sup class="role user-type-admin"><a href="<?php echo get_url('plugin/media/delete_album').'/'.$record->id; ?>">Delete</a></sup></td>
		</tr>
		<?php endforeach; ?>
		<?php if(count($records) == 0):  ?>
			<tr><td><?php echo __('There are no records yet. Please add one using the <i>Add record</i> button from the menu.'); ?></td><td></td><td></td></tr>
		<?php endif; ?>
	</tbody>
</table>
</div>