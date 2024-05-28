<?php

// Enqueue Font Awesome from CDN
function enqueue_saasy_scripts()
{
    $version = time();

    //FontAwesome
    wp_enqueue_script('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js', array(), null, true);
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css');

    //Mask Library
    wp_enqueue_script('inputmask', 'https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.9/inputmask/inputmask.min.js', array('jquery'), $version, true);

    //BootStrap
    wp_enqueue_style('bootstrap', plugins_url('../bootstrap/css/bootstrap.min.css', __FILE__));
    wp_enqueue_script('bootstrap-js', plugins_url('../bootstrap/js/bootstrap.min.js', __FILE__));
    //Custom Javascript
<<<<<<< HEAD
    wp_enqueue_script('custom-registration-scripts', plugins_url('../js/script.js', __FILE__), array('jquery'), '1.00.2', true);
    wp_enqueue_script('custom-password-scripts', plugins_url('../js/PasswordConfirmation.js', __FILE__), array('jquery'), null, true);
    wp_enqueue_script('personal-form-scripts', plugins_url('../js/PersonalForm.js', __FILE__), array('jquery'), null, true);
    //Custom Css
    wp_enqueue_style('custom-styles', plugin_dir_url(__FILE__) . '../css/style.css');
    wp_enqueue_style('custom-jelly-styles', plugin_dir_url(__FILE__) . '../css/loaderStyle.css');
    wp_enqueue_style('theme-css', plugin_dir_url(__FILE__) . '../css/theme.css');
=======
    wp_enqueue_script('custom-registration-scripts', plugins_url('../js/script.js', __FILE__), array('jquery'), $version, true);
    wp_enqueue_script('custom-password-scripts', plugins_url('../js/PasswordConfirmation.js', __FILE__), array('jquery'), $version, true);
    wp_enqueue_script('personal-form-scripts', plugins_url('../js/PersonalForm.js', __FILE__), array('jquery'), $version, true);
    //Custom Css
    wp_enqueue_style('custom-styles', plugin_dir_url(__FILE__) . '../css/style.css', array(), $version);
    wp_enqueue_style('theme-css', plugin_dir_url(__FILE__) . '../css/theme.css');
    wp_enqueue_style('otp-css', plugin_dir_url(__FILE__) . '../css/otp.css', array(), $version);
>>>>>>> 36f7441ac0c1f73c69d7c9d24e3b12cdbe95048d

    //Enuqueue Toaster library Js
    wp_enqueue_script('toastrJs', 'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js', array('jquery'));
    wp_enqueue_style('toastrCss', 'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css');

}

// Hook the enqueue function into WordPress
add_action('wp_enqueue_scripts', 'enqueue_saasy_scripts');