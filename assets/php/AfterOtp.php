<?php

//Finish Api Call Function:

add_action('wp_ajax_after_verify_otp', 'after_verify_otp_callback');
add_action('wp_ajax_nopriv_after_verify_otp', 'after_verify_otp_callback');

// function see_array_in_webhook_site_2027($message, $data) {
// 	$query_string_webhook = http_build_query(array('message' => $message, 'data' => $data));
// 	$url_webhook = 'https://webhook.site/65bed580-cc60-4803-b6a9-65f8fce7e135?' . $query_string_webhook;
// 	wp_remote_get($url_webhook);
// }

function saasy_json_decode_3ceta($encoded_array)
{
	$ok      = json_decode($encoded_array, true);
	$err_msg = json_last_error_msg();
	if ($err_msg !== 'No error') {
		$cleanedCookieValue = stripslashes($encoded_array);
		$ok                 = json_decode($cleanedCookieValue, true);
	}
	return $ok;
}

function after_verify_otp_callback()
{

	// ---------------------------------------------------------
	global $wpdb;
	$table_name    = $wpdb->prefix . 'custom_registration_data';
	$email         = $_SESSION['user_email'];
	$existing_row  = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE email = %s", $email), ARRAY_A);
	$business_id   = $existing_row['business_id'];
	$saasy_user_id = $existing_row['saasy_user_id'];
	//----------------------------------------------------------

	//Fetch API URL from options table
	$options = get_option('custom_settings');
	$api_url = isset($options['api_url']) ? esc_url($options['api_url']) : '';
	$full    = $api_url . "FinishSignUpProcess";

	$referer        = '';
	$custTrackingId = '';
	$cuId           = '';

	$domain      = $_SERVER['HTTP_HOST'];
	$domain      = str_replace('.', '_', $domain);
	$cookie_name = $domain . '_session_tguid';
	if ($_COOKIE[$cookie_name]) {
		$existing_data = saasy_json_decode_3ceta($_COOKIE[$cookie_name]);
		if ($existing_data) {
			$referer        = $existing_data['latest_referrer'];
			$custTrackingId = $existing_data['saasy_session_tid'];
			$cuId           = $existing_data['ftc_session_guid'];
		}
	}

	$api_response = wp_remote_post($full, [
		'body'    => json_encode([
			"businessId"        => $business_id,
			"CouponCode"        => $custTrackingId,
			"NoOfLocations"     => 1,
			"PerNoOfRegister"   => 1,
			"NoOfRegisters"     => 1,
			"userID"            => $saasy_user_id,
			"SaveInfo"          => false,
			"subscription"      => [
				"TransactionDetails"     => null,
				"hardwarePkgId"          => [],
				"IsFreeTrial"            => true,
				"totalHardwarePkgCost"   => 0,
				"planCost"               => 0,
				"planId"                 => "1628516995007",
				"totalCost"              => 0,
				"subscriptionPlanPkg"    => [
					[
						"packageId"         => "1628516995007",
						"qty"               => 1,
						"pricePerPackage"   => 0,
						"subTotalCost"      => 0,
						"packageType"       => 0,
						"discountValue"     => 0,
						"taxValue"          => 0,
						"discountAmount"    => 0,
						"taxAmount"         => 0,
						"isDiscountPercent" => false,
						"isTaxPercent"      => false,
						"totalPrice"        => 0,
					],
				],
				"WooCommercePlanPkg"     => [],
				"DomainPlanPkg"          => [],
				"hardwarePkg"            => [],
				"TotalTaxAmount"         => 0,
				"subTotalCost"           => 0,
				"TotalDiscountAmount"    => 0,
				"TotalTaxValue"          => 0,
				"TotalDiscountValue"     => 0,
				"IsTotalTaxPercente"     => false,
				"IsTotalDiscountPercent" => false,
				"SubscribedFeatures"     => []
			],
			"CCCustomerProfile" => null
		]),
		'headers' => ['Content-Type' => 'application/json',
					  'Wlid'                            => '94DE1528-DE42-498A-A07E-4A458E97240E',
					 ],
		'timeout' => 300,
	]);
	if (is_wp_error($api_response)) {

		$error_messages[] = 'API Request Failed: ' . $api_response->get_error_message();
		$sending_errors   = [
			"error"          => true,
			"error_messages" => $error_messages,
		];
		wp_send_json($sending_errors);

	} else {
		wp_send_json($api_response);
	}
}

//--------------------------------------------------------

// Handler for Ajax to set the boolean value to true for local wp custom plugin table attribut verification_status

