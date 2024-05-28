<?php

<<<<<<< HEAD
=======
/*

>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d
//-----------------Ajax Handling Email Field With Local WP-Database-------------------------------

function continueProcessButton_handler()
{
<<<<<<< HEAD
    //Fetch API URL from options table
=======
//Fetch API URL from options table
$options = get_option('custom_settings');
$api_url = isset($options['api_url']) ? esc_url($options['api_url']) : '';
$full = $api_url . "SendOTP";

if (isset($_POST['email'])) {
global $wpdb;
$table_name = $wpdb->prefix . 'custom_registration_data';
$email = sanitize_text_field($_POST['email']);
$_SESSION['user_email'] = $email;
$existing_row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE email = %s", $email), ARRAY_A);
// Access the values of 'business_id' and 'saasy_user_id' from the $existing_row array
$business_id = $existing_row['business_id'];
$saasy_user_id = $existing_row['saasy_user_id'];
$verification_status = $existing_row['verification_status'];
// ----------------------------------------------------

// Check if business_name is not empty and business is not verified
if (!empty($existing_row['business_name']) && $verification_status == 0) {

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
$response_to_send = array(
'success' => true,
'data' => $existing_row,
);
wp_send_json($existing_row);
exit();

}
// Check if business_name is not empty and business is verified (Just send row to success)
else if (!empty($existing_row['business_name']) && $verification_status == 1) {
$response_to_send = array(
'success' => true,
'data' => $existing_row,
);
wp_send_json($existing_row);
exit();
}
// Check if business_name is empty (Just send the Existing row in success so form can be filled)
else if (empty($existing_row['business_name'])) {
$response_to_send = array(
'success' => true,
'data' => $existing_row,
);

wp_send_json($existing_row);
}
//Rest of the warnings
else {
echo "Nothing to do bussiness is empty or email is already verified";
}

}

wp_die();
}

// Hook the email validation function to AJAX action
add_action('wp_ajax_continueProcessButton', 'continueProcessButton_handler');
add_action('wp_ajax_nopriv_continueProcessButton', 'continueProcessButton_handler');

 */

//-----------------Ajax Handling Email Field With Local WP-Database-------------------------------

function continueProcessButton_handler()
{

>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d
    $options = get_option('custom_settings');
    $api_url = isset($options['api_url']) ? esc_url($options['api_url']) : '';
    $full = $api_url . "SendOTP";

    if (isset($_POST['email'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'custom_registration_data';
        $email = sanitize_text_field($_POST['email']);
<<<<<<< HEAD
        $_SESSION['user_email'] = $email;
        $existing_row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE email = %s", $email), ARRAY_A);
        // Access the values of 'business_id' and 'saasy_user_id' from the $existing_row array
        $business_id = $existing_row['business_id'];
        $saasy_user_id = $existing_row['saasy_user_id'];
        $verification_status = $existing_row['verification_status'];
        // ----------------------------------------------------

        // Check if business_name is not empty and business is not verified
        if (!empty($existing_row['business_name']) && $verification_status == 0) {

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
            $response_to_send = array(
                'success' => true,
                'data' => $existing_row,
            );
            wp_send_json($existing_row);
            exit();

        }
        // Check if business_name is not empty and business is verified (Just send row to success)
        else if (!empty($existing_row['business_name']) && $verification_status == 1) {
            $response_to_send = array(
                'success' => true,
                'data' => $existing_row,
            );
            wp_send_json($existing_row);
            exit();
        }
        // Check if business_name is empty (Just send the Existing row in success so form can be filled)
        else if (empty($existing_row['business_name'])) {
            $response_to_send = array(
                'success' => true,
                'data' => $existing_row,
            );

            wp_send_json($existing_row);
        }
        //Rest of the warnings
        else {
            echo "Nothing to do bussiness is empty or email is already verified";
        }

    }

    wp_die();
=======
        $localWpEmailSuccess = sanitize_text_field($_POST['localWpEmailSuccess']);
        $ApiEmailSuccess = sanitize_text_field($_POST['ApiEmailSuccess']);
        $_SESSION['user_email'] = $email;
        $existing_row = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE email = %s", $email), ARRAY_A);
        $business_id = $existing_row['business_id'];
        $saasy_user_id = $existing_row['saasy_user_id'];

        if ($localWpEmailSuccess == "false" && $ApiEmailSuccess == "true") {

            $response_data = array(
                'existing_row' => $existing_row,
            );
            wp_send_json($response_data);
            return;
        }

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

        wp_send_json($api_response);

    }

>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d
}

// Hook the email validation function to AJAX action
add_action('wp_ajax_continueProcessButton', 'continueProcessButton_handler');
<<<<<<< HEAD
add_action('wp_ajax_nopriv_continueProcessButton', 'continueProcessButton_handler');

/*
function continueProcessButton_handler_script()
{
// Enqueue the script
wp_enqueue_script('custom-email-form-ajax-localDB', plugin_dir_url(__FILE__) . '/assets/js/AjaxHandeling/AjaxEmail.js', array('jquery'), '1.0', true);

}

// Hook the function to wp_enqueue_scripts action
add_action('wp_enqueue_scripts', 'continueProcessButton_handler_script');
 */
=======
add_action('wp_ajax_nopriv_continueProcessButton', 'continueProcessButton_handler');
>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d
