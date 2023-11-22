<?php

/*
Plugin Name: Sassy Pro SignUp
Description: Sassy Pro Signup System For Signing up .
Version: 1.0.0
Author: Zilon Solutions
*/


// Adding File of Plugin Activation / Deactivation 
require_once plugin_dir_path(__FILE__) . 'activeDeactive.php';

// Adding File of Enqueue Third Party Scripts and Styling
require_once plugin_dir_path(__FILE__) . 'EnqueueFile.php';

// Adding File of Signup Html and Handling Php Function
require_once plugin_dir_path(__FILE__) . 'signupMultistepForm.php';

// Adding File of Email Verification Page System
require_once plugin_dir_path(__FILE__) . 'EmailVerification.php';