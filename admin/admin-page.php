<?php
function simple_cookie_gdpr_add_admin_menu() {
    add_menu_page(
        'GDPR Cookie Settings',
        'GDPR Cookies',
        'manage_options',
        'simple_cookie_gdpr',
        'simple_cookie_gdpr_options_page'
    );
}

function simple_cookie_gdpr_options_page() {
    ?>
    <div class="wrap">
        <h1>GDPR Cookie Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('simple_cookie_gdpr');
            do_settings_sections('simple_cookie_gdpr');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Enqueue the admin-specific stylesheet and JavaScript.
function simple_cookie_gdpr_enqueue_admin_scripts($hook) {
    // Ensure we're on the correct admin page
    if ($hook != get_plugin_page_hook('simple_cookie_gdpr', 'admin.php')) {
        return;
    }

    // Correct the path as needed.
    wp_enqueue_style('simple-cookie-gdpr-admin-css', plugin_dir_url(__FILE__) . 'css/admin-settings.css', array(), '1.0');
    wp_enqueue_script('simple-cookie-gdpr-admin-js', plugin_dir_url(__FILE__) . 'js/admin-settings.js', array('jquery'), '1.0', true);
}

add_action('admin_enqueue_scripts', 'simple_cookie_gdpr_enqueue_admin_scripts');
add_action('admin_menu', 'simple_cookie_gdpr_add_admin_menu');