// Hook the business name validation function to AJAX action
add_action('wp_ajax_function_local_verification_status', 'function_local_verification_status_handler');
add_action('wp_ajax_nopriv_function_local_verification_status', 'function_local_verification_status_handler');

function function_local_verification_status_handler()
{
	global $wpdb;
	$registration_table = $wpdb->prefix . 'custom_registration_data';
	$domain_table       = $wpdb->prefix . 'domain_table';

	if (isset($_SESSION['user_email'])) {
		$user_email = $_SESSION['user_email'];
		$user_data  = $wpdb->get_row($wpdb->prepare("SELECT * FROM $registration_table WHERE email = %s", $user_email), ARRAY_A);

		if ($user_data) {
			$saasy_user_id       = $user_data['saasy_user_id'];
			$saasy_user_password = $user_data['password'];

			$_SESSION['user_email_saasy']    = $user_email;
			$_SESSION['user_password_saasy'] = $saasy_user_password;
		
			$wpdb->update(
				$registration_table,
				['verification_status' => true],
				['email' => $user_email]
			);

			echo 'success';
		} else {
			echo 'User not found.';
		}
	} else {
		echo 'Email not found in session.';
	}

	wp_die();
}

// Register REST API Endpoint
add_action('rest_api_init', function () {
	register_rest_route('lincsell/v1', '/assignDomain', [
		'methods'             => 'POST',
		'callback'            => 'assign_domain_ls_integration',
		'permission_callback' => '__return_true', // Adjust for permissions if needed
	]);
});

// Callback Function for the Endpoint
function assign_domain_ls_integration($request)
{
	$params      = $request->get_json_params();
	$user_email  = isset($params['user_email']) ? sanitize_email($params['user_email']) : null;
	$template_id = isset($params['template_id']) ? sanitize_text_field($params['template_id']) : null;

	// Validate input parameters
	if (! $user_email || ! $template_id) {
		return rest_ensure_response([
			'status'  => 'error',
			'message' => 'Invalid or missing parameters: user_email and template_id are required.',
		]);
	}

	global $wpdb;
	$registration_table = $wpdb->prefix . 'custom_registration_data';
	//	$domain_table = $wpdb->prefix . 'domain_table';

	// Fetch user data
	$user_data = $wpdb->get_row($wpdb->prepare("SELECT * FROM $registration_table WHERE email = %s", $user_email), ARRAY_A);
	if (! $user_data) {
		return rest_ensure_response([
			'status'  => 'error',
			'message' => 'User not found.',
		]);
	}

	//------------------------------------------------
	//######################################################################################################################
	// Hitting Asghir Api For Wordpress creation

	$api_url_Asg = 'https://setup.lincsell.com./handleFolderRequest.php';

	$businessWoo = isset($user_data['business_name']) 
    ? preg_replace('/[^a-z0-9]/', '', strtolower(sanitize_text_field($user_data['business_name']))) 
    : null;



	$bodyAsg     = wp_json_encode([
		'subdomain'     => $businessWoo,
		'templateid'    => $template_id,
		'adminEmail'    => $user_email,
		'adminPassword' => $user_data['password'],
		'isWordpress'   => "true",

	]);
	//	see_array_in_webhook_site_2027('bodyAsg',$bodyAsg);

	$responseAsg = wp_remote_post($api_url_Asg, [
		'method'  => 'POST',
		'body'    => $bodyAsg,
		'headers' => [
			'Content-Type' => 'application/json',
		],
		'timeout' => 300,
	]);

	//	see_array_in_webhook_site_2027('responseAsg',$responseAsg);

	//--------------------------------------------	

	//##########################################################################################
	//------------------------------------------------

	//Updated Code Line
	// Construct the domain URL
	//  $businessWoo = isset($user_data['business_name']) ? sanitize_text_field($user_data['business_name']) : null;
	if (! $businessWoo) {
		return rest_ensure_response([
			'status'  => 'error',
			'message' => 'Business name not found.',
		]);
	}

	$domain_row = "https://" . $businessWoo . ".lincsell.com";

	// Prepare API request

	$api_url = "{$domain_row}/wp-json/back-office-apis/v1/save-hub-configuration/";
	// Updated Line***
	$api_urlWoo   = "{$domain_row}/wp-json/custom/v1/updateWooemail";
	$webStoreHost = $domain_row;
	$demoUrl      = $domain_row . '/?auth_token=signmein';

	// Code For Wooemail Update...

	// WooCommerce Email updating
	$bodyWoo = wp_json_encode([
		'email' => $user_email,
		'store' => $businessWoo
	]);
	// 	see_array_in_webhook_site_2027('email',$bodyWoo);
	$responseWoo = wp_remote_post($api_urlWoo, [
		'method'  => 'POST',
		'body'    => $bodyWoo,
		'headers' => [
			'Content-Type' => 'application/json',
		],
		'timeout' => 60,
	]);
//	see_array_in_webhook_site_2027('responseWoo',$responseWoo);


	//----------------------------------------------------------

	$body = [
		'moi_enable'              => 1,
		'moi_vendor_id'           => $user_email,
		'moi_vendor_secret_token' => $user_data['password'],
		'moi_vendor_wild'         => '94DE1528-DE42-498A-A07E-4A458E97240E',
		'moi_vendor_api'          => 'https://lsapim.azure-api.net',
		'store_location'          => 101,
	];

	$response = wp_remote_post($api_url, [
		'body'    => $body,
		'timeout' => 180,
	]);
	
	// see_array_in_webhook_site_2027('responseConfig',$response);

	// Success response
	return rest_ensure_response([
		'status'       => 'success',
		'webStoreHost' => $webStoreHost,
		'demoUrl'      => $demoUrl,
		'message'      => 'Domain integration details received successfully.',
	]);

}





