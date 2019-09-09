<?php
/**
 * Typography Options
 *
 * @package christmas_shop
 */
 
function christmas_shop_customize_register_typography_scheme( $wp_customize ) {
    
    /** Typography Settings */
    $wp_customize->add_section(
        'christmas_shop_typography_settings',
        array(
            'title'       => __( 'Typography Settings', 'christmas-shop' ),
            'description' => __( 'Choose typography scheme for theme.', 'christmas-shop' ),
            'priority'    => 60,
            'capability'  => 'edit_theme_options',
        )
    );
      
    /** Section Title */
    $wp_customize->add_setting(
        'christmas_shop_typography',
        array(
            'default'=> 'Dancing+Script',
            'sanitize_callback'=> 'sanitize_text_field'
            )
        );
    $wp_customize-> add_control(
        'christmas_shop_typography',
        array(
              'label' => __('Select Font','christmas-shop'),
              'type' => 'select',
              'section' => 'christmas_shop_typography_settings', 
              'choices' => array(
                'Oswald' => __('Oswald', 'christmas-shop'),
                'Open+Sans'=> __( 'Open Sans', 'christmas-shop'),
                'Dancing+Script' => __( 'Dancing Script', 'christmas-shop')
              ),
         
    ));
    
}
add_action( 'customize_register', 'christmas_shop_customize_register_typography_scheme' );