<?php 

/*
Plugin Name: News Corps Logos
Description: This is to provide the logo's JSON.
Author: Luis Youn
Version: 1.0.0
*/

function ajax_enqueuescripts() {
    wp_enqueue_script('ajaxloadpost', plugins_url().'/logos/js/my-ajax.js', array('jquery'));
    wp_localize_script( 'ajaxloadpost', 'ajax_logosajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action('wp_enqueue_scripts', ajax_enqueuescripts);

function my_action_callback(){  
    echo json_encode([
        'upper' => [
            '/wp-content/themes/empty/images/courier_mail_icon.png',
            '/wp-content/themes/empty/images/dailytelegraph_icon.png',
            '/wp-content/themes/empty/images/herald_sun_icon.png',
            '/wp-content/themes/empty/images/mercury_icon.png'
        ],
        'lower' => [
            '/wp-content/themes/empty/images/ntnews_icon.png',
            '/wp-content/themes/empty/images/the_advertiser_icon.png',
            '/wp-content/themes/empty/images/theaus_icon.png',
            '/wp-content/themes/empty/images/wall_street_journal_icon.png'
        ],
    ]);
    die;
}
add_action('wp_ajax_nopriv_ajax_ajaxhandler', 'my_action_callback' );
add_action('wp_ajax_ajax_ajaxhandler', 'my_action_callback' );
