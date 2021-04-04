<?php 

if ( is_search() ) {
	
	$cat = get_term_by( 'slug', 'indy-lights', 'product_cat' );
	
} else if ( has_term( 'dot_race', 'product_cat' ) ) {
	
	$cat = get_term_by( 'slug', 'dot_race', 'product_cat' );
		
} else if ( has_term( 'indy-lights', 'product_cat' ) ) {
	
	$cat = get_term_by( 'slug', 'indy-lights', 'product_cat' );
	
} else if ( has_term( 'indy-pro-2000', 'product_cat' ) ) {
	
	$cat = get_term_by( 'slug', 'indy-pro-2000', 'product_cat' );
	
} else if ( has_term( 'rally', 'product_cat' ) ) {
	
	$cat = get_term_by( 'slug', 'rally', 'product_cat' );
	
} else {
	
	$cat = get_term_by( 'slug', 'indy-lights', 'product_cat' );
	
}

$bg_img = wp_get_attachment_image_src( get_field('header_image', $cat), 'hero banner' ) ;

?>

<?php if ( $bg_img ): ?>

	<div id="section-page-header" style="background-image: url(<?php echo $bg_img[0]; ?>)"></div>
	
<?php endif; ?>