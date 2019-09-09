<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package christmas-shop
 */

		if( ! is_page_template( 'template-home.php' ) ){ 
				echo '</div>'; // .row	
		}


?>			
	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php if( is_active_sidebar( 'footer-one' ) || is_active_sidebar( 'footer-two' ) || is_active_sidebar( 'footer-three' ) ){ ?>
			<div class="widget-area">
            
				<div class="row">
					
                    <?php if( is_active_sidebar( 'footer-one' ) ){ ?>
                    <div class="col-4">
						<?php dynamic_sidebar( 'footer-one' ); ?>
					</div>
					<?php } ?>
                    
                    <?php if( is_active_sidebar( 'footer-two' ) ){ ?>
                    <div class="col-4">
						<?php dynamic_sidebar( 'footer-two' ); ?>
					</div>
                    <?php } ?>
					
                    <?php if( is_active_sidebar( 'footer-three' ) ){ ?>
                    <div class="col-4">
						<?php dynamic_sidebar( 'footer-three' ); ?>
					</div>
                    <?php } ?>
                    
				</div><!-- .row -->
			
			</div><!-- .widget-area -->
		<?php } 
			do_action( 'christmas_shop_footer_credit' ); ?>
		
	</footer><!-- #colophon -->
	</div><!-- .container -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

