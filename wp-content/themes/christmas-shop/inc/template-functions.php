<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package christmas_shop
 */


/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function christmas_shop_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'christmas_shop_pingback_header' );


/* Home page */

if( ! function_exists( 'christmas_shop_template_section_header' ) ) :
/**
 * Template Section Header
 * 
 * @since 1.0.1
*/
function christmas_shop_template_header( $section_title ){
    $header_query = new WP_Query( array( 
        'p'         => $section_title,
        'post_type' => 'page'
    ));

        if( $section_title && $header_query->have_posts() ){ 
            while( $header_query->have_posts() ){ $header_query->the_post();
    ?>
                <header class="main-header">
                    <?php 
                        echo '<h1>';
                         the_title();
                         echo '</h2>';
                        echo the_excerpt(); 
                    ?>
                </header>
    <?php   }
        wp_reset_postdata();
        }   

}
endif;

if( ! function_exists( 'christmas_shop_slider' ) ) :
/**
 * Home Page Slider Section
 * 
 * @since 1.0.1
*/
function christmas_shop_slider(){
    global $christmas_shop_default_post;
    
    $slider_enable      = get_theme_mod( 'christmas_shop_ed_slider','1' );
    $slider_caption     = get_theme_mod( 'christmas_shop_slider_caption', '1' );
    $slider_readmore    = get_theme_mod( 'christmas_shop_slider_readmore', __( 'Learn More', 'christmas-shop' ) );
    $slider_contact     = get_theme_mod( 'christmas_shop_slider_contact_text', __( 'Contact Us', 'christmas-shop' ) );
    $slider_contact_url = get_theme_mod( 'christmas_shop_slider_contact_url', '#' );
   
    if( $slider_enable ){

        echo '<section id="banner" class="banner">';
            echo '<div class="fadeout owl-carousel owl-theme clearfix">';
            for( $i=1; $i<=3; $i++){  
                $christmas_shop_slider_post_id = get_theme_mod( 'christmas_shop_slider_post_'.$i, $christmas_shop_default_post ); 
                if( $christmas_shop_slider_post_id ){
                    $qry = new WP_Query ( array( 'p' => $christmas_shop_slider_post_id ) );            

                    if( $qry->have_posts() ){ 

                        while( $qry->have_posts() ){
                        $qry->the_post();

                             ?>
                        
                            <div class="item">
                                <?php 
                                    if( has_post_thumbnail() ){
                                         the_post_thumbnail( 'christmas-shop-slider' ) ; 
                                     }else{
                                        echo '<img src="'. esc_url( get_template_directory_uri() ).'/images/default.png">'; 
                                     }

                                    if( $slider_caption ){ ?>
                                        <div class="banner-text">
                                             <?php the_title('<h1 class="main-title">', '</h1>');
                                             the_excerpt(); ?>                                        

                                            <?php if( $slider_readmore ){ ?> 
                                                <a class="read-more" href="<?php the_permalink(); ?>">
                                                <?php echo esc_html( $slider_readmore );?></a>
                                            <?php } ?>
                                        </div>
                                <?php } ?>
                                
                            </div>

                        <?php 
                        }
                       
                    }

                }
            }
            wp_reset_postdata();  
            echo '</div>';
        echo '</section>';     
    }    
}

endif;

