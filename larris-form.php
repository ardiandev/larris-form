<?php
/**
 * Plugin Name:       Larris Form
 * Description:       Custom WordPress block-based contact form with spam protection and Brevo email integration.
 * Version:           0.1.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            Ardian Pradana
 * Author URI:        https://ardianpradana.com/
 * Plugin URI:        https://github.com/ardiandev/larris-form
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       larris-form
 *
 * @package LarrisForm
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function create_block_ct_form_block_init() {
	if ( function_exists( 'wp_register_block_types_from_metadata_collection' ) ) {
		wp_register_block_types_from_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
		return;
	}

	if ( function_exists( 'wp_register_block_metadata_collection' ) ) {
		wp_register_block_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
	}

	$manifest_data = require __DIR__ . '/build/blocks-manifest.php';
	foreach ( array_keys( $manifest_data ) as $block_type ) {
		register_block_type( __DIR__ . "/build/{$block_type}" );
	}
}
add_action( 'init', 'create_block_ct_form_block_init' );

require_once plugin_dir_path( __FILE__ ) . 'includes/admin-panel.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/form-handler.php';
