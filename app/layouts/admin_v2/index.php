<?php
if (!class_exists('Nav'))
    include APP_PATH.'/models/User.php';

if(!User::hasPermissions()) {
	Flash::set('error', __('Access denied for user : <b>%user%</b>.', array('%user%' => $_COOKIE['user'])));
	go_to('admin/index');
}
$ctrl = Green::getController();
$action = Green::getAction();
if(!isset($nav)) $nav ="";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Firecamp - <?php echo __('Administrative panel'); ?> - <?php echo ucwords(green::$watches['pageHeading']); ?></title>

<link rel="shortcut icon" type="image/png" href="<?php echo BASE_URL; ?>app/layouts/admin_v2/images/favicon.png">
<link href="<?php echo BASE_URL; ?>app/layouts/admin_v2/css/pretty_layout.css" media="screen" rel="stylesheet" type="text/css">
<link href="<?php echo BASE_URL; ?>app/layouts/admin_v2/css/print.css" media="print" rel="stylesheet" type="text/css">

	<!-- Plugins stylesheets -->
		
	<?php foreach(Plugin::$plugins as $plugin_id => $plugin): ?>
	<?php if (file_exists(APP_PATH . '/plugins/' . $plugin_id . '/' . $plugin_id . '.css')): ?>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/plugins/<?php echo $plugin_id.'/'.$plugin_id; ?>.css"  media="screen" type="text/css">
	<?php endif; ?>
	<?php endforeach; ?>

<script src="<?php echo BASE_URL; ?>app/layouts/admin_v2/js/jquery_bundle.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>app/layouts/admin_v2/js/jquery.tabel.js" type="text/javascript"></script>
<script src="<?php echo BASE_URL; ?>app/layouts/admin_v2/js/activity.js" type="text/javascript"></script>

		<!-- Plugin scripts -->
		<?php foreach(Plugin::$plugins as $plugin_id => $plugin): ?>
		<?php if (file_exists(APP_PATH . '/plugins/' . $plugin_id . '/' . $plugin_id . '.js')): ?>
		<script type="text/javascript" charset="utf-8" src="<?php echo BASE_URL; ?>app/plugins/<?php echo $plugin_id.'/'.$plugin_id; ?>.js"></script>
		<?php endif; ?>
		<?php endforeach; ?>
 
</head>
<body id="">
	<?php if(Flash::get('error') != "") { ?>
        <div class="global-notification trial-account"><strong style="background:#FF4D49">
            <?php echo Flash::get('error'); ?></strong>
        </div>
    <?php } ?>
        
    <?php if(Flash::get('success') != "") { ?>
        <div class="global-notification trial-account"><strong style="background:#E3F5CE">
            <?php echo Flash::get('success'); ?></strong>
        </div>
    <?php } ?>

    <?php if(Flash::get('information') != "") { ?>
        <div class="global-notification trial-account"><strong>
            <?php echo Flash::get('information'); ?></strong>
        </div>
    <?php } ?>
