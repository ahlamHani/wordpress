<?php
/**
 * Default Theme Option.
 *
 * @package christmas_shop
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

 
function christmas_shop_customize_register_default( $wp_customize ) {

    if( christmas_shop_is_woocommerce_activated() ){
        /* Option list of all post */ 
        $christmas_shop_options_products = array();
        $christmas_shop_options_products_obj = get_posts('posts_per_page=-1&post_type=product');
        $christmas_shop_options_products[''] = __( 'Choose Product', 'christmas-shop' );
        foreach ( $christmas_shop_options_products_obj as $posts ) {
            $christmas_shop_options_products[$posts->ID] = $posts->post_title;
        }
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
   

    /** Default Settings */    
    $wp_customize->add_panel( 
        'wp_default_panel',
         array(
            'priority' => 10,
            'capability' => 'edit_theme_options',
            'theme_supports' => '',
            'title' => __( 'Default Settings', 'christmas-shop' ),
            'description' => __( 'Default section provided by WordPress customizer.', 'christmas-shop' ),
        ) 
    );
    
    $wp_customize->get_section( 'title_tagline' )->panel     = 'wp_default_panel';
    $wp_customize->get_section( 'colors' )->panel            = 'wp_default_panel';
    $wp_customize->get_section( 'background_image' )->panel  = 'wp_default_panel';
    $wp_customize->get_section( 'static_front_page' )->panel = 'wp_default_panel'; 
    
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'background_color' )->transport = 'refresh';
    $wp_customize->get_setting( 'background_image' )->transport = 'refresh';


    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial( 'blogname', array(
            'selector'        => '.site-title a',
            'render_callback' => 'christmas_shop_customize_partial_blogname',
        ) );
        $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
            'selector'        => '.site-description',
            'render_callback' => 'christmas_shop_customize_partial_blogdescription',
        ) );
    }

    }
add_action( 'customize_register', 'christmas_shop_customize_register_default' );