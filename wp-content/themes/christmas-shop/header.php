<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package christmas-shop
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<div id ="snow"></div>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'christmas-shop' ); ?></a>
	<div class="container">
	<header id="masthead" class="site-header">
		<div class="header-top">
			<div class="site-branding">
	            <?php 
	                if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
	                          the_custom_logo();
	                      } 
	            ?>
	                <div class="text-logo">
	                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	                  <?php
	                        $description = get_bloginfo( 'description', 'display' );
	                        if ( $description || is_customize_preview() ) { ?>
	                          <p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
	                  <?php } ?>
	                </div>  
	        </div><!-- .site-branding -->
	    </div>
	    
        <div class="header-bottom">
			<div id="mobile-header">
			    <a id="responsive-menu-button" href="#sidr-main">
			    	<i class="fa fa-bars"></i>
			    </a>
			</div>
			<nav id="site-navigation" class="main-navigation" /*role="navigation"*/>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
	        </nav><!-- #site-navigation -->
	    </div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
