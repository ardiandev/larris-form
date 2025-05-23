<?php
// This file is generated. Do not modify it manually.
return array(
	'larris-form' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'create-block/larris-form',
		'version' => '0.1.0',
		'title' => 'Larris Form',
		'category' => 'widgets',
		'icon' => 'email',
		'description' => 'Example block scaffolded with Create Block tool.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false,
			'spacing' => array(
				'margin' => true,
				'padding' => true
			),
			'color' => array(
				'background' => true,
				'text' => true
			),
			'align' => true
		),
		'textdomain' => 'larris-form',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScript' => 'file:./view.js',
		'attributes' => array(
			'nameLabel' => array(
				'type' => 'string',
				'default' => 'Your Name'
			),
			'subjectLabel' => array(
				'type' => 'string',
				'default' => 'Your Subject'
			),
			'emailLabel' => array(
				'type' => 'string',
				'default' => 'Your Email'
			),
			'messageLabel' => array(
				'type' => 'string',
				'default' => 'Your Message'
			),
			'senderEmail' => array(
				'type' => 'string'
			),
			'recipentEmail' => array(
				'type' => 'string'
			)
		)
	)
);
