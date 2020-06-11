<?php
/**
 * Template part for displaying page content in page-simple.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package xtremetm
 */

?>
<?php get_template_part('store-parts/section', 'header-bar'); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div id="global-store-container">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9">
					<div class="bg-white p-3 mt-2 mb-2 text-center">
						<h2 class="text-center mb-2"><?php the_title(); ?></h2>
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
