<?php
if(Green::segment(2) == 'adauga_imagine')
	$current = 'class="current"';
else
	$current = '';
?>
<li><a href="<?php echo get_url('plugin/banner_rotator/adauga_imagine'); ?>" <?php echo $current; ?>>Adauga imagine</a></li>