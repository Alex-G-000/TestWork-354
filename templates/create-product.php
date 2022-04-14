<?php

/* 
Template name: create product 
*/

get_header(); 
wp_enqueue_script( 'tw-custom-scripts');
wp_enqueue_media();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) :
			the_post();
			do_action( 'storefront_page_before' );
                ?>

                <div class="tw-form-wrapper">

                    <form class="tw-form">
			<?php wp_nonce_field( 'tw_create_nonce_action', 'tw_create_nonce' ); ?> 
			<input type="hidden" id="tw_product_type_val" name="tw_product_type_val"  value="" />
			<input type="hidden" id="tw_alt_image_id" name="tw_alt_image_id"  value="" />

			<h2 class="w-100">Create product</h2>

			<div class="tw-input-group">
				<label for="tw_product_name">Name</label>
				<input type="text" name="tw_product_name" id="tw_product_name" required>
			</div>

			<div class="tw-input-group">
				<label for="tw_product_price">Price</label>							
				<input type="number" name="tw_product_price" id="tw_product_price" required>
			</div>

			<div class="tw-input-group">
				<label for="tw_product_type">Type</label>
				<select name="tw_product_type" id="tw_product_type">
					<option value="">...</option>
					<option value="rare">rare</option>
					<option value="frequent">frequent</option>
					<option value="unusual">unusual</option>
				</select>
			</div>

			<div class="tw-input-group">
				<label for="tw_creation_date">Date</label>
				<input type="date" name="tw_creation_date" id="tw_creation_date" required>
			</div>

			<div class="tw-input-group tw-image">							
				<div class="tw-form__img-container"></div>
				<div class="tw-form__btn-container">
					<a href="#" class="tw-input tw-image-input">Add image</a>
					<a href="#" class="tw-input tw-image-delete">Remove image</a>
				</div>
			</div>

			<div class="tw-input-group w-100">
				<button id="submit-product" class="button button-primary">Create</button>
			</div>

		</form>

		<div class="tw-overlay">
			<div class="tw-overlay-inner">
				<h4>Product created</h4>
				<button id="tw-overlay-close">Create one more</button>
			</div>
		</div>

                </div>
				
                <?php do_action( 'storefront_page_after' ); ?>
		<?php endwhile; ?>			

		</main><!-- #main -->
	</div><!-- #primary -->
	
<?php
do_action( 'storefront_sidebar' );
get_footer();
