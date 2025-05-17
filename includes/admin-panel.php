<?php

function larris_register_email_settings_page() {
	add_menu_page(
		'Email Settings',             // Page title
		'Email Settings',             // Menu title
		'manage_options',             // Capability
		'larris-email-settings',      // Menu slug
		'larris_render_settings_page',// Callback
		'dashicons-email',            // Icon
		55                            // Position
	);
}
add_action('admin_menu', 'larris_register_email_settings_page');

function larris_render_settings_page() {
	$sender_email = get_option('larris_sender_email', '');
	$recipient_email = get_option('larris_recipient_email', '');
	?>
	<div class="wrap">
		<h1>Larris Form - Email Settings</h1>
		<form method="post" action="options.php">
			<?php
				settings_fields('larris_email_settings_group');
				do_settings_sections('larris-email-settings');
				submit_button();
			?>
		</form>
	</div>
	<?php
}

function larris_register_email_settings() {
	register_setting('larris_email_settings_group', 'larris_sender_email');
	register_setting('larris_email_settings_group', 'larris_recipient_email');

	add_settings_section(
		'larris_email_settings_section',
		'Email Configuration',
		null,
		'larris-email-settings'
	);

	add_settings_field(
		'larris_sender_email',
		'Sender Email',
		'larris_sender_email_field_callback',
		'larris-email-settings',
		'larris_email_settings_section'
	);

	add_settings_field(
		'larris_recipient_email',
		'Recipient Email',
		'larris_recipient_email_field_callback',
		'larris-email-settings',
		'larris_email_settings_section'
	);
}
add_action('admin_init', 'larris_register_email_settings');

function larris_sender_email_field_callback() {
	$value = esc_attr(get_option('larris_sender_email', ''));
	echo "<input type='email' name='larris_sender_email' value='$value' placeholder='admin@yourdomain.com' class='regular-text' />";
	echo "<p class='description'>Use a domain-based email address (like <code>admin@yourdomain.com</code>). Avoid using free email providers like Gmail or Yahoo here to prevent delivery issues.</p>";
}

function larris_recipient_email_field_callback() {
	$value = esc_attr(get_option('larris_recipient_email', ''));
	echo "<input type='email' name='larris_recipient_email' value='$value' placeholder='john@gmail.com' class='regular-text' />";
	echo "<p class='description'>This is the email that will receive the messages. You can use any valid email, including free providers like Gmail or Yahoo. Make sure SMTP is properly configured. We recommend using <strong>Brevo</strong> (formerly Sendinblue). If you're stuck, check out the <a href='#' target='_blank'>documentation</a>.</p>";
}

