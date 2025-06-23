<?php

//-----------------Ajax Handling Email Field With Api-------------------------------

function custom_email_validation_ajax_handler()
{

    //Fetch API URL from options table
    $options = get_option('custom_settings');
    $api_url = isset($options['api_url']) ? esc_url($options['api_url']) : '';
    $full = $api_url . "IsUserExist";


    if (isset($_POST['email'])) {
        $email = sanitize_text_field($_POST['email']);

// Make request to custom API for email validation
        $api_response = wp_remote_post($full, array(
            'body' => json_encode(array('Username' => $email)),
            'headers' => array('Content-Type' => 'application/json',
                'Wlid' => '94DE1528-DE42-498A-A07E-4A458E97240E',
            ),
            'timeout' => 60,
        ));

        if (is_wp_error($api_response)) {

            $error_messages[] = 'API Request Failed: ' . $api_response->get_error_message();
            $sending_errors = array(
                "error" => true,
                "error_messages" => $error_messages,
            );
            wp_send_json($sending_errors);

        } else {
            wp_send_json($api_response);
        }
    }

    wp_die();
}


// Hook the email validation function to AJAX action
add_action('wp_ajax_custom_email_validation_ajax', 'custom_email_validation_ajax_handler');
add_action('wp_ajax_nopriv_custom_email_validation_ajax', 'custom_email_validation_ajax_handler');

function custom_email_form_ajax()
{
// Enqueue the script
    wp_enqueue_script('custom-email-form-ajax', plugin_dir_url(__FILE__) . '../js/AjaxHandeling/AjaxEmailApi.js', array('jquery'), '1.0', true);

// Localize the script
    wp_localize_script('custom-email-form-ajax', 'customEmailForm', array('ajaxurl' => admin_url('admin-ajax.php')));
}

// Hook the function to wp_enqueue_scripts action
add_action('wp_enqueue_scripts', 'custom_email_form_ajax');

//-----------------Ajax Handling Email Field With Local WP-Database-------------------------------

function custom_email_validation_ajax_handler_localDB()
{

    if (isset($_POST['email'])) {
        global $wpdb;

        $table_name = $wpdb->prefix . 'custom_registration_data';
        $email = sanitize_text_field($_POST['email']);
        $existing_row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE email = %s", $email), ARRAY_A);
        if ($existing_row) {
            wp_send_json($existing_row);}
    }

    wp_die();
}

// Hook the email validation function to AJAX action
add_action('wp_ajax_custom_email_validation_ajax_local', 'custom_email_validation_ajax_handler_localDB');
add_action('wp_ajax_nopriv_custom_email_validation_ajax_local', 'custom_email_validation_ajax_handler_localDB');

function custom_email_form_ajax_localDB()
{
	$version = time();
// Enqueue the script
    wp_enqueue_script('custom-email-form-ajax-localDB', plugin_dir_url(__FILE__) . '../js/AjaxHandeling/AjaxEmail.js', array('jquery'), $version, true);

}

// Hook the function to wp_enqueue_scripts action
add_action('wp_enqueue_scripts', 'custom_email_form_ajax_localDB');
