<?php
/**
 * Dynamic Styles
*/

function christmas_shop_dynamic_css(){
    
    $color_scheme = get_theme_mod( 'christmas_shop_color_scheme', '#386FA7' );

    $typhography_scheme = get_theme_mod( 'christmas_shop_typography', 'Dancing+Script' );
    switch ( $typhography_scheme ) {
    	case 'Oswald':
    		$font_family = 'Oswald';
            $font_family_fallback = 'Cursive';
    		break;

		case 'Open+Sans':
			$font_family = 'opens Sans';
            $font_family_fallback = 'sans-serif';
		break;
    	
    	default:
    		$font_family = 'Oswald';
            $font_family_fallback = 'Oswald';
    		break;
    }

    
    echo "<style type='text/css' media='all'>"; 
    	
		echo 'body, button, input, select, optgroup, textarea , .content-area .post .entry-content table th, .content-area .page .entry-content table th, .widget-area .widget-title{ font-family: "'.  esc_html( $font_family ) .'" , '. esc_html( $font_family_fallback ) .' } ';
    
    echo "</style>";
}
