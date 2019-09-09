<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package christmas_shop
 */

if( ! function_exists( 'christmas_shop_categories' ) ) :
/**
 * Function that list categories
*/
function christmas_shop_categories( $blog = false ){
    
    $categories_list = get_the_category_list( esc_html( ', ' ) ); 
    if ( $categories_list && christmas_shop_categorized_blog() ) {
        printf( '<span class="category">' . esc_html( '%1$s' ) . '</span>', $categories_list ); // WPCS: XSS OK.
    }
}
endif;

if( ! function_exists( 'christmas_shop_comments' ) ) :
/**
 * Function that list categories
*/
function christmas_shop_comments( $blog = false ){

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'christmas-shop' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}
}
endif;


if ( ! function_exists( 'christmas_shop_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function christmas_shop_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);

		echo '<span class="posted-on"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></span><span class="byline"><span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span></span>'; // WPCS: XSS OK.

	}
endif;



if ( ! function_exists( 'christmas_shop_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function christmas_shop_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'christmas-shop' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'christmas-shop' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'christmas-shop' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;


if( ! function_exists( 'christmas_shop_sidebar_layout' ) ) :
/**
 * Return sidebar layouts for pages
 */
function christmas_shop_sidebar_layout(){
    global $post;
    
    if( get_post_meta( $post->ID, 'christmas_shop_sidebar_layout', true ) ){
        return get_post_meta( $post->ID, 'christmas_shop_sidebar_layout', true );    
    }else{
        return 'right-sidebar';
    }
    
}
endif;



if( ! function_exists( ' christmas_shop_get_the_archive_title' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function  christmas_shop_get_the_archive_title( $title ){

    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = get_the_author() ;
    }	else {
    	$title = ( single_month_title(' ',false) ); 
    }
return $title;
}
endif;
add_filter( 'get_the_archive_title', 'christmas_shop_get_the_archive_title' );

if( ! function_exists( 'christmas_shop_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function christmas_shop_change_comment_form_default_fields( $fields ){
    
    // get the current commenter if available
    $commenter = wp_get_current_commenter();
 
    // core functionality
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );    
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><input id="author" name="author" placeholder="' . esc_attr__( 'Name*', 'christmas-shop' ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><input id="email" name="email" placeholder="' . esc_attr__( 'Email*', 'christmas-shop' ) . '" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'christmas-shop' ) . '" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;
    
}
endif;
add_filter( 'comment_form_default_fields', 'christmas_shop_change_comment_form_default_fields' );

if( ! function_exists( 'christmas_shop_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function christmas_shop_change_comment_form_defaults( $defaults ){
    
    // Change the "cancel" to "I would rather not comment" and use a span instead
    $defaults['comment_field'] = '<p class="comment-form-comment"><label for="comment"></label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'christmas-shop' ) . '" cols="45" rows="8" aria-required="true"></textarea></p>';
    
    $defaults['label_submit'] = esc_attr__( 'Submit', 'christmas-shop' );
    
    return $defaults;
    
}
endif;
add_filter( 'comment_form_defaults', 'christmas_shop_change_comment_form_defaults' );



/* Homepage Section End*/

if( ! function_exists( 'christmas_shope_breadcrumbs_cb' ) ) :
/**
 * App Landing Page Breadcrumb
 * 
 * @since 1.0.1
*/

function christmas_shop_breadcrumbs_cb() {

    $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter = esc_html( get_theme_mod( 'christmas_shop_breadcrumb_separator', '>' ) ); // delimiter between crumbs
    $home = esc_html( get_theme_mod( 'christmas_shop_breadcrumb_home_text', __( 'Home', 'christmas-shop' ) ) ); // text for the 'Home' link
    $showCurrent = get_theme_mod( 'christmas_shop_ed_current', '1' ); // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $before = '<span class="current">'; // tag before the current crumb
    $after = '</span>'; // tag after the current crumb
    
    global $post;
    $homeLink = home_url();
    
    if ( is_front_page() ) {
    
        if ( $showOnHome == 1 ) echo '<div id="crumbs"><a href="' . esc_url( $homeLink ) . '">' . esc_html( $home ) . '</a></div>';
    
    } else {
    
        echo '<div id="crumbs"><a href="' . esc_url( $homeLink ) . '">' . esc_html( $home ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
    
        if ( is_category() ) {
            $thisCat = get_category( get_query_var( 'cat' ), false );
            if ( $thisCat->parent != 0 ) echo get_category_parents( $thisCat->parent, TRUE, ' <span class="separator">' . esc_html( $delimiter ) . '</span> ' );
            echo $before .  esc_html( single_cat_title( '', false ) ) . $after;
        
        } elseif ( is_search() ) {
            echo $before . esc_html__( 'Search Results for "', 'christmas-shop' ) . esc_html( get_search_query() ) . '"' . $after;
        
        } elseif ( is_day() ) {
            echo '<a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . esc_html( get_the_time( 'Y' ) ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
            echo '<a href="' . esc_url( get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) ) . '">' . esc_html( get_the_time( 'F' ) ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
            echo $before . esc_html( get_the_time( 'd' ) ) . $after;
        
        } elseif ( is_month() ) {
            echo '<a href="' . esc_url( get_year_link( get_the_time( 'Y' ) ) ) . '">' . esc_html( get_the_time( 'Y' ) ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
            echo $before . esc_html( get_the_time( 'F' ) ) . $after;
        
        } elseif ( is_year() ) {
            echo $before . esc_html( get_the_time( 'Y' ) ) . $after;
    
        } elseif ( is_single() && !is_attachment() ) {
            if ( christmas_shop_is_woocommerce_activated() && 'product' === get_post_type() ) {
                if ( $terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
                    $main_term = apply_filters( 'woocommerce_breadcrumb_main_term', $terms[0], $terms );
                    $ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
                    $ancestors = array_reverse( $ancestors );
                    foreach ( $ancestors as $ancestor ) {
                        $ancestor = get_term( $ancestor, 'product_cat' );    
                        if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                            echo '<a href="' . esc_url( get_term_link( $ancestor ) ) . '">' . esc_html( $ancestor->name ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span>';
                        }
                    }
                    echo '<a href="' . esc_url( get_term_link( $main_term ) ) . '">' . esc_html( $main_term->name ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span>';
                }
                if ( $showCurrent == 1 ) echo  $before . esc_html( get_the_title() ) . $after;
            }elseif ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a href="' . esc_url( $homeLink . '/' . $slug['slug'] ) . '/">' . esc_html( $post_type->labels->singular_name ) . '</a>';
                if ( $showCurrent == 1 ) echo ' <span class="separator">' . esc_html( $delimiter ) . '</span> ' . $before . esc_html( get_the_title() ) . $after;
            } else {
                $cat = get_the_category(); 
                if( $cat ){
                    $cat = $cat[0];
                    $cats = get_category_parents( $cat, TRUE, ' <span class="separator">' . esc_html( $delimiter ) . '</span> ' );
                    if ( $showCurrent == 0 ) $cats = preg_replace( "#^(.+)\s$delimiter\s$#", "$1", $cats );
                    echo $cats;
                }
                if ( $showCurrent == 1 ) echo $before . esc_html( get_the_title() ) . $after;
            }
        
        } elseif( christmas_shop_is_woocommerce_activated() && ( is_product_category() || is_product_tag() ) ){
            
            $current_term = $GLOBALS['wp_query']->get_queried_object();
            if( is_product_category() ){
                $ancestors = get_ancestors( $current_term->term_id, 'product_cat' );
                $ancestors = array_reverse( $ancestors );
            foreach ( $ancestors as $ancestor ) {
              $ancestor = get_term( $ancestor, 'product_cat' );    
              if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                echo '<a href="' . esc_url( get_term_link( $ancestor ) ) . '">' . esc_html( $ancestor->name ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
              }
            }
            }           
            if ( $showCurrent == 1 ) echo $before . esc_html( $current_term->name ) . $after;
        
        } elseif( christmas_shop_is_woocommerce_activated() && is_shop() ){
            if ( get_option( 'page_on_front' ) == wc_get_page_id( 'shop' ) ) {
            return;
          }
          $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
        
          if ( ! $_name ) {
            $product_post_type = get_post_type_object( 'product' );
            $_name = $product_post_type->labels->singular_name;
          }
            if ( $showCurrent == 1 ) echo $before . esc_html( $_name ) . $after;
        
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . esc_html( $post_type->labels->singular_name ) . $after;
        
        } elseif ( is_attachment() ) {
            $parent = get_post( $post->post_parent );
            $cat = get_the_category( $parent->ID ); 
            if( $cat ){
                $cat = $cat[0];
                echo get_category_parents( $cat, TRUE, ' <span class="separator">' . esc_html( $delimiter ) . '</span> ');
                echo '<a href="' . esc_url( get_permalink( $parent ) ) . '">' . esc_html( $parent->post_title ) . '</a>' . ' <span class="separator">' . esc_html( $delimiter ) . '</span> ';
            }
            if ( $showCurrent == 1 ) echo  $before . esc_html( get_the_title() ) . $after;
        
        } elseif ( is_page() && !$post->post_parent ) {
            if ( $showCurrent == 1 ) echo $before . esc_html( get_the_title() ) . $after;
    
        } elseif ( is_page() && $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while( $parent_id ){
                $page = get_page( $parent_id );
                $breadcrumbs[] = '<a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . esc_html( get_the_title( $page->ID ) ) . '</a>';
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse( $breadcrumbs );
            for ( $i = 0; $i < count( $breadcrumbs) ; $i++ ){
                echo $breadcrumbs[$i];
                if ( $i != count( $breadcrumbs ) - 1 ) echo ' <span class="separator">' . esc_html( $delimiter ) . '</span> ';
            }
            if ( $showCurrent == 1 ) echo ' <span class="separator">' . esc_html( $delimiter ) . '</span> ' . $before . esc_html( get_the_title() ) . $after;
        
        } elseif ( is_tag() ) {
            echo $before . esc_html( single_tag_title( '', false ) ) . $after;
        
        } elseif ( is_author() ) {
            global $author;
            $userdata = get_userdata( $author );
            echo $before . esc_html( $userdata->display_name ) . $after;
        
        } elseif ( is_404() ) {
            echo $before . esc_html__( 'Error 404', 'christmas-shop' ) . $after;
        
        } elseif( is_home() ){
            echo $before;
                single_post_title();
            echo $after;
            }
    
        echo '</div>';
    
    }
} // end christmas_shop_breadcrumbs()
endif;

add_action( 'christmas_shop_breadcrumbs', 'christmas_shop_breadcrumbs_cb');
