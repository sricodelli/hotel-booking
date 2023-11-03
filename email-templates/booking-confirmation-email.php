<?php
/**
 * The template for sending booking confirmation email.
 *
 * This file can be overridden by copying it to theme/woocommerce/emails/booking-confirmation-email.php.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_email_header', $email_heading, $email );

echo wp_kses_post( $email_intro ); // Display the email intro message.

echo "\n";

echo wp_kses_post( $email_message ); // Display the email message content.

echo "\n";

do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

echo "\n";

do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email );

echo "\n";

do_action( 'woocommerce_email_footer', $email );

