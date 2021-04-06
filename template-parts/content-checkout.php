<?php
/**
 * Template part for displaying page content for shopping cart
 *
 * @package xtrememtm
 */

?>

<?php get_template_part('store-parts/section', 'series-bar'); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div id="global-store-container">
	
		<div class="container">
			
			<div class="row">
			
				<div class="col">
					
					<h1 class="mb-2"><?php _e('Checkout'); ?></h1>
					
				</div>
				
			</div>
			
			<div class="box s p-1 p-lg-2">
	
				<div class="entry-content">
	
					<?php the_content(); ?>
			
				</div><!-- .entry-content -->
	
			</div>
	
		</div>

	</div>

</div>