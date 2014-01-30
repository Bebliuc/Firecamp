<div id="contentHolder">
<table  class="tbl-permissions">
		<thead>
			<tr>
				<th id="left">User</th>
				<th id="left">Module</th>
				<th id="left">Action</th>
				<th id="left">Time</th>
				<th id="left">Edit</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($logs as $log): ?>
            <tr>
				<td id="left"><small class="yui"><?php echo (!empty($log->user) ? $log->user : 'Guest'); ?></small></td>
				<td id="left"><small class="yui"><?php echo $log->module; ?></small></td>
            	<td id="left"><u><small class="yui"><?php echo $log->action; ?></small></u></td>
				<td id="left"><small class="yui"><?php echo $log->time; ?></small></td>
				<!-- <td id="left"></td>-->
				<td id="left">
					<sup class="role user-type-admin"><?php if(User::hasPermissionsTo('*')) { ?><a href="#" class="sterge" title="<?php echo get_url('plugin/logger/delete/'.$log->id); ?>">Delete</a><?php } ?></sup>
					<sup class="role user-type-owner"><a href="<?php echo get_url('plugin/logger/hide/'.$log->id); ?>">Hide</a></sup>
</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
</table>
</div>
