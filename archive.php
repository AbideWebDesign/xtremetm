<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package xtremetm
 */

get_header();
?>

<?php if ( have_posts() ) : ?>

	<?php
	/* Start the Loop */
	while ( have_posts() ) :
		
		the_post();

	endwhile;

	the_posts_navigation();

else :

	get_template_part( 'template-parts/content', 'none' );

endif;
?>

<?php
get_footer();
