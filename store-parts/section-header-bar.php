<div id="header-nav">
	<div class="container">
		<div class="row no-gutters">
			<div class="col-12 col-md-auto flex-md-grow-1 align-self-center">
				<?php if (!is_user_logged_in() && is_account_page()): ?>
					
					<h1 class="mb-0 text-center text-md-left">Customer Login</h1>

				<?php else: ?>
					
					<?php the_title( '<h1 class="mb-0 text-center text-md-left">', '</h1>' ); ?>

				<?php endif; ?>
			</div>
			
			<?php if(is_cart()): ?>
			
				<div class="col-12 d-block d-sm-none text-center mt-1">
					<a href="<?php echo esc_url( wc_get_checkout_url() );?>" class="btn btn-primary">
						<span><?php esc_html_e( 'Checkout', 'woocommerce' ); ?> <i class="fas fa-chevron-right"></i></span>
					</a>
				</div>	
			
			<?php endif; ?>
			
			<?php if (is_product_category()): ?>		
				<div class="col-md-auto align-self-center d-none d-md-block">
					<?php get_template_part('store-parts/search', 'bar'); ?>
				</div>
			<?php endif; ?>
			<div class="col-md-auto d-none d-md-block align-self-center">
				<div id="header-phone" class="py-1"><?php the_field('global_phone', 'options'); ?></div>
			</div>			
		</div>
	</div>
</div>	