<?php

// save post fix
add_action('save_post', function($id) {
    if(isset($_POST['tw_product_type_val']) ) {
        update_post_meta( $id, 'tw_product_type', strip_tags($_POST['tw_product_type_val']) );
    }
    if(isset($_POST['tw_alt_image_id']) ) {
        update_post_meta( $id, 'tw_alt_image', strip_tags($_POST['tw_alt_image_id']) );
    }
    if(isset($_POST['tw_creation_date']) ) {
        update_post_meta( $id, 'tw_creation_date', strip_tags($_POST['tw_creation_date']) );
    }
});


//utility filter for default date display
function tw_filter_publish_dates( $the_date, $d, $post ) {
    if ( is_int( $post) ) {
        $post_id = $post;
    } else {
        $post_id = $post->ID;
    } 
    if ( 'product' != get_post_type( $post_id ) ){
        return $the_date;
    }
    
    return date( 'm-d-Y', strtotime( $the_date ) );
}
add_action( 'get_the_date', 'tw_filter_publish_dates', 10, 3 ); 

