<?php

/*
Plugin Name: Lincsell SignUp
Description: Lincsell Signup System For Signing up .
Version: 1.0.5
Author: Zilon Solutions
 */

// Adding File of Enqueue Third Party Scripts and Styling
require_once plugin_dir_path(__FILE__) . 'assets/php/EnqueueFile.php';

// Adding File of Signup Html and Handling Php Function
require_once plugin_dir_path(__FILE__) . 'assets/php/PersonalFormShortCode.php';

// Adding File of Email Verification Page System
require_once plugin_dir_path(__FILE__) . 'assets/php/EmailVerification.php';

// Adding File of Setting Page System
require_once plugin_dir_path(__FILE__) . 'assets/php/settingPage.php';

// Adding File of Handeling Otp Code.
require_once plugin_dir_path(__FILE__) . 'assets/php/OtpHandeling.php';

// Adding File of Direct Otp Sending.
require_once plugin_dir_path(__FILE__) . 'assets/php/directEmailOtp.php';

// Adding File of After Otp Verification Final Step.
require_once plugin_dir_path(__FILE__) . 'assets/php/AfterOtp.php';

// Adding File of Handeling Business Field (Checking Uniquessness in api and local wp db).
require_once plugin_dir_path(__FILE__) . 'assets/php/HandleBusinessField.php';

// Adding File of Handeling Email Field (Checking Uniquessness in api and local wp db).
require_once plugin_dir_path(__FILE__) . 'assets/php/HandleEmailField.php';

// Adding File of Handeling Forms in WP db.
require_once plugin_dir_path(__FILE__) . 'assets/php/LocalDbForm.php';

// Adding File of Handeling Forms in Ajax db.
require_once plugin_dir_path(__FILE__) . 'assets/php/AjaxDbForm.php';

// Adding File of Storing Data in Sessions.
require_once plugin_dir_path(__FILE__) . 'assets/php/StoringData.php';

// Activation and Deactivation Hooks
register_activation_hook(__FILE__, 'custom_registration_plugin_activate');
register_deactivation_hook(__FILE__, 'custom_registration_plugin_deactivate');

function custom_registration_plugin_activate()
{
    // Create custom table on activation
    global $wpdb;

    $table_name = $wpdb->prefix . 'custom_registration_data';
    $charset_collate = $wpdb->get_charset_collate();
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            first_name varchar(50) NOT NULL,
            last_name varchar(50) NOT NULL,
            email varchar(100) NOT NULL ,
            phone_number varchar(20) NOT NULL,
            password varchar(255) NOT NULL,
            terms_and_conditions tinyint(1) NOT NULL,
            saasy_user_id varchar(50) NOT NULL,
            business_name varchar(100),
            business_info_choice varchar(50) NOT NULL DEFAULT '1623770624890',
            business_id varchar(50) NOT NULL,
            verification_status tinyint(1) NOT NULL DEFAULT 0,
            CouponCode varchar(100),
            Referer varchar(100),
            CustTrackingId varchar(100),
            CuId varchar(100),
            registration_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY  (id),
            UNIQUE KEY email (email)
        ) $charset_collate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }

    // Set default values for options when the plugin is activated
    $default_options = array(
        'save_data_to_db' => 1,
        'save_data_to_api' => 1,
        'api_url' => 'https://lsapim.azure-api.net/auth-svc/api/',
        'email_verification_url' => 'https://app.lincsell.com/',
    );

    // Check if options exist, if not, add them
    $existing_options = get_option('custom_settings');
    foreach ($default_options as $option => $value) {
        if (!isset($existing_options[$option])) {
            $existing_options[$option] = $value;
        }
    }

    // Update the options with default values
    update_option('custom_settings', $existing_options);
}

function custom_registration_plugin_deactivate()
{
    // Delete plugin option custom setting on plugin deactivation.
    delete_option('custom_settings');
    // Delete custom table on deactivation
    global $wpdb;

    $table_name = $wpdb->prefix . 'custom_registration_data';
 //   $wpdb->query("DROP TABLE IF EXISTS $table_name");
 //   $wpdb->query("DELETE FROM $table_name");
}
