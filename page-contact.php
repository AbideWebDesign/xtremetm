<?php
/**
 * Template Name: Contact
 *
 * @package xtremetm
 */

get_header();
?>
<?php get_template_part('store-parts/section', 'header-bar'); ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div id="global-store-container">
		<div class="container">
			<div class="box s p-2">
				<h2 class="mb-1">Customer Service</h2>
				<?php the_field('contact_content'); ?>
				<h3 class="mb-1">Phone Number:</h3>
				<p class="mb-2">Please call <?php the_field('global_phone', 'options'); ?></p>
				<h3 class="mb-1">Email:</h3>
				<p class="mb-2"><a href="mailto:<?php the_field('global_email', 'options'); ?>"><?php the_field('global_email', 'options'); ?></a></p>
				<h3 class="mb-1">Customer Service Hours:</h3>
				<p class="mb-0"><?php the_field('global_schedule', 'options'); ?></p>
			</div>
			<div class="box s mt-2 p-2">
				<h3 class="mb-2">Submit Your Question</h3>
				<?php echo do_shortcode('[gravityform id=2 title=false description=false ajax=true tabindex=49]'); ?>
			</div>
		</div>
	</div>
</div>
<?php
get_footer();
