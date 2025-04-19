<?php
// This file is generated. Do not modify it manually.
return array(
	'ct-form' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'create-block/ct-form',
		'version' => '0.1.0',
		'title' => 'Ct Form',
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
		'textdomain' => 'ct-form',
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
			'inputFontSize' => array(
				'type' => 'string',
				'default' => '16px'
			),
			'labelFontSize' => array(
				'type' => 'string',
				'default' => '18px'
			),
			'inputPadding' => array(
				'type' => 'string',
				'default' => '10px'
			),
			'inputMarginTop' => array(
				'type' => 'string',
				'default' => '5px'
			),
			'textareaHeight' => array(
				'type' => 'string',
				'default' => '150px'
			),
			'inputGap' => array(
				'type' => 'string',
				'default' => '5px'
			),
			'buttonFontSize' => array(
				'type' => 'string',
				'default' => '18px'
			),
			'buttonPadding' => array(
				'type' => 'string',
				'default' => '10px'
			),
			'buttonTextColor' => array(
				'type' => 'string',
				'default' => '#ffff'
			),
			'buttonBackgroundColor' => array(
				'type' => 'string',
				'default' => 'black'
			)
		)
	)
);
