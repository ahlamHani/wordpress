<?php

 /**
 * Template hooks for this theme.
 *
 * @package Christmas_Shop
 */


/**
 * Home Page Contents
 * 
 * @see christmas_shop_slider     - 10
 * @see christmas_shop_contact    - 20
 * @see christmas_shop_welcome    - 30
 * @see christmas_shop_blog       - 40 
 * @see christmas_shop_service    - 50
 * @see christmas_shop_portfolio  - 60
*/
add_action( 'christmas_shop_home_page', 'christmas_shop_slider', 10 );
add_action( 'christmas_shop_home_page', 'christmas_shop_contact', 20 );
add_action( 'christmas_shop_home_page', 'christmas_shop_welcome', 30 );
add_action( 'christmas_shop_home_page', 'christmas_shop_products', 35 );

add_action( 'christmas_shop_home_page', 'christmas_shop_blog', 40 );
add_action( 'christmas_shop_home_page', 'christmas_shop_service', 50 );
add_action( 'christmas_shop_home_page', 'christmas_shop_portfolio', 60 );