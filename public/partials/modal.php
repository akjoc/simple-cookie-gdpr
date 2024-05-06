<?php
defined('ABSPATH') or die('No script kiddies please!');

function simple_cookie_gdpr_render_modal() {
    $options = get_option('simple_cookie_gdpr_settings');
$banner_description = isset($options['banner_description']) ? $options['banner_description'] : 'Default banner description';
$adjust_button_text = isset($options['adjust_button_text']) ? $options['adjust_button_text'] : 'Adjust';
$accept_button_text = isset($options['accept_button_text']) ? $options['accept_button_text'] : 'Accept all';
$reject_button_text = isset($options['reject_button_text']) ? $options['reject_button_text'] : 'Reject all';

?>
<div class="disclaimer-bar-new border-top" id="disclaimerBar">
    <div class="sc-center">
        <div class="cookie_text_data text-left">
            <p><?php echo esc_html($banner_description); ?></p>
        </div>
        <div class="cookie-buttons">
            <button class="detail-btn cookie-button" data-toggle="modal" data-target="#arky_cookies_Modal" onclick="openDisclaimerModal()"><?php echo esc_html($adjust_button_text); ?></button>
            <button class="close-btn  cookie-button" onclick="closeDisclaimer()"><?php echo esc_html($reject_button_text); ?></button>
            <button class="accept-btn  cookie-button" onclick="setCookieViaAjax()"><?php echo esc_html($accept_button_text); ?></button>
        </div>
    </div>
</div>
    <?php
}

add_action('wp_footer', 'simple_cookie_gdpr_render_modal');
