<?php
/**
 * xtremetm functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package xtremetm
 */

require WP_CONTENT_DIR . '/plugins/plugin-update-checker-master/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/AbideWebDesign/xtremetm',
	__FILE__,
	'xtremetm'
);

if ( ! function_exists( 'xtremetm_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function xtremetm_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on xtremetm, use a find and replace
		 * to change 'xtremetm' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'xtremetm', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'xtremetm' ),
			'top-links' => esc_html__( 'Top', 'xtremetm' ),
			'top-links-logged-in' => esc_html__( 'Top Logged In', 'xtremetm' )
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		
		function remove_menus(){
			
			remove_menu_page( 'edit.php' ); //Posts
			
			if(!is_admin()) {
				remove_menu_page( 'themes.php' ); //Appearance
				remove_menu_page( 'plugins.php' ); //Plugins
				remove_menu_page( 'users.php' ); //Users
				remove_menu_page( 'tools.php' ); //Tools
			}
		}
		add_action( 'admin_menu', 'remove_menus' );
	
		function remove_wp_logo( $wp_admin_bar ) {
			$wp_admin_bar->remove_node( 'wp-logo' );
		}
		add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );

		function remove_wp_nodes() {
		    global $wp_admin_bar;   
		    $wp_admin_bar->remove_node( 'new-post' );
		    $wp_admin_bar->remove_menu( 'autoptimize' );
		    $wp_admin_bar->remove_menu( 'customize' );
		}
		add_action( 'admin_bar_menu', 'remove_wp_nodes', 999 );

	}
endif;
add_action( 'after_setup_theme', 'xtremetm_setup' );

/**
 * Enqueue scripts and styles.
 */
function xtremetm_scripts() {
	$theme = wp_get_theme();
	
	wp_deregister_script( 'jquery' );
	
	wp_register_script( 'jquery', 'https://code.jquery.com/jquery-3.0.0.min.js', false, null );
	
	wp_enqueue_script( 'jquery' );
	
	wp_enqueue_style( 'fontawesome', 'https://use.fontawesome.com/releases/v5.7.1/css/all.css' );
	
	wp_enqueue_style( 'xtremetm-style', get_stylesheet_uri(), '', $theme->version );
	
	wp_enqueue_style( 'xtremetm-fonts', 'https://fonts.googleapis.com/css?family=Oswald:400,500,700|Roboto:400,700' );

	wp_enqueue_script( 'xtremetm-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '', true );
	
	wp_enqueue_script( 'core', get_template_directory_uri() . '/js/core.js', array(), '', true );	

	wp_enqueue_script( 'popper.min', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array(), '', true );
	
	wp_enqueue_script( 'bootstrap.min', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array(), '', true );
}
add_action( 'wp_enqueue_scripts', 'xtremetm_scripts' );

function ajax_site_scripts() {
    // Enqueue our JS file
    wp_enqueue_script( 'ajax_appjs', get_template_directory_uri() . '/js/ajax.js', array( 'jquery' ), filemtime( get_template_directory() . '/js/ajax.js'), true);
    
    // Provide a global object to our JS file containing the AJAX url and security nonce
    wp_localize_script( 'ajax_appjs', 'ajax_object',
        array(
            'ajax_url'      => admin_url('admin-ajax.php'),
            'ajax_nonce'    => wp_create_nonce('ajax_nonce'),
        )
    );
}
add_action( 'wp_enqueue_scripts', 'ajax_site_scripts', 999) ;

/**
 * Image sizes
 */
add_image_size('col-3', 295);
add_image_size('col-4', 434);
add_image_size('col-5', 542);
add_image_size('col-6', 650);
add_image_size('col-7', 759);
add_image_size('hero banner', 2400, 1600, true);

/**
 * Plugin: ACF Options page
 */
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Store Global Fields',
		'menu_title'	=> 'Store Global Fields',
		'parent_slug'	=> 'theme-general-settings',
	));

}

/**
 * Add Bootstrap 4 Nav walker
 */
require_once("bs4Navwalker.php");

/**
 * Add Bootstrap 4 inline list classes
 */
function bootstrap_inline_list_class($classes, $item, $args) {
	if ( 'shiftnav' != $args->theme_location ) {
		if( $args->add_li_class  ) {
		    $classes[] = $args->add_li_class;
		}
	}
    return $classes;
}
add_filter('nav_menu_css_class', 'bootstrap_inline_list_class', 1, 3);

/*
 * Custom pagination function
 */
