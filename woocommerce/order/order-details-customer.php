<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>

<section class="woocommerce-customer-details text-sm mb-0 row">
	
	<div class="col-6 col-lg-12">
	
		<h3 class="woocommerce-column__title mb-1"><?php esc_html_e( 'Billing Address', 'woocommerce' ); ?></h3>
		
		<address>
	
			<?php echo wp_kses_post( $order->get_formatted_billing_address( __( 'N/A', 'woocommerce' ) ) ); ?>
		
			<?php if ( $order->get_billing_phone() ) : ?>
	
				<p class="woocommerce-customer-details--phone"><?php echo esc_html( $order->get_billing_phone() ); ?></p>
	
			<?php endif; ?>
		
			<?php if ( $order->get_billing_email() ) : ?>
	
				<p class="woocommerce-customer-details--email"><?php echo esc_html( $order->get_billing_email() ); ?></p>
	
			<?php endif; ?>
	
		</address>
	
	</div>

	<?php if ( $show_shipping ) : ?>	
	
		<div class="col-6 col-lg-12">
	
			<div class="woocommerce-column woocommerce-column--shipping-address mt-1">
	
				<h3 class="woocommerce-column__title mb-1"><?php esc_html_e( 'Shipping Address', 'woocommerce' ); ?></h3>
	
				<address>
	
					<?php if ( has_product_category_in_order( $order, 'indy-lights') || has_product_category_in_order( $order, 'indy-pro-2000') || has_product_category_in_order( $order, 'usf-2000' ) ): ?>
					
						<strong><?php _e('Event: '); ?></strong><?php echo get_post_meta( $order->get_id(), 'Ship to Event', true ); ?>
						
					<?php else: ?>
										
						<?php echo wp_kses_post( $order->get_formatted_shipping_address( __( 'N/A', 'woocommerce' ) ) ); ?>
						
					<?php endif; ?>
	
				</address>
	
			</div>
	
		</div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>

</section>