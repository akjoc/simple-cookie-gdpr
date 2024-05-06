<?php

function simple_cookie_gdpr_register_settings() {
    register_setting('simple_cookie_gdpr', 'simple_cookie_gdpr_settings', 'simple_cookie_gdpr_validate_settings');

    add_settings_section(
        'simple_cookie_gdpr_section',
        __('Cookie Banner Settings', 'simple-cookie-gdpr-plugin'),
        'simple_cookie_gdpr_section_callback',
        'simple_cookie_gdpr'
    );

    $fields = [
        'banner_description' => __('Banner Description', 'simple-cookie-gdpr-plugin'),
        'modal_title' => __('Modal Title', 'simple-cookie-gdpr-plugin'),
        'modal_description' => __('Modal Description', 'simple-cookie-gdpr-plugin'),
        'modal_close_button_text' => __('Modal Close Button Text', 'simple-cookie-gdpr-plugin'),
        'modal_save_button_text' => __('Modal Save Button Text', 'simple-cookie-gdpr-plugin'),
        'accept_button_text' => __('Accept Button Text', 'simple-cookie-gdpr-plugin'),
        'reject_button_text' => __('Reject Button Text', 'simple-cookie-gdpr-plugin'),
        'adjust_button_text' => __('Adjust Button Text', 'simple-cookie-gdpr-plugin'),
    ];

    foreach ($fields as $key => $label) {
        add_settings_field(
            $key,
            $label,
            'simple_cookie_gdpr_field_render',
            'simple_cookie_gdpr',
            'simple_cookie_gdpr_section',
            ['label_for' => $key, 'class' => 'simple_cookie_gdpr_field', 'type' => 'text']
        );
    }

    add_settings_field(
        'cookie_fields',
        __('Cookies', 'simple-cookie-gdpr-plugin'),
        'simple_cookie_gdpr_cookie_fields_render',
        'simple_cookie_gdpr',
        'simple_cookie_gdpr_section'
    );
}

function simple_cookie_gdpr_field_render($args) {
    $options = get_option('simple_cookie_gdpr_settings');
    if ($args['type'] === 'textarea') {
        echo "<textarea cols='40' rows='5' name='simple_cookie_gdpr_settings[" . esc_attr($args['label_for']) . "]'>" . esc_textarea($options[$args['label_for']] ?? '') . "</textarea>";
    } else {
        echo "<input type='text' name='simple_cookie_gdpr_settings[" . esc_attr($args['label_for']) . "]' value='" . esc_attr($options[$args['label_for']] ?? '') . "'>";
    }
}

function simple_cookie_gdpr_cookie_fields_render() {
    $options = get_option('simple_cookie_gdpr_settings');
    $cookies = $options['cookies'] ?? [];
    echo '<div id="cookieFieldsContainer">';
    foreach ($cookies as $index => $cookie) {
        echo '<div class="cookieField">';
        echo '<input type="text" name="simple_cookie_gdpr_settings[cookies][' . esc_attr($index) . '][name]" value="' . esc_attr($cookie['name'] ?? '') . '" placeholder="Cookie Name" />';
        echo '<textarea name="simple_cookie_gdpr_settings[cookies][' . esc_attr($index) . '][description]" placeholder="Cookie Description">' . esc_textarea($cookie['description'] ?? '') . '</textarea>';
        echo '<button type="button" class="removeCookieField" onclick="removeField(this)">Remove</button>';
        echo '</div>';
    }
    echo '</div><button type="button" id="addMoreCookies" style="margin-top: 10px;">Add More</button>';
}

function simple_cookie_gdpr_settings_section_callback() {
    echo esc_html__('Customize the text and behavior of your GDPR cookie consent banner.', 'simple-cookie-gdpr-plugin');
}

function simple_cookie_gdpr_validate_settings($input) {
    foreach ($input['cookies'] as $index => $cookie) {
        $input['cookies'][$index]['name'] = sanitize_text_field($cookie['name']);
        $input['cookies'][$index]['description'] = sanitize_textarea_field($cookie['description']);
    }
    return $input;
}

add_action('admin_init', 'simple_cookie_gdpr_register_settings');
