<?php

$hp_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_hp_option',
	'title' => 'Homepage Options',
	'template' => get_stylesheet_directory() . '/metaboxes/hp_option-meta.php',
	'types' => array('page'),
	'context' => 'normal',
	'priority' => 'high',
	'include_template' => array('page-home-template.php',)
));

/* eof */
