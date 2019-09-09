<?php

/**
 * Template Name: Home Page
 *
 * @package christmas_shop
 */

get_header();

     /**
     * Home Page Contents
     * 
     * @hooked christmas_shop_slider     - 10
     * @hooked christmas_shop_contact    - 20
     * @hooked christmas_shop_welcome    - 30
     * @hooked christmas_shop_blog       - 40 
	 * @hooked christmas_shop_service    - 50
	 * @hooked christmas_shop_portfolio  - 60
    */
    do_action( 'christmas_shop_home_page' );

get_footer();