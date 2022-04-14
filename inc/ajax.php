<?php

/**
 * Ajax action for creating new product
 */
function tw_creaete_product_frontend() {
    
    $name =  isset( $_POST['name'] ) ? $_POST['name'] : false;
    $price =  isset( $_POST['price'] ) ? $_POST['price'] : false;
    $date =  isset( $_POST['date'] ) ? $_POST['date'] : false;
    $prodtype =  isset( $_POST['prodtype'] ) ? $_POST['prodtype'] : false;
    $image =  isset( $_POST['image'] ) ? $_POST['image'] : false;

    if ( isset( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], 'tw_create_nonce_action' ) ) {        
        $post_id = wp_insert_post( array( 
                'post_title' => $name,
				'post_type' => 'product',
				'post_status' => 'publish'
			)
		);
        update_post_meta( $post_id, 'tw_creation_date', $date );
        update_post_meta( $post_id, 'tw_product_type', $prodtype );
        update_post_meta( $post_id, 'tw_alt_image', $image );
        wp_set_object_terms( $post_id, 'simple', 'product_type' );
		update_post_meta( $post_id, '_visibility', 'visible' );
		update_post_meta( $post_id, '_stock_status', 'instock' );
		update_post_meta( $post_id, '_price', $price );
		update_post_meta( $post_id, '_regular_price', $price );		
        update_post_meta( $post_id, '_thumbnail_id', $image );	

    } else {       
        wp_die('nonce error');
    }    
 
    wp_die('created');
}  
add_action('wp_ajax_nopriv_tw_creaete_product', 'tw_creaete_product_frontend');
add_action('wp_ajax_tw_creaete_product', 'tw_creaete_product_frontend');



/**
 * Ajax action for clearing custom fields (edit page)
 */
function tw_reset_custom_meta() { 
    $postid =  isset( $_POST['postid'] ) ? $_POST['postid'] : false;    
    if ( !current_user_can('edit_posts', $postid) || !$postid ) die();
    if ( isset( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], 'tw_nonce_action' ) ) {
        delete_post_meta( $postid, 'tw_alt_image', '' );
        delete_post_meta( $postid, 'tw_creation_date', '' );
        delete_post_meta( $postid, 'tw_product_type', '' );   
    } else {       
        wp_die('nonce error');
    }   
    
    wp_die('reseted');
}  
add_action('wp_ajax_tw_reset_product_custom_meta', 'tw_reset_custom_meta');