if( ! function_exists( 'christmas_shop_contact' ) ) :
/**
 * Home Page contact Section
 * 
 * @since 1.0.1
*/
function christmas_shop_contact(){
    global $christmas_shop_default_page;
    $contact_enable  = get_theme_mod( 'christmas_shop_ed_contact_section', '1' );
    $contact_page    = get_theme_mod( 'christmas_shop_contact_section_page', $christmas_shop_default_page ); 
    $contact_one     = get_theme_mod( 'christmas_shop_contact_section_button_one', __( 'About Us', 'christmas-shop' ) ); 
    $contact_one_url = get_theme_mod( 'christmas_shop_contact_button_one_url', '#' ); 

    if( $contact_page  && $contact_enable ){
        $qry = new WP_Query ( array( 
            'post_type'     => 'page', 
            'p'             => $contact_page 
        ) );

            if( $qry->have_posts() ){
                while( $qry->have_posts() ){
                    $qry->the_post();
                ?>
               <section id="cta" >
                   
                    <div class="row">
                        <div class="cta-item">
                            <div class="cta-text">
                                <?php 
                                    the_title('<h2 class="main-title">', '</h2>'); 
                                    the_excerpt(); 
                                ?>
                               
                            </div>
                             <?php 
                                    if( $contact_one && $contact_one_url ) { 
                                        echo '<a class="read-more" href="' . esc_url( $contact_one_url ) . '">';
                                            echo esc_html( $contact_one ); 
                                        echo '</a>';
                                    } 
                                ?>
                            </div>
                        </div>
                </section>          
                <?php
                }
            }
        wp_reset_postdata();  
    }    
}

endif;


if( ! function_exists( 'christmas_shop_welcome' ) ) :
/**
 * Home Page welcome Section
 * 
 * @since 1.0.1
*/
function christmas_shop_welcome(){
    global $christmas_shop_default_page;
    
    $welcome_enable     = get_theme_mod( 'christmas_shop_ed_welcome_section','1' );
    $welcome_page       = get_theme_mod( 'christmas_shop_welcome_page', $christmas_shop_default_page ); 
   
    if( $welcome_page  && $welcome_enable ){
        $qry = new WP_Query ( array(  'page_id' => $welcome_page ) );
        echo '<section id="about" class="about">';
                if( $qry->have_posts() ){
                    echo '<div class="row">';
                        while( $qry->have_posts() ){
                            $qry->the_post();
                        ?>
                            <div class="about-item">
                                <?php if( has_post_thumbnail() ){ the_post_thumbnail( 'christmas-shop-welcome' ); } ?>
                                <div class="about-text">
                                    <?php
                                        the_title('<h1 class="main-title">', '</h1>');
                                        echo esc_attr(wp_trim_words(get_the_content(),500,'&hellip;') ) ;
                                    ?>                                   
                                  
                                </div>

                                <a class="read-more" href="<?php the_permalink();?> ">
                                   <?php esc_html_e( 'Read More','christmas-shop'); ?></i>
                                </a>

                            </div>
                            
                        <?php
                        }
                    echo '</div>'; 
                }
                wp_reset_postdata();  
                
        echo '</section>';     
    }    
 
}

endif;

if( ! function_exists( 'christmas_shop_products' ) ) :
/**
 * Home Page welcome Section
 * 
 * @since 1.0.1
*/
function christmas_shop_products(){
global $christmas_shop_default_page;

$products_enable     = get_theme_mod( 'christmas_shop_ed_product_section' );

$featured_product_page  = get_theme_mod('christmas_shop_featured_product_page', $christmas_shop_default_page);  

if( $products_enable ){

echo '<div id="featured-products-section" class="featured-products-section">';
    if($featured_product_page ){
        
        $page_qry = new WP_Query(array(
            'post_type' => 'page',
            'p' => $featured_product_page,
              ));

            if($page_qry->have_posts()){
                while($page_qry->have_posts()){ $page_qry->the_post(); 
                    echo '<header class="main-header">';
                      echo '<h1>';
                        the_title();
                      echo '</h1>';
                        the_excerpt();
                    echo '</header>';
                }
            }
        wp_reset_postdata();
        }

        /** Woocommerce Product*/
        if( christmas_shop_is_woocommerce_activated() ){
            global $product;
            
            echo '<div class="featured-slider owl-carousel owl-theme clearfix">';
            
            for( $i = 1; $i <= 10; $i++ ){
                $christmas_shop_product_post_id = get_theme_mod( 'christmas_shop_product_post_'.$i); 

                    if( $christmas_shop_product_post_id ) {                           
                       
                        $qry = new WP_Query( array( 'post_type' => 'product', 'p' => $christmas_shop_product_post_id ) );


                            if( $qry->have_posts() ){ 
                             $price = get_post_meta( $christmas_shop_product_post_id, '_regular_price', true);
                               
                                while( $qry->have_posts() ){
                                    $qry->the_post();
                                ?>  <div class="item">
                                        <div class="product-holder">
                                            <div class="price">
                                                <div class="arrow-holder">
                                                    <div class="arrow"></div>
                                                </div>
                                                
                                                <div class="price-tag">

                                                <?php $string = wc_price( $price, array() );
                                                      echo wp_kses_post( $string ); ?>
                                                </div>
                                            </div>
                                            <a href="<?php the_permalink(); ?>">
                                                 <?php the_post_thumbnail('christmas-shop-col-four'); ?>
                                            </a>

                                            <div class="products-text">
                                                <a href="<?php the_permalink(); ?>"><h2 class="entry-title"><?php the_title(); ?></h2></a>
                                                    
                                                    <?php echo esc_attr(wp_trim_words(get_the_content(),15,'&hellip;')); ?>
                                            </div>
                                        </div>                    
                                    </div>
                                    
                                <?php
                                }
                            }
                        
                        wp_reset_postdata();  
                    }
                }
            echo '</div>';
        }
        echo '</div>';
    }
} 
endif;

