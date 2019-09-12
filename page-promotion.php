<?php
/**
 * Template Name: Promotion
 *
 * @package xtremetm
 */

get_header();
?>
<div id="section-hero-banner" class="store-rehv carousel slide" data-ride="carousel">
	<div class="carousel-inner h-100">
	
		<?php while ( have_rows('banners') ): the_row(); ?>
	
			<?php $bg_img = wp_get_attachment_image_src(get_sub_field('hero_banner_image'), 'hero banner', false); ?>
	
				<div class="carousel-item h-100 text-center bg-img <?php echo ($count==0 ? 'active' : ''); ?>" style="background-image: url('<?php echo $bg_img[0]; ?>')">
					<div class="bg-overlay"></div>
					<div class="bg-img-content text-center d-flex flex-column h-100 align-content-center justify-content-center">
						<h1 class="text-white mb-1"><?php the_sub_field('hero_banner_title'); ?></h1>
						<h4 class="mb-2 text-white"><?php the_sub_field('header_banner_sub_title'); ?></h4>
						
						<?php if (get_sub_field('add_button')): ?>
						
							<a href="<?php the_sub_field('hero_banner_button_link'); ?>" target="_blank" class="btn btn-primary btn-rehv btn-lg"><span><?php the_sub_field('hero_banner_button_label'); ?> <i class="fas fa-chevron-right ml-1"></i></span></a>
						
						<?php endif; ?>
				
					</div>
				</div>
	
			<?php $count = 1; ?>
			
		<?php endwhile; ?>
	
	</div>
</div>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div id="global-store-container">
		<div class="container">
			<div class="box s p-1 p-lg-2">
				<div class="row">
					<div class="col-12 text-center">
						<h1 class="mb-3"><?php the_field('section_title'); ?></h1>
					</div>
				</div>
				<div class="row justify-content-center">
					
					<?php while ( have_rows('steps') ): the_row(); ?>
					
						<div class="col-lg-4 mb-2 mb-lg-0">
							<div class="bg-light h-100">
								<div class="bg-rehv p-1">
									<h2 class="mb-0 text-center"><?php the_sub_field('step_number'); ?></h2>
								</div>
								<div class="p-2">
									<h3 class="mb-1"><?php the_sub_field('step_title'); ?></h3>
									<?php the_sub_field('step_content'); ?>
								</div>
							</div>
						</div>
					
					<?php endwhile; ?>
					
				</div>
			</div>
		</div>
	</div>
	<div id="section-footer-top" class="py-3">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-3 text-center text-lg-left mb-2 mb-lg-0">
					<a href="<?php the_field('footer_top_button_link'); ?>" <?php echo ( get_field('footer_top_link_type') ? 'target="_blank"' : '' ); ?>>
						<?php echo wp_get_attachment_image(get_field('footer_top_logo'), 'col-3', false, array('class'=>'img-fluid')); ?>
					</a>
				</div>
				<div class="col-lg-7 mb-2 mb-lg-0">
					<h3 class="mb-0"><?php the_field('footer_top_description'); ?></h3>
				</div>
				<div class="col-lg-2 text-center text-lg-left">
					<a href="<?php the_field('footer_top_button_link'); ?>" <?php echo (get_field('footer_top_link_type') ? 'target="_blank"' : ''); ?> class="btn btn-primary btn-white"><span>Shop Avon <i class="fas fa-chevron-right"></i></span></a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();
