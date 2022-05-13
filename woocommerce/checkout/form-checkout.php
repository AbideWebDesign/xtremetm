<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	
	exit;

}

do_action( 'woocommerce_before_checkout_form', $checkout );

$shipping_method = WC()->session->get( 'chosen_shipping_methods' );

if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) { // If checkout registration is disabled and not logged in, the user cannot checkout.

	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );

	return;

}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="row" id="customer_details">
			
			<div class="col-12 col-lg-8">
			
				<h3 class=""><?php _e('Shipping Details'); ?></h3>
				
				<?php if ( dotr_in_cart() ): ?>
				
					<div id="ship-option" class="my-1 bg-light">
			
						<p class="form-row m-0 p-0" id="ship-event-wrap">
			
							<span class="woocommerce-input-wrapper">
			
								<label for="ship-to-event-checkbox" class="checkbox">
			
									<input id="ship-to-event-checkbox" class="input-checkbox " type="checkbox" name="ship-to-event-checkbox" value="1" <?php echo ( WC()->session->get( 'ship_to_event') == 'true' ? 'checked': '' ); ?>>
			
									<?php _e( 'Pickup at track or warehouse?', 'woocommerce' ); ?>
			
								</label>
			
							</span>
			
						</p>
			
					</div>
					
				<?php endif; ?>
				
				<?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>
				
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>

				<?php do_action( 'woocommerce_checkout_billing' ); ?>
				
				<div class="woocommerce-additional-fields">
					
					<?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>
				
					<?php if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_order_comments', 'yes' ) ) ) : ?>
				
						<?php if ( ! WC()->cart->needs_shipping() || wc_ship_to_billing_address_only() ) : ?>
				
							<h3><?php _e( 'Additional information', 'woocommerce' ); ?></h3>
				
						<?php endif; ?>
				
						<div class="woocommerce-additional-fields__field-wrapper">
			
							<?php foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field ) : ?>
			
								<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
			
							<?php endforeach; ?>
			
						</div>
				
					<?php endif; ?>
				
				</div>
				
				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
			
			</div>
			
			<div class="col-lg-4">
			
				<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>

				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
			
				<div id="order_review" class="woocommerce-checkout-review-order">
			
					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
			
				</div>
			
				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>				
			
			</div>
		
		</div>

	<?php endif; ?>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>

<!-- Event Select Modal -->
<div class="modal fade" id="eventSelectModal" tabindex="-1" role="dialog" aria-labelledby="eventSelectModal" aria-hidden="true">
	
	<div class="modal-dialog modal-dialog-centered" role="document">
    
    	<div class="modal-content">
			
			<div class="modal-header bg-primary">
				
				<h4>Ship to Event?</h4>
				
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				
			</div>
			
			<div class="modal-body">
			
				<h3>Event Details</h3>
				
				<p>Select the event you would like to ship to.</p>
				
				<div id="events"></div>
			
			</div>

			<div class="modal-footer text-left">
				
				<button id="ship_to_event" type="button" class="btn btn-primary" disabled><span>Ship to Event</span></button>
						
				<input type="hidden" id="event_name" />
				<input type="hidden" id="event_shipping_address_1" />
				<input type="hidden" id="event_shipping_city" />
				<input type="hidden" id="event_shipping_state" />
				<input type="hidden" id="event_shipping_postcode" />
				
			</div>
	
		</div>
		
	</div>
	
</div>