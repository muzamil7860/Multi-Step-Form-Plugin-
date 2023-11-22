<?php

// Enqueue Font Awesome from CDN
function enqueue_font_awesome() {
     
     //FontAwesome
      wp_enqueue_script('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js', array(), null, true);
      wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css');

     //Mask Library 
      wp_enqueue_script('inputmask', 'https://cdnjs.cloudflare.com/ajax/libs/inputmask/4.0.9/inputmask/inputmask.min.js', array('jquery'), null, true);
     
     //BootStrap
      wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
      wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery'), '', true);

     //Custom Javascript
      wp_enqueue_script('custom-registration-scripts', plugins_url('script.js', __FILE__), array('jquery'), null, true);

     //Custom Css
      wp_enqueue_style('custom-styles', plugin_dir_url(__FILE__) . 'style.css');



}

// Hook the enqueue function into WordPress
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');