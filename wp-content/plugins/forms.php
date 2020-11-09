<?php 

/*
Plugin Name: News Corps Form
Description: This is a plug for form submit.
Author: Luis Youn
Version: 1.0.0
*/

function ajax_form_enqueuescripts() {
    wp_enqueue_script( 'ajaxloadpost', plugins_url().'/forms/js/form-ajax.js', array('jquery'));
    wp_localize_script( 'ajaxloadpost', 'ajax_postajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action('wp_enqueue_scripts', ajax_form_enqueuescripts);

function my_action_form_callback(){  
    echo json_encode([
        "companyName" => $_POST["companyName"],
        "phoneNumber" => $_POST["phoneNumber"],
    ]);
    die;
}
add_action('wp_ajax_nopriv_ajax_posthandler', 'my_action_form_callback' );
add_action('wp_ajax_ajax_posthandler', 'my_action_form_callback' );