<?php
// Activation and Deactivation Hooks
register_activation_hook(__FILE__, 'custom_registration_plugin_activate');
register_deactivation_hook(__FILE__, 'custom_registration_plugin_deactivate');

function custom_registration_plugin_activate()
{
    // Create custom table on activation
    global $wpdb;

    $table_name = $wpdb->prefix . 'custom_registration_data';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        first_name varchar(50) NOT NULL,
        last_name varchar(50) NOT NULL,
        email varchar(100) NOT NULL UNIQUE,
        phone_number varchar(20) NOT NULL,
        password varchar(255) NOT NULL,
        terms_and_conditions tinyint(1) NOT NULL,
        business_name varchar(100),
        business_info_choice varchar(50),
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}

function custom_registration_plugin_deactivate()
{
    // Delete custom table on deactivation
    global $wpdb;

    $table_name = $wpdb->prefix . 'custom_registration_data';
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
}
