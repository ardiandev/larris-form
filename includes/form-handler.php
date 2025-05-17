<?php
function custom_contact_form_handler() {
	// Verify nonce
	if ( ! isset( $_POST['ccf_nonce'] ) || ! wp_verify_nonce( $_POST['ccf_nonce'], 'ccf_form_nonce' ) ) {
		wp_send_json_error( [ 'message' => '❌ Security check failed.' ] );
	}

	// Honeypot validation
	if ( ! empty( $_POST['ccf_honeypot'] ) ) {
		wp_send_json_error( [ 'message' => '❌ Spam detected.' ] );
	}

	// Sanitize and validate input fields based on the form's field names
	$name           = isset( $_POST['userName'] ) ? sanitize_text_field( $_POST['userName'] ) : '';
	$email          = isset( $_POST['userEmail'] ) ? sanitize_email( $_POST['userEmail'] ) : '';
	$subject        = isset( $_POST['userSubject'] ) ? sanitize_text_field( $_POST['userSubject'] ) : '';
	$message        = isset( $_POST['userMessage'] ) ? sanitize_textarea_field( $_POST['userMessage'] ) : '';
	$math_answer    = isset( $_POST['ccf_math'] ) ? intval( $_POST['ccf_math'] ) : 0;
	$correct_answer = isset( $_POST['ccf_math_answer'] ) ? intval( $_POST['ccf_math_answer'] ) : 0;

	// Required fields check
	if ( empty( $name ) || empty( $email ) || empty( $subject ) || empty( $message ) ) {
		wp_send_json_error( [ 'message' => '❌ All fields are required.' ] );
	}

	// Validate email
	if ( ! is_email( $email ) ) {
		wp_send_json_error( [ 'message' => '❌ Invalid email address.' ] );
	}

	// Validate math CAPTCHA
	if ( $math_answer !== $correct_answer ) {
		wp_send_json_error( [ 'message' => '❌ Incorrect answer to the math question.' ] );
	}

// Prepare email
$emailRecipient = get_option('larris_recipient_email');  
$fromEmail      = get_option('larris_sender_email');

$to             = $emailRecipient;

$headers  = "From: $name <$fromEmail>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8";

$body = "Name: $name\nEmail: $email\nSubject: $subject\n\nMessage:\n$message";
	// Send email
	if ( wp_mail( $to, $subject, $body, $headers ) ) {
		// Prepare new CAPTCHA
		$num1          = rand( 1, 10 );
		$num2          = rand( 1, 10 );
		$new_answer    = $num1 + $num2;
		$new_question  = "$num1 + $num2?";

		// Send JSON response
		wp_send_json_success( [
			'status'		=> 'success',
			'message'      => '✅ Message sent successfully!',
			'new_question' => $new_question,
			'new_answer'   => $new_answer,
		] );
	} else {
		wp_send_json_error( [ 'message' => '❌ Failed to send message.' ] );
	}
}


add_action( 'wp_ajax_nopriv_custom_contact_form_handler', 'custom_contact_form_handler' );
add_action( 'wp_ajax_custom_contact_form_handler', 'custom_contact_form_handler' );