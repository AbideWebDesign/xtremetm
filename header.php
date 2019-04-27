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

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="icon" type="image/png" href="<?php the_field('favicon', 'options'); ?>">
	<?php wp_head(); ?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-139180184-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		
		gtag('config', 'UA-139180184-1');
	</script>

</head>
<body <?php body_class(); ?>>
	<div id="header-global">
		<div class="container">
			<div class="row">
				<div class="col-auto d-lg-none align-self-center">
					<?php shiftnav_toggle( 'shiftnav-main' , '' , array( 'icon' => 'bars' , 'class' => 'shiftnav-toggle-button') ); ?>
				</div>
				<div class="col-auto col-lg-2 align-self-center flex-grow-1 flex-md-grow-0 text-center">
					<div id="header-logo">
						<a href="<?php echo home_url(); ?>"><img class="img-fluid" src="<?php echo home_url('/wp-content/uploads/2019/02/logo-xtremetm.png'); ?>" /></a>
					</div>
				</div>
				<div class="col-lg-5 d-none d-lg-block">
					<div id="header-global-stores" class="d-flex flex-row">
						<div class="flex-fill">
							<a href="<?php echo home_url('/store/rehv/'); ?>" class="<?php echo (is_store('rehv') ? 'active' : ''); ?>">
								<?php if(is_store('rehv')): ?>
									<img src="<?php echo home_url('/wp-content/uploads/2019/02/logo-rehz-color.png'); ?>" class="img-fluid" style="height: 20px" />
								<?php else: ?>
									<img src="<?php echo home_url('/wp-content/uploads/2019/02/logo-rehv.png'); ?>" class="img-fluid" style="height: 20px" />
								<?php endif; ?>
							</a>
						</div>
						<div class="flex-fill">
							<a href="<?php echo home_url('/store/primis/'); ?>" class="<?php echo (is_store('primis') ? 'active' : ''); ?>">
								<?php if(is_store('primis')): ?>
									<img src="<?php echo home_url('/wp-content/uploads/2019/02/logo-primis-color.png'); ?>" class="img-fluid" style="height: 20px" />
								<?php else: ?>
									<img src="<?php echo home_url('/wp-content/uploads/2019/02/logo-primis.png'); ?>" class="img-fluid" style="height: 20px" />
								<?php endif; ?>
							</a>
						</div>
						<div class="flex-fill">
							<a href="<?php echo home_url('/store/contract/'); ?>" class="<?php echo (is_store('contract') ? 'active' : ''); ?>">
								<?php if(is_store('contract')): ?>
									<img src="<?php echo home_url('/wp-content/uploads/2019/02/logo-xtremetm-alt-color.png'); ?>" class="img-fluid" style="height: 20px" />
								<?php else: ?>
									<img src="<?php echo home_url('/wp-content/uploads/2019/02/logo-xtremetm-alt.png'); ?>" class="img-fluid" style="height: 20px" />
								<?php endif; ?>
							</a>
						</div>
					</div>
				</div>
				<div class="col-auto col-lg-auto align-self-center flex-grow-1 d-none d-md-block">
					
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
					<a class="cart-container d-none d-lg-inline-block" href="<?php echo wc_get_cart_url(); ?>"><img src="<?php echo home_url('wp-content/uploads/2019/02/cart.png'); ?>" /><?php echo $woocommerce->cart->get_cart_total(); ?> <i class="fas fa-chevron-right"></i></a>
					<a class="cart-container d-lg-none" href="<?php echo wc_get_cart_url(); ?>"><img src="<?php echo home_url('wp-content/uploads/2019/02/cart.png'); ?>" /><span class="d-none d-md-inline-block"><?php echo WC()->cart->get_cart_contents_count() ?></span></a>
				</div>
			</div>
		</div>
	</div>