<?php

//Calling function for opt
//--------------------------------------------------------
function function_opt_handler()
{

    if (!session_id()) {
        session_start();
    }

    // ---------------------------------------------------------
    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_registration_data';
    $email = $_SESSION['user_email'];
    $existing_row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE email = %s", $email), ARRAY_A);
    $user_id_global = $_POST["user_id_global"];
    $business_id_global = $_POST["business_id_global"];

    $business_id = $existing_row['business_id'];
    $saasy_user_id = $existing_row['saasy_user_id'];

    if (empty($existing_row['business_id']) ||
        empty($existing_row['saasy_user_id'])) {
        $wpdb->update(
            $table_name,
            array(
                'saasy_user_id' => $user_id_global,
                'business_id' => $business_id_global,
            ),
            array('email' => $email)
        );
    }
//----------------------------------------------------------

    //Fetch API URL from options table
    $options = get_option('custom_settings');
    $api_url = isset($options['api_url']) ? esc_url($options['api_url']) : '';
    $full = $api_url . "SendOTP";

    $api_response = wp_remote_post($full, array(
        'body' => json_encode(array(
            // 'BusinessId' => $business_id,
            // 'UserId' => $saasy_user_id,
            'BusinessId' => $business_id_global,
            'UserId' => $user_id_global,
        )),
        'headers' => array('Content-Type' => 'application/json',
            'Wlid' => '94DE1528-DE42-498A-A07E-4A458E97240E',
        ),
        'timeout' => 30,
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

// Hook the handler to the corresponding action
add_action('wp_ajax_function_opt', 'function_opt_handler');
add_action('wp_ajax_nopriv_function_opt', 'function_opt_handler');

// Calling for otp in email page
//--------------------------------------------------------
function function_opt_emailpage_handler()
{

    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_registration_data';
    $email = $_SESSION['user_email'];
    $existing_row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE email = %s", $email), ARRAY_A);
    $business_id = $existing_row['business_id'];
    $saasy_user_id = $existing_row['saasy_user_id'];
//----------------------------------------------------------
    //Fetch API URL from options table
    $options = get_option('custom_settings');
    $api_url = isset($options['api_url']) ? esc_url($options['api_url']) : '';
    $full = $api_url . "SendOTP";

    $api_response = wp_remote_post($full, array(
        'body' => json_encode(array(
            'BusinessId' => $business_id,
            'UserId' => $saasy_user_id,
        )),
        'headers' => array('Content-Type' => 'application/json',
            'Wlid' => '94DE1528-DE42-498A-A07E-4A458E97240E',
        ),
        'timeout' => 30,
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

// Hook the handler to the corresponding action
add_action('wp_ajax_function_opt_emailpage', 'function_opt_emailpage_handler');
add_action('wp_ajax_nopriv_function_opt_emailpage', 'function_opt_emailpage_handler');

function custom_form_ajax_email_otp_page()
{
    $version = time();
// Enqueue the script
    wp_enqueue_script('ResendEmailOtp', plugin_dir_url(__FILE__) . '../js/AjaxHandeling/ResendEmailOtp.js', array('jquery'), $version, true);

// Localize the script
    wp_localize_script('ResendEmailOtp', 'ResendEmailOtp', array('ajaxurl' => admin_url('admin-ajax.php')));
}

// Hook the function to wp_enqueue_scripts action
add_action('wp_enqueue_scripts', 'custom_form_ajax_email_otp_page');

//--------------------------------------------------------

//Verifying Otp Function

add_action('wp_ajax_verify_otp', 'verify_otp_callback');
add_action('wp_ajax_nopriv_verify_otp', 'verify_otp_callback');

function verify_otp_callback()
{

    // ---------------------------------------------------------
    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_registration_data';
    $email = $_SESSION['user_email'];
    $existing_row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE email = %s", $email), ARRAY_A);
    $business_id = $existing_row['business_id'];
    $saasy_user_id = $existing_row['saasy_user_id'];
//----------------------------------------------------------
    // Get the OTP from the AJAX request
    $otp = sanitize_text_field($_POST['otp']);
    //Fetch API URL from options table
    $options = get_option('custom_settings');
    $api_url = isset($options['api_url']) ? esc_url($options['api_url']) : '';
    $full = $api_url . "VerifyOTP";

    $api_response = wp_remote_post($full, array(
        'body' => json_encode(array(
            'BusinessId' => $business_id,
            'UserId' => $saasy_user_id,
            'Code' => $otp,
        )),
        'headers' => array('Content-Type' => 'application/json',
            'Wlid' => '94DE1528-DE42-498A-A07E-4A458E97240E',
        ),
        'timeout' => 30,
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

function custom_form_ajax_email_otp_page_verify()
{
    $version = time();

// Enqueue the script
    wp_enqueue_script('VerifyEmailOtp', plugin_dir_url(__FILE__) . '../js/AjaxHandeling/AjaxVerifyingOtp.js', array('jquery'), $version, true);

// Localize the script
    wp_localize_script('VerifyEmailOtp', 'VerifyEmailOtp', array('ajaxurl' => admin_url('admin-ajax.php')));
}

// Hook the function to wp_enqueue_scripts action
add_action('wp_enqueue_scripts', 'custom_form_ajax_email_otp_page_verify');