function show_pagination_links() {
    global $wp_query;

    $page_tot   = $wp_query->max_num_pages;
    $page_cur   = get_query_var( 'paged' );
    $big        = 999999999;

    if ( $page_tot == 1 ) return;

    echo paginate_links( array(
            'base'      => str_replace( $big, '%#%',get_pagenum_link( 999999999, false ) ), // need an unlikely integer cause the url can contains a number
            'format'    => '?paged=%#%',
            'current'   => max( 1, $page_cur ),
            'total'     => $page_tot,
            'prev_next' => true,
			'prev_text'    => __('&lsaquo; Previous', 'progression'),
			'next_text'    => __('Next &rsaquo;', 'progression'),
            'end_size'  => 1,
            'mid_size'  => 2,
            'type'      => 'list'
        )
    );
}

/*
 * Check if store front
 */
function is_store($slug) {
	
	if (is_home()) {
		
		return false;
	
	} elseif (is_product_category()) {
		
		$term = get_queried_object();
		$store = get_top_level($term);

	} elseif (is_product()) {
		
		$product = get_queried_object();
		$terms = get_the_terms($product->ID, 'product_cat');
		$store = get_product_store($terms);
		
	} else {
		return false;
	}
	
	if ($slug == $store->slug) {
			
		return true;		
	
	} else {
		
		return false;
		
	}
}

/*
 * Woocommerce
 */

add_theme_support( 'woocommerce', array(
	'thumbnail_image_width' => 200,
	'gallery_thumbnail_image_width' => 150,
	'single_image_width' => 500,
) );

add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
	return array(
		'width' => 150,
		'height' => 180,
		'crop' => 1,
	);
} );
/*
 * Store widget
 */
function xtremetm_widgets_init() {

	register_sidebar( array(
		'name'          => 'Store Sidebar',
		'id'            => 'store_sidebar',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
	) );
	
	register_sidebar( array(
		'name'          => 'Store Filter Notes',
		'id'            => 'store_filter_notes',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
	) );

}
add_action( 'widgets_init', 'xtremetm_widgets_init' );

function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

/**
 * Hide update notifications from all users
 */
add_action( 'admin_init', 'xtremetm_hide_update_notifications_users' );
 
function xtremetm_hide_update_notifications_users() {
    global $menu, $submenu;
    $user = wp_get_current_user();
     
    // ENTER HERE THE ONLY ALLOWED USERNAME
    $allowed = array( 'abide_admin' );
     
    // HIDE WP, PLUGIN, THEME NOTIFICATIONS FOR ALL OTHER USERS
    if ( $user && isset( $user->user_login ) && ! in_array( $user->user_login, $allowed ) ) {
        add_filter( 'pre_site_transient_update_core', 'xtremetm_disable_update_notifications' );
        add_filter( 'pre_site_transient_update_plugins', 'xtremetm_disable_update_notifications' ); 
        add_filter( 'pre_site_transient_update_themes', 'xtremetm_disable_update_notifications' );
         
        // ALSO REMOVE THE RED UPDATE COUNTERS @ SIDEBAR MENU ITEMS
        $menu[65][0] = 'Plugins up to date';   
        $submenu['index.php'][10][0] = 'Updates disabled';   
    }
}
 
function xtremetm_disable_update_notifications() {
    global $wp_version;
    return (object) array( 'last_checked' => time(), 'version_checked' => $wp_version, );
}
/**
 * Setup Woocommerce
 */
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );
remove_theme_support( 'wc-product-gallery-zoom' );
add_action( 'wp_enqueue_scripts', 'dequeue_stylesandscripts_select2', 100 );
 
function dequeue_stylesandscripts_select2() {
    if ( class_exists( 'woocommerce' ) && !(is_admin()) ) {
        wp_dequeue_style( 'selectWoo' );
        wp_deregister_style( 'selectWoo' );
 
        wp_dequeue_script( 'selectWoo');
        wp_deregister_script('selectWoo');
    } 
} 
/**
 * Remove product tags
 */
add_action('init', function() {
    register_taxonomy('product_tag', 'product', [
        'public'            => false,
        'show_ui'           => false,
        'show_admin_column' => false,
        'show_in_nav_menus' => false,
        'show_tagcloud'     => false,
    ]);
}, 100);

add_action( 'admin_init' , function() {
    add_filter('manage_product_posts_columns', function($columns) {
        unset($columns['product_tag']);
        return $columns;
    }, 100);
});

/**
 * Add store to body class
 */
