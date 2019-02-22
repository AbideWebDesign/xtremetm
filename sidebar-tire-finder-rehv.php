<?php
/**
 * The sidebar containing the tire finder for Rehv
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package xtremetm
 */

if ( ! is_active_sidebar( 'tire_finder_rehv' ) ) {
	return;
}
?>
<?php dynamic_sidebar( 'tire_finder_rehv' ); ?>
