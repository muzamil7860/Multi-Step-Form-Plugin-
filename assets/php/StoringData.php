<?php

//Storing user id (data) in sessions and local wp db table
function store_data_in_options_table()
{
    if (!session_id()) {
        session_start();
    }

    $data_inside_data = $_POST['dataInsideData'];
    $user_email = $_POST['email'];
    echo $data_inside_data;
    echo $user_email;
    // Store data in session
    $_SESSION['saasy_user_id'] = $data_inside_data;
    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_registration_data';

    $wpdb->update(
        $table_name,
        array(
            'saasy_user_id' => $data_inside_data,
        ),
        array('email' => $user_email)
    );

    echo 'success';

    //  wp_die();

}

// Hook the handler to the corresponding action
add_action('wp_ajax_store_data_in_options_table', 'store_data_in_options_table');
add_action('wp_ajax_nopriv_store_data_in_options_table', 'store_data_in_options_table');

//Storing business id (data) in sessions and wordpress local db plugin test
function store_business_data_in_options_table_handler()
{
    if (!session_id()) {
        session_start();
    }

    $data_inside_data = sanitize_text_field($_POST['dataInsideData']);
    $user_email = $_POST['email'];
// Store data in session
    $_SESSION['saasy_user_bus_id'] = $data_inside_data;
    echo $data_inside_data;

    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_registration_data';

    $wpdb->update(
        $table_name,
        array(
            'business_id' => $data_inside_data,
        ),
        array('email' => $user_email)
    );

    echo 'success';
    //  wp_die(); // This is required to terminate immediately and return a proper response
}

// Hook the handler to the corresponding action
add_action('wp_ajax_store_business_data_in_options_table', 'store_business_data_in_options_table_handler');
add_action('wp_ajax_nopriv_store_business_data_in_options_table', 'store_business_data_in_options_table_handler');