add_filter( 'body_class', 'xtremetm_body_classes' );
function xtremetm_body_classes($classes) {

	global $wp_query;

	$obj = $wp_query->get_queried_object();
		
	if (is_product()) { 
		
		$terms = get_the_terms($obj, 'product_cat');
		
		$store = get_product_store($terms);

		$classes[] = 'store-' . $store->slug;
		
	} elseif (is_product_category()) {
		
		$store = get_top_level($obj);

		$classes[] = 'store-' . $store->slug;
		
	}
	
	return $classes;
}

/**
 * Setup custom field rules for product categories (stores)
 */
add_filter('acf/location/rule_types', 'acf_wc_product_type_rule_type');
function acf_wc_product_type_rule_type($choices) {

	if (!isset($choices['Product'])) {

	  $choices['Product'] = array();

	}

	// now add the 'Category' rule to it
	if (!isset($choices['Product']['product_cat'])) {

	  // product_cat is the taxonomy name for woocommerce products
	  $choices['Product']['product_cat_term'] = 'Product Category Term';

	}

	return $choices;
}
add_filter('acf/location/rule_values/product_cat_term', 'acf_wc_product_type_rule_values');
function acf_wc_product_type_rule_values($choices) {

	$args = array(
	  'taxonomy' => 'product_cat',
	  'hide_empty' => false
	);
	$terms = get_terms($args);
	
	foreach ($terms as $term) {
		$choices[$term->term_id] = $term->name;
	}
	
	return $choices;
}
add_filter('acf/location/rule_match/product_cat_term', 'acf_wc_product_type_rule_match', 10, 3);
function acf_wc_product_type_rule_match($match, $rule, $options) {
	
	if (!isset($_GET['tag_ID'])) {
	
		// tag id is not set
		return $match;
	
	}
	
	if ($rule['operator'] == '==') {
	
	  $match = ($rule['value'] == $_GET['tag_ID']);
	
	} else {
	
	  $match = !($rule['value'] == $_GET['tag_ID']);
	}
	
	return $match;
}
  
/**
 * Remove related products output
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

/**
 * Remove additional information tab
 */
add_filter( 'woocommerce_product_tabs', 'xtremetm_remove_product_tabs', 98 );

function xtremetm_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] ); 
    return $tabs;
}

/**
 * Add a shipping/return tab
 */
add_filter( 'woocommerce_product_tabs', 'xtremetm_shipping_tab' );
function xtremetm_shipping_tab( $tabs ) {
	
	// Adds the new tab
	$tabs['policies_tab'] = array(
		'title' 	=> __( 'Shipping and Returns', 'woocommerce' ),
		'priority' 	=> 50,
		'callback' 	=> 'xtremetm_shipping_tab_content'
	);

	return $tabs;
}
function xtremetm_shipping_tab_content() {

	$product = get_queried_object();
	$terms = get_the_terms($product->ID, 'product_cat');
	$store = get_product_store($terms);
	
	echo '<h2>Shipping Policy</h2>';
	the_field('shipping_policy', $store);
	echo '<h2>Return Policy</h2>';
	the_field('return_policy', $store);
}

/**
 * Remove sidebar on single product pages
 */
add_action( 'wp', 'xtremetm_remove_sidebar_product_pages' );
 
function xtremetm_remove_sidebar_product_pages() {
	if ( is_product() ) {
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	}
}

/**
 * Return top level store object
 */
function get_top_level($term) {

	if (is_shop()) {
		
		return $term;
	
	} elseif ($term->parent > 0) {
       
        $term = get_term_by("id", $term->parent, "product_cat");
       
        return get_top_level($term);
    
    } else {
    
        return $term;
    
    }
}

/**
 * Return top level store categories
 */
function get_parent_cats() {
	
	global $wp_query;
	
	$obj = $wp_query->get_queried_object();	

	if (is_category() || is_tax()) {

		if($obj->parent == 0) {
			
			// This is the top level
			
			$cats = get_terms('product_cat', array( 'child_of' => $obj->term_taxonomy_id, 'hide_empty' => false ));
	
			return($cats);
			
		} else {
			
			// Not top level. Get top level
			$parent = get_top_level($obj);
	
			$cats = get_terms('product_cat', array( 'child_of' => $parent->term_taxonomy_id, 'hide_empty' => false ));
			
			return($cats);
			
		}
	} elseif (is_product()) {
		
		$terms = get_the_terms($obj->ID, 'product_cat'); 
		
		$store = get_product_store($terms);
		
		$cats = get_terms('product_cat', array( 'child_of' => $store->term_taxonomy_id, 'hide_empty' => false ));
	
		return($cats);

	}
}

/**
 * Return top level store for product
 */
function get_product_store($terms) {
	
	foreach($terms as $term) {
		if ($term->parent == 0) {
			return($term);
		}
	}
}
 
