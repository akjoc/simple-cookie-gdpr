<?php

function simple_cookie_gdpr_enqueue_scripts() {
    // Correct the handle to be consistent
    wp_enqueue_script('simple-cookie-gdpr-js', plugins_url('../public/js/modal-control.js', __FILE__), array('jquery'), '1.0', true);

    // Use the same handle as used in wp_enqueue_script
    wp_localize_script('simple-cookie-gdpr-js', 'simpleCookieData', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
    
    wp_enqueue_style('simple-cookie-gdpr-css', plugins_url('../public/css/style.css', __FILE__), array(), '1.0', 'all');
}

add_action('wp_enqueue_scripts', 'simple_cookie_gdpr_enqueue_scripts');


function handle_ajax_request() {
    // Check for nonce or other security measures here

    // Prepare a proper JSON response
    $response = array('message' => 'Response to AJAX request.');

    // Send JSON response
    wp_send_json($response); // This function automatically calls wp_die()
}

add_action('wp_ajax_nopriv_record_cookie_acceptance', 'handle_ajax_request'); // For non-logged in users
add_action('wp_ajax_record_cookie_acceptance', 'handle_ajax_request'); // For logged in users

