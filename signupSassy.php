<?php
/*
Plugin Name: Custom Registration Plugin
Description: A simple plugin to create a multi-step registration form and store data in a custom table.
Version: 1.0
Author: Your Name
*/

// Activation and Deactivation Hooks
register_activation_hook(__FILE__, 'custom_registration_plugin_activate');
register_deactivation_hook(__FILE__, 'custom_registration_plugin_deactivate');

function custom_registration_plugin_activate() {
    // Create custom table on activation
    global $wpdb;

    $table_name = $wpdb->prefix . 'custom_registration_data';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        first_name varchar(50) NOT NULL,
        last_name varchar(50) NOT NULL,
        email varchar(100) NOT NULL,
        phone_number varchar(20) NOT NULL,
        password varchar(255) NOT NULL,
        terms_and_conditions tinyint(1) NOT NULL,
        business_name varchar(100),
        business_address varchar(255),
        business_phone varchar(20),
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

function custom_registration_plugin_deactivate() {
    // Delete custom table on deactivation
    global $wpdb;

    $table_name = $wpdb->prefix . 'custom_registration_data';
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
}


// Enqueue Font Awesome from CDN
function enqueue_font_awesome() {
    wp_enqueue_script('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js', array(), null, true);
}

// Hook the enqueue function into WordPress
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');


// Enqueue Bootstrap
function custom_registration_enqueue_scripts() {
   wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
   wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery'), '', true);
}

add_action('wp_enqueue_scripts', 'custom_registration_enqueue_scripts');

// Shortcode to display the multi-step registration form
function custom_registration_form_shortcode() {
    ob_start();
    ?>

<form id="custom-registration-form" action="" method="post">
    <!-- Step 1: Personal Information -->
    <div class="form-step" id="step-1">
        <h2>Step 1: Personal Information</h2>
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="tel" class="form-control" id="phone_number" name="phone_number" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="terms_and_conditions" name="terms_and_conditions"
                required>
            <label class="form-check-label" for="terms_and_conditions">I agree to the Terms and
                Conditions</label>
        </div>
        <button class="btn btn-primary" type="button" onclick="nextStep()">Next</button>
    </div>

    <!-- Step 2: Business Information -->
    <div class="form-step" id="step-2" style="display: none;">
        <h2>Step 2: Business Information</h2>
        <div class="form-group">
            <label for="business_name">Business Name:</label>
            <input type="text" class="form-control" id="business_name" name="business_name">
        </div>
        <div class="form-group">
            <label for="business_address">Business Address:</label>
            <input type="text" class="form-control" id="business_address" name="business_address">
        </div>
        <div class="form-group">
            <label for="business_phone">Business Phone:</label>
            <input type="tel" class="form-control" id="business_phone" name="business_phone">
        </div>
        <button class="btn btn-primary" type="button" onclick="prevStep()">Previous</button>
        <button class="btn btn-primary" id=submit-form onclick="emailStep()" type="submit">Submit</button>
    </div>
</form>


<script>
function nextStep() {


    jQuery('#step-1').hide();
    jQuery('#step-2').show();
}

function prevStep() {

    jQuery('#step-2').hide();

    jQuery('#step-1').show();
}

function emailStep() {
    jQuery('#submit-form').show()
    jQuery('#custom-registration-form').hide()
}
</script>
<style>

</style>
<?php
    return ob_get_clean();
}

add_shortcode('custom_registration_form', 'custom_registration_form_shortcode');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['first_name'])) {
    custom_registration_handle_form();
}

function custom_registration_handle_form() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'custom_registration_data';
    $email = sanitize_email($_POST['email']); // Get the email value
    // Store the email value in the options table
    update_option('registration_email', $email);


    // Store the email value in a session variable
    //session_start();
    if (!session_id()) {
        session_start();
    }
    $_SESSION['registration_email'] = $email;
    print_r($_SESSION['registration_email']);
    $wpdb->insert(
        $table_name,
        array(
            'first_name' => sanitize_text_field($_POST['first_name']),
            'last_name' => sanitize_text_field($_POST['last_name']),
            'email' => sanitize_email($_POST['email']),
            'phone_number' => sanitize_text_field($_POST['phone_number']),
            'password' => sanitize_text_field($_POST['password']),
            'terms_and_conditions' => isset($_POST['terms_and_conditions']) ? 1 : 0,
            'business_name' => sanitize_text_field($_POST['business_name']),
            'business_address' => sanitize_text_field($_POST['business_address']),
            'business_phone' => sanitize_text_field($_POST['business_phone']),
        )
    );
    // Send email
    $to = $_POST['email']; // Use the provided email from the form
    $subject = 'Registration Confirmation';
    $message = 'Thank you for registering!'; // You can customize the email message
    wp_mail($to, $subject, $message);
}


// -------------Email Verification Pageshortcode------------------------------------------------


function custom_email_form_shortcode() {

    ob_start();
    // $email = isset($_SESSION['registration_email']) ? $_SESSION['registration_email'] : '';
    $email = get_option('registration_email', '');
    ?>
<div class="email-verification">
    <h1>Verification</h1>
    <p>Account verification via Email</p>
    <h2>Verify Your Email Address</h2>
    <p>We have sent an account verification email <?php echo $email;?> to verify your email
        and activate your account. If you
        don’t see it, please check your spam/junk folder. </p>
    <p>Didn t receive the verification code?</p>
    <button class="btn btn-primary">Submit</button>
</div>

<?php
    return ob_get_clean();
}

add_shortcode('custom_email_form', 'custom_email_form_shortcode');