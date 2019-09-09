<?php
/**
 * Breadcrumbs Options
 *
 * @package christmas_shop
 */
 
function christmas_shop_customize_register_breadcrumbs( $wp_customize ) {

    /** BreadCrumb Settings */
    
    $wp_customize->add_section(
        'christmas_shop_breadcrumb_settings',
        array(
            'title' => __( 'Breadcrumb Settings', 'christmas-shop' ),
            'priority' => 50,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Enable/Disable BreadCrumb */
    $wp_customize->add_setting(
        'christmas_shop_ed_breadcrumb',
        array(
            'default' => '',
            'sanitize_callback' => 'christmas_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_ed_breadcrumb',
        array(
            'label' => __( 'Enable Breadcrumb', 'christmas-shop' ),
            'section' => 'christmas_shop_breadcrumb_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Show/Hide Current */
    $wp_customize->add_setting(
        'christmas_shop_ed_current',
        array(
            'default' => '1',
            'sanitize_callback' => 'christmas_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_ed_current',
        array(
            'label' => __( 'Show current', 'christmas-shop' ),
            'section' => 'christmas_shop_breadcrumb_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Home Text */
    $wp_customize->add_setting(
        'christmas_shop_breadcrumb_home_text',
        array(
            'default' => __( 'Home', 'christmas-shop' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_breadcrumb_home_text',
        array(
            'label' => __( 'Breadcrumb Home Text', 'christmas-shop' ),
            'section' => 'christmas_shop_breadcrumb_settings',
            'type' => 'text',
        )
    );
    
    /** Breadcrumb Separator */
    $wp_customize->add_setting(
        'christmas_shop_breadcrumb_separator',
        array(
            'default' => '>',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_breadcrumb_separator',
        array(
            'label' => __( 'Breadcrumb Separator', 'christmas-shop' ),
            'section' => 'christmas_shop_breadcrumb_settings',
            'type' => 'text',
        )
    );
    /** BreadCrumb Settings Ends */
    
    }
add_action( 'customize_register', 'christmas_shop_customize_register_breadcrumbs' );
