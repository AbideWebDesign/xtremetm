<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
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
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>
<div class="row">
	<div class="col-md-4 col-lg-3">
		<div class="woocommerce-sidebar-nav navbar navbar-expand-md navbar-light mb-1 mb-md-0" role="navigation">
			<button type="button" class="navbar-toggler btn btn-block" data-toggle="collapse" data-target="#woocommerce-MyAccount-navigation" aria-expanded="false"><span class="sr-only">Toggle navigation</span>Menu <i class="fa fa-1x fa-chevron-down"></i></button>
			<div id="woocommerce-MyAccount-navigation" class="list-group collapse navbar-collapse">
			
				<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			
					<a class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?> list-group-item list-group-item-action" href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
			
				<?php endforeach; ?>
			
			</div>
		</div>
	</div>
	
	<?php do_action( 'woocommerce_after_account_navigation' ); ?>