if( ! function_exists( 'christmas_shop_blog' ) ) :
/**
 * Home Page Latest Post Section
 * 
 * @since 1.0.1
*/
function christmas_shop_blog(){
    global $christmas_shop_default_page;
    
    $blog_enable    = get_theme_mod( 'christmas_shop_ed_blog_section','1' );
    $blog_meta      = get_theme_mod( 'christmas_shop_ed_blog_date','1' );
    $blog_title     = get_theme_mod( 'christmas_shop_blog_section_title', $christmas_shop_default_page ); 
    $blog_readmore  = get_theme_mod( 'christmas_shop_blog_section_readmore',__('Read More','christmas-shop') ); 
    $blog_url       = get_theme_mod( 'christmas_shop_blog_section_url','#' ); 
    $blog_category  = get_theme_mod( 'christmas_shop_blog_section_category' ); 
   
    if( $blog_enable ){
        $args = array( 
            'post_type'          => 'post', 
            'post_status'        => 'publish',
            'posts_per_page'     => 3,        
            'ignore_sticky_post' => true  
        );

        if( $blog_category ){
            $args[ 'cat' ] = $blog_category;
        }
        
        $qry = new WP_Query( $args );

        echo '<section id="latest-recipe">';

            if( $blog_title ) {  christmas_shop_template_header( $blog_title ); }
           
                echo '<div class="row">';

                    if( $qry->have_posts() ){ ?>
                        <?php
                        while( $qry->have_posts() ){
                            $qry->the_post();
                        ?>
                            <div class="col-4 ">
                            <div class="recipe-items">
                                <?php
                                    if( has_post_thumbnail() ){ 
                                        the_post_thumbnail( 'christmas-shop-portfolio' ); 
                                    }else{
                                        echo '<img src="'. esc_url( get_template_directory_uri() ).'/images/default-thumb.png">'; 
                                    } 
                                ?>
                                <div class="recipe-text">
                                    <header class="entry-header">
                                        
                                        <a href="<?php the_permalink(); ?>"><?php the_title('<h3 class="entry-title">','</h3>'); ?></a>
                                        <?php if( isset( $blog_meta ) ){ ?>
                                        <div class="entry-meta">
                                            <?php 
                                                christmas_shop_posted_on();
                                            ?>
                                        </div>
                                        <?php } ?>
                                    </header>
                                </div>
                            </div>
                            </div>
                        <?php
                        }
                    }
                    wp_reset_postdata();  
                echo '</div>'; 
                if( $blog_readmore && $blog_url ){ ?>
                    <div class="button-holder">
                        <a class="read-more" href="<?php echo esc_url( $blog_url) ?>"><?php echo esc_html( $blog_readmore );?></a>
                    </div> 
                <?php } 
        echo '</section>';     
    }    
}
endif;