/**
 * Opening div for content wrapper
 */
add_action('woocommerce_before_main_content', 'xtremetm_open_div', 5);

function xtremetm_open_div() {
    echo '<div id="global-store-container"><div class="container">';
}

/**
 * Closing content for after content wrapper
 */
add_action('woocommerce_after_main_content', 'xtremetm_close_div', 50);

function xtremetm_close_div() {
   
    echo '</div></div>';
    
    if (!is_search() && (is_product_category() || is_product())) {

		$post = get_queried_object();
		$terms = get_the_terms($post->ID, 'product_cat');
		$store = get_product_store($terms);
		
		if (is_product()) {

	    		include(locate_template('/store-parts/section-footer-top.php', false, false));

    		} 	
    	
		include(locate_template('/store-parts/section-footer-value-bar.php', false, false));
    	
	} elseif (is_search()) {
		
		$store = get_queried_object();
		
		include(locate_template('/store-parts/section-footer-value-bar.php', false, false));
		
	}
}

/**
 * Remove the breadcrumbs on archive pages
 */
add_action( 'woocommerce_before_main_content', 'xtremetm_remove_wc_breadcrumbs' );
 
function xtremetm_remove_wc_breadcrumbs() {
	
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

}

/**
 * Reposition WooCommerce breadcrumb
 */
add_action( 'xtremetm_custom_breadcrumb', 'woocommerce_custom_breadcrumb' );

function woocommerce_custom_breadcrumb() {
	$args = array(
		'delimiter' => '<i class="fas fa-chevron-right"></i>',
		'wrap_before' => '<div class="woocommerce-breadcrumb"><div class="container"><div class="row"><div class="col">',
		'wrap_after' => '</div></div></div></div>',
		'home' => false,
	);
	
    woocommerce_breadcrumb($args);
}

/**
 * Remove term descriptions from post editor
 */
function xtremetm_hide_cat_desc() { ?>

    <style type="text/css">
		.term-description-wrap, .form-field .description {
			display: none;
		}
		#product_cat_thumbnail {
			display: inline-block;
			float: none !important;
		}
		#product_cat_thumbnail img {
			width: 100% !important;
		}
    </style>

<?php } 

add_action( 'admin_head-term.php', 'xtremetm_hide_cat_desc' );
add_action( 'admin_head-edit-tags.php', 'xtremetm_hide_cat_desc' );

/**
 * Modify loop price output for variable products
 */
add_filter('woocommerce_variable_sale_price_html', 'xtremetm_product_minmax_price_html', 10, 2);
add_filter('woocommerce_variable_price_html', 'xtremetm_product_minmax_price_html', 10, 2);

function xtremetm_product_minmax_price_html($price, $product) {
    $variation_min_price = $product->get_variation_price('min', true);
    $variation_max_price = $product->get_variation_price('max', true);
    $variation_min_regular_price = $product->get_variation_regular_price('min', true);
    $variation_max_regular_price = $product->get_variation_regular_price('max', true);

    if (($variation_min_price == $variation_min_regular_price) && ($variation_max_price == $variation_max_regular_price)) {
        $html_min_max_price = $price;
    } else {
        $html_price = '<div class="price d-flex">';
        $html_price .= '<div>' . wc_price($variation_min_price) /* . '-' . wc_price($variation_max_price)  */. '</div>';
        $html_price .= '<div><del>' . wc_price($variation_min_regular_price) /* . '-' . wc_price($variation_max_regular_price) */ . '</del></div></div>';
        $html_min_max_price = $html_price;
    }

    return $html_min_max_price;
}

/**
 * Remove "Select options" button from (variable) products on the main WooCommerce shop page.
 */
add_filter( 'woocommerce_loop_add_to_cart_link', function( $product ) {

	global $product;

	if ( is_shop() && $product->is_type('variable')) {
		return '';
	} else {
		sprintf( '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
			esc_url( $product->add_to_cart_url() ),
			esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
			esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
			isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
			esc_html( $product->add_to_cart_text() )
		);
	}

} );

/**
 * Remove reset variations from displaying
 */
add_filter( 'woocommerce_reset_variations_link', 'filter_woocommerce_reset_variations_link', 10, 1 ); 
function filter_woocommerce_reset_variations_link( $link ) { 
    return ''; 
}; 

add_action( 'wp_footer', 'xtremetm_cart_refresh_update_qty' ); 
 
