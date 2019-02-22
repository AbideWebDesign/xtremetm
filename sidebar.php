<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package xtremetm
 */

if ( ! is_active_sidebar( 'store_sidebar' ) ) {
	return;
}
?>
<div id="store-sidebar" class="s">
	<?php dynamic_sidebar( 'store_sidebar' ); ?>
</div>
