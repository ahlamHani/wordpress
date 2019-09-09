<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Christmas_Shop
 * @since 1.0.0
 * @version 1.0.2
 */

$slider_enable      = get_theme_mod( 'christmas_shop_ed_slider','1' );
$contact_enable  = get_theme_mod( 'christmas_shop_ed_contact_section', '1' );
$welcome_enable     = get_theme_mod( 'christmas_shop_ed_welcome_section','1' );
$blog_enable    = get_theme_mod( 'christmas_shop_ed_blog_section','1' );
$services_enable     = get_theme_mod( 'christmas_shop_ed_service_section', '1' );
$portfolios_enable     = get_theme_mod( 'christmas_shop_ed_portfolio_section', '1' );

get_header(); 
           
    if ( 'posts' == get_option( 'show_on_front' ) ) {
        include( get_home_template() );
    }elseif( $slider_enable || $contact_enable || $welcome_enable || $blog_enable || $services_enable || $portfolios_enable ){ ?>
        
        <?php
        /**
         * Home Page Contents
         * 
         * @hooked christmas_shop_slider     - 10
         * @hooked christmas_shop_contact    - 20
         * @hooked christmas_shop_welcome    - 30
         * @hooked christmas_shop_blog       - 40 
		 * @hooked christmas_shop_service   - 50
		 * @hooked christmas_shop_portfolio - 60
        */
        do_action( 'christmas_shop_home_page' );
        ?>
   
    <?php        
    }else {
        include( get_page_template() );
    }


get_footer();