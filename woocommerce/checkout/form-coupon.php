<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

?>
<div id="woocommerce-coupon-code" class="woocommerce-form-coupon-toggle bg-light p-1 d-none">
	<form class="checkout_coupon woocommerce-form-coupon form-inline" method="post">
		<div class="d-flex">
			<input type="text" name="coupon_code" class="form-control form-control-sm flex-grow-1 mr-1" placeholder="<?php esc_attr_e( 'Gift card or discount code', 'woocommerce' ); ?>" id="coupon_code" value="" />
			<input type="submit" class="btn btn-sm" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>" />
		</div>
	</form>
</div>