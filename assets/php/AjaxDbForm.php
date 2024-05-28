<?php

//-----------------Ajax Handling Whole Form 1 Api-------------------------------

<<<<<<< HEAD
function custom_form_ajax_full_api()
{

// Enqueue the script
    wp_enqueue_script('custom-form-ajax-full-api', plugin_dir_url(__FILE__) . '../js/AjaxHandeling/AjaxScriptFormApi_1.js', array('jquery'), '1.0', true);
=======

function saasy_json_decode_3beta($encoded_array)
{
    $ok = json_decode($encoded_array, true);
    $err_msg = json_last_error_msg();
    if ($err_msg !== 'No error') {
        $cleanedCookieValue = stripslashes($encoded_array);
        $ok = json_decode($cleanedCookieValue, true);
    }
    return $ok;
}

function custom_form_ajax_full_api()
{
    $version = time();
// Enqueue the script
    wp_enqueue_script('custom-form-ajax-full-api', plugin_dir_url(__FILE__) . '../js/AjaxHandeling/AjaxScriptFormApi_1.js', array('jquery'), $version, true);
>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d

// Localize the script
    wp_localize_script('custom-form-ajax-full-api', 'customFormFullApi', array('ajaxurl' => admin_url('admin-ajax.php')));
}

// Hook the function to wp_enqueue_scripts action
add_action('wp_enqueue_scripts', 'custom_form_ajax_full_api');

add_action('wp_ajax_custom_form_ajax_full_form', 'custom_form_ajax_handler_full_form');
add_action('wp_ajax_nopriv_custom_form_ajax_full_form', 'custom_form_ajax_handler_full_form');

function custom_form_ajax_handler_full_form()
{

    $first_name = sanitize_text_field($_POST['firstName']);
    $last_name = sanitize_text_field($_POST['lastName']);
    $email = sanitize_text_field($_POST['email']);
    $phone_number = sanitize_text_field($_POST['phone']);
    $password = sanitize_text_field($_POST['password']);

    //Fetch API URL from options table
    $options = get_option('custom_settings');
    $api_url = isset($options['api_url']) ? esc_url($options['api_url']) : '';
    $full = $api_url . "CreateBusinessUserV2";
<<<<<<< HEAD

=======
	
	
	$referer = '';
    $custTrackingId = '';
    $cuId = '';

    $domain = $_SERVER['HTTP_HOST'];
    $domain = str_replace('.', '_', $domain);
    $cookie_name = $domain . '_session_tguid';
	
    if ($_COOKIE[$cookie_name]) {
        $existing_data = saasy_json_decode_3beta($_COOKIE[$cookie_name]);
        if ($existing_data) {
            $referer = $existing_data['latest_referrer'];
            $custTrackingId = $existing_data['saasy_session_tid'];
            $cuId = $existing_data['ftc_session_guid'];
        }
    }
>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d
// Make request to custom API for email validation
    $api_response = wp_remote_post($full, array(
        'body' => json_encode(array(

<<<<<<< HEAD
            "firstName" => $first_name,
=======
           "firstName" => $first_name,
>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d
            "lastName" => $last_name,
            "email" => $email,
            "confirmEmail" => $email,
            "password" => $password,
            "confirmPassword" => $password,
            "phone" => $phone_number,
            "doAgree" => true,
            "userExist" => false,
<<<<<<< HEAD
=======
            "CouponCode" => $custTrackingId,
            "Referer" => $referer,
            "CustTrackingId" => $custTrackingId,
            "CuId" => $cuId,
>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d

        )),
        'headers' => array('Content-Type' => 'application/json',
            'Wlid' => '94DE1528-DE42-498A-A07E-4A458E97240E',
        ),
        'timeout' => 30,
    ));
<<<<<<< HEAD
    wp_send_json_success($api_response);
=======
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
>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d

}

//-----------------Ajax Handling Whole Form 2 Api-------------------------------

function custom_form_ajax_full_api_two()
{

// Enqueue the script
    wp_enqueue_script('custom-form-ajax-full2-api', plugin_dir_url(__FILE__) . '../js/AjaxHandeling/AjaxScriptFormApi_2.js', array('jquery'), '1.0', true);

// Localize the script
    wp_localize_script('custom-form-ajax-full2-api', 'customFormFull2Api', array('ajaxurl' => admin_url('admin-ajax.php'), 'verification_url' => esc_url(get_option('custom_settings')['email_verification_url'])));
}

// Hook the function to wp_enqueue_scripts action

add_action('wp_enqueue_scripts', 'custom_form_ajax_full_api_two');

add_action('wp_ajax_custom_form_ajax_full_form_two', 'custom_form_ajax_handler_full_form_two');
add_action('wp_ajax_nopriv_custom_form_ajax_full_form_two', 'custom_form_ajax_handler_full_form_two');

function custom_form_ajax_handler_full_form_two()
{

    //Fetch API URL from options table
    $options = get_option('custom_settings');
    $api_url = isset($options['api_url']) ? esc_url($options['api_url']) : '';
    $full = $api_url . "CreateBusinessInfoV2";
    error_log('Received AJAX request:');
    error_log(print_r($_POST, true));

    $userIdSessions = sanitize_text_field($_POST['userIdGlobal']);
    $email = sanitize_text_field($_POST['email']);
    $phone_number = sanitize_text_field($_POST['phone']);
    $business_name = sanitize_text_field($_POST['business_name']);
    $business_info_choice = sanitize_text_field($_POST['business_info_choice']);

    // ---------------mixing ajax As saving bussiness in wp between bussiness saving api
    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_registration_data';
    if ($business_info_choice) {
        $wpdb->update(
            $table_name,
            array(
                'business_name' => $business_name,
                'business_info_choice' => $business_info_choice,
            ),
            array('email' => $email)
        );
    } else {
        $wpdb->update(
            $table_name,
            array(
                'business_name' => $business_name,
            ),
            array('email' => $email)
        );
    }
    //----------------------------------------------------------------------------------

    $api_response = wp_remote_post($full, array(
        'body' => json_encode(array(

<<<<<<< HEAD
           "businessId" => 0, //mandatory
=======
            "businessId" => 0, //mandatory
>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d
            "userID" => $userIdSessions, //mandatory
            "companyName" => $business_name,
            "businessName" => $business_name, //mandatory
            "industryTypeId" => $business_info_choice,
            "phone" => $phone_number, //mandatory
            "email" => $email,
            "address" => "",
            "zip" => "",
            "city" => "",
            "state" => "",
            "selectedState" => null,
            "industry" => $business_info_choice,
            "contactEmail" => "",

        )),
        'headers' => array('Content-Type' => 'application/json',
            'Wlid' => '94DE1528-DE42-498A-A07E-4A458E97240E',
        ),
        'timeout' => 30,
    ));

<<<<<<< HEAD
// Log the API response
    error_log('API Response:');
    error_log(print_r($api_response, true));

    wp_send_json_success($api_response);

    // Decode the JSON string in the "body" property
    $body_data = json_decode($api_response['data']['body']);

    // Access the "data" field
    $result = $body_data->data;

    // Print or log the result
    echo $result;
=======
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
>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d

}
