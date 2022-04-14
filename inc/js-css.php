<?php

//front end js-css
function tw_register_scripts() {    
	wp_register_script( 'tw-custom-scripts', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), null, false);
    wp_localize_script( 'tw-custom-scripts', 'the_ajax_script', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );	
    wp_enqueue_style( 'tw-styles', get_stylesheet_directory_uri() . '/assets/css/styles.css', array() );
}
add_action( 'wp_enqueue_scripts', 'tw_register_scripts' );


//admin js-css
function tw_register_admin_scripts( $hook_suffix ) {
    wp_register_script( 'tw-edit-product', get_stylesheet_directory_uri() . '/assets/js/edit-product.js', array('jquery'), null, false);
    wp_enqueue_style( 'tw-admin-styles', get_stylesheet_directory_uri() . '/assets/css/admin-styles.css', array() );      
}
add_action('admin_enqueue_scripts', 'tw_register_admin_scripts');
