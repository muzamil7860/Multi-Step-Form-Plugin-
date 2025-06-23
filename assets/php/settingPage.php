<?php

function custom_settings_page()
{
    ?>


<div class="wrap">
    <img style="width:160px; margin-top:10px;" src="<?php echo plugins_url('../images/logo.svg', __FILE__); ?>" alt="">
    <h1
        style="color:black; word-spacing:3px;font-size:23px;border:1px solid #00000033; padding:5px; width:230px; margin-top:20px; margin-bottom:30px; font-weight:700;">
        <span style="color:#F95629;">Lincsell</span>
        Settings
    </h1>
    <form id="ajax_form" method="post" action="options.php">
        <?php
settings_fields('custom_settings_group');
    do_settings_sections('custom_settings_page');
    submit_button();
    ?>
    </form>
</div>

<?php
}

function custom_settings_page_init()
{

    register_setting(
        'custom_settings_group', // Option group
        'custom_settings', // Option name
        'sanitize_callback' // Sanitize callback function
    );

    add_settings_section(
        'section_one', // ID
        'Lincsell Data Mode', // Title
        'section_one_callback', // Callback function
        'custom_settings_page' // Page
    );

    add_settings_field(
        'save_data_to_db', // ID
        'Save Data to Database', // Title
        'save_data_to_db_callback', // Callback function
        'custom_settings_page', // Page
        'section_one' // Section
    );

    add_settings_field(
        'save_data_to_api', // ID
        'Save Data to API', // Title
        'save_data_to_api_callback', // Callback function
        'custom_settings_page', // Page
        'section_one' // Section
    );

    add_settings_section(
        'section_two', // ID
        'Lincsell API URL ( Production or Development )', // Title
        'section_two_callback', // Callback function
        'custom_settings_page' // Page
    );

    add_settings_field(
        'api_url', // ID
        'API URL', // Title
        'api_url_callback', // Callback function
        'custom_settings_page', // Page
        'section_two' // Section
    );

    add_settings_section(
        'section_three', // ID
        'Redirect Page URL On Success :', // Title
        'section_three_callback', // Callback function
        'custom_settings_page' // Page
    );

    add_settings_field(
        'email_verification_url', // ID
        'Redirect Page URL', // Title
        'email_verification_url_callback', // Callback function
        'custom_settings_page', // Page
        'section_three' // Section
    );
}

function section_one_callback()
{
    echo '<p>Choose where to save data:</p>';
}

function save_data_to_db_callback()
{
    $options = get_option('custom_settings', ['save_data_to_db' => 1]);
    $save_data_to_db = isset($options['save_data_to_db']) ? $options['save_data_to_db'] : 0;
    echo '<input type="checkbox" id="save_data_to_db" name="custom_settings[save_data_to_db]"  value="1" ' . checked(1, $save_data_to_db, false) . ' />';
}

function save_data_to_api_callback()
{
    $options = get_option('custom_settings', ['save_data_to_api' => 1]);
    $save_data_to_api = isset($options['save_data_to_api']) ? $options['save_data_to_api'] : 0;
    echo '<input type="checkbox" id="save_data_to_api" name="custom_settings[save_data_to_api]" value="1" ' . checked(1, $save_data_to_api, false) . ' />';
    //echo '<input type="checkbox" id="save_data_to_api" name="custom_settings[save_data_to_api]" disabled checked />';

}
function section_two_callback()
{
    echo '<p>Enter API URL:</p>';
}

function api_url_callback()
{
    $options = get_option('custom_settings', ['api_url' => 'https://connect360-stg.azure-api.net/auth-svc/api/']);
    $api_url = isset($options['api_url']) ? esc_attr($options['api_url']) : '';
    echo '<input type="text" style="width: 50%;
    height: 30px;" id="api_url" name="custom_settings[api_url]" value="' . $api_url . '" />';
}

function section_three_callback()
{
    // echo '<p>Enter Redirect Page URL On Success :</p>';
}

function email_verification_url_callback()
{
    $options = get_option('custom_settings', ['email_verification_url' => '']);
    $email_verification_url = isset($options['email_verification_url']) ? esc_attr($options['email_verification_url']) : '';
    echo '<input type="text" style="width: 50%; height: 30px;" id="email_verification_url" name="custom_settings[email_verification_url]" value="' . $email_verification_url . '" />';
}

function sanitize_callback($options)
{
    // Sanitize input data as needed
    return $options;
}

add_action('admin_menu', function () {
    add_menu_page(
        'Lincsell Setting', // Page title
        'Lincsell Setting', // Menu title
        'manage_options', // Capability
        'custom_settings_page', // Menu slug
        'custom_settings_page' // Callback function
    );

    add_action('admin_init', 'custom_settings_page_init');
});

//Enqueueing Ajax Js File in Admin panel

// Retrieve the serialized option value
$serialized_value = get_option('custom_settings');

// Unserialize the value
$unserialized_value = maybe_unserialize($serialized_value);

// Output the unserialized value
//echo '<pre style="margin-left:500px; margin-top:500px;">';
//var_dump($unserialized_value);
//echo '</pre>';

// Fetch API URL from options table
//$options = get_option('custom_settings');
//$api_url = isset($options['api_url']) ? esc_url($options['api_url']) : '';

//var_dump($api_url);

//$full = $api_url . "IsUserExist";
//var_dump($full);

// -------------------------------------------------------------------------------------
// Admin Menu & Page
add_action('admin_menu', 'custom_dashboard_table_menu');

