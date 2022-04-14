<?php

/**
 * Custom metabox for product edit page
 */


//register metabox
function tw_add_custom_box() {
    add_meta_box(
        'tw_custom_box',       
        'Custom fields',       
        'tw_custom_box_html',  
        'product'              
    );
}
add_action( 'add_meta_boxes', 'tw_add_custom_box' );

//callback
function tw_custom_box_html( $post ) {  

    //load scripts    
    wp_enqueue_media();  
    wp_enqueue_script( 'tw-edit-product');
 
    //get values
    $tw_alt_image = get_post_meta($post->ID, 'tw_alt_image', true);   
    $tw_creation_date = get_post_meta($post->ID, 'tw_creation_date', true);
    $tw_product_type = get_post_meta($post->ID, 'tw_product_type', true);

    $upload_link = esc_url( get_upload_iframe_src( 'image', $post->ID ) );    
    $tw_img_src = wp_get_attachment_image_src( $tw_alt_image, 'full' );
    $you_have_img = is_array( $tw_img_src );
    ?>   

    <div class="tw-form">        
        <?php wp_nonce_field( 'tw_nonce_action', 'tw_update_nonce' ); ?>          
        <input type="hidden" id="tw_postid" name="tw_postid" value="<?php echo $post->ID; ?>" />         
        <input type="hidden" id="tw_product_type_val" name="tw_product_type_val" value="<?php echo $tw_product_type; ?>" /> 
        <input type="hidden" id="tw_alt_image_id" name="tw_alt_image_id"  value="<?php echo esc_attr( $tw_alt_image ); ?>" />

        <div class="tw-form__row">
            <div class="tw-form__img-container">
                <?php if ( $you_have_img ) : ?>
                    <img src="<?php echo $tw_img_src[0] ?>" alt=""  />
                <?php endif; ?>
            </div>            
            <p class="tw-form__img-btn">
                <a class="upload-custom-img <?php if ( $you_have_img  ) { echo 'hidden'; } ?>" 
                href="<?php echo $upload_link ?>">
                    <?php _e('Set custom image') ?>
                </a>
                <a class="delete-custom-img <?php if ( !$you_have_img  ) { echo 'hidden'; } ?>" 
                href="#">
                    <?php _e('Remove this image') ?>
                </a>
            </p>
        </div>

        <div class="tw-form__row">
            <label for="tw_creation_date">Published on</label>         
            <input 
                type="date" 
                id="tw_creation_date" 
                name="tw_creation_date" 
                class="postbox tw-form__postbox"
                value="<?php echo $tw_creation_date; ?>"
            >
        </div>

        <div class="tw-form__row">
            <label for="tw_product_type">Product type</label>
            <select name="tw_product_type" id="tw_product_type" class="postbox tw-form__postbox">
                <option value="">...</option>
                <option value="rare">rare</option>
                <option value="frequent">frequent</option>
                <option value="unusual">unusual</option>
            </select>
        </div>

        <div class="tw-form__row w-100">
            <button id="tw_update" class="button button-primary tw-form__button">Update</button>
            <div id="tw_reset" class="button tw-form__button">Reset</div>
        </div>
    </div>  
    
    <?php
}

?>
