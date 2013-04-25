<?php

$announcement = new WPAlchemy_MetaBox(array
(
	'id' => '_an',
	'title' => 'Annoucement Properties',
	'template' => get_stylesheet_directory() . '/metaboxes/announcement-meta.php',
	'types' => array('announcement'),
	'context' => 'normal',
	'priority' => 'high',
));

/* eof */