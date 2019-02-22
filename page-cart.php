<?php
/**
 * Template Name: Cart
 *
 * @package xtremetm
 */

get_header();
?>
<?php get_template_part('store-parts/section', 'header-bar'); ?>
<?php
while ( have_posts() ) :
	
	the_post();

	get_template_part( 'template-parts/content', 'cart' );

endwhile; // End of the loop.
?>

<?php
get_footer();
