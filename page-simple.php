<?php
/**
 * Template Name: Simple
 *
 * @package xtremetm
 */

get_header();
?>

<?php
while ( have_posts() ) :
	
	the_post();

	get_template_part( 'template-parts/content', 'simple-page' );

endwhile; // End of the loop.
?>

<?php
get_footer();
