<?php
/**
 * Proceed to checkout button
 *
 * Contains the markup for the proceed to checkout button on the cart.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/proceed-to-checkout-button.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="row justify-content-center justify-content-md-end">
	
	<div class="col-auto text-left mb-1 mb-md-0 text-center">
		<a href="<?php echo site_url(); ?>" class="btn btn-primary">
			<span><i class="fas fa-chevron-left"></i> <?php esc_html_e( 'Return to Shop', 'woocommerce' ); ?> </span>
		</a>
	</div>
	<div class="col-auto">
		<div class="text-center text-sm-left text-lg-right">
			<a href="<?php echo esc_url( wc_get_checkout_url() );?>" class="btn btn-primary">
				<span><?php esc_html_e( 'Checkout', 'woocommerce' ); ?> <i class="fas fa-chevron-right"></i></span>
			</a>
		</div>
	</div>
	
</div>
