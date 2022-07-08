<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Get_Outdoors
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'get-outdoors' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				

				<p class="go-back-home"> <?php esc_html_e( 'Please go back to the home.', 'get-outdoors' ) ?> </p>

				<a class="home-link" href="<?php echo get_home_url(); ?>"><?php esc_html_e( 'Home', 'get-outdoors' ) ?></a>

 
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'get-outdoors' ); ?></p>

				<?php
				get_search_form();
				?>

			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
