<?php
/**
 * Christmas Shop Theme Customizer.
 *
 * @package christmas_shop
 */

    $christmas_shop_settings = array( 'info','default', 'home', 'breadcrumb', 'typography'  );

    /* Option list of all post */	
    $christmas_shop_options_posts = array();
    $christmas_shop_options_posts_obj = get_posts('posts_per_page=-1');
    $christmas_shop_options_posts[''] = __( 'Choose Post', 'christmas-shop' );
    foreach ( $christmas_shop_options_posts_obj as $christmas_shop_posts ) {
    	$christmas_shop_options_posts[$christmas_shop_posts->ID] = $christmas_shop_posts->post_title;
    }
    
 	/* Option list of all page */   
    $christmas_shop_options_pages = array();
    $christmas_shop_options_pages_obj = get_pages('posts_per_page=-1');
    $christmas_shop_options_pages[''] = __( 'Choose Page', 'christmas-shop' );
    foreach ( $christmas_shop_options_pages_obj as $christmas_shop_pages ) {
        $christmas_shop_options_pages[$christmas_shop_pages->ID] = $christmas_shop_pages->post_title;
    }

    /* Option list of all categories */
    $christmas_shop_args = array(
	   'type'                     => 'post',
	   'orderby'                  => 'name',
	   'order'                    => 'ASC',
	   'hide_empty'               => 1,
	   'hierarchical'             => 1,
	   'taxonomy'                 => 'category'
    ); 
    $christmas_shop_option_categories = array();
    $christmas_shop_category_lists = get_categories( $christmas_shop_args );
    $christmas_shop_option_categories[''] = __( 'Choose Category', 'christmas-shop' );
    foreach( $christmas_shop_category_lists as $christmas_shop_category ){
        $christmas_shop_option_categories[$christmas_shop_category->term_id] = $christmas_shop_category->name;
    }

	foreach( $christmas_shop_settings as $setting ){
		require get_template_directory() . '/inc/customizer/' . $setting . '.php';
	}

/**
 * Sanitization Functions
*/
require get_template_directory() . '/inc/customizer/sanitization-functions.php';

/**
 * FontAwesome list
*/
require get_template_directory() . '/inc/fontawesome-list.php';

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function christmas_shop_customize_preview_js() {
    wp_enqueue_script( 'christmas_shop_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'christmas_shop_customize_preview_js' );

/**
 * Enqueue Scripts for customize controls
*/
function christmas_shop_customize_scripts() {
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/css/font-awesome.css');   
	wp_enqueue_style( 'christmas_shop-admin-style',get_template_directory_uri().'/inc/css/admin.css', '1.0', 'screen' );    
    wp_enqueue_script( 'christmas_shop-admin-js', get_template_directory_uri().'/inc/js/admin.js', array( 'jquery' ), '', true );
}
add_action( 'customize_controls_enqueue_scripts', 'christmas_shop_customize_scripts' );

