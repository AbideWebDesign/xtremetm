<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package xtremetm
 */

get_header();
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div id="global-store-container">
		<div class="container text-center py-4 text-center">
								
			<h1 class="text-primary mb-2">Page Not Found</h1>
			<p class="lead">The page you are looking for does not exist.</p>
			<a href="<?php echo home_url(); ?>" class="btn btn-primary"><span>Return Home</span></a>

		</div>
	</div>
</div>


<?php
get_footer();
