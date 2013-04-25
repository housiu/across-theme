<?php

$pp_gallery = new WPAlchemy_MetaBox(array
(
	'id' => '_pp_gallery',
	'title' => 'Gallery Properties',
	'template' => get_stylesheet_directory() . '/metaboxes/gallery_cpt-meta.php',
	'types' => array('gallery'),
	'context' => 'normal',
	'priority' => 'high',
));

/* eof */