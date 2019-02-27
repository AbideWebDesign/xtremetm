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

<?php wp_footer(); ?>
		<div id="footer" class="py-3">
			<div class="container">
				<div id="footer-divider-wrapper" class="row justify-content-center">
					<div class="col-lg-8 text-center">
						<div class="footer-divider">
							<a href="<?php echo home_url(); ?>"><img class="img-fluid" src="<?php echo home_url('/wp-content/uploads/2019/02/logo-xtremetm-divider.jpg'); ?>" /></a>
						</div>
					</div>
				</div>
				<div id="footer-boxes" class="row align-items-stretch">
					<div class="col-lg-6 mb-1 mb-lg-0">
						<div class="footer-box h-100">
							<div class="footer-box-title text-center mb-1"><?php the_field('footer_box_title_1', 'options'); ?></div>
							<?php echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]'); ?>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="footer-box h-100 text-center text-lg-left">
							<div class="row align-items-center h-100">
								<div class="col-lg-auto mb-1 mb-lg-0">
									<div class="footer-box-title"><?php the_field('footer_box_title_2', 'options'); ?></div>
									<?php the_field('global_schedule', 'options'); ?>
								</div>
								<div class="col-lg-auto mb-1 mb-lg-0">
									<div><i class="fas fa-phone"></i> <?php the_field('global_phone', 'options'); ?></div>
									<div><i class="fas fa-envelope"></i> <?php the_field('global_email', 'options'); ?></div>
								</div>
								<div class="col-lg-auto">
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
						<a href="<?php echo home_url('/store/primis'); ?>"><img src="<?php echo home_url('/wp-content/uploads/2019/02/logo-primis.png'); ?>" /></a>
					</div>
					<div class="col-auto">
						<a href="<?php echo home_url('/store/xtremetmtires'); ?>"><img src="<?php echo home_url('/wp-content/uploads/2019/02/logo-xtremetm-alt.png'); ?>" /></a>
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
						<span><a href="#">Privacy Policy</a><i class="fas fa-chevron-right mx-2"></i><a href="#">Terms & Conditions</a></span>
						<i class="fas fa-chevron-right mx-2"></i> <a href="https://abidewebdesign.com" target="_blank">Website Design by Abide Web Design</a>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