if( ! function_exists( 'christmas_shop_service' ) ) :
/**
 * Home Page Latest Post Section
 * 
 * @since 1.0.1
*/

function christmas_shop_service(){
    global $christmas_shop_default_page;
    global $christmas_shop_default_post;

    $services_enable     = get_theme_mod( 'christmas_shop_ed_service_section', '1' );
    $services_font_icon  = get_theme_mod( 'christmas_shop_ed_service_fontawesome', '1' );
    $services_page       = get_theme_mod( 'christmas_shop_service_section_page', $christmas_shop_default_page ); 

    if( $services_enable ){

        echo '<section id="services" class="services">';
            if( $services_page ) {  christmas_shop_template_header( $services_page ); }
           
                echo '<div class="row">';
                    for( $i = 1; $i <= 6; $i++ ){
                        $christmas_shop_services_post_id = get_theme_mod( 'christmas_shop_service_post_'.$i, $christmas_shop_default_post ); 
                        $christmas_shop_services_page_icon = get_theme_mod( 'christmas_shop_service_icon_'.$i, 'fa-bell');

                            if( $christmas_shop_services_post_id ) {                           
                                $qry = new WP_Query( array( 'p' => $christmas_shop_services_post_id ) );

                                    if( $qry->have_posts() ){ ?>
                                        <?php
                                        while( $qry->have_posts() ){
                                            $qry->the_post();
                                        ?>
                                            <div class="col-4">
                                                <div class="services-item">
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php 
                                                            if( has_post_thumbnail() &&  ! $services_font_icon ){ 
                                                                the_post_thumbnail( 'christmas-shop-services-thumb' ); 
                                                            }else{
                                                                echo '<i class="fa ' . esc_html( $christmas_shop_services_page_icon ) .'"></i>';
                                                            }
                                                        ?>
                                                    </a>
                                                    <div class="services-text">
                                                        <h3 class="main-title"><a href="<?php the_permalink(); ?>"><?php the_title( );?></a> </h3>
                                                            <?php echo esc_attr(wp_trim_words(get_the_content(),15,'&hellip;')); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        <?php
                                        }
                                    }
                                
                                wp_reset_postdata();  
                            }
                        }
                        

                echo '</div>';

        echo '</section>';     
    }    
}
endif;

if( ! function_exists( 'christmas_shop_portfolio' ) ) :
/**
 * Home Page Latest Post Section
 * 
 * @since 1.0.1
*/
function christmas_shop_portfolio(){
    global $christmas_shop_default_post;
    global $christmas_shop_default_page;
    
    $portfolios_enable     = get_theme_mod( 'christmas_shop_ed_portfolio_section', '1' );
    $portfolios_page       = get_theme_mod( 'christmas_shop_portfolio_section_page', $christmas_shop_default_page ); 
    $portfolios_readmore   = get_theme_mod( 'christmas_shop_portfolio_section_readmore',__('Read More','christmas-shop') ); 
    $portfolios_url        = get_theme_mod( 'christmas_shop_portfolio_section_url','#' );
   
    if( $portfolios_enable ){

        echo '<section id="gallery" class="main-gallery">';
                echo '<div class="row">';

                    if( $portfolios_page ) {  christmas_shop_template_header( $portfolios_page ); } 

                    for( $i = 1; $i <= 6; $i++ ){
                        $christmas_shop_portfolio_post_id = get_theme_mod( 'christmas_shop_portfolio_post_'.$i, $christmas_shop_default_post ); 

                        if( $christmas_shop_portfolio_post_id ){
        
                            $qry = new WP_Query( array( 'p' => $christmas_shop_portfolio_post_id ) );                 

                            if( $qry->have_posts() ){ 
                                while( $qry->have_posts() ){
                                    $qry->the_post();

                                    
                                ?>
                                    <div class="col-4">
                                        <div class="main-gallery-item">
                                            <?php 
                                                if( has_post_thumbnail() ){ 
                                                    the_post_thumbnail( 'christmas-shop-portfolio' ); 
                                                }else{
                                                    echo '<img src="'. esc_url( get_template_directory_uri() ).'/images/default-thumb.png">'; 
                                                } ?>
                                            <div class="gallery-mask">
                                            <?php 
                                                the_title('<h2>', '</h2>' );
                                                the_excerpt(); 
                                            ?>
                                                <a href="<?php the_permalink(); ?>" class="read-more"><?php esc_html_e( 'Read More','christmas-shop' );?></a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                <?php
                                    
                                }
                            }
                        wp_reset_postdata();  
                        }
                    }

                    if( $portfolios_readmore && $portfolios_url ){ ?>
                        <div class="about-buttons">
                            <a class="read-more" href="<?php echo esc_url( $portfolios_url) ?>"><?php echo esc_html( $portfolios_readmore );?></a>
                        </div> 
                    <?php }
                echo '</div>';
        echo '</section>';     
    }    

}
endif;

