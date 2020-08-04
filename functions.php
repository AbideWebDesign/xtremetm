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
		    $wp_admin_bar->remove_menu( 'customize' );
		    $wp_admin_bar->remove_node( 'updates' );
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
	
	wp_enqueue_script( 'core', get_template_directory_uri() . '/js/core.js', array(), '', false );	

	wp_enqueue_script( 'popper.min', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array(), '', true );
	
	wp_enqueue_script( 'bootstrap.min', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array(), '', true );
	
	wp_enqueue_script( 'product-filters', home_url() . '/wp-content/plugins/woocommerce-product-filters/assets/prod/styles/plugin.css', array(), '', true );
	
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
add_image_size('hero banner', 1600, 500, true);

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
 * Allow SVG
 */
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/**
 * Add Bootstrap 4 Nav walker
 */
require_once("bs4Navwalker.php");

/**
 * Add Bootstrap 4 inline list classes
 */
function bootstrap_inline_list_class($classes, $item, $args) {

	if ( 'top-links-logged-in' == $args->theme_location || 'top-links' == $args->theme_location ) {
		
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
     
    $allowed = array( 'abide_admin' );
     
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

// Remove unused scripts
add_action( 'wp_enqueue_scripts', 'dequeue_stylesandscripts', 100 );
function dequeue_stylesandscripts() {
	
	wp_dequeue_style( 'wc-block-style' );
	wp_dequeue_style( 'wp-block-library' );
	
    if ( !is_woocommerce() && !is_cart() && !is_checkout() ) {
        
        wp_dequeue_style( 'selectWoo' );
        wp_deregister_style( 'selectWoo' );
 
        wp_dequeue_script( 'selectWoo');
        wp_deregister_script('selectWoo');

    } 
    
    if ( !is_product_category() ) {
	    
	    // Remove product filter plugin scripts
	    wp_dequeue_script( 'wcpf-plugin-vendor-script' );
	    wp_dequeue_script( 'wcpf-plugin-script' );
	    wp_dequeue_script( 'accounting' );
	    wp_dequeue_script( 'wcpf-plugin-polyfills-script' );
	    
	    wp_dequeue_style( 'wcpf-plugin-style' );

	}
	
	if ( !is_checkout() ) {
		
		// Remove payment gateway scripts/styles
		wp_dequeue_style( 'sv-wc-payment-gateway-payment-form' );
		wp_dequeue_script( 'wc-intuit-payments' );
		wp_dequeue_script( 'sv-wc-payment-gateway-payment-form' );
	}

} 

// Register main datepicker jQuery plugin script
add_action( 'wp_enqueue_scripts', 'enabling_date_picker' );
function enabling_date_picker() {

    // Only on front-end and checkout page
    if( is_admin() || !is_account_page() ) return;

    // Load the datepicker jQuery-ui plugin script
    wp_enqueue_script( 'jquery-ui-datepicker' );
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
 * Add custom fields to registration
 */

add_action( 'woocommerce_register_form', 'xtremetm_add_register_fields_woocommerce', 15 );

function xtremetm_add_register_fields_woocommerce() { ?>
    
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
	
	xtremetm_add_custom_fields_woocommerce();
}

add_action( 'woocommerce_edit_account_form_start', 'xtremetm_add_custom_fields_woocommerce', 10 );

function xtremetm_add_custom_fields_woocommerce() {
	
	if ( current_user_can( 'reseller' ) || ! is_user_logged_in() ) {
		
		$userMeta = get_user_meta( get_current_user_id() );
		
		$custom_fields = apply_filters( 'woocommerce_forms_field', xtremetm_custom_setup_fields() );
		
		echo '<h3 class="mb-0">Resale Account</h3>';
	
		foreach ( $custom_fields as $key => $field_args ) {
			
			if ( $field_args['id'] == 'resale_account' ) {
				
				// Display resale select field only on registration
				
				if ( !is_user_logged_in() ) {
					
					woocommerce_form_field( $key, $field_args );
					
				}
				
			} else {
			
				$id = $field_args['id'];
				woocommerce_form_field( $key, $field_args, $userMeta[$id][0] );

			}
		
		}
			
	}	
	
	if ( current_user_can( 'reseller' ) ) {
		
		// Add space below reseller account information on edit account page.
		
		echo '<div class="mb-2"></div>';
	
	}

}

function xtremetm_custom_setup_fields() {
    
    $fields = array(
		array(
            'type'        => 'select',
            'label'       => __( 'Create Resale Account', 'xtremetm' ),
            'placeholder' => __( 'No', 'xtremetm' ),
            'id'		  => 'resale_account',
            'required'    => false,
            'options' 	  => array('no' => 'No', 'yes' => 'Yes'),
		),
	    array(
            'type'        => 'text',
            'label'       => __( 'Resale Certificate Number', 'xtremetm' ),
            'id'		  => 'resale_certificate_number',
            'placeholder' => __( '', 'xtremetm' ),
            'required'    => true,
		),
		array(
            'type'        => 'state',
            'label'       => __( 'Resale State', 'xtremetm' ),
            'id'		  => 'resale_state',
            'class' 	  => ['address-field'],
            'validate' 	  => ['state'],
            'required'    => true,
		),
		array(
            'type'        => 'date',
            'label'       => __( 'Resale Date', 'xtremetm' ),
            'placeholder' => __( '', 'xtremetm' ),
            'id'		  => 'resale_date',
            'required'    => true,
		)		
    );   

    return $fields;
}

/**
 * Validate custom registration fields
 */ 
 
add_action( 'woocommerce_register_post', 'xtremetm_validate_extra_register_fields', 10, 3 );

function xtremetm_validate_extra_register_fields( $username, $email, $validation_errors ) {
			
	return xtremetm_custom_validations( $validation_errors );
}

add_action( 'woocommerce_save_account_details_errors', 'xtremetm_validate_extra_fields', 10, 1 );

function xtremetm_validate_extra_fields( $validation_errors ) {
	
	$validation_errors = xtremetm_custom_validations( $validation_errors );
		
}

function xtremetm_custom_validations( $validation_errors ) {
	
	if ( isset( $_POST['billing_phone'] ) && empty( $_POST['billing_phone'] ) ) {
	
		$validation_errors->add( 'billing_phone_error', __( 'Phone number is required.', 'woocommerce' ) );
	
	}
	if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {
	
		$validation_errors->add( 'billing_first_name_error', __( 'First name is required.', 'woocommerce' ) );
	
	}
	
	if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {
		
		$validation_errors->add( 'billing_last_name_error', __( 'Last name is required.', 'woocommerce' ) );
	
	}
	
	if ( (isset( $_POST['0'] ) && $_POST['0'] == 'yes') || current_user_can('reseller') ) {
		
		if ( isset( $_POST['1'] ) && empty( $_POST['1'] ) ) {

			$validation_errors->add( 'resale_certificate_number', __( 'Resale certificate number is required.', 'woocommerce' ) );
	
		}
		
		if ( isset( $_POST['2'] ) && empty( $_POST['2'] ) ) {

			$validation_errors->add( 'resale_state', __( 'Resale state is required.', 'woocommerce' ) );
	
		}
		
		if ( isset( $_POST['3'] ) && empty( $_POST['3'] ) ) {

			$validation_errors->add( 'resale_date', __( 'Resale expiration date is required.', 'woocommerce' ) );
	
		}
	
	}
	
	return $validation_errors;

}

/**
 * Save custom registration fields
 */ 
 
add_action( 'woocommerce_created_customer', 'xtremetm_save_extra_register_fields' );
add_action( 'personal_options_update', 'xtremetm_save_extra_register_fields' ); // edit own account admin
add_action( 'edit_user_profile_update', 'xtremetm_save_extra_register_fields' ); // edit other account admin
add_action( 'woocommerce_save_account_details', 'xtremetm_save_extra_register_fields' ); // edit WC account

function xtremetm_save_extra_register_fields( $customer_id ) {

	if ( isset( $_POST['billing_first_name'] ) ) {
	
		// WordPress default first name field.
		
		update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
		
		
		// WooCommerce billing first name.
		
		update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
	
	}
	
	if ( isset( $_POST['billing_last_name'] ) ) {
	
		// WordPress default last name field.
		
		update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
		
		
		// WooCommerce billing last name.
		
		update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
	
	}
	
	if ( isset( $_POST['billing_phone'] ) ) {
		
		// WooCommerce billing phone
		
		update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
		
	}
	
	if ( isset( $_POST['0'] ) && $_POST['0'] == 'yes' && !current_user_can('reseller') ) {

		// Create reseller account
		
		$user = get_user_by( 'id', $customer_id );
		$user->set_role('reseller');
		
		update_user_meta( $customer_id, 'resale_account', sanitize_text_field( $_POST['0'] ) );
		update_user_meta( $customer_id, 'resale_certificate_number', sanitize_text_field( $_POST['1'] ) );
		update_user_meta( $customer_id, 'resale_state', sanitize_text_field( $_POST['2'] ) );
		update_user_meta( $customer_id, 'resale_date', $_POST['3'] );
		update_user_meta( $customer_id, 'tax_exemption_type', 'wholesale' ); // Needed for TaxJar plugin
		update_user_meta( $customer_id, 'tax_exempt_regions', sanitize_text_field( $_POST['2'] ) ); // Needed for TaxJar plugin
		
	} elseif ( current_user_can('reseller') ) {
		
		// Handel edit account page
		
		if ( isset( $_POST['1'] ) ) {
	      
	      update_user_meta( $customer_id, 'resale_certificate_number', sanitize_text_field( $_POST['1'] ) );
	      
		}

		if ( isset( $_POST['2'] ) ) {
	      
	      update_user_meta( $customer_id, 'resale_state', sanitize_text_field( $_POST['2'] ) );
	      
		}
		
		if ( isset( $_POST['3'] ) ) {
	      
	      update_user_meta( $customer_id, 'resale_date', $_POST['3'] );
	      
		}
	
	}

}

/**
 * Change order of account tabs
 */

add_filter ( 'woocommerce_account_menu_items', 'xtremetm_reorder_my_account_menu' );

function xtremetm_reorder_my_account_menu() {
    $order = array(
        'edit-account'       => __( 'Account Details', 'woocommerce' ),
        'orders'             => __( 'Previous Orders', 'woocommerce' ),
        'edit-address'       => __( 'Addresses', 'woocommerce' ),
        'customer-logout'    => __( 'Logout', 'woocommerce' ),
    );
    return $order;
}

/**
 * Add store to body class
 */
add_filter( 'body_class', 'xtremetm_body_classes' );

function xtremetm_body_classes( $classes ) {

	global $wp_query;

	$obj = $wp_query->get_queried_object();
		
	if ( is_product() ) { 
		
		$terms = get_the_terms($obj, 'product_cat');
		
		$store = get_product_store($terms);

		$classes[] = 'store-' . $store->slug;
		
	} elseif ( is_product_category() ) {
		
		$store = get_top_level($obj);

		$classes[] = 'store-' . $store->slug;
		
	}
	
	return $classes;
}

/**
 * Setup custom field rules for product categories (stores)
 */
add_filter( 'acf/location/rule_types', 'acf_wc_product_type_rule_type' );

function acf_wc_product_type_rule_type( $choices ) {

	if ( !isset( $choices['Product'] ) ) {

	  $choices['Product'] = array();

	}

	// now add the 'Category' rule to it
	if ( !isset( $choices['Product']['product_cat'] ) ) {

	  // product_cat is the taxonomy name for woocommerce products
	  $choices['Product']['product_cat_term'] = 'Product Category Term';

	}

	return $choices;
}

add_filter('acf/location/rule_values/product_cat_term', 'acf_wc_product_type_rule_values');

function acf_wc_product_type_rule_values( $choices ) {

	$args = array(
	  'taxonomy' => 'product_cat',
	  'hide_empty' => false
	);
	$terms = get_terms( $args );
	
	foreach ( $terms as $term ) {
		$choices[$term->term_id] = $term->name;
	}
	
	return $choices;
}

add_filter( 'acf/location/rule_match/product_cat_term', 'acf_wc_product_type_rule_match', 10, 3 );

function acf_wc_product_type_rule_match( $match, $rule, $options ) {
	
	if ( !isset($_GET['tag_ID']) ) {
	
		// tag id is not set
		return $match;
	
	}
	
	if ( $rule['operator'] == '==' ) {
	
	  $match = ( $rule['value'] == $_GET['tag_ID'] );
	
	} else {
	
	  $match = !( $rule['value'] == $_GET['tag_ID'] );
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
	$terms = get_the_terms( $product->ID, 'product_cat' );
	$store = get_product_store( $terms );
	
	echo '<h2>Shipping Policy</h2>';
	
	the_field( 'shipping_policy', $store );
	
	echo '<h2>Return Policy</h2>';
	
	the_field( 'return_policy', $store );
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
function get_top_level( $term ) {

	if ( is_shop() ) {
		
		return $term;
	
	} elseif ( $term->parent > 0 ) {
       
        $term = get_term_by( 'id', $term->parent, 'product_cat' );
       
        return get_top_level( $term );
    
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

	if ( is_category() || is_tax() ) {

		if( $obj->parent == 0 ) {
						
			$product_cat = get_term_by( 'slug', $wp_query->get('product_cat'), 'product_cat' );
			// This is the top level
			$cats = get_terms( 'product_cat', array( 'child_of' => $product_cat->term_taxonomy_id, 'hide_empty' => false ) );
	
			return( $cats );
			
		} else {
			
			// Not top level. Get top level
			
			$parent = get_top_level( $obj );
	
			$cats = get_terms( 'product_cat', array( 'child_of' => $parent->term_taxonomy_id, 'hide_empty' => false ) );
			
			return( $cats );
			
		}
	} elseif ( is_product() ) {
		
		$terms = get_the_terms( $obj->ID, 'product_cat' ); 
		
		$store = get_product_store( $terms );
		
		$cats = get_terms( 'product_cat', array( 'child_of' => $store->term_taxonomy_id, 'hide_empty' => false ) );
	
		return( $cats );

	}
}

/**
 * Return top level store for product
 */
function get_product_store( $terms ) {
	
	if ( $terms ) {
		foreach( $terms as $term ) {
			
			if ( $term->parent == 0 ) {
			
				return( $term );
			
			}
		}
	}
}
 
/**
 * Opening div for content wrapper
 */
add_action( 'woocommerce_before_main_content', 'xtremetm_open_div', 5 );

function xtremetm_open_div() {
	
	echo '<div id="global-store-container"><div class="container">';

}

/**
 * Closing content for after content wrapper
 */
add_action( 'woocommerce_after_main_content', 'xtremetm_close_div', 50 );

function xtremetm_close_div() {
   
    echo '</div></div>';
    
    if ( !is_search() && ( is_product_category() || is_product() ) ) {

		$post = get_queried_object();
		$terms = get_the_terms($post->ID, 'product_cat');
		$store = get_product_store($terms);
		
		if ( is_product() ) {

	    		include(locate_template('/store-parts/section-footer-top.php', false, false));

    		} 	
    	
		include(locate_template('/store-parts/section-footer-value-bar.php', false, false));
    	
	} elseif (is_search()) {
		
		$store = get_queried_object();
		
		include(locate_template('/store-parts/section-footer-value-bar.php', false, false));
		
	}
}

add_filter( 'woocommerce_ship_to_different_address_checked', '__return_true' );

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
	
    woocommerce_breadcrumb( $args );
    
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
add_filter( 'woocommerce_variable_sale_price_html', 'xtremetm_product_minmax_price_html', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'xtremetm_product_minmax_price_html', 10, 2 );

function xtremetm_product_minmax_price_html( $price, $product ) {
   
    $variation_min_price = $product->get_variation_price( 'min', true );
    $variation_max_price = $product->get_variation_price( 'max', true );
    $variation_min_regular_price = $product->get_variation_regular_price( 'min', true );
    $variation_max_regular_price = $product->get_variation_regular_price( 'max', true );

    if ( ( $variation_min_price == $variation_min_regular_price ) && ( $variation_max_price == $variation_max_regular_price ) ) {
       
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

	if ( is_shop() && $product->is_type('variable') ) {
		
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
    
    if ( is_cart() ) {
	     
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
 * Add ship to event field on checkout page
 */ 
add_action('woocommerce_after_order_notes', 'ship_to_event_field');

function ship_to_event_field( $checkout ) {
	
	$events = array();
	
	$events['blank'] = 'Select an Event';
	
	while ( have_rows('event_shipping', 'options') ) {
		
		the_row();
		
		$event_name = get_sub_field('event_name');
		
		$events[$event_name] = $event_name;
	}

	if ( WC()->session->get( 'ship_to_event') == 'true' ) {
		
		echo '<div id="ship-to-event" class="bg-light">';
		
	} else {
		
		echo '<div id="ship-to-event" class="bg-light" style="display: none;">';
		
	}
	
	woocommerce_form_field( 'ship_to_event_list', array(
		'type' 			=> 'select',
		'label' 		=> __('Event') ,
		'placeholder' 	=> __('Select an Event') ,
		'options' 		=> $events,
		'required' 		=> true,
		'input_class' 	=> array('form-check'),
		'default' 		=> WC()->session->get( 'ship_to_event_name')
	), $checkout->get_value( 'ship_to_event_list' ) );
	
	echo '</div>';

}

/**
 * Ajax function to return event shipping address meta values
 */ 
add_action( 'wp_ajax_set_event_session', 'set_event_session' );
add_action( 'wp_ajax_nopriv_set_event_session', 'set_event_session' );

function set_event_session() {

	if ( !wp_verify_nonce( $_POST['security'], 'ajax_nonce' ) ) {

		wp_send_json_error( array( 'message' => 'Nonce is invalid.' ) );
	
	}
	
	if ( $_POST['status'] ) {
		
		if ( WC()->session->get( 'ship_rush' ) ) {
			
			WC()->session->set( 'ship_rush', 'false' );
			
		}
		
	}
	
	if ( $_POST['event'] ) {
		
		WC()->session->set( 'ship_to_event_name',  $_POST['event'] );
		
	}
	
	WC()->session->set( 'ship_to_event', $_POST['status'] );
	
	wp_send_json_success( array( 'message' => 'success', 'status' => WC()->session->get( 'ship_to_event' ) ) );
	
}

add_action( 'wp_ajax_get_event_address', 'get_event_address' );
add_action( 'wp_ajax_nopriv_get_event_address', 'get_event_address' );

function get_event_address() {  

	if ( !wp_verify_nonce( $_POST['security'], 'ajax_nonce' ) ) {
	
		wp_send_json_error( array( 'message' => 'Nonce is invalid.' ) );
	
	}
	
	while ( have_rows( 'event_shipping', 'options' ) ) {
	
		the_row();
	
		if ( get_sub_field('event_name') == $_POST['eventname'] ) {
			
			$event['event_name'] = get_sub_field('event_name');
			$event['street'] = get_sub_field('event_address_street');
			$event['city'] = get_sub_field('event_address_city');
			$event['state'] = get_sub_field('event_address_state');
			$event['zip'] = get_sub_field('event_address_zip');
			
			WC()->session->set( 'ship_to_event_name', $event['event_name'] );	

			wp_send_json_success( array( 'message' => 'success', 'address' => $event ) );
			
		}
	}
	
	wp_send_json_error( array( 'message' => 'No event found.' ) );
	
}


/**
 * Ajax function to check if supplied shipping zip matches event
 */ 
add_action( 'wp_ajax_check_for_event', 'check_for_event' );
add_action( 'wp_ajax_nopriv_check_for_event', 'check_for_event' );

function check_for_event() {

	if ( !wp_verify_nonce( $_POST['security'], 'ajax_nonce' ) ) {
	
		wp_send_json_error( array( 'message' => 'Nonce is invalid.' ) );
	
	}	

	$events = array();
	$count = 0;
	$provided_zip = sanitize_text_field( $_POST['zip'] );
	
	while ( have_rows('event_shipping', 'options') ) {
		
		the_row();
		
		$event_zip = strtok( get_sub_field('event_address_zip'), '-' );
	
		if ( $event_zip == $provided_zip ) {
			
			$count++;
						
			$event['event_name'] = get_sub_field('event_name');
			$event['street'] = get_sub_field('event_address_street');
			$event['city'] = get_sub_field('event_address_city');
			$event['state'] = get_sub_field('event_address_state');
			$event['zip'] = get_sub_field('event_address_zip');
			
			$events[] = $event;
			
		}
		
	}
	
	if ( !empty( $events ) ) {
	
		wp_send_json_success( array( 'message' => 'success', 'events' => $events ) );
	
	} else {
		
		wp_send_json_error( array( 'message' => 'No event found.' ) );
		
	}
		
}

/*
 * Clear event session on order complete
*/ 
add_action( 'woocommerce_thankyou', 'clear_event_session_order_complete' );

function clear_event_session_order_complete( $order_id ) {
	
	WC()->session->__unset( 'ship_to_event_name' );
	WC()->session->__unset( 'ship_to_event' );
	WC()->session->__unset( 'ship_rush' );
	
}

/**
 * Custom rush shipping field
 */
add_action( 'woocommerce_cart_totals_after_shipping', 'xtremetm_rush_checkout_fields' );

function xtremetm_rush_checkout_fields( $checkout ) {

	// Rush Delivery
	if ( has_product_category_in_cart('indy-lights') || has_product_category_in_cart( 'indy-pro-2000') || has_product_category_in_cart( 'usf-2000' ) ) {
	
		echo '<tr id="ship-rush-wrap"><th>Rush Shipping</th><td>';
		  
		$checked =  WC()->session->get( 'ship_rush' ) == 'true' ? 1 : 0;
	
		woocommerce_form_field( 'ship-rush-checkbox', array (
			'type'	=> 'checkbox',
			'label'	=> __( 'Do you need these to arrive within 10 days?' ),
			'class' => array('mb-0'),
		), $checked );
		
		echo '<div id="ship-date-wrap" class="bg-primary text-white p-1"' . ( WC()->session->get( 'ship_rush' ) == 'true' ? '' : 'style="display: none;"' ) . '>';
		 
		echo '<h5 class="text-white mb-1">Preferred Arrival Date</h5><div class="text-sm mb-1">' . get_field('rush_shipping_message', 'options') . '</div>';
		
		// Delivery Date if Rush Delivery
	    $today = strtotime('today');
	    $tomorrow = strtotime('tomorrow');
	    $dayAfterTomorrow = strtotime('+10 days');
	    $dates[] = strtotime('today');
	    
	    for ( $x = 1; $x < 10; $x++ ) {
		    
		    $dates[] = strtotime( '+' . $x . ' days' );
		    
	    }
		
	    woocommerce_form_field( 'delivery_date', array (
	        'type'		=> 'select',
	        'label'		=> __( '' ),
	        'class'		=> array( 'mb-0' ),
	        'options'	=> array(
				date( get_option('date_format'), $dates[0] ) => date( get_option('date_format'), $dates[0] ),
				date( get_option('date_format'), $dates[1] ) => date( get_option('date_format'), $dates[1] ),
				date( get_option('date_format'), $dates[2] ) => date( get_option('date_format'), $dates[2] ),
				date( get_option('date_format'), $dates[3] ) => date( get_option('date_format'), $dates[3] ),
				date( get_option('date_format'), $dates[4] ) => date( get_option('date_format'), $dates[4] ),
				date( get_option('date_format'), $dates[5] ) => date( get_option('date_format'), $dates[5] ),
				date( get_option('date_format'), $dates[6] ) => date( get_option('date_format'), $dates[6] ),
				date( get_option('date_format'), $dates[7] ) => date( get_option('date_format'), $dates[7] ),
				date( get_option('date_format'), $dates[8] ) => date( get_option('date_format'), $dates[8] ),
				date( get_option('date_format'), $dates[9] ) => date( get_option('date_format'), $dates[9] ),
	        ) ) );
	        
	    echo '</td></tr>';
	
	}
	
}

/**
 * Ajax function to set rush session
 */ 
add_action( 'wp_ajax_set_rush_session', 'set_rush_session' );
add_action( 'wp_ajax_nopriv_set_rush_session', 'set_rush_session' );

function set_rush_session() {

	if ( !wp_verify_nonce( $_POST['security'], 'ajax_nonce' ) ) {

		wp_send_json_error( array( 'message' => 'Nonce is invalid.' ) );
	
	}
	
	WC()->session->set( 'ship_rush', $_POST['status'] );
	
	wp_send_json_success( array( 'status' => WC()->session->get( 'ship_rush' ) ) );
	
}

/**
 * Calculate custom rush order fee
 */
add_filter( 'woocommerce_cart_calculate_fees', 'xtremetm_add_rush_fee', 10, 1 );

function xtremetm_add_rush_fee( $cart ) {
	
	// Only on checkout
    if ( ( is_admin() && ! defined( 'DOING_AJAX' ) ) || is_cart() )
    	return;
    
    $fee = 750;
        
	if ( WC()->session->get( 'ship_rush' ) == 'true' ) {
		
		WC()->cart->add_fee( 'Rush', $fee, false );
		
	} else {
		
		if ( WC()->session->get( 'ship_rush' ) ) {
			
			WC()->cart->add_fee( 'Rush', 0, false );
			
		}
		
	}
	
}

/**
 * Function to calculate order weight
 */
function get_order_weight( $order_id ) {
	
	$order = wc_get_order( $order_id );
	$total_weight = 0;
	
	foreach ( $order->get_items() as $item_id => $product_item ) {
		
		$quantity = $product_item->get_quantity(); // get quantity
		$product = $product_item->get_product(); // get the WC_Product object
		$product_weight = $product->get_weight(); // get the product weight
		// Add the line item weight to the total weight calculation
		$total_weight += floatval( $product_weight * $quantity );
		
	}	
	
	return ( $total_weight );
	
}

/**
 * Update the order meta with custom field value
 */
add_action( 'woocommerce_checkout_update_order_meta', 'xtremetm_rush_checkout_field_update_order_meta' );

function xtremetm_rush_checkout_field_update_order_meta( $order_id ) {

	if ( ! empty( $_POST['ship_to_event_list'] ) && $_POST['ship_to_event_list'] != 'blank' ) {
	
		update_post_meta( $order_id, 'Ship to Event', sanitize_text_field( $_POST['ship_to_event_list'] ) );
	
	}
	
	if ( ! empty( $_POST['delivery_date'] ) && $_POST['ship-rush-checkbox'] ) {
		
		update_post_meta( $order_id, 'rush_delivery', true );
		
		update_post_meta( $order_id, 'rush_delivery_date', sanitize_text_field( $_POST['delivery_date'] ) );
	
	}

	// Calculate order weight
	$total_weight = get_order_weight( $order_id );
	
	add_post_meta( $order->id, 'order_weight', $total_weight, false );
	
}

/**
 * Display custom field on the order edit page
 */
add_action( 'woocommerce_admin_order_data_after_shipping_address', 'xtremetm_rush_checkout_field_display_admin_order_meta', 10, 1 );

function xtremetm_rush_checkout_field_display_admin_order_meta( $order ) {
	
	// Total order weight
	if ( !metadata_exists( 'post', $order->id, 'order_weight' ) ) {
		
		$total_weight = get_order_weight( $order->id );
	
		add_post_meta( $order->id, 'order_weight', $total_weight, false );
		
	} 
	
	echo '<p><strong>' . __( 'Total Order Weight: ', 'xtremetm' ) . '</strong><br>' . get_post_meta( $order->id, 'order_weight', true ) . 'kg</p>';	

	// Check ship to event
	if ( ! empty( get_post_meta( $order->id, 'Ship to Event', true ) ) ) {
		
		echo '<p><strong>' . __('Ship to Event', 'xtremetm') . ':</strong> ' . get_post_meta( $order->id, 'Ship to Event', true ) . '</p>';
	
	}

	// Check rush delivery
	if ( ! empty( get_post_meta( $order->id, 'rush_delivery', true ) ) ) {
		
		echo '<p><strong>' . __('Rush Delivery', 'xtremetm') . ':</strong> Yes</p>';
		
		echo '<p><strong>' . __('Rush Delivery Date', 'xtremetm') . ':</strong> ' . get_post_meta( $order->id, 'rush_delivery_date', true ) . '</p>';
	
	}
	
}

/*
 * Add rush delivery field to emails
 */
add_action( 'woocommerce_email_order_meta', 'xtremetm_email_order_meta_fields', 10, 3 );

function xtremetm_email_order_meta_fields( $order_obj, $sent_to_admin, $plain_text ) {
	
	$is_rush = get_post_meta( $order_obj->get_order_number(), 'rush_delivery', true );
 
	// we won't display anything if it is not rush
	if ( empty( $is_rush ) )
		return;
	
	$date = get_post_meta( $order_obj->get_order_number(), 'rush_delivery_date', true );
	
	echo '<h2>Rush Delivery Date</h2><strong>' . $date . '</strong><br><br>';

}

/*
 * Utility function that checks if at least a cart items remains to a product category
 */
function has_product_category_in_cart( $product_category ) {
    
    // Loop through cart items
    foreach ( WC()->cart->get_cart() as $cart_item ) {
    
        // If any product category is found in cart items

        if ( has_term( $product_category, 'product_cat', $cart_item['product_id'] ) ) {
    
            return true;
    
        }
    
    }
    
    return false;
}

/**
 * Customize all fields
 */
add_filter( 'woocommerce_form_field' , 'xtremetm_override_fields', 10, 4 );

function xtremetm_override_fields( $field, $key, $args, $value ) {
	
	// Remove optional label
	$optional = '&nbsp;<span class="optional">(' . esc_html__( 'optional', 'woocommerce' ) . ')</span>';
	$field = str_replace( $optional, '', $field );
    
    return $field;
    
}

/**
 * Customize checkout fields
 */
add_filter( 'woocommerce_checkout_fields' , 'xtremetm_override_checkout_fields', 100 );

function xtremetm_override_checkout_fields( $checkout_fields ) {
    
    // Change labels
	$checkout_fields['shipping']['shipping_company']['label'] = 'Company/Event Name';
	$checkout_fields['shipping']['shipping_state']['class']	= array('address-field', 'form-row-first');
	$checkout_fields['shipping']['shipping_postcode']['class'] = array('address-field', 'form-row-last');

	$checkout_fields['billing']['billing_country']['priority'] = 91;
	$checkout_fields['billing']['billing_state']['class'] = array('form-row-first');
	$checkout_fields['billing']['billing_postcode']['class'] = array('form-row-last');
	$checkout_fields['billing']['billing_phone']['class'] = array('form-row-first');
	$checkout_fields['billing']['billing_email']['class'] = array('form-row-last');
	
	return $checkout_fields;
     
}

/**
 * Custom shipping method logic
 */
add_filter( 'woocommerce_package_rates', 'xtremetm_shipping_methods', 100 );

function xtremetm_shipping_methods( $rates ) {

	// Set free shipping for shipping to events. NOTE: production is fedex:8 and free_shipping:9, dev is fedex:7 and free_shipping:8
	if ( WC()->session->get( 'ship_to_event' ) == 'true' ) {
		
		unset( $rates['free_shipping:9'] );
		unset( $rates['odfl'] );
		unset( $rates['fedex:8:FEDEX_GROUND'] );
		unset( $rates['fedex:8:FEDEX_EXPRESS_SAVER'] );
		unset( $rates['fedex:8:FEDEX_2_DAY'] );
		unset( $rates['fedex:8:STANDARD_OVERNIGHT'] );
		unset( $rates['fedex:8:PRIORITY_OVERNIGHT'] );
				
	} elseif ( WC()->session->get( 'ship_rush' ) == 'true' ) {
		
		unset( $rates['flat_rate:4'] );
		unset( $rates['odfl'] );
		unset( $rates['fedex:8:FEDEX_GROUND'] );
		unset( $rates['fedex:8:FEDEX_EXPRESS_SAVER'] );
		unset( $rates['fedex:8:FEDEX_2_DAY'] );
		unset( $rates['fedex:8:STANDARD_OVERNIGHT'] );
		unset( $rates['fedex:8:PRIORITY_OVERNIGHT'] );	
		
	} elseif ( has_product_category_in_cart( 'rally-contract' ) && WC()->cart->get_cart_contents_count() >= 20 ) {
	
		unset( $rates['free_shipping:9'] );
		unset( $rates['odfl'] );
		unset( $rates['fedex:8:FEDEX_GROUND'] );
		unset( $rates['fedex:8:FEDEX_EXPRESS_SAVER'] );
		unset( $rates['fedex:8:FEDEX_2_DAY'] );
		unset( $rates['fedex:8:STANDARD_OVERNIGHT'] );
		unset( $rates['fedex:8:PRIORITY_OVERNIGHT'] );
		
	} else {

		// Remove free shipping methods
		unset( $rates['flat_rate:4'] );
		unset( $rates['free_shipping:9'] );
		
		if ( WC()->cart->get_cart_contents_count() >= 8 ) {
			
			unset( $rates['fedex:8:FEDEX_GROUND'] );
			unset( $rates['fedex:8:FEDEX_EXPRESS_SAVER'] );
			unset( $rates['fedex:8:FEDEX_2_DAY'] );
			unset( $rates['fedex:8:STANDARD_OVERNIGHT'] );
			unset( $rates['fedex:8:PRIORITY_OVERNIGHT'] );
			
		} else {
			
			unset( $rates['odfl'] );
			
			if ( has_product_category_in_cart('indy-lights') || has_product_category_in_cart( 'indy-pro-2000') || has_product_category_in_cart( 'usf-2000' ) ) {
	
				unset( $rates['fedex:8:FEDEX_EXPRESS_SAVER'] );
				unset( $rates['fedex:8:FEDEX_2_DAY'] );
				unset( $rates['fedex:8:STANDARD_OVERNIGHT'] );
				unset( $rates['fedex:8:PRIORITY_OVERNIGHT'] );	
				
			}
			
		}
		
	}
	
	return $rates;
	
}

/**
 * Add custom discount for ACH payment method purchases
 */
add_action('woocommerce_cart_calculate_fees' , 'woocommerce_add_ach_discount');

function woocommerce_add_ach_discount( WC_Cart $cart ){
	
	if ( is_admin() && ! defined( 'DOING_AJAX' ) || is_cart() ) {
		
		return;
	
	}

    if( WC()->session->chosen_payment_method == 'intuit_payments_echeck' ) {
	    
	    foreach ( $cart->get_cart() as $cart_item ) {
			
			$terms = wp_get_post_terms($cart_item['product_id'], 'product_cat', false);
			$store = get_product_store($terms);

			if ( $store->name == 'Rehv' || $store->name == 'Primis' ) {
				
				return;
				
			}
		   		    
	    }

	    // Calculate the amount to reduce
	    $discount = $cart->get_cart_contents_count() * 10;
	    $cart->add_fee( 'Bank Account Discount', -$discount);
	    
	}
	
}

/**
 * Change shipping method label
 */
add_filter( 'woocommerce_cart_shipping_method_full_label', 'xtremetm_shipping_labels', 10, 2 );

function xtremetm_shipping_labels( $full_label, $method ) {
    
    $full_label = str_replace( 'Shipping: ', '', $full_label );

	return $full_label;

}

/**
 * Index WooCommerce product_variation SKUs with the parent post
 */
add_filter( 'searchwp_extra_metadata', 'xtremetm_searchwp_index_woocommerce_variation_skus', 10, 2 );

function xtremetm_searchwp_index_woocommerce_variation_skus( $extra_meta, $post_being_indexed ) {
	
	if ( 'product' !== get_post_type( $post_being_indexed ) ) {
		
		return $extra_meta;
	
	}
	
	// retrieve all the product variations
	$args = array(
		'post_type'       => 'product_variation',
		'posts_per_page'  => -1,
		'fields'          => 'ids',
		'post_parent'     => $post_being_indexed->ID,
	);
	
	$product_variations = get_posts( $args );
	
	if ( ! empty( $product_variations ) ) {
		
		// store all SKUs as a Custom Field with a key of 'my_product_variation_skus'
		$extra_meta['xtremetm_product_variation_skus'] = array();
		
		// loop through all product variations, grab and store the SKU
		
		foreach ( $product_variations as $product_variation ) {
		
			$extra_meta['xtremetm_product_variation_skus'][] = get_post_meta( absint( $product_variation ), '_sku', true );
		
		}
	}
	
	return $extra_meta;
	
}

add_filter( 'searchwp_custom_field_keys', 'xtremetm_searchwp_custom_field_keys_variation_skus', 10, 1 );

function xtremetm_searchwp_custom_field_keys_variation_skus( $keys ) {
  
  $keys[] = 'xtremetm_product_variation_skus';
  
  return $keys;
  
}

/**
 * Redirect sku searches to go directly to product page with options selected
 */
add_action('template_redirect', 'xtremetm_searchwp_search_woocommerce_sku_redirect');

function xtremetm_searchwp_search_woocommerce_sku_redirect() {
	
	if ( is_search() ) {
      
        global $wp_query;

        if ( $wp_query->post_count == 1 ) {
	        
	        $product = wc_get_product( get_the_id() );

			if ( $product->get_stock_status() == 'outofstock' ) {
				
				wp_redirect( home_url('/out-of-stock/') );
				
				exit;
								
			}
	        
	        $sku = get_search_query();

			$args = array(
				'post_type'       => 'product_variation',
				'posts_per_page'  => 1,
				'fields'          => 'ids',
				'meta_query'      => array(
					array(
						'key'     => '_sku',
						'value'   => $sku,
					),
				),
			);
			
			$variation = get_posts( $args );
			
			if ( ! empty( $variation ) && function_exists( 'wc_get_attribute_taxonomy_names' ) ) {
				
				// this is a variation SKU, we need to prepopulate the filters
				$variation_id = absint( $variation[0] );
				$variation_obj = new WC_Product_Variation( $variation_id );
				$attributes = $variation_obj->get_variation_attributes();
				
				if ( !empty( $attributes ) ) {

					$permalink = add_query_arg( $attributes, get_permalink( $wp_query->posts['0']->ID ) );
					
					wp_redirect( $permalink );
				
				}
				 
			}
			
        }
        
    }
    
}

/**
 * Change out of stock message
 */
add_action( 'woocommerce_no_products_found', 'xtremetm_no_stock_message', 9);

function xtremetm_no_stock_message() {
    
    global $wp_query;
    
    $store_url = home_url('/store/') . $wp_query->queried_object->slug;
    
	remove_action( 'woocommerce_no_products_found', 'wc_no_products_found', 10 );
	
	$message = __( 'Whoops! Looks like that’s not a product we carry…please try your search one more time!', 'woocommerce' );
	
	echo '<div class="bg-white p-3 mt-2 mb-2 text-center"><h2 class="text-center mb-2">No Products Found</h2><p>' . $message .'</p><a href="' . $store_url . '" class="btn btn-primary"><span>Shop <i class="fas fa-chevron-right"></i></span></a></div>';
    
}

/**
 * Check for user role and turn off tax for that role
 */
add_action( 'template_redirect', 'xtremetm_no_tax_for_user', 1 );

function xtremetm_no_tax_for_user() {

	// check for the user role
	if ( is_user_logged_in() && valid_reseller() ) {

		// set the customer object to have no VAT
		WC()->customer->set_is_vat_exempt(true);
	}

}

/**
 * Filter the variable product hash based on user
 */
add_filter( 'woocommerce_get_variation_prices_hash', 'xtremetm_get_variation_prices_hash_filter', 1, 3 );

function xtremetm_get_variation_prices_hash_filter( $hash, $item, $display ) {

	// check for the user role
	if ( is_user_logged_in() && valid_reseller() ) {

		// clear key 2, which is where taxes are
		$hash['2'] = array();
		
	}

	// return the hash
	return $hash;
	
}

/**
 * Function that removes the price suffix (inc. Tax) from variable products based on role
 */
add_filter( 'woocommerce_get_price_suffix', 'xtremetm_get_price_suffix_filter', 10, 2 );

function xtremetm_get_price_suffix_filter( $price_display_suffix, $item ) {

	// check for the user role
	if ( is_user_logged_in() && valid_reseller() ) {

		// return blank if it matches
		return '';
		
	}

	// return if unmatched
	return $price_display_suffix;
	
}

function valid_reseller() {
	
	// Check to see if user has valid reseller account
	$current_user = wp_get_current_user();
	
	if ( !$current_user || !$current_user->roles ) {
           
            return false;
    
    }
    
	
	if ( current_user_can( 'reseller' ) && !current_user_can( 'administrator' ) ) {
		
		$tz = new DateTimeZone('America/Los_Angeles');
		
		$resale_date = new DateTime(get_user_meta($current_user->ID, 'resale_date', true));	
		$resale_date->setTimeZone($tz);

		$date_now = new DateTime();
		$date_now->setTimeZone($tz);

		if ( $date_now >= $resale_date ) {

			return false;
			
		} else {
			
			return true;
			
		}
		
	} else {
		
		return false;
		
	}
	
}

/**
 *  Function to clear inventory for import.
 */
add_action( 'clear_inventory_hook', 'clear_inventory', 10, 0 );

function clear_inventory() {
	
	$query = new WP_Query( array(
	    'post_type'       	=> 'product_variation',
	    'post_status'     	=> 'publish',
	    'posts_per_page' 	=> -1,
	    'numberposts'   	=> -1,
	    'post_parent__not_in' 	=> array('554', '543', '532', '516', '513', '510', '487', '496', '493', '490')
	) );

	while ( $query->have_posts() ) {
		
		$query->the_post();

		the_title();
		
		$variation = new WC_Product_Variation( get_the_id() );
		
		$variation->set_stock_status('outofstock');
		
		$variation->set_stock_quantity(0);
		
		$variation->save();
		
		echo "<br>SKU: " . $variation->get_sku() . "<br>";
	
		echo "Stock: " . $variation->get_stock_quantity() . "<br>";
		
		echo "Stock Status: " . $variation->get_stock_status() . "<br><br>";	
			
	}
	
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
    
} );

add_action( 'admin_head', 'xtremetm_hide_yoast_profile' );

function xtremetm_hide_yoast_profile() {
	
  echo '<style>
          form#your-profile > h3, form#your-profile .user-profile-picture, form#your-profile .user-description-wrap, form#your-profile .user-display-name-wrap, form#your-profile .user-nickname-wrap, form#your-profile .show-admin-bar, .user-comment-shortcuts-wrap, form#your-profile .yoast-settings, form#your-profile .user-rich-editing-wrap, form#your-profile .user-admin-color-wrap, form#your-profile .user-url-wrap, form#your-profile .user-facebook-wrap, form#your-profile .user-instagram-wrap, form#your-profile .user-linkedin-wrap, form#your-profile .user-myspace-wrap, form#your-profile .user-pinterest-wrap, form#your-profile .user-soundcloud-wrap, form#your-profile .user-tumblr-wrap, form#your-profile .user-twitter-wrap, form#your-profile .user-youtube-wrap, form#your-profile .user-wikipedia-wrap  {
               display: none;
          }
        </style>';
        
}
/**
 * Jetpack - turn off upsell ads
 */
add_filter( 'jetpack_just_in_time_msgs', '_return_false' );

/**
 * Woocommerce - turn off upsell ads
 */
add_filter( 'woocommerce_helper_suppress_admin_notices', '__return_true' );

/**
 * Woocommerce - turn off marketing tab
 */
add_filter( 'woocommerce_marketing_menu_items', 'xtremetm_hide_marketing_tab' );

function xtremetm_hide_marketing_tab( $marketing_pages ) {
	
	return array();

}

/**
 * Woocommerce - turn off analytics tab
 */
add_filter( 'woocommerce_admin_disabled', '__return_true' );