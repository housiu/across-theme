<?php

$slider_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_hp_slider_',
	'title' => 'Slider Options',
	'template' => get_stylesheet_directory() . '/metaboxes/hp_slider-meta.php',
	'types' => array('page'),
	'context' => 'normal',
	'priority' => 'high',
	'include_template' => array('page-home-template.php',)
));

/* eof */