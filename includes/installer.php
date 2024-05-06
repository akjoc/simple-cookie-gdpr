<?php
// Ensures this file cannot be executed outside of WordPress environment
defined('ABSPATH') or die('No script kiddies please!');

/**
 * Handles installation logic for the Simple Cookie GDPR Plugin.
 */
function simple_cookie_gdpr_install() {
    // Perform any setup needed on activation, e.g., setting default options
    if (!get_option('simple_cookie_gdpr_settings')) {
        add_option('simple_cookie_gdpr_settings', array(
            'analytics' => true,  // Default setting for analytics cookies
            'marketing' => false  // Default setting for marketing cookies
        ));
    }
}

/**
 * Handles uninstallation logic for the Simple Cookie GDPR Plugin.
 */
function simple_cookie_gdpr_uninstall() {
    // Clean up any data and settings on plugin deactivation if necessary
    delete_option('simple_cookie_gdpr_settings');
}
