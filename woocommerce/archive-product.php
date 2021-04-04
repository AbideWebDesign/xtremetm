<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

get_template_part('store-parts/section', 'page-header');

get_template_part('store-parts/section', 'series-bar');

if ( is_search() ) {
	
	global $wp_query;
	
	$term = get_term_by( 'slug', $wp_query->get('product_cat'), 'product_cat' );
	
} else {

	$term = get_queried_object();
	
}

$store = get_top_level( $term );	

?>

<?php if ( is_product_category() ): ?>

<div class="py-2">
	
	<div class="container">
		
		<div class="row justify-content-between align-items-center">
			
			<div class="col-lg-7">
				
				<?php if ( is_search() ): ?>
					
					<h2 class="mb-0 h1-lg text-center text-sm-left"><?php _e('Search: '); ?> <?php echo get_search_query(); ?></h2>
				
				<?php else: ?>
				
					<h1 class="mb-0 h1-lg text-center text-sm-left"><?php echo $term->name; ?> <?php _e('Tires'); ?></h1>
					
					<?php if ( get_field('series_lead_text', $term ) ): ?>
					
						<div class="my-1 lead">
							
							<?php the_field('series_lead_text', $term); ?>
							
						</div>
					
					<?php endif; ?>
					
				<?php endif; ?>
				
			</div>
			
			<div class="col-lg-5">
				
				<?php if ( get_field('series_lead_image', $term ) ): ?>
				
					<?php echo wp_get_attachment_image( get_field('series_lead_image', $term), 'Full', false, array( 'class' => 'img-fluid img-alt' ) ); ?>
				
				<?php endif; ?>
				
			</div>
			
		</div>
		
	</div>
	
</div>
		
<?php endif; ?>

<?php 
/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

?>

<?php if ( get_field('ad_space_1', $store) ): ?>

	<?php $ad_space_1_link = get_field('ad_space_1_link', $store); ?>
	
	<div class="row">
		
		<div class="col-12">
		
			<div class="mb-2 text-center">
			
				<a href="<?php echo $ad_space_1_link['url']; ?>" target="<?php echo $ad_space_1_link['target']; ?>"><?php echo wp_get_attachment_image(get_field('ad_space_1', $store), 'full', false, array('class' => 'img-fluid')); ?></a>
		
			</div>
		
		</div>
	
	</div>	

<?php endif; ?>

<div class="row justify-content-center">

	<div id="sidebar-filter" class="col-lg-3">		

		<?php

		/**
		 * Hook: woocommerce_sidebar.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */

		do_action( 'woocommerce_sidebar' );		

		?>

	</div>

	<div class="col-lg-9">
		
		
		<?php
			
		if ( woocommerce_product_loop() ) {
		
			/**
			 * Hook: woocommerce_before_shop_loop.
			 *
			 * @hooked woocommerce_output_all_notices - 10
			 * @hooked woocommerce_result_count - 20
			 * @hooked woocommerce_catalog_ordering - 30
			 */
			do_action( 'woocommerce_before_shop_loop' );
		
			woocommerce_product_loop_start();
		
			if ( wc_get_loop_prop( 'total' ) ) {
			
				while ( have_posts() ) {
			
					the_post();
		
					/**
					 * Hook: woocommerce_shop_loop.
					 *
					 * @hooked WC_Structured_Data::generate_product_data() - 10
					 */
			
					do_action( 'woocommerce_shop_loop' );
					
					$product = wc_get_product( get_the_id() );
					
					if ( $product->get_stock_status() != 'outofstock' ) {
					
						if ($store->slug == 'contract') {
							
							wc_get_template_part( 'content', 'product-contract' );
						
						} else {
							
							wc_get_template_part( 'content', 'product' );
						
						}
						
					}
					
				}
			}
		
			woocommerce_product_loop_end();
		
			/**
			 * Hook: woocommerce_after_shop_loop.
			 *
			 * @hooked woocommerce_pagination - 10
			 */
		
			do_action( 'woocommerce_after_shop_loop' );
		
		} else {
		
			/**
			 * Hook: woocommerce_no_products_found.
			 *
			 * @hooked wc_no_products_found - 10
			 */
		
			do_action( 'woocommerce_no_products_found' );
		
		}							
		
		?>
	
	</div>

</div>

<?php
/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );		

get_template_part('store-parts/section', 'tire-links');

get_footer( 'shop' );