<?php

$hp_mid_bot_section_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_hp_update_',
	'title' => 'Bottom Half Content Section',
	'template' => get_stylesheet_directory() . '/metaboxes/hp_bot-meta.php',
	'types' => array('page'),
	'context' => 'normal',
	'priority' => 'high',
	'include_template' => array('page-home-template.php',)
));

/* eof */
