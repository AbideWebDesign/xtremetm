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
	
		<?php while(have_rows('banners')): the_row(); ?>
	
			<?php $bg_img = wp_get_attachment_image_src(get_sub_field('hero_banner_image'), 'hero banner', false); ?>
	
				<div class="carousel-item h-100 text-center bg-img <?php echo ($count==0 ? 'active' : ''); ?>" style="background-image: url('<?php echo $bg_img[0]; ?>')">
					<div class="bg-overlay"></div>
					<div class="bg-img-content text-center d-flex flex-column h-100 align-content-center justify-content-center">
						<h2 class="text-white mb-1"><?php the_sub_field('hero_banner_title'); ?></h2>
						<h4 class="mb-2 text-white"><?php the_sub_field('header_banner_sub_title'); ?></h4>
						<?php if (get_sub_field('add_button')): ?>
						
							<a href="<?php the_sub_field('hero_banner_button_link'); ?>" class="btn btn-primary btn-rehv btn-lg"><span><?php the_sub_field('hero_banner_button_label'); ?> <i class="fas fa-chevron-right ml-1"></i></span></a>
						
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
						<h1 class="mb-3">How it Works</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4 mb-2 mb-lg-0">
						<div class="bg-light h-100">
							<div class="bg-rehv p-1">
								<h2 class="mb-0 text-center">Step 1</h2>
							</div>
							<div class="p-2">
								<h3 class="mb-1">Purchase your Avon Tires</h3>
								<p class="mb-0">You get a $20 reward for purchasing 1 tire and $60 for purchasing a single set. Purchase between May 31st, 2019 and August 31, 2019. </p>
							</div>
						</div>
					</div>
					<div class="col-lg-4 mb-2 mb-lg-0">
						<div class="bg-light h-100">
							<div class="bg-rehv p-1">
								<h2 class="mb-0 text-center">Step 2</h2>
							</div>
							<div class="p-2">
								<h3 class="mb-1">CLAIM YOUR REWARD</h3>
								<p class="mb-0">Fill in the <a href="https://www.avontyrerewards.com/#/home" target="_blank">form</a> and upload your sales receipt through our external reward platform. </p>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="bg-light h-100">
							<div class="bg-rehv p-1">
								<h2 class="mb-0 text-center">Step 3</h2>
							</div>
							<div class="p-2">
								<h3 class="mb-1">RECEIVE YOUR REWARD</h3>
								<p class="mb-0">Enjoy your new tires and don't forget to drive safe! Please allow 6 to 8 weeks for the delivery of the Visa prepaid card after your reward is submitted. </p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="section-footer-top" class="py-3">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-3 text-center text-lg-left mb-2 mb-lg-0">
					<a href="<?php the_field('footer_top_button_link'); ?>" <?php echo (get_field('footer_top_link_type') ? 'target="_blank"' : ''); ?>>
						<?php echo wp_get_attachment_image(get_field('footer_top_logo'), 'col-3', false, array('class'=>'img-fluid')); ?>
					</a>
				</div>
				<div class="col-lg-7 mb-2 mb-lg-0">
					<h3 class="mb-0"><?php the_field('footer_top_description'); ?></h3>
				</div>
				<div class="col-lg-2 text-center text-lg-left">
					<a href="<?php the_field('footer_top_button_link'); ?>" <?php echo (get_field('footer_top_link_type') ? 'target="_blank"' : ''); ?> class="btn btn-primary btn-white"><span>Shop Avon Tires <i class="fas fa-chevron-right"></i></span></a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();
