<?php
/**
 * Template part for displaying page content for shopping cart
 *
 * @package xtrememtm
 */

?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div id="global-store-container">
		<div class="container">

			<?php if ( WC()->cart->get_cart_contents_count() != 0 ): ?>
				<div class="row justify-content-center d-md-none">
					<div class="col-auto mb-1">
						<a href="<?php echo esc_url( wc_get_checkout_url() );?>" class="btn btn-primary">
							<span><?php esc_html_e( 'Checkout', 'woocommerce' ); ?> <i class="fas fa-chevron-right"></i></span>
						</a>
					</div>
				</div>
			<?php endif; ?>

			<div class="box s p-1 p-lg-2">
				<div class="entry-content">
					<?php the_content(); ?>
			
				</div><!-- .entry-content -->
			</div>
		</div>
	</div>
</div>
