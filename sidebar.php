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
<div id="store-sidebar" class="s mb-1 mb-lg-0">
	<a class="btn btn-primary d-block d-lg-none" data-toggle="collapse" href=".wcpf-filter" role="button" aria-expanded="false" aria-controls="wcpf-filter"><span>Filters</span></a>
	<?php dynamic_sidebar( 'store_sidebar' ); ?>
</div>
