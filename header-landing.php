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
<html class="h-100">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="icon" type="image/png" href="<?php the_field('favicon', 'options'); ?>">
	<?php wp_head(); ?>
</head>
<body class="h-100">