<?php

if ( ! defined('FIRECAMP')) exit('No direct script access allowed');

/**
 * Firecamp
 *
 * @package		Firecamp
 * @author		Firecamp Team
 * @copyright	Copyright (c) 2010 - 2011, Bebliuc
 * @license		http://firecamp.ro/license
 * @link		http://firecamp.ro
 * @since		Version 1.0.01
 */

/**
 * 
 *
 * @package		Dictionar Plugin
 * @author		Firecamp Team
 * @copyright	Copyright (c) 2010 - 2011, Bebliuc
 * @license		http://firecamp.ro/license
 * @link		http://firecamp.ro
 * @since		Version 1.0.01
 */


Plugin::setInfos(array(
		'id' => 'dictionar',
		'title' => 'Dictionar',
		'author' => 'Bebliuc George',
		'website' => 'http://george.bebliuc.eu',
		'version' => '1.0',
		'description' => 'Dictionar cuvant - definitie - categorie.'));
		

Plugin::addController('dictionar', 'Dictionar');


if(class_exists('TemplateTags')) {

	templateTags::add('dictionar:start', '<?php foreach(Record::findAllFrom("dictionar", "id != 0 ORDER BY cuvant ASC") as $cuvant): ?>');
	templateTags::add('cuvant', '<?php echo $cuvant->cuvant; ?>');
	templateTags::add('cuvant:definitie', '<?php echo $cuvant->definitie; ?>');
	templateTags::add('cuvant:categorie', '<?php echo $cuvant->categorie; ?>');
	templateTags::add('cuvant:alt', '<?php echo $cuvant->altele; ?>');
	templateTags::add('dictionar:end', '<?php endforeach; ?>');

}
