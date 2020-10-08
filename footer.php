<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package xtremetm
 */

?>
		<div id="footer" class="py-3">
			<div class="container">
				<div id="footer-divider-wrapper" class="row justify-content-center">
					<div class="col-lg-8 text-center">
						<div class="footer-divider">
							<a href="<?php echo home_url(); ?>"><img class="img-fluid" src="<?php echo home_url('/wp-content/uploads/2019/02/logo-xtremetm-divider.jpg'); ?>" /></a>
						</div>
					</div>
				</div>
				<div id="footer-boxes" class="row align-items-stretch justify-content-center">
					<div class="col-md-11 col-lg-9 col-xl-7">
						<div class="footer-box h-100 text-center text-md-left">
							<div class="row align-items-center justify-content-center h-100">
								<div class="col-md-auto mb-1 mb-md-0">
									<div class="footer-box-title"><?php the_field('footer_box_title_2', 'options'); ?></div>
									<?php the_field('global_schedule', 'options'); ?>
								</div>
								<div class="col-md-auto mb-1 mb-md-0">
									<div><i class="fas fa-phone"></i> <a class="text-white" href="tel:<?php the_field('global_phone', 'options'); ?>"><?php the_field('global_phone', 'options'); ?></a></div>
									<div><i class="fas fa-envelope"></i> <a class="text-white" href="mailto:<?php the_field('global_email', 'options'); ?>"><?php the_field('global_email', 'options'); ?></a></div>
								</div>
								<div class="col-md-auto">
									<a href="<?php echo home_url('/contact/'); ?>" class="btn btn-primary btn-sm"><span>Contact Us <i class="fas fa-chevron-right"></i></span></a>
								</div>
							</div>
						</div>						
					</div>					
				</div>
				<div id="footer-brands" class="row justify-content-center align-content-center mt-2 mt-lg-3">
					<div class="col-auto">
						<a href="<?php echo home_url('/store/rehv'); ?>"><img src="<?php echo home_url('/wp-content/uploads/2019/02/logo-rehv.png'); ?>" /></a>
					</div>
					<div class="col-auto">
						<a href="<?php echo home_url('/store/contract'); ?>"><img src="<?php echo home_url('/wp-content/uploads/2019/02/logo-xtremetm-alt.png'); ?>" /></a>
					</div>					
				</div>
			</div>
		</div>
		<div id="footer-bottom" class="py-1">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col text-center">
						<span>Copyright <?php echo date('Y'); ?> xtremetm.com. All rights reserved.</span>
						<i class="fas fa-chevron-right mx-2"></i>
						<span><a href="<?php echo home_url('/privacy-policy'); ?>">Privacy Policy</a><i class="fas fa-chevron-right mx-2"></i><a href="<?php echo home_url('/terms'); ?>">Terms & Conditions</a></span>
						<i class="fas fa-chevron-right mx-2"></i> <a href="https://abidewebdesign.com" target="_blank">Website Design and Maintenance by Abide Web Design</a>
					</div>
				</div>
			</div>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>