if( ! function_exists( 'christmas_shop_content_image' ) ) :
/**
 * Page Featured Image
 * 
 * @since 1.0.1
*/
function christmas_shop_content_image(){
    $sidebar_layout = christmas_shop_sidebar_layout();
    if( has_post_thumbnail() )
    ( is_active_sidebar( 'right-sidebar' ) && ( $sidebar_layout == 'right-sidebar' ) ) ? the_post_thumbnail( 'christmas-shop-with-sidebar' ) : the_post_thumbnail( 'christmas-shop-without-sidebar' );    
}
endif;

add_action( 'christmas_shop_content_image', 'christmas_shop_content_image' );

  
if( ! function_exists( 'christmas_shop_archive_entry_header' ) ) :
/**
 * Archive Entry Header
 * 
 * @since 1.0.1
*/
function christmas_shop_archive_entry_header(){
    ?>
    <header class="entry-header">
        <div class="entry-meta">
            <?php christmas_shop_posted_on_date(); ?>
        </div><!-- .entry-meta -->
        <h2 class="entry-title"><a href="<?php the_permalink(); ?> "><?php the_title(); ?></a></h2>
    </header>   
    <?php
}
endif;

if( ! function_exists( 'christmas_shop_post_author' ) ) :
/**
 * Post Author Bio
 * 
 * @since 1.0.1
*/
function christmas_shop_post_author(){
    if( get_the_author_meta( 'description' ) ){
        global $post;
    ?>
    <section class="author-section">
        <div class="img-holder"><?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?></div>
            <div class="text-holder">
                <strong class="name"><?php the_author_meta( 'display_name', $post->post_author ); ?></strong>
                <?php the_author_meta( 'description' ); ?>
            </div>
    </section>
    <?php  
    }  
}
endif;
add_action( 'christmas_shop_author_info_box', 'christmas_shop_post_author' );

if( ! function_exists( 'christmas_shop_footer_credit' ) ) :
/**
 * Footer Credits 
 */
function christmas_shop_footer_credit(){
    $copyright_text = get_theme_mod( 'christmas_shop_footer_copyright_text' );
    echo '<div class="footer-b">';
        echo '<div class="site-info">';
            if( $copyright_text ){
                echo wp_kses_post( $copyright_text );
            }else{
            echo '&copy;&nbsp;'. esc_html( date_i18n( 'Y' ), 'christmas-shop' );
            echo ' <a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</a>';
            }
            printf( '&nbsp;%s', '<a href="'. esc_url( __( 'http://prosystheme.com/wordpress-themes/christmas-shop/', 'christmas-shop' ) ) .'" target="_blank">'. esc_html__( 'Christmas Shop By Prosys Theme. ', 'christmas-shop' ) .'</a>' );
            printf( esc_html__( 'Powered by %s', 'christmas-shop' ), '<a href="'. esc_url( __( 'https://wordpress.org/', 'christmas-shop' ) ) .'" target="_blank">'. esc_html__( 'WordPress', 'christmas-shop' ) . '</a>' );
        echo '</div>';
    echo '</div>';
}
endif;

add_action( 'christmas_shop_footer_credit', 'christmas_shop_footer_credit');