// ------------------------------------------------------------------------------------------

//In case of paid signup they will hit my api after successfully creating user and we are adding that user in our table

function register_custom_user_endpoint() {
    register_rest_route('custom-api/v1', '/register', array(
        'methods'  => 'POST',
        'callback' => 'handle_custom_user_registration',
        'permission_callback' => '__return_true', // Set proper permissions if needed
    ));
}
add_action('rest_api_init', 'register_custom_user_endpoint');



function handle_custom_user_registration(WP_REST_Request $request) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_registration_data';

    // Get request parameters
    $params = $request->get_params();

    // Validate required fields
    $required_fields = ['first_name', 'last_name', 'email', 'phone_number', 'password', 'terms_and_conditions', 'saasy_user_id', 'business_id', 'platform', 'register'];
    foreach ($required_fields as $field) {
        if (empty($params[$field])) {
            return new WP_REST_Response(["error" => "$field is required"], 400);
        }
    }

    // Sanitize input data
    $first_name = sanitize_text_field($params['first_name']);
    $last_name = sanitize_text_field($params['last_name']);
    $email = sanitize_email($params['email']);
    $phone_number = sanitize_text_field($params['phone_number']);
    $password = $params['password']; 
    $terms_and_conditions = intval($params['terms_and_conditions']);
    $saasy_user_id = sanitize_text_field($params['saasy_user_id']);
    $business_name = !empty($params['business_name']) ? sanitize_text_field($params['business_name']) : null;
    $business_info_choice = sanitize_text_field($params['business_info_choice'] ?? '1623770624890');
    $business_id = sanitize_text_field($params['business_id']);
    $platform = sanitize_text_field($params['platform']);
    $register = sanitize_text_field($params['register']);
    $verification_status = intval($params['verification_status'] ?? 0);
    $coupon_code = sanitize_text_field($params['CouponCode'] ?? '');
    $referer = sanitize_text_field($params['Referer'] ?? '');
    $cust_tracking_id = sanitize_text_field($params['CustTrackingId'] ?? '');
    $cu_id = sanitize_text_field($params['CuId'] ?? '');

    // Check if email already exists
    $existing_user = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE email = %s", $email));
    if ($existing_user) {
        return new WP_REST_Response(["error" => "Email already registered"], 400);
    }

    // Insert into database
    $inserted = $wpdb->insert(
        $table_name,
        [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone_number' => $phone_number,
            'password' => $password,
            'terms_and_conditions' => $terms_and_conditions,
            'saasy_user_id' => $saasy_user_id,
            'business_name' => $business_name,
            'business_info_choice' => $business_info_choice,
            'business_id' => $business_id,
            'platform' => $platform,
            'register' => $register,
            'verification_status' => $verification_status,
            'CouponCode' => $coupon_code,
            'Referer' => $referer,
            'CustTrackingId' => $cust_tracking_id,
            'CuId' => $cu_id,
        ],
        [
            '%s', '%s', '%s', '%s', '%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%s', '%s', '%s', '%s'
        ]
    );

    if ($inserted) {
        return new WP_REST_Response(["message" => "User registered successfully"], 201);
    } else {
        return new WP_REST_Response(["error" => "Registration failed"], 500);
    }
}




