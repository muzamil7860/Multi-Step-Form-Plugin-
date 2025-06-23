<?php

/*
Plugin Name: Lincsell SignUp
Description: Lincsell Signup System For Signing up .
Version: 1.1.0
Author: Muzamil Attiq | Zilon Solutions
 */

// Adding File of Enqueue Third Party Scripts and Styling
require_once plugin_dir_path(__FILE__) . 'assets/php/EnqueueFile.php';

// Adding File of Signup Html and Handling Php Function
require_once plugin_dir_path(__FILE__) . 'assets/php/PersonalFormShortCode.php';

// Adding File of Success Html and Handling Php Function
require_once plugin_dir_path(__FILE__) . 'assets/php/AfterSuccessCode.php';

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
            platform varchar(50) NOT NULL,
            register varchar(50) NOT NULL,
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

/*
// Create domain_table table with an email field
$domain_table_name = $wpdb->prefix . 'domain_table';
if ($wpdb->get_var("SHOW TABLES LIKE '$domain_table_name'") != $domain_table_name) {
$sql = "CREATE TABLE $domain_table_name (
id mediumint(9) NOT NULL AUTO_INCREMENT,
domain_name varchar(255) NOT NULL,
email varchar(255) NOT NULL,
status boolean DEFAULT 0,
user_name varchar(255) DEFAULT '',
password varchar(255) DEFAULT '',
user_id_domain varchar(255) DEFAULT '',
business_id varchar(255) DEFAULT '',
location varchar(255) DEFAULT '101',
PRIMARY KEY  (id)
) $charset_collate;";

require_once ABSPATH . 'wp-admin/includes/upgrade.php';
dbDelta($sql);

// Insert predefined rows into domain_table
$default_domains = array(
'https://temp-w3x9b2.stg.stg.lincsell.com', //template id 1
'https://temp-f8d1k4.stg.stg.lincsell.com', //template id 2
'https://temp-p7q3z6.stg.stg.lincsell.com', //template id 3
'https://temp-l2a5n7.stg.stg.lincsell.com', //template id 1
'https://temp-v9u4m3.stg.stg.lincsell.com', //template id 2
);

foreach ($default_domains as $domain) {
$wpdb->insert(
$domain_table_name,
array(
'domain_name' => $domain,
)
);
}
}
 */
    // Create or update the domain_table to include a template_id field
    $domain_table_name = $wpdb->prefix . 'domain_table';
    if ($wpdb->get_var("SHOW TABLES LIKE '$domain_table_name'") != $domain_table_name) {
        // Create the table with the new `template_id` column
        $sql = "CREATE TABLE $domain_table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        domain_name varchar(255) NOT NULL,
        email varchar(255) NOT NULL,
        status boolean DEFAULT 0,
        user_name varchar(255) DEFAULT '',
        password varchar(255) DEFAULT '',
        user_id_domain varchar(255) DEFAULT '',
        business_id varchar(255) DEFAULT '',
        location varchar(255) DEFAULT '101',
        template_id mediumint(9) DEFAULT NULL, -- New column for template ID
        PRIMARY KEY  (id)
    ) $charset_collate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    } else {
        // Add the `template_id` column if it doesn't exist
        $column_exists = $wpdb->get_results(
            $wpdb->prepare(
                "SHOW COLUMNS FROM $domain_table_name LIKE %s",
                'template_id'
            )
        );

        if (empty($column_exists)) {
            $wpdb->query("ALTER TABLE $domain_table_name ADD template_id mediumint(9) DEFAULT NULL");
        }
    }

// Insert predefined rows into domain_table
    $default_domains = array(
		array('domain' => 'http://template1.provezilon.site', 'template_id' => 1), 
		array('domain' => 'http://template2.provezilon.site', 'template_id' => 2),
        array('domain' => 'http://template3.provezilon.site', 'template_id' => 3),
        array('domain' => 'http://template4.provezilon.site', 'template_id' => 4),
    );

    foreach ($default_domains as $domain_entry) {
        // Check if the domain already exists before inserting
        $existing_domain = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM $domain_table_name WHERE domain_name = %s",
            $domain_entry['domain']
        ));

        if (!$existing_domain) {
            $wpdb->insert(
                $domain_table_name,
                array(
                    'domain_name' => $domain_entry['domain'],
                    'template_id' => $domain_entry['template_id'], // Include template ID in insert
                )
            );
        }
    }

    // Set default values for options when the plugin is activated
    $default_options = array(
        'save_data_to_db' => 1,
        'save_data_to_api' => 1,
        'api_url' => 'https://lsapim.azure-api.net/auth-svc/api/',
        'email_verification_url' => 'https://app.lincsell.com/#/pages/signin?',
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

//     $table_name = $wpdb->prefix . 'custom_registration_data';
	$table_name = $wpdb->prefix . 'domain_table';
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
    //   $wpdb->query("DELETE FROM $table_name");
}


// 404 page redirect

function custom_redirect_404_to_elementor_page_permanent() {
    if (is_404()) {
        wp_redirect(home_url('/page-not-found'), 301); 
        exit;
    }
}
add_action('template_redirect', 'custom_redirect_404_to_elementor_page_permanent');