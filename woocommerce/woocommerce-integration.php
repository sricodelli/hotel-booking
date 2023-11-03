<?php
class HotelBookingIntegration {
    public function __construct() {
        // Add any necessary actions and filters here
        add_action('woocommerce_cart_calculate_fees', array($this, 'add_custom_fee'));
    }

    public function add_custom_fee() {
        if (is_admin() && !defined('DOING_AJAX')) {
            return;
        }

        // Get the selected hotel price from the frontend form (you need to implement this logic)
        $selected_hotel_price = floatval($_POST['selected_hotel_price']); // Modify this to get the correct price

        // Calculate the custom fee based on the selected hotel price
        $custom_fee = $selected_hotel_price * 0.10; // 10% of the selected hotel price

        // Add the custom fee to the cart
        if ($custom_fee > 0) {
            WC()->cart->add_fee('Hotel Booking Fee', $custom_fee);
        }
    }
}

new HotelBookingIntegration();

