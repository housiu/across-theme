<?php

$hp_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_hp_option',
	'title' => 'Quick Features Options',
	'template' => get_stylesheet_directory() . '/metaboxes/hp_qf-meta.php',
	'types' => array('page'),
	'context' => 'normal',
	'priority' => 'high',
	'include_template' => array('page-home-template.php',)
));

/* eof */
