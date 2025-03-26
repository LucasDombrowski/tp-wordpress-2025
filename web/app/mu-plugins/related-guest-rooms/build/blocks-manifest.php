<?php
// This file is generated. Do not modify it manually.
return array(
	'related-guest-rooms' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'create-block/related-guest-rooms',
		'version' => '0.1.0',
		'title' => 'Related Guest Rooms',
		'category' => 'widgets',
		'icon' => 'smiley',
		'description' => 'Example block scaffolded with Create Block tool.',
		'example' => array(
			
		),
		'keywords' => array(
			'guest',
			'room',
			'related',
			'taxonomy'
		),
		'attributes' => array(
			'numberOfRooms' => array(
				'type' => 'number',
				'default' => 3
			),
			'orderBy' => array(
				'type' => 'string',
				'default' => 'date'
			),
			'taxonomy' => array(
				'type' => 'string',
				'default' => ''
			)
		),
		'supports' => array(
			'html' => false
		),
		'textdomain' => 'related-guest-rooms',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScript' => 'file:./view.js'
	)
);
