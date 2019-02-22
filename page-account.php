<?php
/**
 * Template Name: Account
 *
 * @package xtremetm
 */

get_header();
?>
<?php get_template_part('store-parts/section', 'header-bar'); ?>
<?php
while ( have_posts() ) :
	
	the_post();

	get_template_part( 'template-parts/content', 'account' );

endwhile; // End of the loop.
?>

<?php
get_footer();
