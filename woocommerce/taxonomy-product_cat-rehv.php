<?php
/**
 * The Template for displaying products in a product category. Simply includes the archive template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/taxonomy-product_cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
get_header( 'shop' );

$term = get_queried_object();
$store = get_top_level($term);	

// include(locate_template('/store-parts/section-store-cats-nav.php', false, false));

if (!is_search() && (is_product_category() || is_shop())) {

	include(locate_template('/store-parts/hero-banner.php', false, false));  

}

include(locate_template('/store-parts/section-value-bar.php', false, false));

/**
	 * Hook: woocommerce_before_main_content.
	 *
	 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	 * @hooked woocommerce_breadcrumb - 20
	 * @hooked WC_Structured_Data::generate_website_data() - 30
	 */
	do_action( 'woocommerce_before_main_content' );
	
	?>
	<div class="row justify-content-center">
		<div class="col-md-10">
			<div id="countdown" class="d-flex align-items-start justify-content-center">
				<div class="bg-dark p-4">
					<h1 class="mb-2 text-center text-light">Avon Tyres coming soon!</h1>
					<div id="flipdown" class="flipdown"></div>
				</div>
			</div>
		</div>
	</div>
	<?php
	/**
	 * Hook: woocommerce_after_main_content.
	 *
	 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action( 'woocommerce_after_main_content' );		

?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/flipdown.js"></script>
<script>
new FlipDown(1561129200, {
	theme: 'light'
}).start();	
</script>

<?php
get_footer( 'shop' );
