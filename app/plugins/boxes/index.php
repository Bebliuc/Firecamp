<?php



/**

 * @package BebliuCMS

 * @subpackage plugin

 *

 * @author Bebliuc George <george@bebliuc.ro>

 * @version 0.1

 * @copyright Bebliuc George, 2009

 */



/**

 * Boxes Plugin

 *

 * @package BebliuCMS

 * @subpackage boxes

 * @todo Simple content boxes management

 * 

 * @version 0.1

 * @since 0.1

 */

 

Plugin::setInfos(array(

		'id' => 'boxes',

		'title' => 'Boxes Management',

		'author' => 'Bebliuc',

		'website' => 'http://bebliuc.ro',

		'version' => '1.0',

		'description' => 'Simple CRUD boxes management.'));



Plugin::addController('boxes', 'Boxes');

if(plugin::isEnabled('boxes')) {

	foreach(box::getAll() as $box)

	    templateTags::add('box:'.$box->id, '<?php $box = new Box('.$box->id.');   ?>');



	templateTags::add('box:title', '<?php echo $box->title(); ?>');

	templateTags::add('box:content', '<?php echo $box->content(); ?>');

}