<?php

//Finish Api Call Function:

add_action('wp_ajax_after_verify_otp', 'after_verify_otp_callback');
add_action('wp_ajax_nopriv_after_verify_otp', 'after_verify_otp_callback');

// function see_array_in_webhook_site_2027($message, $data) {
// 	$query_string_webhook = http_build_query(array('message' => $message, 'data' => $data));
// 	$url_webhook = 'https://webhook.site/8746c0ac-b9f8-47e1-8d93-00b4d93d533d?' . $query_string_webhook;
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
			/*
    $domain_row = $wpdb->get_row("SELECT * FROM $domain_table WHERE status = false LIMIT 1", ARRAY_A);
    if ($domain_row) {
        $wpdb->update(
            $domain_table,
            array(
                'user_name' => $user_data['first_name'] . ' ' . $user_data['last_name'],
                'password' => $user_data['password'],
                'user_id_domain' => $saasy_user_id,
                'business_id' => $user_data['business_id'],
                'email' => $user_email,
                'status' => true,
            ),
            array('id' => $domain_row['id'])
        );
    }
*/
			$wpdb->update(
				$registration_table,
				['verification_status' => true],
				['email' => $user_email]
			);

			/*
    $api_url = $domain_row ? "{$domain_row['domain_name']}/wp-json/back-office-apis/v1/save-hub-configuration/" : "https://development.stg.lincsell.com/wp-json/back-office-apis/v1/save-hub-configuration/";

    $body = array(
        'moi_enable' => 1,
        'moi_vendor_id' => $user_email,
        'moi_vendor_secret_token' => $saasy_user_password,
        'moi_vendor_wild' => '94DE1528-DE42-498A-A07E-4A458E97240E',
        'moi_vendor_api' => 'https://lsapim.azure-api.net',
        'store_location' => 101
    );

    $response = wp_remote_post($api_url, array(
        'body' => $body,
        'timeout' => 120,
    ));

    if (!is_wp_error($response)) {
        echo 'success';
    }
*/
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

	/*
// Check if email is already present in the domain table

$existing_domain = $wpdb->get_row($wpdb->prepare("SELECT * FROM $domain_table WHERE email = %s", $user_email), ARRAY_A);
if ($existing_domain) {
return rest_ensure_response(array(
    'status' => 'error',
    'message' => 'Configuration already exists for this email.',
));
}

// Fetch domain data
$domain_row = $wpdb->get_row(
$wpdb->prepare(
    "SELECT * FROM $domain_table WHERE status = false AND template_id = %d LIMIT 1",
    $template_id
),
ARRAY_A
);

if (!$domain_row) {
return rest_ensure_response(array(
    'status' => 'error',
    'message' => 'No available domain found for the provided template_id.',
));
}

// Update domain table
$wpdb->update(
$domain_table,
array(
    'user_name' => $user_data['first_name'] . ' ' . $user_data['last_name'],
    'password' => $user_data['password'],
    'user_id_domain' => $user_data['saasy_user_id'],
    'business_id' => $user_data['business_id'],
    'email' => $user_email,
    'status' => true,
),
array('id' => $domain_row['id'])
);
*/

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

	/*
// Error handling
if (is_wp_error($responseWoo)) {
$error_message = $responseWoo->get_error_message();
echo "Something went wrong: $error_message";
} else {
echo 'Response:<pre>';
print_r(wp_remote_retrieve_body($responseWoo));
echo '</pre>';
}
*/
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

	// Success response
	return rest_ensure_response([
		'status'       => 'success',
		'webStoreHost' => $webStoreHost,
		'demoUrl'      => $demoUrl,
		'message'      => 'Domain integration details received successfully.',
	]);

}