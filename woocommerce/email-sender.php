<?php
function hb_send_booking_confirmation_email($room_type_id, $checkin_date, $checkout_date, $hotel_name, $location, $selected_checkin, $selected_checkout) {
    // made for testing. need to replace
    $to = 'recipient@example.com';
    $subject = 'Booking Confirmation';
    $message = 'Dear guest, your booking has been confirmed.';
    $headers = 'From: your_email@example.com' . "\r\n" .
        'Reply-To: your_email@example.com' . "\r\n";

    $sent = wp_mail($to, $subject, $message, $headers);

    if ($sent) {
        // Email sent successfully
        return true;
    } else {
        // Email sending failed
        return false;
    }
}

