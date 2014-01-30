<div class="content-box-header">
	<h3>
		Instaleaza sablon
	</h3>
	<div class="clear"></div>
</div>
<div class="content-box-content">
	
	<?php foreach(Template::getThemes() as $theme): ?>
	<h3><?php echo $theme['name']; ?></h3>
	<p><?php echo $theme['description']; ?></p>
	<p><?php echo $theme['path']; ?></p>
	<p><img src="<?php echo Template::getScreenshot($theme['id']); ?>" /></p>
	<p>
		<?php if(!Template::isInstalled($theme['id'])) { ?>
			<a href="<?php echo get_url('templates/install/'.$theme['id']); ?>">Instaleaza</a></p>
		<?php  } else { ?>
			<a href="<?php echo get_url('templates/uninstall/'.$theme['id']); ?>">Dezinstaleaza</a></p>
		<?php } ?>
	<?php endforeach; ?>
</div>