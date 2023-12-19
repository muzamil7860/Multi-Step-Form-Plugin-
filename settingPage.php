<?php

function custom_settings_page()
{
    ?>


<div class="wrap">
    <img style="width:160px; margin-top:10px;" src="<?php echo plugins_url('./assets/images/logo.png', __FILE__); ?>"
        alt="">
    <h1
        style="color:#171046; word-spacing:3px;font-size:23px;border:1px solid #00000033; padding:5px; width:230px; margin-top:20px; margin-bottom:30px; font-weight:700;">
        <span style="color:#23DC32;">Saasy POS</span>
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
        'Sassy POS Data Mode', // Title
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
        'Sassy POS API URL ( Production or Development )', // Title
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
        'Email Verification Page URL', // Title
        'section_three_callback', // Callback function
        'custom_settings_page' // Page
    );

    add_settings_field(
        'email_verification_url', // ID
        'Email Verification URL', // Title
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
    echo '<p>Enter Email Verification Page URL:</p>';
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
        'Saasy POS', // Page title
        'Saasy POS', // Menu title
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

?>