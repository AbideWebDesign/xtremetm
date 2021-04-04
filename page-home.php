<?php
/**
 * Template Name: Home
 *
 * @package xtremetm
 */

get_header();

?>

<?php get_template_part( 'store-parts/hero', 'banner' ); ?>

<?php get_template_part('store-parts/section', 'series-bar'); ?>

<div id="section-series" class="py-4">
	
	<div class="container">
		
		<div class="row">
			
			<div class="col-12 text-center">
				
				<h1 class="h1-lg mb-3"><?php the_field('series_section_title'); ?></h1>
				
			</div>
			
		</div>
		
		<div class="row justify-content-center">
			
			<?php while ( have_rows('series') ): the_row(); ?>
			
				<?php $series_bg_src = wp_get_attachment_image_src( get_sub_field('series_image'), 'col-7', false ); ?>
				
				<div class="col-md-6 col-lg-3">
					
					<div class="bg-tire s">
					
						<a href="<?php the_sub_field('series_link'); ?>">
											
							<h2 class="text-white text-center pt-2"><?php the_sub_field('series_name'); ?></h2>
							
							<div class="bg-overlay"></div>
							
							<div class="bg-img d-flex px-1">
								
								<img src="<?php echo $series_bg_src[0]; ?>">
					
							</div>
						
						</a>
				
					</div>	

				</div>
			
			<?php endwhile; ?>
			
		</div>
		
	</div>
	
</div>

<?php get_template_part( 'store-parts/section', 'tire-links' ); ?>

<?php get_footer(); ?>