<?php
/**
 * Plugin Name:       Ct Form
 * Description:       Example block scaffolded with Create Block tool.
 * Version:           0.1.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       ct-form
 *
 * @package CreateBlock
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

function custom_contact_form_handler() {
	// Verify nonce
	if ( ! isset( $_POST['ccf_nonce'] ) || ! wp_verify_nonce( $_POST['ccf_nonce'], 'ccf_form_nonce' ) ) {
		wp_die( '❌ Security check failed.' );
	}

	// Honeypot validation
	if ( ! empty( $_POST['ccf_honeypot'] ) ) {
		wp_die( '❌ Spam detected.' );
	}

	// Sanitize and validate input fields
	$name          = isset( $_POST['ccf_name'] ) ? sanitize_text_field( $_POST['ccf_name'] ) : '';
	$email         = isset( $_POST['ccf_email'] ) ? sanitize_email( $_POST['ccf_email'] ) : '';
	$subject       = isset( $_POST['ccf_subject'] ) ? sanitize_text_field( $_POST['ccf_subject'] ) : '';
	$message       = isset( $_POST['ccf_message'] ) ? sanitize_textarea_field( $_POST['ccf_message'] ) : '';
	$math_answer   = isset( $_POST['ccf_math'] ) ? intval( $_POST['ccf_math'] ) : 0;
	$correct_answer = isset( $_POST['ccf_math_answer'] ) ? intval( $_POST['ccf_math_answer'] ) : 0;

	// Required fields check
	if ( empty( $name ) || empty( $email ) || empty( $subject ) || empty( $message ) ) {
		wp_die( '❌ All fields are required.' );
	}

	// Validate email
	if ( ! is_email( $email ) ) {
		wp_die( '❌ Invalid email address.' );
	}

	// Validate math CAPTCHA
	if ( $math_answer !== $correct_answer ) {
		wp_die( '❌ Incorrect answer to the math question.' );
	}

	// Prepare email
	$emailRecipient = get_option( 'larris_contact_form_email', get_option( 'admin_email' ) );
	$to      = $emailRecipient;
	$headers = "From: $name <$email>\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8";
	$body    = "Name: $name\nEmail: $email\nSubject: $subject\n\nMessage:\n$message";

	// Send email
	if ( wp_mail( $to, $subject, $body, $headers ) ) {
		// Prepare new CAPTCHA
		$num1          = rand( 1, 10 );
		$num2          = rand( 1, 10 );
		$new_answer    = $num1 + $num2;
		$new_question  = "What is $num1 + $num2?";

		// Send JSON response
		header( 'Content-Type: application/json' );
		echo json_encode( [
			'status'       => 'success',
			'message'      => '✅ Message sent successfully!',
			'new_question' => $new_question,
			'new_answer'   => $new_answer,
		] );
	} else {
		wp_die( '❌ Failed to send message.' );
	}

	wp_die(); // Terminate Ajax call
}
add_action( 'wp_ajax_nopriv_custom_contact_form_handler', 'custom_contact_form_handler' );
add_action( 'wp_ajax_custom_contact_form_handler', 'custom_contact_form_handler' );
