<?php 

function wpb_adding_scripts() {
    wp_register_script('form_react_script', get_template_directory_uri() . '/dist/main.js', array(), '1.0', true);
    wp_enqueue_script('form_react_script');
} 

add_action( 'wp_enqueue_scripts', 'wpb_adding_scripts', 999 ); 