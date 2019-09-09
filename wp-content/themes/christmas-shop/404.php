<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package christmas_shop
 */

get_header(); ?>
	<section class="error-404 not-found">
			<h1><?php esc_html_e( 'HO HO HO!', 'christmas-shop' ); ?></h1>
			<h1><?php esc_html_e( '404!', 'christmas-shop' ); ?></h1>
			<h2><?php esc_html_e( 'The requested page cannot be found', 'christmas-shop' ); ?></h2>
			<p><?php esc_html_e( 'Sorry but the page you are looking for cannot be found. Take a moment and do a search below or start from our', 'christmas-shop' ); ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'homepage.', 'christmas-shop' ); ?></a></p>
			<?php
				get_search_form();
			?>
	</section><!-- .error-404 -->
<?php
get_footer();
