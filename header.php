<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package xtremetm
 */
global $woocommerce;

$stores = get_terms('product_cat', array( 'parent' => 0, 'hide_empty' => false ));

if ( is_search() ) {
	
	global $wp_query;

	$term = get_term_by( 'slug', $wp_query->get('product_cat'), 'product_cat' );

	$store_class = 'store-' . $term->slug;

} else {
	
	$store_class = 'store-xtremetm';
	
}

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="icon" type="image/png" href="<?php the_field('favicon', 'options'); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class( $store_class ); ?>>
	<div id="header-global">
		<div class="container">
			<div class="row">
				<div class="col-auto d-xl-none align-self-center">
					<?php shiftnav_toggle( 'shiftnav-main' , '' , array( 'icon' => 'bars' , 'class' => 'shiftnav-toggle-button') ); ?>
				</div>
				<div class="col-auto col-lg-2 align-self-center flex-grow-1 flex-md-grow-0 text-center">
					<div id="header-logo">
						<a href="<?php echo home_url(); ?>"><img class="img-fluid" src="<?php echo home_url('/wp-content/uploads/2019/02/logo-xtremetm.png'); ?>" /></a>
					</div>
				</div>
				<div class="col-auto flex-xl-grow-1 d-none d-xl-block">
					<div id="header-global-stores" class="d-flex h-100">
						<!- Staging 307. Production 309 -->
						<?php ubermenu( 'main' , array( 'menu' => 309 ) ); ?>						
					
					</div>
				</div>
				<div class="col-auto flex-grow-1 flex-xl-grow-0 align-self-center d-none d-md-block">
					
					<?php 
						wp_nav_menu( array(
							'theme_location' => (is_user_logged_in() ? 'top-links-logged-in' : 'top-links'),
							'menu_class' => 'list-inline d-none d-sm-block',
							'depth' => 1, 
							'add_li_class'  => 'list-inline-item'
							)
						);
					?>
					
				</div>
				<div class="col-auto align-self-center">
					<a class="cart-container d-none d-lg-inline-block" href="<?php echo wc_get_cart_url(); ?>"><img src="<?php echo home_url('wp-content/uploads/2019/02/cart.png'); ?>" /><?php echo WC()->cart->get_cart_total(); ?> <i class="fas fa-chevron-right"></i></a>
					<a class="cart-container d-lg-none" href="<?php echo wc_get_cart_url(); ?>"><img src="<?php echo home_url('wp-content/uploads/2019/02/cart.png'); ?>" /><span class="d-none d-md-inline-block"><?php echo WC()->cart->get_cart_contents_count() ?></span></a>
				</div>
			</div>
		</div>
	</div>