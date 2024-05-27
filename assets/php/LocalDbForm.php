<?php

//-----------------Ajax Handling First Form-------------------------------

function saasy_json_decode_3alpha($encoded_array)
{
    $ok = json_decode($encoded_array, true);
    $err_msg = json_last_error_msg();
    if ($err_msg !== 'No error') {
        $cleanedCookieValue = stripslashes($encoded_array);
        $ok = json_decode($cleanedCookieValue, true);
    }
    return $ok;
}


add_action('wp_ajax_custom_form_ajax', 'custom_form_ajax_handler');
add_action('wp_ajax_nopriv_custom_form_ajax', 'custom_form_ajax_handler');

$options = get_option('custom_settings');
$save_data_to_db = isset($options['save_data_to_db']) ? $options['save_data_to_api'] : 0;

if ($save_data_to_db == 1) {
    function custom_form_ajax()
    {

// Localize the script
        wp_localize_script('custom-form-ajax', 'customForm', array('ajaxurl' => admin_url('admin-ajax.php')));
    }

// Hook the function to wp_enqueue_scripts action
    add_action('wp_enqueue_scripts', 'custom_form_ajax');

    function custom_form_ajax_handler()
    {
        
		 $referer = '';
        $custTrackingId = '';
        $cuId = '';
		
		$domain = $_SERVER['HTTP_HOST'];
		$domain = str_replace('.', '_', $domain);
		$cookie_name = $domain . '_session_tguid';
		
        if ($_COOKIE[$cookie_name]) {
            $existing_data = saasy_json_decode_3alpha($_COOKIE[$cookie_name]);
            if ($existing_data) {
                $referer = $existing_data['latest_referrer'];
                $custTrackingId = $existing_data['saasy_session_tid'];
                $cuId = $existing_data['ftc_session_guid'];
            }
        }

// Check if any of the required fields are empty
        if (empty($_POST['first_name']) ||
            empty($_POST['last_name']) ||
            empty($_POST['email']) ||
            empty($_POST['phone_number']) ||
            empty($_POST['password']) ||
            !isset($_POST['terms_and_conditions'])) {

// If any field is empty, terminate the function
            echo 'error: one or more fields are empty';
            wp_die();
            return;
        }

        //--------------------------------------------------------
        if (isset($_POST['first_name']) && isset($_POST['last_name'])) {
            global $wpdb;

            $table_name = $wpdb->prefix . 'custom_registration_data';

            $first_name = sanitize_text_field($_POST['first_name']);
            $last_name = sanitize_text_field($_POST['last_name']);
            $email = sanitize_text_field($_POST['email']);
            $phone_number = sanitize_text_field($_POST['phone_number']);
            $password = sanitize_text_field($_POST['password']);
            $terms_and_conditions = isset($_POST['terms_and_conditions']) ? 1 : 0;
            $hasedPassword = wp_hash_password($password);
            $business_name = sanitize_text_field($_POST['business_name']);
            //----------------------------------------------------------------------
            // Prepare email content
            $to = 'arehmanzilon@gmail.com';
            $subject = 'New Signup Customer';

            $message = '
				<html>
				<head>
					<title>New Signup Customer</title>
					<style>
						body {
							font-family: Arial, sans-serif;
							background-color: #f4f4f4;
							margin: 0;
							padding: 20px;
						}
						.container {
							margin: auto;
							background: #fff;
							padding: 30px;
							border-radius: 5px;
							box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
						}
						h2 {
							color: #333;
						}
						p {
							margin-bottom: 15px;
						}
						strong {
							font-weight: bold;
						}
						.heading_email{
							color: #fff;
							background-color: blue;
							padding: 6px;
							border-radius: 3px;
						}
					</style>
				</head>
				<body>
					<div class="container" style="border:1px solid #EBEBEB; background-color:#00000005;">
						<h2 class="heading_email">New Signup Customer</h2>
						<p>Hey Team,<br>Exciting news! We have got a new addition to our Lincsell. Check out the details below:</p>
						<p><strong>First Name:</strong> ' . $first_name . '</p>
						<p><strong>Last Name:</strong> ' . $last_name . '</p>
						<p><strong>Email:</strong> ' . $email . '</p>
						<p><strong>Phone Number:</strong> ' . $phone_number . '</p>
						<p><strong>Business Name:</strong> ' . $business_name . '</p>
					</div>
					<div><p>Copyright © 2024 LincSell. All rights reserved.</p></div>
				</body>
				</html>
			';

            $headers = array('Content-Type: text/html; charset=UTF-8');

// Send the email
            $sent = wp_mail($to, $subject, $message, $headers);

            if (!$sent) {
                echo 'error: failed to send email';
                //   wp_die();
                //   return;
            }

            //----------------------------------------------------------------------
            $data = array(
               'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'phone_number' => $phone_number,
                'password' => $hasedPassword,
                'terms_and_conditions' => $terms_and_conditions,
                "CouponCode" => $custTrackingId,
                "Referer" => $referer,
                "CustTrackingId" => $custTrackingId,
                "CuId" => $cuId,
            );

            $format = array(
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%d',
            );
            $existing_user = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE email = %s", $email));
            if ($existing_user) {
                // Email already exists, update the data
                $wpdb->update(
                    $table_name,
                    $data,
                    array('email' => $email),
                    $format,
                    array('%s') // Format for the WHERE condition
                );
            } else {
                // Email doesn't exist, insert a new row
                $wpdb->insert(
                    $table_name,
                    $data,
                    $format
                );
            }

            if (!session_id()) {
                session_start();
            }
            $_SESSION['user_email'] = $email;
            echo 'success';
        }

        wp_die();
    }
}
//-----------------Ajax Handling Second Form-------------------------------

add_action('wp_ajax_custom_2form_ajax', 'custom_2form_ajax_handler');
add_action('wp_ajax_nopriv_custom_2form_ajax', 'custom_2form_ajax_handler');

$options = get_option('custom_settings');
$save_data_to_db = isset($options['save_data_to_db']) ? $options['save_data_to_api'] : 0;

if ($save_data_to_db == 1) {

    function custom_2form_ajax()
    {
// Enqueue the script
        // wp_enqueue_script('custom-2form-ajax', plugin_dir_url(__FILE__) . 'AjaxScriptForm2.js', array('jquery'), '1.0', true);

// Localize the script
        wp_localize_script('custom-2form-ajax', 'custom2Form', array('ajaxurl' => admin_url('admin-ajax.php')));
    }

// Hook the function to wp_enqueue_scripts action
    add_action('wp_enqueue_scripts', 'custom_2form_ajax');

}
