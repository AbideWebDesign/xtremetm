<?php if (get_field('display_banner_area', $term)): ?>

	<?php $count = 0; ?>
	<?php $banners = count(get_field('banners', $term)); ?>
		
		<div id="section-hero-banner" class="carousel slide" data-ride="carousel">
			
			<?php if ($banners > 1): ?>
			
				<ol class="carousel-indicators">
					
					<?php while(have_rows('banners', $term)): the_row(); ?>
					
						<li data-target="#section-hero-banner" data-slide-to="<?php echo $count; ?>" class="<?php echo ($count==0 ? 'active' : ''); ?>"></li>
						
						<?php $count ++; ?>
						
					<?php endwhile; ?>
					
				</ol>
				
			<?php endif; ?>
			
			<div class="carousel-inner h-100">
	
				<?php $count = 0; ?>
				
				<?php while(have_rows('banners', $term)): the_row(); ?>
			
					<?php $bg_img = wp_get_attachment_image_src(get_sub_field('hero_banner_image'), 'hero banner', false); ?>
		
						<div class="carousel-item h-100 text-center bg-img <?php echo ($count==0 ? 'active' : ''); ?>" style="background-image: url('<?php echo $bg_img[0]; ?>')">
							<div class="bg-overlay"></div>
							<div class="bg-img-content text-center d-flex flex-column h-100 align-content-center justify-content-center">
								<h4 class="mb-1 mb-lg-0 text-white"><?php the_sub_field('header_banner_sub_title'); ?></h4>
								<h1 class="text-white mb-2"><?php the_sub_field('hero_banner_title'); ?></h1>
								
								<?php if (get_sub_field('add_button')): ?>
								
									<a href="<?php the_sub_field('hero_banner_button_link'); ?>" class="btn btn-primary btn-lg"><span><?php the_sub_field('hero_banner_button_label'); ?> <i class="fas fa-chevron-right ml-1"></i></span></a>
								
								<?php endif; ?>
							</div>
						</div>
			
					<?php $count = 1; ?>
					
				<?php endwhile; ?>
		
			</div>
		</div>

<?php elseif (get_field('display_banner_area', $store) && is_store($term->slug)): ?>

	<?php $count = 0; ?>
	
	<div id="section-hero-banner" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner h-100">

			<?php while(have_rows('banners', $store)): the_row(); ?>
		
				<?php $bg_img = wp_get_attachment_image_src(get_sub_field('hero_banner_image'), 'hero banner', false); ?>
	
					<div class="carousel-item h-100 text-center bg-img <?php echo ($count==0 ? 'active' : ''); ?>" style="background-image: url('<?php echo $bg_img[0]; ?>')">
						<div class="bg-overlay"></div>
						<div class="bg-img-content text-center d-flex flex-column h-100 align-content-center justify-content-center">
							<h4 class="mb-1 mb-lg-0 text-white"><?php the_sub_field('header_banner_sub_title'); ?></h4>
							<h2 class="text-white mb-2"><?php the_sub_field('hero_banner_title'); ?></h2>
							
							<?php if (get_sub_field('add_button')): ?>
							
								<a href="<?php the_sub_field('hero_banner_button_link'); ?>" class="btn btn-primary btn-lg"><span><?php the_sub_field('hero_banner_button_label'); ?> <i class="fas fa-chevron-right ml-1"></i></span></a>
							
							<?php endif; ?>
						</div>
					</div>
		
				<?php $count = 1; ?>
				
			<?php endwhile; ?>
	
		</div>
	</div>

<?php endif; ?>
	
