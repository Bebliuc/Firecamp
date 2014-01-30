<?php
//  Init ---------------------------------------------------------------------------
if(file_exists('config/config.sample.php'))	header('Location: install/');
else include('config/config.php');

// Include custom error_handler for error_handler plugin
if(file_exists('app/plugins/error_handler/error_handler.php'))
	include 'app/plugins/error_handler/error_handler.php';

define('GREEN_ROOT', dirname(__FILE__).'/system');
define('APP_PATH',  dirname(__FILE__).'/app');

define('BASE_URL',  'http://'.dirname($_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']).'/');

define('DEFAULT_CONTROLLER', 'index');
define('DEFAULT_ACTION', 'index');


include GREEN_ROOT.'/Green.php';
include GREEN_ROOT.'/Main.php';
include GREEN_ROOT.'/Record.php';
//	Time default format ------------------------------------------------------------
date_default_timezone_set('Europe/Bucharest');

//	Create nice URLs ---------------------------------------------------------------
Green::addRoute(Page::buildRoutes());
//	Initiate Setting and Plugin Controllers-----------------------------------------
Setting::init();
Plugin::init();

//I18n::setLocale(Setting::get('language'));
I18n::setLocale('ro');

// check state and kill if 2

// template class check

include 'app/models/Template.php';

if($cfg->state == 2 && $_SERVER['REMOTE_ADDR'] != '89.39.33.126') {
$maintenance = new PluginController();
				$maintenance->setLayout('');
				$message = __(' Website is offline.');
				$details = __('<h2>Need More Time?</h2>
				<h2>We hope you enjoy using Firecamp, and we\'re committed to providing the absolute best publishing service on the internet both today and in the future.  Please feel free to contact us at any time via email or phone.</h2>
				<h2>Keeping Your Account</h2>
				<h2>To reactivate your Firecamp account and avoid losing any data, drop us an email. This website and all its data will be deleted in 14 days.</h2>
				');
				$maintenance->display('maintenance/html/index', array('message' => $message, 									      		      'details' => $details));
}

//	Get started --------------------------------------------------------------------
Green::dispatch();

Observer::notify("system.end");