function custom_dashboard_table_menu()
{
    $icon_url = 'dashicons-admin-users'; // Replace with your chosen Dashicon

    add_menu_page(
        'Lincsell Database',
        'Lincsell Database',
        'manage_options',
        'custom-registration-data',
        'custom_registration_data_page',
        $icon_url
    );
}

function custom_registration_data_page()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'custom_registration_data';
    $data = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);

    echo '<div class="wrap">';
    echo '<h2>Saasy User Db</h2>';
    echo '<style>
            .wp-list-table {
                border-collapse: collapse;
                width: 100%;
                margin-top: 20px;
            }
            .wp-list-table thead th {
                background-color: #f7f7f7;
                border: 1px solid #e3e3e3;
                padding: 10px;
                text-align: left;
            }
            .wp-list-table tbody td {
                border: 1px solid #e3e3e3;
                padding: 10px;
            }
        </style>';
    echo '<table class="wp-list-table widefat fixed striped">';
    echo '<thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone Number</th><th>Password</th><th>Terms and Conditions</th><th>Saasy User ID</th><th>Business Name</th><th>Business Info Choice</th><th>Business ID</th><th>Coupon Code</th><th>Referer</th><th>Cust Tracking ID</th><th>CuId</th><th>Verification Status</th><th>Platform</th><th>Reg Domain</th><th>Registration Time</th></tr></thead>';
    echo '<tbody>';
    foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . esc_html($row['id']) . '</td>';
        echo '<td>' . esc_html($row['first_name']) . '</td>';
        echo '<td>' . esc_html($row['last_name']) . '</td>';
        echo '<td>' . esc_html($row['email']) . '</td>';
        echo '<td>' . esc_html($row['phone_number']) . '</td>';
        echo '<td>' . esc_html($row['password']) . '</td>';
        echo '<td>' . ($row['terms_and_conditions'] ? 'Yes' : 'No') . '</td>';
        echo '<td>' . esc_html($row['saasy_user_id']) . '</td>';
        echo '<td>' . esc_html($row['business_name']) . '</td>';
        echo '<td>' . esc_html($row['business_info_choice']) . '</td>';
        echo '<td>' . esc_html($row['business_id']) . '</td>';
        echo '<td>' . esc_html($row['CouponCode']) . '</td>';
        echo '<td>' . esc_html($row['Referer']) . '</td>';
        echo '<td>' . esc_html($row['CustTrackingId']) . '</td>';
        echo '<td>' . esc_html($row['CuId']) . '</td>';
        echo '<td>' . ($row['verification_status'] ? 'Verified' : 'Not Verified') . '</td>';
        echo '<td>' . esc_html($row['platform']) . '</td>';
        echo '<td>' . esc_html($row['register']) . '</td>';
        echo '<td>' . esc_html($row['registration_time']) . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';

    /*
    // Display the domain_table with the email column
    $domain_table_name = $wpdb->prefix . 'domain_table';
    $domain_data = $wpdb->get_results("SELECT * FROM $domain_table_name", ARRAY_A);

    echo '<h2 style="margin-top: 40px;">Domain Table</h2>';
    echo '<table class="wp-list-table widefat fixed striped">';
    echo '<thead><tr><th>ID</th><th>Domain Name</th><th>Email</th><th>Status</th><th>User Name</th><th>Password</th><th>User ID</th><th>Business ID</th><th>Location</th></tr></thead>';
    echo '<tbody>';
    foreach ($domain_data as $row) {
    echo '<tr>';
    echo '<td>' . esc_html($row['id']) . '</td>';
    echo '<td>' . esc_html($row['domain_name']) . '</td>';
    echo '<td>' . esc_html($row['email']) . '</td>';
    echo '<td>' . ($row['status'] ? 'True' : 'False') . '</td>';
    echo '<td>' . esc_html($row['user_name']) . '</td>';
    echo '<td>' . esc_html($row['password']) . '</td>';
    echo '<td>' . esc_html($row['user_id_domain']) . '</td>';
    echo '<td>' . esc_html($row['business_id']) . '</td>';
    echo '<td>' . esc_html($row['location']) . '</td>';
    echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
     */

    // Display the domain_table with the email and template_id columns
    $domain_table_name = $wpdb->prefix . 'domain_table';
    $domain_data = $wpdb->get_results("SELECT * FROM $domain_table_name", ARRAY_A);

    echo '<h2 style="margin-top: 40px;">Domain Table</h2>';
    echo '<table class="wp-list-table widefat fixed striped">';
    echo '<thead><tr>
        <th>ID</th>
        <th>Domain Name</th>
        <th>Email</th>
        <th>Status</th>
        <th>User Name</th>
        <th>Password</th>
        <th>User ID</th>
        <th>Business ID</th>
        <th>Location</th>
        <th>Template ID</th>
      </tr></thead>';
    echo '<tbody>';
    foreach ($domain_data as $row) {
        echo '<tr>';
        echo '<td>' . esc_html($row['id']) . '</td>';
        echo '<td>' . esc_html($row['domain_name']) . '</td>';
        echo '<td>' . esc_html($row['email']) . '</td>';
        echo '<td>' . ($row['status'] ? 'True' : 'False') . '</td>';
        echo '<td>' . esc_html($row['user_name']) . '</td>';
        echo '<td>' . esc_html($row['password']) . '</td>';
        echo '<td>' . esc_html($row['user_id_domain']) . '</td>';
        echo '<td>' . esc_html($row['business_id']) . '</td>';
        echo '<td>' . esc_html($row['location']) . '</td>';
        echo '<td>' . esc_html($row['template_id']) . '</td>'; // Added Template ID column
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';

}


?>