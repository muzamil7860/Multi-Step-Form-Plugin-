<?php

//----------------- Ajax Handling Business Name Field With Api -------------------------------

function custom_business_name_validation_ajax_handler()
{
    //Fetch API URL from options table
    $options = get_option('custom_settings');
    $api_url = isset($options['api_url']) ? esc_url($options['api_url']) : '';
    $full = $api_url . "IsCompanyExist";
// check_ajax_referer('custom_form_nonce', 'security');

    if (isset($_POST['business_name'])) {
        $businessName = sanitize_text_field($_POST['business_name']);

// Make request to custom API for business name validation
        $api_response = wp_remote_post($full, array(
            'body' => json_encode(array('CompanyName' => $businessName)),
            'headers' => array('Content-Type' => 'application/json',
                'Wlid' => '94DE1528-DE42-498A-A07E-4A458E97240E'),
			 'timeout' => 30,
        ));

        if (is_wp_error($api_response)) {
// Handle error, e.g., log or display an error message
            echo 'error';
        } else {
            $api_data = json_decode(wp_remote_retrieve_body($api_response));
            echo json_encode($api_data->data);
            if ($api_data->exists) {
// Business name exists, send response to the client
// echo 'exists';
            } else {
// Business name is unique, send response to the client
// echo 'unique';
            }
        }
    }

    wp_die();
}

// Hook the business name validation function to AJAX action
add_action('wp_ajax_custom_business_name_validation_ajax', 'custom_business_name_validation_ajax_handler');
add_action('wp_ajax_nopriv_custom_business_name_validation_ajax', 'custom_business_name_validation_ajax_handler');

function custom_business_form_ajax()
{
// Enqueue the script
    wp_enqueue_script('custom-business-form-ajax', plugin_dir_url(__FILE__) . '../js/AjaxHandeling/AjaxBusinessApi.js', array('jquery'), '1.0', true);

// Localize the script
    wp_localize_script('custom-business-form-ajax', 'customBusinessForm', array('ajaxurl' => admin_url('admin-ajax.php')));
}

// Hook the function to wp_enqueue_scripts action
add_action('wp_enqueue_scripts', 'custom_business_form_ajax');