<div id="container">

	<div id="header">

		<div class="metanav">
		
			<p class="meta-global">
				<!--<a href="<?php echo get_url(''); ?>app/layouts/admin_v2/test.html" class="help" rel="help" title="Help">Help</a>-->
				<?php echo BASE_URL; ?>
				• <a href="<?php echo get_url('login/logout'); ?>" title=""><?php echo __('Logout')?></a>
			</p>
			<!--
				  <p class="meta-personal">
				  <a href="<?php echo get_url('user/index'); ?>" title="">My Profile</a>
				• <a href="<?php echo BASE_URL; ?>" title="View Website" target="_BLANK">View website</a>
				• <a href="<?php echo get_url('login/logout'); ?>" title="Logout">Logout</a>
			</p>
			-->
		</div>
		<div id="title">
        <?php
            $titles = array(
                'admin' => 'Dashboard',
                'pages' => 'Pages',
                'nav' => 'Navigation',
                'user' => 'Members',
				'usergroup' => 'Permissions',
                'setting' => 'Options',
                'templates' => 'Templates'
            );
        ?>		
            <a href="<?php echo BASE_URL; ?>admin"><h1 class="logo_img"><strong>
            </strong><a href="<?php echo BASE_URL; ?>" target="_BLANK"><i>View website</i></a></h1></a>
			<!-- 
			<div class="dropdown">
				<ul>
                <?php 
                    $options = array();
                	$options['controller'] = Green::getController();
                    $options['plugins'] = Plugin::$controllers;
                    nav::generateThemeDropDown($options);
                 ?>
                 
				</ul>
			</div>
			-->
		</div>
		<ul class="mainnav">	
				<?php
				Nav::generateNav(Green::getController(), Plugin::$controllers, Green::getAction());
				?>
		</ul>
	</div>
	<div id="page">
		<h1 class="page-heading" id="activity-selector"><?php if(isset(green::$watches['pageHeading'])) echo __(green::$watches['pageHeading']); ?>
		<?php
			if(isset(green::$watches['submenu'])) {
				foreach(green::$watches['submenu'] as $link => $title) {
					echo '<a class="button" href="'.$link.'"><span><b class="icon arrow"></b>'.__($title).'</span></a>';
				}	
			}
		?>
		<a rel="switchView" class="button" id="switchView" style="display:none" href="#"><span><b class="icon arrow"></b> <?php echo __('Toggle sidebar view'); ?></span></a></h1>
		<div class="content">
			<?php if(Green::$watches['toggleSidebar']) { ?>
            <div class="maincol" id="maincol">
            <?php } ?>
			<?php echo $content_for_layout; ?>	
			</div>
			<?php if(Green::$watches['toggleSidebar']) { ?>
			<?php if(isset(Green::$watches['sidebar'])) echo Green::$watches['sidebar']; else { ?>
            <div id="sidebar">
				<div class="wrapper">
					<?php Observer::notify('backend.sidebar'); ?>
				<div class="repo-team">
				  <h2><?php echo __('Your profile'); ?></h2>
				  
				  <ul>
					
					  <li>
						<a href="<?php echo get_url('user/edit').'/'.user::getUserId(); ?>"><span class="userpic size-large"><img height="32" width="32" src="<?php echo BASE_URL; ?>app/layouts/admin_v2/images/userpic.gif" class="photo" alt="<?php echo $_COOKIE['user']; ?>"><b></b></span><span class="username"><span class="fn"><?php echo $_COOKIE['user']; ?></span> <sup class="role user-type-owner"><?php echo user::getGroupByUser(); ?></sup></span><span class="last-ci"><?php echo __('Security Key:'); ?> <?php echo user::getUserHash(); ?></span></a>
					  </li>
					
				  </ul>
				  
				  
				</div>
				<div class="repo-subscription">
                   			<h2><?php echo __('Switch administration panel view'); ?></h2>
			<p class="action ">
			  <a rel="switchView" class="button" id="switchView" href="#"><span><b class="icon arrow"></b><?php echo __('Toggle widescreen view'); ?></span></a>
			</p>
			</div>
			<script type="text/javascript">
				jQuery(function($) {
					$('#switchView').live('click', function(e) {
						$("#sidebar").toggle();
						$("#maincol").toggleClass('maincol');
						$("#activity-selector #switchView").toggle();
						e.preventDefault();
					});
				});
			</script>
                    <?php } ?>

				</div>
			</div>
            <?php } ?>
		<?php if(Green::$watches['toggleSidebar']) { ?>
        </div>
        <?php } ?>
	</div>
	<div id="footer">
		<div class="bebliuco">
			<a class="bebliuc-logo" href="http://bebliuc.ro/" title="Bebliuc*">&nbsp;</a>
			<p class="vcard">
			<br />	© 2007 - <?php echo date('Y'); ?>, <a href="http://www.bebliuc.ro">Bebliuc*</a>. <?php echo __('All rights reserved.'); ?>
			</p>
		

		</div>
	</div>
</div>
<div id="help" class="hide">
	<div class="wrapper">
		<a href="#" class="close-help">Close</a>
		<div class="scroll-area">
			<div class="wrapper">
			</div>
		</div>
	</div>
</div>

<?php Observer::notify('admin.theme'); ?>
<script type="text/javascript">
jQuery(function($) {
	$("#toggle_exposee").click(function() {
		$("#exposee").fadeIn();
			var width = $("#exposee .holder .exposee_content").width();
			var height = $("#exposee .holder .exposee_content").height();
			
			var new_height = '-' + height / 2 + 'px';
			var new_width = '-' + width / 2 + 'px';
			$("#exposee .holder").css('marginTop', new_height).css('marginLeft', new_width);
	});
});
</script>
</body>
</html>