function xtremetm_cart_refresh_update_qty() { 
    if (is_cart()) { 
        ?> 
        <script type="text/javascript"> 
            jQuery('div.woocommerce').on('change', '.qty', function(){ 
                jQuery("[name='update_cart']").trigger("click"); 
            }); 
        </script> 
        <?php 
    } 
}

/**
 * Add registration fields
 */
add_action( 'woocommerce_register_form_start', 'xtremetm_extra_register_fields' );
function xtremetm_extra_register_fields() {?>
	<p class="form-row form-row-first">
		<label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?><span class="required">*</span></label>
		<input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
	</p>
	<p class="form-row form-row-last">
		<label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?><span class="required">*</span></label>
		<input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
	</p>
	<p class="form-row form-row-wide">
		<label for="reg_billing_phone"><?php _e( 'Phone', 'woocommerce' ); ?><span class="required">*</span></label>
		<input type="text" class="input-text" name="billing_phone" id="reg_billing_phone" value="<?php if(isset($_POST['billing_phone'])): esc_attr_e( $_POST['billing_phone'] ); endif; ?>" />
	</p>
	<div class="clear"></div>
	<?php
 }

/**
 * Validate registration fields
 */ 
function wooc_validate_extra_register_fields( $username, $email, $validation_errors ) {

	if ( isset( $_POST['billing_phone'] ) && empty( $_POST['billing_phone'] ) ) {
	
		$validation_errors->add( 'billing_phone_error', __( '<strong>Error</strong>: Phone number is required.', 'woocommerce' ) );
	
	}
	if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
	
		$validation_errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: First name is required.', 'woocommerce' ) );
	
	}
	
	if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
		
		$validation_errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Last name is required.', 'woocommerce' ) );
	
	}
	 return $validation_errors;
}
 
add_action( 'woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 );

/**
 * Add ship to event field on checkout page
 */ 
add_action('woocommerce_after_order_notes', 'ship_to_event_field');

function ship_to_event_field($checkout) {
	
	$events = array();
	
	$events['blank'] = 'Select an Event';
	
	while (have_rows('event_shipping', 'options')) {
		the_row();
		$event_name = get_sub_field('event_name');
		
		$events[$event_name] = $event_name;
	}
	
	echo '<div id="ship-to-event" class="mt-1" style="display: none;">';
	
	woocommerce_form_field('ship_to_event_list', array(
		'type' => 'select',
		'label' => __('') ,
		'placeholder' => __('Select an Event') ,
		'options' => $events,
		'required' => false,
		'input_class' => array('form-check'),
	), $checkout->get_value('ship_to_event_list'));
	
	echo '</div>';

}
add_filter( 'woocommerce_ship_to_different_address_checked', '__return_true' );
/**
 * Ajax function to return event shipping address meta values
 */ 
add_action("wp_ajax_get_event_address", "get_event_address");
add_action("wp_ajax_nopriv_get_event_address", "get_event_address");

function get_event_address() {  
	
	if ( !wp_verify_nonce( $_POST['security'], 'ajax_nonce') ) {
	
		wp_send_json_error( array('message' => 'Nonce is invalid.') );
	
	}
	
	while (have_rows('event_shipping', 'options')) {
	
		the_row();
	
		if (get_sub_field('event_name') == $_POST['eventname']) {
			
			$event['street'] = get_sub_field('event_address_street');
			$event['city'] = get_sub_field('event_address_city');
			$event['state'] = get_sub_field('event_address_state');
			$event['zip'] = get_sub_field('event_address_zip');
			
			wp_send_json_success( array('message' => 'success', 'address' => $event) );
		}
	}
	
	wp_send_json_error( array('message' => 'No event found.') );
} 
/**
 * Gravity Forms
 */
add_filter( 'gform_submit_button_1', 'xtremetm_form_submit_button', 10, 2 );
function xtremetm_form_submit_button( $button, $form ) {
    return "<button class='btn btn-primary' id='gform_submit_button_{$form['id']}'><i class='fas fa-chevron-right'></i></button>";
}

/**
 * Yoast SEO
 */
add_action( 'admin_init', function() {
    if ( class_exists( 'Yoast_Notification_Center' ) ) {
        $yoast_nc = Yoast_Notification_Center::get();
        remove_action( 'admin_notices', array( $yoast_nc, 'display_notifications' ) );
        remove_action( 'all_admin_notices', array( $yoast_nc, 'display_notifications' ) );
    }
});

/**
 * Jetpack - turn off upsell ads
 */
add_filter( 'jetpack_just_in_time_msgs', '_return_false' );

/**
 * Woocommerce - turn off upsell ads
 */
add_filter( 'woocommerce_helper_suppress_admin_notices', '__return_true' );