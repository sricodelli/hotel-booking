<?php
function hb_settings_init() {
    register_setting(
        'hb_settings', // Option group
        'hb_api_token' // Option name
    );

    add_settings_section(
        'hb_settings_section', // ID
        'Hotel Booking Settings', // Title
        'hb_settings_section_cb', // Callback
        'hb' // Page
    );

    add_settings_field(
        'hb_api_token', // ID
        'API Token', // Title
        'hb_api_token_cb', // Callback
        'hb', // Page
        'hb_settings_section' // Section
    );
}

function hb_settings_section_cb() {
    // Section content needs to be added for advanced customization
}

function hb_api_token_cb() {
    $hb_api_token = get_option('hb_api_token');
    ?>
    <input type="text" id="hb_api_token" name="hb_api_token" value="<?php echo esc_attr($hb_api_token); ?>" />
    <?php
}

add_action('admin_menu', 'hb_menu');

function hb_menu() {
    add_menu_page(
        'Hotel Booking',
        'Hotel Booking',
        'manage_options',
        'hb',
        'hb_settings_page'
    );
}

function hb_settings_page() {
    ?>
    <div class="wrap">
        <h2>Hotel Booking Settings</h2>
        <form method="post" action="options.php">
            <?php
            settings_fields('hb_settings');
            do_settings_sections('hb');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

add_action('admin_init', 'hb_settings_init');

