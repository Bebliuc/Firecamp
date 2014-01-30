<h2>Albums</h2>
<div id="contentHolder">
<table class="tbl-permissions">
	<thead>
		<th>Album title</th>
		<th>Number of photos</th>
		<th class="tbl-right">Actions</th>
	</thead>
	<tbody>
		<?php foreach($albums as $album): ?>
		<tr>
			<td><?php echo $album->name; ?></td>
			<td><?php echo gallery::photosNumber($album->id); ?></td>
			<td class="tbl-right"><sup class="role user-type-owner"><a href="<?php echo get_url('plugin/gallery/add_photo').'/'.$album->id; ?>">Add photo</a></sup><sup class="role user-type-yellow"><a href="<?php echo get_url('plugin/gallery/edit_album').'/'.$album->id; ?>">Edit</a></sup><sup class="role user-type-admin"><a href="<?php echo get_url('plugin/gallery/delete_album').'/'.$album->id; ?>">Delete</a></sup></td>
		</tr>
		<?php endforeach; ?>
		<?php if(count($albums) == 0):  ?>
			<tr><td>There are no albums yet. Please add one using the <i>Add new album</i> button from the submenu.</td><td></td><td></td></tr>
		<?php endif; ?>
	</tbody>
</table>
</div>

<h2>Latest photos added</h2>
<div id="contentHolder">
<table class="tbl-permissions">
	<thead>
		<th>Photo title</th>
		<th>Album</th>
		<th class="tbl-right">Actions</th>
	</thead>
	<tbody>
		<?php foreach($photos as $photo): ?>
		<tr>
			<td><?php echo $photo->title; ?></td>
			<td><?php echo gallery::getAlbumName($photo->album); ?></td>
			<td class="tbl-right"><sup class="role user-type-yellow"><a href="<?php echo get_url('plugin/gallery/edit_photo').'/'.$photo->id; ?>">Edit</a></sup><sup class="role user-type-admin"><a href="<?php echo get_url('plugin/gallery/delete_photo').'/'.$photo->id; ?>">Delete</a></sup></td>
		</tr>
		<?php endforeach; ?>
		<?php if(count($photos) == 0):  ?>
			<tr><td>There are no photos yet. Please add one using the <i>Add new photo</i> from the albums action bar.</td><td></td><td></td></tr>
		<?php endif; ?>
	</tbody>
</table>
</div>