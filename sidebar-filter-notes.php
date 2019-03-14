<?php
/**
 * The sidebar containing the filter notes for Rehv
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package xtremetm
 */

if ( ! is_active_sidebar( 'store_filter_notes' ) ) {
	return;
}
?>
<?php dynamic_sidebar( 'store_filter_notes' ); ?>
