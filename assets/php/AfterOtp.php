<?php

//Finish Api Call Function:

add_action('wp_ajax_after_verify_otp', 'after_verify_otp_callback');
add_action('wp_ajax_nopriv_after_verify_otp', 'after_verify_otp_callback');

<<<<<<< HEAD
=======

function saasy_json_decode_3ceta($encoded_array)
{
    $ok = json_decode($encoded_array, true);
    $err_msg = json_last_error_msg();
    if ($err_msg !== 'No error') {
        $cleanedCookieValue = stripslashes($encoded_array);
        $ok = json_decode($cleanedCookieValue, true);
    }
    return $ok;
}

>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d
function after_verify_otp_callback()
{

// ---------------------------------------------------------
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
    $full = $api_url . "FinishSignUpProcess";
<<<<<<< HEAD
=======
	
	$referer = '';
    $custTrackingId = '';
    $cuId = '';

	$domain = $_SERVER['HTTP_HOST'];
    $domain = str_replace('.', '_', $domain);
    $cookie_name = $domain . '_session_tguid';
    if ($_COOKIE[$cookie_name]) {
        $existing_data = saasy_json_decode_3ceta($_COOKIE[$cookie_name]);
        if ($existing_data) {
            $referer = $existing_data['latest_referrer'];
            $custTrackingId = $existing_data['saasy_session_tid'];
            $cuId = $existing_data['ftc_session_guid'];
        }
    }
>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d

    $api_response = wp_remote_post($full, array(
        'body' => json_encode(array(
            "businessId" => $business_id,
<<<<<<< HEAD
=======
			"CouponCode" => $custTrackingId,
>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d
            "NoOfLocations" => 1,
            "PerNoOfRegister" => 1,
            "NoOfRegisters" => 1,
            "userID" => $saasy_user_id,
            "SaveInfo" => false,
            "subscription" => array(
                "TransactionDetails" => null,
                "hardwarePkgId" => [],
                "IsFreeTrial" => true,
                "totalHardwarePkgCost" => 0,
                "planCost" => 0,
                "planId" => "162851695001",
                "totalCost" => 0,
                "subscriptionPlanPkg" => array(
                    array(
                        "packageId" => "162851695001",
                        "qty" => 1,
                        "pricePerPackage" => 0,
                        "subTotalCost" => 0,
                        "packageType" => 0,
                        "discountValue" => 0,
                        "taxValue" => 0,
                        "discountAmount" => 0,
                        "taxAmount" => 0,
                        "isDiscountPercent" => false,
                        "isTaxPercent" => false,
                        "totalPrice" => 0,
                    ),
                ),
                "WooCommercePlanPkg" => [],
                "DomainPlanPkg" => [],
                "hardwarePkg" => [],
                "TotalTaxAmount" => 0,
                "subTotalCost" => 0,
                "TotalDiscountAmount" => 0,
                "TotalTaxValue" => 0,
                "TotalDiscountValue" => 0,
                "IsTotalTaxPercente" => false,
                "IsTotalDiscountPercent" => false,
                "SubscribedFeatures" => []
            ),
            "CCCustomerProfile" => null
        )),
        'headers' => array('Content-Type' => 'application/json',
            'Wlid' => '94DE1528-DE42-498A-A07E-4A458E97240E',
        ),
<<<<<<< HEAD
		 'timeout' => 30, 
    ));
    wp_send_json_success($api_response);
=======
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
>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d
}

//--------------------------------------------------------

// Handler for Ajax to set the boolean value to true for local wp custom plugin table attribut verification_status

// Hook the business name validation function to AJAX action
add_action('wp_ajax_function_local_verification_status', 'function_local_verification_status_handler');
add_action('wp_ajax_nopriv_function_local_verification_status', 'function_local_verification_status_handler');
function function_local_verification_status_handler()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_registration_data';
// Check if the email is stored in the session
    if (isset($_SESSION['user_email'])) {
        $user_email = $_SESSION['user_email'];
    }

    $wpdb->update(
        $table_name,
        array(
            'verification_status' => true,
        ),
        array('email' => $user_email)
    );

    echo 'success';
    wp_die();
}
