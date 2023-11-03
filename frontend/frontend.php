<?php
add_action('wp_enqueue_scripts', 'hb_enqueue_frontend_scripts');
function hb_enqueue_frontend_scripts() {
    wp_enqueue_script('hotel-booking-frontend', plugins_url('/frontend/frontend.js', __FILE__), array('jquery'), '1.0', true);

    wp_localize_script('hotel-booking-frontend', 'hb_frontend_params', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'room_type_id' => get_room_type_id(),
        'checkin_date' => get_checkin_date(),
        'checkout_date' => get_checkout_date(),
    ));
}

function get_room_type_id() {
    // logic to retrieve the room type ID
    return 1; //need to customize
}

function get_checkin_date() {
    // logic to retrieve the check-in date
    return date('Y-m-d'); // need to customize
}

function get_checkout_date() {
    // logic to retrieve the check-out date
    return date('Y-m-d', strtotime('+1 day')); // need to customize
}

add_shortcode('hotel_booking_form', 'hb_display_hotel_booking_form');
function hb_display_hotel_booking_form() {
    ob_start(); ?>
    <form>
        <div style="display: flex; align-items: center;">
            <label for="location" style="margin-right: 10px;">Location:</label>
            <select id="location" name="location" required>
                <option value="6">Ahobilam</option>
                <option value="25">Amaravathi</option>
                <option value="13">Araku - Mayuri Hotel</option>
                <option value="14">Ananthagiri</option>
                <option value="15">Tyda Jungel Bells hotel</option>
                <option value="16">Araku Hill Resort</option>
                <option value="23">Dindi - Coconut Country Hotel</option>
                <option value="24">Dwaraka - Tirumala Hotel</option>
                <option value="38">Ettipothala</option>
                <option value="40">Gandikota</option>
                <option value="7">Gandikshethram</option>
                <option value="28">Horsely hills</option>
                <option value="41">Idupulapaya</option>
                <option value="3">Kadapa</option>
                <option value="31">Kailasnathkona</option>
                <option value="35">Sri Kalahasti</option>
                <option value="1">Kurnool</option>
                <option value="19">Lambasingi</option>
                <option value="10">Lepakshi</option>
                <option value="5">Mahanandi</option>
                <option value="36">Mypadu - Beach Resort</option>
                <option value="26">Nagarjunasagar Vijayapurisouth</option>
                <option value="34">Nellore</option>
                <option value="42">Votimitta</option>
                <option value="8">Orvakallu</option>
                <option value="48">Pulugudu</option>
                <option value="37">Srisailam</option>
                <option value="22">Suryalanka - Beach Resort</option>
                <option value="45">Tada - Flamingo Resort</option>
                <option value="20">Vijayawada - Bhavani Island</option>
                <option value="21">Vijayawada - Berm Park Hotel</option>
                <option value="11">Visakhapatnam - Yatrinivas Hotel</option>
                <!-- Add more location options -->
            </select>
            <label for="checkin" style="margin: 0 10px;">Check-in Date:</label>
            <input type="date" id="checkin" name="checkin" required>
            <label for "checkout" style="margin: 0 10px;">Check-out Date:</label>
            <input type="date" id="checkout" name="checkout" required>
            <button id="portfolio-posts-btn" type="button" style="margin-left: 10px;">Submit</button>
        </div>
    </form>
    <div id="portfolio-posts-container"></div>
    <?php
    return ob_get_clean();
}

