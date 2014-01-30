<?php
if(Green::segment(2) == 'categorii' OR Green::segment(2) == 'poze_album')
	$current = 'class="current"';
else
	$current = '';
?>
<li><a href="<?php echo get_url('plugin/galerie/categorii'); ?>" <?php echo $current; ?>>Categorii</a></li>
<?php
if(Green::segment(2) == 'adauga_categorie')
	$current = 'class="current"';
else
	$current = '';
?>
<li><a href="<?php echo get_url('plugin/galerie/adauga_categorie'); ?>" <?php echo $current; ?>>Adauga categorie</a></li>
<?php
if(Green::segment(2) == 'adauga_album' OR Green::segment(2) == 'editeaza_album')
	$current = 'class="current"';
else
	$current = '';
?>
<li><a href="<?php echo get_url('plugin/galerie/adauga_album'); ?>" <?php echo $current; ?>>Adauga album</a></li>
<?php
if(Green::segment(2) == 'imagine_noua' OR Green::segment(2) == 'crop' OR Green::segment(2) == 'editeaza_imagine')
	$current = 'class="current"';
else
	$current = '';
?>
<li><a href="<?php echo get_url('plugin/galerie/imagine_noua'); ?>" <?php echo $current; ?>>Populeaza album</a></li>
