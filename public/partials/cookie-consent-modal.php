<?php

function simple_cookie_gdpr_render_modal_popup() {
    $options = get_option('simple_cookie_gdpr_settings');
    $modal_title = isset($options['modal_title']) ? $options['modal_title'] : 'Data Protection';
    $modal_description = isset($options['modal_description']) ? $options['modal_description'] : 'Default modal description';
    $modal_close_button_text = isset($options['modal_close_button_text']) ? $options['modal_close_button_text'] : 'Close';
    $modal_accept_button_text = isset($options['modal_save_button_text']) ? $options['modal_save_button_text'] : 'Save and Accept';
    $cookies = isset($options['cookies']) ? $options['cookies'] : [];
    ?>
    <div class="modal" id="arky_cookies_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="font-family: inherit; font-size: 16px; margin-bottom: 15px; margin: 10px 0;"><?php echo esc_html($modal_title); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeDisclaimerModal()">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-family: inherit; font-size: 12px; margin-bottom: 15px; margin: 0 0 12px 0;"><?php echo esc_html($modal_description); ?></p>

                <div class="cookies_data_modal">
                    <div id="cookies_accordion">
                        <?php foreach ($cookies as $index => $cookie): ?>
                            <div class="card mb-2">
                                <details>
                                    <summary>
                                        <div class="card-header" id="heading<?php echo $index; ?>">
                                                <div class="mb-0 model-text-toggle">
                                                    <div class="w-100">
                                                        <a class="  model-click-button collapsed" data-toggle="collapse" data-target="#cookies_collapse<?php echo $index; ?>" aria-expanded="false" aria-controls="cookies_collapse<?php echo $index; ?>">
                                                            <?php echo esc_html($cookie['name']); ?>
                                                        </a>
                                                    </div>

                                                    <div class="cookies_sec_tgl model-text-toggle">
                                                        <label class="toggle">
                                                            <input type="checkbox" checked <?php echo !empty($cookie['status']) ? 'checked' : ''; ?> hidden>
                                                            <span class="circle"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                    </summary>
                                    <div id="cookies_collapse<?php echo $index; ?>" class="collapse" aria-labelledby="heading<?php echo $index; ?>" data-parent="#cookies_accordion">
                                            <div class="card-body">
                                                <p class="mb-0 fs-5"><?php echo esc_html($cookie['description']); ?></p>
                                            </div>
                                     </div>
                        </details>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeDisclaimerModal()"><?php echo esc_html($modal_close_button_text); ?></button>
                    <button type="button" class="btn btn-primary" onclick="setCookieViaAjax()"><?php echo esc_html($modal_accept_button_text); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}

add_action('wp_footer', 'simple_cookie_gdpr_render_modal_popup');
