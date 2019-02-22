<div id="section-footer-top" class="py-3">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-3 text-center text-lg-left mb-2 mb-lg-0">
				<a href="<?php the_field('footer_top_button_link', $store); ?>" <?php echo (get_field('footer_top_link_type', $store) ? 'target="_blank"' : ''); ?>>
					<?php echo wp_get_attachment_image(get_field('footer_top_logo', $store), false, array('class'=>'img-fluid')); ?>
				</a>
			</div>
			<div class="col-lg-7 mb-2 mb-lg-0">
				<p class="mb-0"><?php the_field('footer_top_description', $store); ?></p>
			</div>
			<div class="col-lg-2 text-center text-lg-left">
				<a href="<?php the_field('footer_top_button_link', $store); ?>" <?php echo (get_field('footer_top_link_type', $store) ? 'target="_blank"' : ''); ?> class="btn btn-primary btn-white"><span>Learn More <i class="fas fa-chevron-right"></i></span></a>
			</div>
		</div>
	</div>
</div>