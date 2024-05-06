<?php
/*
Plugin Name: Simple Cookie GDPR 
Description: A lightweight simple GDPR compliant cookie consent banner with customizable settings for accept all, reject all, and adjust cookie preferences.
Version: 1.0
Author: Aman Joshi
License: GPL2
*/

defined('ABSPATH') or die('No script kiddies please!');

// Plugin Activation
register_activation_hook(__FILE__, 'simple_cookie_gdpr_activate');
function simple_cookie_gdpr_activate() {
    require_once plugin_dir_path(__FILE__) . 'includes/installer.php';
    simple_cookie_gdpr_install();
}

// Plugin Deactivation
register_deactivation_hook(__FILE__, 'simple_cookie_gdpr_deactivate');
function simple_cookie_gdpr_deactivate() {
    require_once plugin_dir_path(__FILE__) . 'includes/installer.php';
    simple_cookie_gdpr_uninstall();
}

// Enqueue scripts and styles
require_once plugin_dir_path(__FILE__) . 'includes/enqueues.php';

// Load admin pages if in admin area
if (is_admin()) {
    require_once plugin_dir_path(__FILE__) . 'admin/admin-page.php';
    require_once plugin_dir_path(__FILE__) . 'admin/settings.php';
}

// Load other hooks
require_once plugin_dir_path(__FILE__) . 'includes/hooks.php';

function simple_cookie_gdpr_enqueue_banner() {
    if (empty($_COOKIE['disclaimer'])) {
        // Enqueue the banner script and styles only if the cookie is not set
        //Modal popup
        require_once plugin_dir_path(__FILE__) . 'public/partials/modal.php';
        require_once plugin_dir_path(__FILE__) . 'public/partials/cookie-consent-modal.php';
        add_action('wp_footer', 'simple_cookie_gdpr_render_modal_popup');
    }
}

add_action('init', 'simple_cookie_gdpr_enqueue_banner');


