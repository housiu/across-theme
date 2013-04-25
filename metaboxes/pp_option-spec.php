<?php

$pp_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_pp_option',
	'title' => 'Program Page Options',
	'template' => get_stylesheet_directory() . '/metaboxes/pp_option-meta.php',
	'types' => array('page'),
	'context' => 'normal',
	'priority' => 'high',
	'include_template' => array('page-pp.php',)
));

/* eof */
