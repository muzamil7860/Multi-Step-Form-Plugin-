<?php

//-----------------Ajax Handling First Form-------------------------------

add_action('wp_ajax_custom_form_ajax', 'custom_form_ajax_handler');
add_action('wp_ajax_nopriv_custom_form_ajax', 'custom_form_ajax_handler');

$options = get_option('custom_settings');
$save_data_to_db = isset($options['save_data_to_db']) ? $options['save_data_to_api'] : 0;

if ($save_data_to_db == 1) {
    function custom_form_ajax()
    {
// Enqueue the script
        //wp_enqueue_script('custom-form-ajax', plugin_dir_url(__FILE__) . 'AjaxScriptForm1.js', array('jquery'), '1.0', true);

// Localize the script
        wp_localize_script('custom-form-ajax', 'customForm', array('ajaxurl' => admin_url('admin-ajax.php')));
    }

// Hook the function to wp_enqueue_scripts action
    add_action('wp_enqueue_scripts', 'custom_form_ajax');

    function custom_form_ajax_handler()
    {
        // check_ajax_referer('custom_form_nonce', 'security');
        //--------------------------------------------------------

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

            $data = array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'phone_number' => $phone_number,
                'password' => $password,
                'terms_and_conditions' => $terms_and_conditions,
            );

            $format = array(
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%d',
            );

            // Use replace method to insert or update based on email uniqueness
            //     $wpdb->replace($table_name, $data, $format);

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
    /*
    function custom_2form_ajax_handler()
    {

    // Check if required fields are empty
    if (empty($_POST['business_name']) || empty($_POST['business_info_choice'])) {
    echo 'error';
    wp_die();
    }

    if (isset($_POST['business_name']) && isset($_POST['business_info_choice'])) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_registration_data';
    $business_name = sanitize_text_field($_POST['business_name']);
    $business_info_choice = sanitize_text_field($_POST['business_info_choice']);

    // Store business data in session
    $_SESSION['business_name'] = $business_name;
    $_SESSION['business_info_choice'] = $business_info_choice;

    if (!session_id()) {
    session_start();
    }

    // Check if the email is stored in the session
    if (isset($_SESSION['user_email'])) {
    $user_email = $_SESSION['user_email'];
    $user_id = $_SESSION['saasy_user_id'];

    }

    $wpdb->update(
    $table_name,
    array(
    'business_name' => $business_name,
    'business_info_choice' => $business_info_choice,
    ),
    array('email' => $user_email)
    );

    echo 'success';
    }
    wp_die();
    }
     */
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
