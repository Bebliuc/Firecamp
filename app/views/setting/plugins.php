<?php $loaded_plugins = Plugin::$plugins; ?>
<div id="contentHolder">
        	<table class="tbl-permissions">
				<thead>
					<tr>
						<th>
							<?php echo __('Plugin'); ?>
						</th>
						<th>
							<?php echo __('Description'); ?>
						</th>
						<th>
							<?php echo __('Version'); ?>
						</th>
						<th class="tbl-date">
							<?php echo __('State'); ?>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach(Plugin::findAll() as $plugin): ?><?php $disabled = (!isset($loaded_plugins[$plugin->id])); ?>
					<tr id="<?php if ($disabled) echo 'disabled'; ?>">
						<td style="padding-left:5px;">
							<?php echo $plugin->title; ?>
						</td>
						<td>
							<?php echo $plugin->description; ?>
						</td>
						<td>
							<?php echo $plugin->version; ?>
						</td>
						<td class="tbl-date">
							<?php if(!isset($loaded_plugins[$plugin->id])) { ?><sup class="role user-type-owner"><a href="<?php echo get_url('setting/activate_plugin/'.$plugin->id); ?>"><?php echo __('Activeaza'); ?></a></sup> <?php } else { ?> <sup class="role user-type-admin"><a href="<?php echo get_url('setting/deactivate_plugin/'.$plugin->id); ?>"><?php echo __('Dezactiveaza'); ?></a></sup> <?php } ?></sup>
						</td>
					</tr><?php endforeach; ?>
				</tbody>
			</table>
</div>