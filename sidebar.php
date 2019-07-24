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

$term = get_queried_object();
$store = get_top_level($term);	
?>
<div id="store-sidebar" class="s mb-1 mb-lg-0">
	<a class="btn btn-primary d-block d-lg-none" data-toggle="collapse" href=".wcpf-filter" role="button" aria-expanded="false" aria-controls="wcpf-filter"><span>Filters</span></a>
	
	<?php dynamic_sidebar( 'store_sidebar' ); ?>
	
</div>

<?php if ( get_field('ad_space_2', $store) ): ?>
	
	<?php $ad_space_2_link = get_field('ad_space_2_link', $store); ?>
	
	<div class="mt-1">
	
		<a href="<?php echo $ad_space_2_link['url']; ?>" target="<?php echo $ad_space_2_link['target']; ?>"><?php echo wp_get_attachment_image(get_field('ad_space_2', $store), 'full', false, array('class' => 'img-fluid')); ?></a>

	</div>	

<?php endif; ?>

