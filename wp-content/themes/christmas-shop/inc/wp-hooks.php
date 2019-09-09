<?php
/**
 * WP hooks for this theme.
 *
 * @package christmas_shop
 */

/**
 * @see christmas_shop_setup
*/
add_action( 'after_setup_theme', 'christmas_shop_setup' );

/**
 * @see christmas_shop_content_width
*/
add_action( 'after_setup_theme', 'christmas_shop_content_width', 0 );

/**
 * @see christmas_shop_template_redirect_content_width
*/
add_action( 'template_redirect', 'christmas_shop_template_redirect_content_width' );

/**
 * @see christmas_shop_scripts 
*/
add_action( 'wp_enqueue_scripts', 'christmas_shop_scripts' );

/**
 * @see christmas_shop_body_classes
*/
add_filter( 'body_class', 'christmas_shop_body_classes' );

/**
 * @see christmas_shop_category_transient_flusher
*/
add_action( 'edit_category', 'christmas_shop_category_transient_flusher' );
add_action( 'save_post',     'christmas_shop_category_transient_flusher' );

/**
 * Move comment field to the bottm
 * @see christmas_shop_move_comment_field_to_bottom
*/
add_filter( 'comment_form_fields', 'christmas_shop_move_comment_field_to_bottom' );

/**
 * @see christmas_shop_excerpt_more
 * @see christmas_shop_excerpt_length
*/
add_filter( 'excerpt_more', 'christmas_shop_excerpt_more' );
add_filter( 'excerpt_length', 'christmas_shop_excerpt_length', 999 );

/**
 * Dynamic CSS
 * @see christmas_shop_dynamic_css
*/
add_action( 'wp_head', 'christmas_shop_dynamic_css', 99 );