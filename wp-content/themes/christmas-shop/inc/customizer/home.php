<?php
/**
 * Home Page Options
 *
 * @package christmas_shop
 */
 
function christmas_shop_customize_register_home( $wp_customize ) {
    
    global $christmas_shop_options_pages;
    global $christmas_shop_options_posts;
    global $christmas_shop_option_categories;
    global $christmas_shop_default_post;
    global $christmas_shop_default_page;

    if( christmas_shop_is_woocommerce_activated() ){

        /* Option list of all post */ 
        $christmas_shop_options_products = array();
        $christmas_shop_options_products_obj = get_posts('posts_per_page=-1&post_type=product');
        $christmas_shop_options_products[''] = __( 'Choose Product', 'christmas-shop' );
        foreach ( $christmas_shop_options_products_obj as $posts ) {
            $christmas_shop_options_products[$posts->ID] = $posts->post_title;
        }
    }
    

    /** Home Page Settings */
    $wp_customize->add_panel( 
        'christmas_shop_home_page_settings',
         array(
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'title' => __( 'Home Page Settings', 'christmas-shop' ),
            'description' => __( 'Customize Home Page Settings', 'christmas-shop' ),
        ) 
    );
    
     /** Slider Settings */
    $wp_customize->add_section(
        'christmas_shop_slider_section_settings',
        array(
            'title'     => __( 'Slider Settings', 'christmas-shop' ),
            'priority'  => 10,
            'capability' => 'edit_theme_options',
            'panel' => 'christmas_shop_home_page_settings'
        )
    );
   
    /** Enable/Disable Slider */
    $wp_customize->add_setting(
        'christmas_shop_ed_slider',
        array(
            'default' => '1',
            'sanitize_callback' => 'christmas_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_ed_slider',
        array(
            'label' => __( 'Enable Home Page Slider', 'christmas-shop' ),
            'section' => 'christmas_shop_slider_section_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Auto Transition */
    $wp_customize->add_setting(
        'christmas_shop_slider_auto',
        array(
            'default' => '1',
            'sanitize_callback' => 'christmas_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_slider_auto',
        array(
            'label' => __( 'Enable Slider Auto Transition', 'christmas-shop' ),
            'section' => 'christmas_shop_slider_section_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Loop */
    $wp_customize->add_setting(
        'christmas_shop_slider_loop',
        array(
            'default' => '1',
            'sanitize_callback' => 'christmas_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_slider_loop',
        array(
            'label' => __( 'Enable Slider Loop', 'christmas-shop' ),
            'section' => 'christmas_shop_slider_section_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Pager */
    $wp_customize->add_setting(
        'christmas_shop_slider_pager',
        array(
            'default' => '1',
            'sanitize_callback' => 'christmas_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_slider_pager',
        array(
            'label' => __( 'Enable Slider Pager', 'christmas-shop' ),
            'section' => 'christmas_shop_slider_section_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Enable/Disable Slider Caption */
    $wp_customize->add_setting(
        'christmas_shop_slider_caption',
        array(
            'default' => '1',
            'sanitize_callback' => 'christmas_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_slider_caption',
        array(
            'label' => __( 'Enable Slider Caption', 'christmas-shop' ),
            'section' => 'christmas_shop_slider_section_settings',
            'type' => 'checkbox',
        )
    );
        
    /** Slider Animation */
    $wp_customize->add_setting(
        'christmas_shop_slider_animation',
        array(
            'default' => 'slide',
            'sanitize_callback' => 'christmas_shop_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_slider_animation',
        array(
            'label' => __( 'Select Slider Animation', 'christmas-shop' ),
            'section' => 'christmas_shop_slider_section_settings',
            'type' => 'select',
            'choices' => array(
                'fade' => __( 'Fade', 'christmas-shop' ),
                'slide' => __( 'Slide', 'christmas-shop' ),
            )
        )
    );
    
    /** Slider Speed */
    $wp_customize->add_setting(
        'christmas_shop_slider_speeds',
        array(
            'default' => 400,
            'sanitize_callback' => 'christmas_shop_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_slider_speeds',
        array(
            'label' => __( 'Slider Speed', 'christmas-shop' ),
            'section' => 'christmas_shop_slider_section_settings',
            'type' => 'text',
        )
    );
    
    /** Slider Pause */
    $wp_customize->add_setting(
        'christmas_shop_slider_pause',
        array(
            'default' => 6000,
            'sanitize_callback' => 'christmas_shop_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_slider_pause',
        array(
            'label' => __( 'Slider Pause', 'christmas-shop' ),
            'section' => 'christmas_shop_slider_section_settings',
            'type' => 'text',
        )
    );
    
    for( $i=1; $i<=3; $i++){  
        /** Select Slider Post */
        $wp_customize->add_setting(
            'christmas_shop_slider_post_'.$i,
            array(
                'default' => $christmas_shop_default_post,
                'sanitize_callback' => 'christmas_shop_sanitize_select',
            )
        );
        
        $wp_customize->add_control(
            'christmas_shop_slider_post_'.$i,
            array(
                'label' => __( 'Select Post ', 'christmas-shop' ).$i,
                'section' => 'christmas_shop_slider_section_settings',
                'type' => 'select',
                'choices' => $christmas_shop_options_posts,
            )
        );
    }

     /** Slider Readmore */
    $wp_customize->add_setting(
        'christmas_shop_slider_readmore',
        array(
            'default' => __( 'Learn More', 'christmas-shop' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_slider_readmore',
        array(
            'label' => __( 'Readmore Text', 'christmas-shop' ),
            'section' => 'christmas_shop_slider_section_settings',
            'type' => 'text',
        )
    );
    
    /** Slider Settings Ends */

    /** Contact Section Settings */
    $wp_customize->add_section(
        'christmas_shop_contact_section_settings',
        array(
            'title' => __( 'Contact Us Section', 'christmas-shop' ),
            'priority' => 20,
            'capability' => 'edit_theme_options',
            'panel' => 'christmas_shop_home_page_settings'
        )
    );
    
    /** Enable Contact Section */   
    $wp_customize->add_setting(
        'christmas_shop_ed_contact_section',
        array(
            'default' => '1',
            'sanitize_callback' => 'christmas_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_ed_contact_section',
        array(
            'label' => __( 'Enable Contact Us Section', 'christmas-shop' ),
            'section' => 'christmas_shop_contact_section_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Section Title */
    $wp_customize->add_setting(
        'christmas_shop_contact_section_page',
        array(
            'default'=> $christmas_shop_default_page,
            'sanitize_callback'=> 'sanitize_text_field'
            )
        );
    
    $wp_customize-> add_control(
        'christmas_shop_contact_section_page',
        array(
              'label' => __('Select Page','christmas-shop'),
              'type' => 'select',
              'choices' => $christmas_shop_options_pages,
              'section' => 'christmas_shop_contact_section_settings', 
              
            ));
    

    /** CTA First Button */
    $wp_customize->add_setting(
        'christmas_shop_contact_section_button_one',
        array(
            'default'=> __( 'About Us', 'christmas-shop' ),
            'sanitize_callback'=> 'sanitize_text_field'
            )
        );
    
    $wp_customize-> add_control(
        'christmas_shop_contact_section_button_one',
        array(
              'label' => __('CTA First Button','christmas-shop'),
              'section' => 'christmas_shop_contact_section_settings', 
              'type' => 'text',
            ));

    /** CTA First Button Link */
    $wp_customize->add_setting(
        'christmas_shop_contact_button_one_url',
        array(
            'default'=> '#',
            'sanitize_callback'=> 'esc_url_raw'
            )
        );
    
     $wp_customize-> add_control(
        'christmas_shop_contact_button_one_url',
        array(
              'label' => __('CTA First Button Link','christmas-shop'),
              'section' => 'christmas_shop_contact_section_settings', 
              'type' => 'text',
            ));

    /** Welcome Section Settings */
    $wp_customize->add_section(
        'christmas_shop_welcome_section_settings',
        array(
            'title' => __( 'Welcome Section', 'christmas-shop' ),
            'priority' => 30,
            'capability' => 'edit_theme_options',
            'panel' => 'christmas_shop_home_page_settings'
        )
    );
    
    /** Enable Welcome Section */   
    $wp_customize->add_setting(
        'christmas_shop_ed_welcome_section',
        array(
            'default' => '1',
            'sanitize_callback' => 'christmas_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_ed_welcome_section',
        array(
            'label' => __( 'Enable Welcome Section', 'christmas-shop' ),
            'section' => 'christmas_shop_welcome_section_settings',
            'type' => 'checkbox',
        )
    );

    /** Welcome Content */
    $wp_customize->add_setting(
        'christmas_shop_welcome_page',
        array(
            'default'=> $christmas_shop_default_page,
            'sanitize_callback'=> 'christmas_shop_sanitize_select'
            )
        );
    
    $wp_customize->add_control(
        'christmas_shop_welcome_page',
        array(
              'label' => __('Select Page','christmas-shop'),
              'type' => 'select',
              'choices' => $christmas_shop_options_pages,
              'section' => 'christmas_shop_welcome_section_settings', 
              
            ));
    
    /** welcome Section Ends */

    /** Blog Section Settings */
    $wp_customize->add_section(
        'christmas_shop_blog_section_settings',
        array(
            'title' => __( 'Blog Section', 'christmas-shop' ),
            'priority' => 40,
            'capability' => 'edit_theme_options',
            'panel' => 'christmas_shop_home_page_settings'
        )
    );
    
   /** Enable Blog Section */
    $wp_customize->add_setting(
        'christmas_shop_ed_blog_section',
        array(
            'default' => '1',
            'sanitize_callback' => 'christmas_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_ed_blog_section',
        array(
            'label' => __( 'Enable Blog Section', 'christmas-shop' ),
            'section' => 'christmas_shop_blog_section_settings',
            'type' => 'checkbox',
        )
    );
    
    /** Show/Hide Blog Date */
    $wp_customize->add_setting(
        'christmas_shop_ed_blog_date',
        array(
            'default' => '1',
            'sanitize_callback' => 'christmas_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_ed_blog_date',
        array(
            'label' => __( 'Show Posts Date, Author, Comment, Category', 'christmas-shop' ),
            'section' => 'christmas_shop_blog_section_settings',
            'type' => 'checkbox',
        )
    );
     
    /** Blog Section Title */
    $wp_customize->add_setting(
        'christmas_shop_blog_section_title',
        array(
            'default'=> $christmas_shop_default_page,
            'sanitize_callback'=> 'sanitize_text_field'
        ));
    
    $wp_customize-> add_control(
        'christmas_shop_blog_section_title',
        array(
              'label' => __('Select Page','christmas-shop'),
              'type' => 'select',
              'choices' => $christmas_shop_options_pages,
              'section' => 'christmas_shop_blog_section_settings', 
          
        ));

    /** Select Blog Category */
    $wp_customize->add_setting(
        'christmas_shop_blog_section_category',
        array(
            'default' => '',
            'sanitize_callback' => 'christmas_shop_sanitize_select',
        ));
    
    $wp_customize->add_control(
        'christmas_shop_blog_section_category',
        array(
            'label' => __( 'Select Blogs Category', 'christmas-shop' ),
            'section' => 'christmas_shop_blog_section_settings',
            'type' => 'select',
            'choices' => $christmas_shop_option_categories
        ));

    /** Blog Section Read More Text */
    $wp_customize->add_setting(
        'christmas_shop_blog_section_readmore',
        array(
            'default' => __( 'Read More', 'christmas-shop' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_blog_section_readmore',
        array(
            'label' => __( 'Blog Section Read More Text', 'christmas-shop' ),
            'section' => 'christmas_shop_blog_section_settings',
            'type' => 'text',
        )
    );

    /** Blog Section Read More Url */
    $wp_customize->add_setting(
        'christmas_shop_blog_section_url',
        array(
            'default' => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_blog_section_url',
        array(
            'label' => __( 'Blog Page url', 'christmas-shop' ),
            'section' => 'christmas_shop_blog_section_settings',
            'type' => 'text',
        )
    );
    /** Blog Section Ends */
    
    /* Featured Product Section*/
     $wp_customize-> add_section(
        'christmas_shop_featured_product_settings',
        array(
            'title'=> __('Featured Product Section','christmas-shop'),
            'priority'=> 30,
            'panel'=> 'christmas_shop_home_page_settings'
            )
        );

    /** Enable/Disable featured_dish Section */
    $wp_customize->add_setting(
        'christmas_shop_ed_product_section',
        array(
            'default' => '',
            'sanitize_callback' => 'christmas_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_ed_product_section',
        array(
            'label' => __( 'Enable Featured Product Section', 'christmas-shop' ),
            'section' => 'christmas_shop_featured_product_settings',
            'type' => 'checkbox',
            'description' => __( 'Please Enable Woocommerce to display items in Featured Products.', 'christmas-shop'),
        )
    );
    
    /*select page for Product section*/
    $wp_customize->add_setting(
        'christmas_shop_featured_product_page',
        array(
            'default' => $christmas_shop_default_page,
            'sanitize_callback' => 'christmas_shop_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_featured_product_page',
        array(
            'label' => __( 'Select Page', 'christmas-shop' ),
            'section' => 'christmas_shop_featured_product_settings',
            'type' => 'select',
            'choices' => $christmas_shop_options_pages,
        )
    );

   if( christmas_shop_is_woocommerce_activated() ){
    
        for( $i=1; $i<=10; $i++){  
            /** Select Slider Post */
            $wp_customize->add_setting(
                'christmas_shop_product_post_'.$i,
                array(
                    'default' => '',
                    'sanitize_callback' => 'christmas_shop_sanitize_select',
                )
            );
            
            $wp_customize->add_control(
                'christmas_shop_product_post_'.$i,
                array(
                    'label' => __( 'Select Product ', 'christmas-shop' ).$i,
                    'section' => 'christmas_shop_featured_product_settings',
                    'type' => 'select',
                    'choices' => $christmas_shop_options_products,
                )
            );
        }
    
    }
    
    /** Services Section Settings */
    $wp_customize->add_section(
        'christmas_shop_service_section_settings',
        array(
            'title' => __( 'Services Section', 'christmas-shop' ),
            'priority' => 50,
            'capability' => 'edit_theme_options',
            'panel' => 'christmas_shop_home_page_settings'
        )
    );
    
   /** Enable Services Section */
    $wp_customize->add_setting(
        'christmas_shop_ed_service_section',
        array(
            'default' => '1',
            'sanitize_callback' => 'christmas_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_ed_service_section',
        array(
            'label' => __( 'Enable Services Section', 'christmas-shop' ),
            'section' => 'christmas_shop_service_section_settings',
            'type' => 'checkbox',
        )
    );

    /** Show/Hide Services Font Awesome */
    $wp_customize->add_setting(
        'christmas_shop_ed_service_fontawesome',
        array(
            'default' => '1',
            'sanitize_callback' => 'christmas_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_ed_service_fontawesome',
        array(
            'label' => __( 'Show Font Icon', 'christmas-shop' ),
            'section' => 'christmas_shop_service_section_settings',
            'description' => __( 'Display font icon and hide thumbnail.', 'christmas-shop' ),
            'type' => 'checkbox',
        )
    );

    /** Section Title */
    $wp_customize->add_setting(
        'christmas_shop_service_section_page',
        array(
            'default'=> $christmas_shop_default_page,
            'sanitize_callback'=> 'sanitize_text_field'
            )
        );
    
    $wp_customize-> add_control(
        'christmas_shop_service_section_page',
        array(
              'label' => __('Select Page','christmas-shop'),
              'type' => 'select',
              'choices' => $christmas_shop_options_pages,
              'section' => 'christmas_shop_service_section_settings', 
            
            ));
    
    for( $i=1; $i<=6; $i++){  
    
        /** Services Post */
        $wp_customize->add_setting(
            'christmas_shop_service_post_'.$i,
            array(
                'default' => $christmas_shop_default_post,
                'sanitize_callback' => 'christmas_shop_sanitize_select',
            ));
        
        $wp_customize->add_control(
            'christmas_shop_service_post_'.$i,
            array(
                'label' => __( 'Select Service Post ', 'christmas-shop' ) .$i ,
                'section' => 'christmas_shop_service_section_settings',
                'type' => 'select',
                'choices' => $christmas_shop_options_posts
            ));
        

        $wp_customize->add_setting(
            'christmas_shop_service_icon_'.$i,
            array(
                'default'           => 'fa fa-bell',
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage'
            )
        );

        $wp_customize->add_control(
            new Christmas_Shop_Fontawesome_Icon_Chooser(
            $wp_customize,
            'christmas_shop_service_icon_'.$i,
                array(
                    'settings'      => 'christmas_shop_service_icon_'.$i,
                    'section'       => 'christmas_shop_service_section_settings',
                    'label'         => __( 'FontAwesome Icon ', 'christmas-shop' ) .$i,
                )
            )
        );
    }
    

    /** Portfolio Section Settings */
    $wp_customize->add_section(
        'christmas_shop_portfolio_section_settings',
        array(
            'title' => __( 'Portfolio Section', 'christmas-shop' ),
            'priority' => 60,
            'capability' => 'edit_theme_options',
            'panel' => 'christmas_shop_home_page_settings'
        )
    );
    
    /** Enable Portfolio Section */
    $wp_customize->add_setting(
        'christmas_shop_ed_portfolio_section',
        array(
            'default' => '1',
            'sanitize_callback' => 'christmas_shop_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_ed_portfolio_section',
        array(
            'label' => __( 'Enable Portfolio Section', 'christmas-shop' ),
            'section' => 'christmas_shop_portfolio_section_settings',
            'type' => 'checkbox',
        )
    );

    /** Section Title */
    $wp_customize->add_setting(
        'christmas_shop_portfolio_section_page',
        array(
            'default'=> $christmas_shop_default_page,
            'sanitize_callback'=> 'sanitize_text_field'
            )
        );
    
    $wp_customize-> add_control(
        'christmas_shop_portfolio_section_page',
        array(
              'label' => __('Select Page','christmas-shop'),
              'type' => 'select',
              'choices' => $christmas_shop_options_pages,
              'section' => 'christmas_shop_portfolio_section_settings', 
              
        ));


    for( $i=1; $i<=6; $i++){  
        /** Portfolio Post */
        $wp_customize->add_setting(
            'christmas_shop_portfolio_post_'.$i,
            array(
                'default' => $christmas_shop_default_post,
                'sanitize_callback' => 'christmas_shop_sanitize_select',
            ));
        
        $wp_customize->add_control(
            'christmas_shop_portfolio_post_'.$i,
            array(
                'label' => __( 'Select Post ', 'christmas-shop' ). $i,
                'section' => 'christmas_shop_portfolio_section_settings',
                'type' => 'select',
                'choices' => $christmas_shop_options_posts
            ));
    }
    
    /** Portfolio Section Read More Text */
    $wp_customize->add_setting(
        'christmas_shop_portfolio_section_readmore',
        array(
            'default' => __( 'Read More', 'christmas-shop' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_portfolio_section_readmore',
        array(
            'label' => __( 'Portfolio Section Read More Text', 'christmas-shop' ),
            'section' => 'christmas_shop_portfolio_section_settings',
            'type' => 'text',
        )
    );

    /** Portfolio Section Read More Url */
    $wp_customize->add_setting(
        'christmas_shop_portfolio_section_url',
        array(
            'default' => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
        'christmas_shop_portfolio_section_url',
        array(
            'label' => __( 'Portfolio Page url', 'christmas-shop' ),
            'section' => 'christmas_shop_portfolio_section_settings',
            'type' => 'text',
        )
    );


}
add_action( 'customize_register', 'christmas_shop_customize_register_home' );
