<?php if(Green::segment(2) == 'create') $current = 'class="current"'; else $current = ''; ?>
<li><a href="<?php echo get_url('plugin/faq/create'); ?>" <?php echo $current; ?>>Create new FAQ</a></li>