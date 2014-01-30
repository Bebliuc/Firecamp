<?php if(Green::segment(2) == 'add') $current = 'class="current"'; else $current = ''; ?>
<li><a href="<?php echo get_url('plugin/products/add'); ?>" <?php echo $current; ?>>Adauga produs</a></li>
<?php if(Green::segment(2) == 'categories') $current = 'class="current"'; else $current = ''; ?>
<li><a href="<?php echo get_url('plugin/products/categories'); ?>" <?php echo $current; ?>>Categories</a></li>