<?php
/**
 * Template Name: Checkout
 *
 * @package xtremetm
 */

get_header();

while ( have_posts() ) :
	
	the_post();

	get_template_part( 'template-parts/content', 'checkout' );

endwhile; // End of the loop.

get_footer();
