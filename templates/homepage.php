<?php

/* 
Template name: home 
*/

get_header(); 
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <ul class="products">
            <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => -1
                    );
                $loop = new WP_Query( $args );
                if ( $loop->have_posts() ) {
                    while ( $loop->have_posts() ) : $loop->the_post();
                        wc_get_template_part( 'content', 'product' );
                    endwhile;
                } else {
                    echo __( 'No products found' );
                }
                wp_reset_postdata();
            ?>
        </ul>

    </main><!-- #main -->
</div><!-- #primary -->
	
<?php
get_footer();