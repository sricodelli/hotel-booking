<?php
/**
 * Plugin Name: AP Tourism Hotel Booking
 * Description: Custom WooCommerce Hotel Booking Plugin
 * Version: 1.0
 * Author: Srikanth Gopi
 */

define('HB_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('HB_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once(HB_PLUGIN_DIR . 'frontend/frontend.php');
require_once(HB_PLUGIN_DIR . 'woocommerce/woocommerce-integration.php');
require_once(HB_PLUGIN_DIR . 'woocommerce/email-sender.php');
require_once(HB_PLUGIN_DIR . 'settings/settings.php');

add_action('woocommerce_loaded', 'hb_initialize');

function hb_initialize() {
    add_shortcode('hotel_booking', 'hotel_booking_shortcode_function');
}

register_activation_hook(__FILE__, 'hb_activate');

function hb_activate() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'hotel_bookings';
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        hotel_name text NOT NULL,
        room_type text NOT NULL,
        checkin_date date NOT NULL,
        checkout_date date NOT NULL,
        total_price decimal(10,2) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

register_deactivation_hook(__FILE__, 'hb_deactivate');

function hb_deactivate() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'hotel_bookings';
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
}
