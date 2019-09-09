<?php
/**
 * christmas-shop functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package christmas-shop
 */


//define theme version
if ( !defined( 'CHRISTMAS_SHOP_THEME_VERSION' ) ) {
	$theme_data = wp_get_theme();
	
	define ( 'CHRISTMAS_SHOP_THEME_VERSION', $theme_data->get( 'Version' ) );
}

/* Declare Global Default Page ID*/
$christmas_shop_default_page = '';
$christmas_shop_page_array = get_pages();
if(is_array($christmas_shop_page_array)){
    $christmas_shop_default_page = $christmas_shop_page_array[0]->ID;
}

/* Declare Global Default Post ID*/
$christmas_shop_default_post = '';
$christmas_shop_post_array = get_posts();
if(is_array($christmas_shop_post_array)){
    $christmas_shop_default_post = $christmas_shop_post_array[0]->ID;
}


/**
 * Custom functions for this theme.
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Extra functions for this theme.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Wp hooks for this theme.
 */

require get_template_directory() . '/inc/wp-hooks.php';
/**
 * Metabox for this theme.
 */
require get_template_directory() . '/inc/metabox.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Template hooks for this theme.
 */

require get_template_directory() . '/inc/template-hooks.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';


/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets/widgets.php';

/**
 * Dynamic Styles
 */
require get_template_directory() . '/css/style.php';


/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Query WooCommerce activation
 */
if ( ! function_exists( 'christmas_shop_is_woocommerce_activated' ) ) {
	
	function christmas_shop_is_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
}

/**
 * Add theme compatibility function for woocommerce if active
*/
if( christmas_shop_is_woocommerce_activated() ){
    require get_template_directory() . '/inc/woocommerce-functions.php';    
}

/**
 * Plugin Recommendation
*/
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';