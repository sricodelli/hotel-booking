<?php
add_action('wp_ajax_hb_add_to_cart', 'hb_add_to_cart');
add_action('wp_ajax_nopriv_hb_add_to_cart', 'hb_add_to_cart');

function hb_add_to_cart() {
    $room_type_id = sanitize_text_field($_POST['room_type_id']);
    $checkin_date = sanitize_text_field($_POST['checkin_date']);
    $checkout_date = sanitize_text_field($_POST['checkout_date']);

    $product_id = $room_type_id;
    $quantity = 1;
    $variation_id = 0;

    // Add item to the WooCommerce cart
    $cart_item_key = WC()->cart->add_to_cart($product_id, $quantity, $variation_id);

    if ($cart_item_key) {
        // Item added to cart
        echo json_encode(array('success' => true, 'message' => 'Item added to cart'));
    } else {
        // Failed to add item to cart
        echo json_encode(array('success' => false, 'message' => 'Failed to add item to cart'));
    }

    wp_die();
}
