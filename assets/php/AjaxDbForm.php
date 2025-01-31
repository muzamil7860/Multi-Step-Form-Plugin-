<?php

//-----------------Ajax Handling Whole Form 1 Api-------------------------------


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
	$has_platform = sanitize_text_field($_POST['has_platform']);
	$has_registered = sanitize_text_field($_POST['has_registered']);
	//Fetch API URL from options table
	$options = get_option('custom_settings');
	$api_url = isset($options['api_url']) ? esc_url($options['api_url']) : '';
	$full = $api_url . "CreateBusinessUserV2";


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

	global $wpdb;
	$domain_table = $wpdb->prefix . 'domain_table';
	$domain_row = $wpdb->get_row("SELECT * FROM $domain_table WHERE status = false LIMIT 1", ARRAY_A);
	//$unique_domain_url =$domain_row['domain_name'];
	// Check if $domain_row is not null, otherwise set to default URL
	$unique_domain_url = $domain_row ? $domain_row['domain_name'] : 'https://development.stg.lincsell.com';

	// Make request to custom API for email validation


	$api_response = wp_remote_post($full, array(
		'body' => json_encode(array(
			"firstName" => $first_name,
			"lastName" => $last_name,
			"email" => $email,
			"confirmEmail" => $email,
			"password" => $password,
			"confirmPassword" => $password,
			"phone" => $phone_number,
			"doAgree" => true,
			"userExist" => false,
			"CouponCode" => $custTrackingId,
			"Referer" => $referer,
			"CustTrackingId" => $custTrackingId,
			"CuId" => $cuId,
			"Platform" => $has_platform,
			/*
			"templateInfo" => array(
				array(
					"templateID" => 1,
					"webStoreHost" => $unique_domain_url,
					"demoUrl" => $unique_domain_url . "/?auth_token=signmein",
					"isDefault" => false,
					"isAvailable" => true,
					"imageUrl" => $unique_domain_url . "/wp-content/uploads/2024/09/template_alpha-scaled.webp",
					"isSelectedLater" => false
				),
				array(
					"templateID" => 2,
					"webStoreHost" => $unique_domain_url,
					"demoUrl" => $unique_domain_url . "/?auth_token=signmein",
					"isDefault" => false,
					"isAvailable" => false,
					"imageUrl" => $unique_domain_url . "/wp-content/uploads/2024/09/template_alpha-scaled.webp",
					"isSelectedLater" => false
				),
				array(
					"templateID" => 3,
					"webStoreHost" => $unique_domain_url,
					"demoUrl" => $unique_domain_url . "/?auth_token=signmein",
					"isDefault" => false,
					"isAvailable" => false,
					"imageUrl" => $unique_domain_url . "/wp-content/uploads/2024/09/template_alpha-scaled.webp",
					"isSelectedLater" => false
				)
			)  */
		)),
		'headers' => array(
			'Content-Type' => 'application/json',
			'Wlid' => '94DE1528-DE42-498A-A07E-4A458E97240E'
		),
		'timeout' => 60
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
	$industry = sanitize_text_field($_POST['industry']);

	// ---------------mixing ajax As saving bussiness in wp between bussiness saving api
	global $wpdb;
	$table_name = $wpdb->prefix . 'custom_registration_data';
	if ($industry) {
		$wpdb->update(
			$table_name,
			array(
				'business_name' => $business_name,
				'business_info_choice' => $industry,
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

			"businessId" => 0, //mandatory
			"userID" => $userIdSessions, //mandatory
			"companyName" => $business_name,
			"businessName" => $business_name, //mandatory
			"industryTypeId" => $industry,
			"phone" => $phone_number, //mandatory
			"email" => $email,
			"address" => "",
			"zip" => "",
			"city" => "",
			"state" => "",
			"selectedState" => null,
			"industry" => $industry,
			"contactEmail" => "",

		)),
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
